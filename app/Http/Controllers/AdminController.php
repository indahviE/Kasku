<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    // ========== DASHBOARD & USER MANAGEMENT ==========

    /**
     * Dashboard Admin - Existing method
     */
    public function dashboard(Request $request)
    {
        $totalMasuk = Pembayaran::where('status', 'lunas')->sum('jml_bayar');
        $totalKeluar = Pengeluaran::sum('nominal');
        $saldoKeseluruhan = $totalMasuk - $totalKeluar;
        $jumlahKelas = Kelas::count();

        // List user
        $roleFilter = $request->get('role');
        $query = User::with('kelas');
        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }
        $users = $query->paginate(6);
        $roles = ['admin', 'bendahara', 'siswa', 'wali_kelas'];

        // Grafik per bulan (tahun ini)
        $tahun = date('Y');

        $grafikMasuk = Pembayaran::where('status', 'lunas')
            ->whereYear('tanggal_bayar', $tahun)
            ->selectRaw('MONTH(tanggal_bayar) as bulan, SUM(jml_bayar) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $grafikKeluar = Pengeluaran::whereYear('tanggal', $tahun)
            ->selectRaw('MONTH(tanggal) as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $dataMasuk = [];
        $dataKeluar = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataMasuk[]  = $grafikMasuk[$i]  ?? 0;
            $dataKeluar[] = $grafikKeluar[$i] ?? 0;
        }

        return view('admin.index', [
            'totalMasuk'       => $totalMasuk,
            'totalKeluar'      => $totalKeluar,
            'saldoKeseluruhan' => $saldoKeseluruhan,
            'jumlahKelas'      => $jumlahKelas,
            'users'            => $users,
            'roles'            => $roles,
            'roleFilter'       => $roleFilter,
            'dataMasuk'        => $dataMasuk,
            'dataKeluar'       => $dataKeluar,
        ]);
    }

    /**
     * Generate Class Code - Existing method
     */
    public function generateClassCode(int $id)
    {
        $kelas = Kelas::findOrFail($id);
        $oldCode = $kelas->code;
        $newCode = $this->generateNewCode();

        $kelas->update(['code' => $newCode]);

        return redirect()->route('kelas')->with('success', "Kode kelas diperbarui dari $oldCode menjadi $newCode");
    }

    /**
     * Generate new code - Existing private method
     */
    private function generateNewCode()
    {
        do {
            $code = strtoupper(Str::random(6));
        } while (Kelas::where('code', $code)->exists());

        return $code;
    }

    // ========== KELOLA TRANSAKSI - NEW FEATURES ==========

    /**
     * List semua transaksi dengan filter
     */
    public function daftarTransaksi(Request $request)
    {
        $tahun = date('Y');

        // Ambil pembayaran lunas sebagai transaksi masuk
        $masuk = Pembayaran::with(['siswa'])
            ->where('status', 'lunas')
            ->get()
            ->map(fn($p) => [
                'tipe'      => 'masuk',
                'nominal'   => $p->jml_bayar,
                'tanggal'   => $p->tanggal_bayar,
                'keterangan'=> 'Pembayaran kas - ' . $p->metode,
                'user'      => $p->siswa,
                'kelas'     => null,
            ]);

        // Ambil pengeluaran sebagai transaksi keluar
        $keluar = Pengeluaran::with(['kelas'])
            ->get()
            ->map(fn($p) => [
                'tipe'      => 'keluar',
                'nominal'   => $p->nominal,
                'tanggal'   => $p->tanggal,
                'keterangan'=> $p->keterangan,
                'user'      => null,
                'kelas'     => $p->kelas,
            ]);

        // Gabung dan urutkan by tanggal terbaru
        $transaksi = $masuk->concat($keluar)->sortByDesc('tanggal')->values();
        // Manual pagination
        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $items = $transaksi->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $transaksi = new LengthAwarePaginator(
            $items,
            $transaksi->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        // Saldo
        $totalMasuk  = Pembayaran::where('status', 'lunas')->sum('jml_bayar');
        $totalKeluar = Pengeluaran::sum('nominal');
        $saldo       = $totalMasuk - $totalKeluar;

        // Grafik per bulan
        $grafikMasuk = Pembayaran::where('status', 'lunas')
            ->whereYear('tanggal_bayar', $tahun)
            ->selectRaw('MONTH(tanggal_bayar) as bulan, SUM(jml_bayar) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $grafikKeluar = Pengeluaran::whereYear('tanggal', $tahun)
            ->selectRaw('MONTH(tanggal) as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $dataMasuk = $dataKeluar = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataMasuk[]  = $grafikMasuk[$i]  ?? 0;
            $dataKeluar[] = $grafikKeluar[$i] ?? 0;
        }

        return view('admin.data-transaksi', compact(
            'transaksi',
            'totalMasuk', 'totalKeluar', 'saldo',
            'dataMasuk', 'dataKeluar'
        ));
    }


    /**
     * Simpan transaksi baru
     */
    public function simpanTransaksi(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'user_id' => 'required|exists:users,id',
            'tipe_transaksi' => 'required|in:masuk,keluar',
            'kategori' => 'required|string|max:100',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:500',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_file')) {
            $file = $request->file('bukti_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_transaksi', $filename, 'public');
            $validated['bukti_file'] = 'bukti_transaksi/' . $filename;
        }

        $validated['disetujui_oleh'] = null;
        $validated['status'] = 'pending';

        Transaksi::create($validated);

        return redirect()->route('admin.daftar-transaksi')
            ->with('success', 'Transaksi berhasil ditambahkan dan menunggu persetujuan');
    }

    /**
     * Form edit transaksi
     */
    public function editTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Hanya bisa edit jika masih pending
        if ($transaksi->status !== 'pending') {
            return redirect()->route('admin.daftar-transaksi')
                ->with('error', 'Hanya transaksi pending yang bisa diedit');
        }

        $kelas = Kelas::all();
        $user = User::where('role', 'siswa')->get();

        return view('admin.edit-transaksi', compact('transaksi', 'kelas', 'user'));
    }

    /**
     * Update transaksi
     */
    public function updateTransaksi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return redirect()->route('admin.daftar-transaksi')
                ->with('error', 'Hanya transaksi pending yang bisa diubah');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'user_id' => 'required|exists:users,id',
            'tipe_transaksi' => 'required|in:masuk,keluar',
            'kategori' => 'required|string|max:100',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:500',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_file')) {
            // Hapus file lama jika ada
            if ($transaksi->bukti_file && file_exists(storage_path('app/public/' . $transaksi->bukti_file))) {
                unlink(storage_path('app/public/' . $transaksi->bukti_file));
            }

            $file = $request->file('bukti_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_transaksi', $filename, 'public');
            $validated['bukti_file'] = 'bukti_transaksi/' . $filename;
        }

        $transaksi->update($validated);

        return redirect()->route('admin.daftar-transaksi')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Hapus transaksi (hanya bisa hapus pending)
     */
    public function hapusTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return redirect()->route('admin.daftar-transaksi')
                ->with('error', 'Hanya transaksi pending yang bisa dihapus');
        }

        // Hapus file bukti jika ada
        if ($transaksi->bukti_file && file_exists(storage_path('app/public/' . $transaksi->bukti_file))) {
            unlink(storage_path('app/public/' . $transaksi->bukti_file));
        }

        $transaksi->delete();

        return redirect()->route('admin.daftar-transaksi')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    /**
     * Approve transaksi
     */
    public function approveTransaksi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Transaksi ini sudah diproses'], 400);
        }

        $transaksi->update([
            'status' => 'approved',
            'disetujui_oleh' => Auth::id(),
            'catatan_admin' => $request->input('catatan_admin')
        ]);

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil disetujui']);
    }

    /**
     * Reject transaksi
     */
    public function rejectTransaksi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Transaksi ini sudah diproses'], 400);
        }

        $validated = $request->validate([
            'catatan_admin' => 'required|string|min:5|max:500'
        ]);

        $transaksi->update([
            'status' => 'rejected',
            'disetujui_oleh' => Auth::id(),
            'catatan_admin' => $validated['catatan_admin']
        ]);

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil ditolak']);
    }

    /**
     * Detail transaksi
     */
    public function detailTransaksi($id)
    {
        $transaksi = Transaksi::with(['user', 'kelas', 'approvedBy'])->findOrFail($id);
        return view('admin.detail-transaksi', compact('transaksi'));
    }

    /**
     * Export transaksi ke CSV
     */
    public function exportTransaksi(Request $request)
    {
        $query = Transaksi::with(['user', 'kelas']);

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe_transaksi', $request->tipe);
        }

        if ($request->has('dari_tanggal') && $request->dari_tanggal != '') {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->has('sampai_tanggal') && $request->sampai_tanggal != '') {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $transaksi = $query->orderBy('tanggal', 'desc')->get();

        $filename = 'laporan_transaksi_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://memory', 'r+');

        // Header CSV
        fputcsv($handle, ['No', 'Tanggal', 'Tipe', 'Kategori', 'Nominal', 'Kelas', 'User', 'Status']);

        // Data
        foreach ($transaksi as $key => $row) {
            fputcsv($handle, [
                $key + 1,
                $row->tanggal->format('d-m-Y'),
                ucfirst($row->tipe_transaksi),
                $row->kategori,
                $row->nominal,
                $row->kelas->nama ?? '-',
                $row->user->name ?? '-',
                ucfirst($row->status)
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response()->streamDownload(
            function () use ($csv) {
                echo $csv;
            },
            $filename,
            ['Content-Type' => 'text/csv']
        );
    }

    /**
     * Statistik transaksi
     */
    public function statistikTransaksi(Request $request)
    {
        $dari = $request->input('dari_tanggal', date('Y-m-01'));
        $sampai = $request->input('sampai_tanggal', date('Y-m-d'));

        $stats = [
            'total_masuk' => Transaksi::where('tipe_transaksi', 'masuk')
                ->where('status', 'approved')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->sum('nominal'),
            'total_keluar' => Transaksi::where('tipe_transaksi', 'keluar')
                ->where('status', 'approved')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->sum('nominal'),
            'jumlah_masuk' => Transaksi::where('tipe_transaksi', 'masuk')
                ->where('status', 'approved')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->count(),
            'jumlah_keluar' => Transaksi::where('tipe_transaksi', 'keluar')
                ->where('status', 'approved')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->count(),
            'pending' => Transaksi::where('status', 'pending')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->count(),
            'rejected' => Transaksi::where('status', 'rejected')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->count(),
        ];

        // Data per kategori
        $per_kategori = Transaksi::select('kategori')
            ->selectRaw('SUM(nominal) as total, COUNT(*) as jumlah')
            ->where('status', 'approved')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->groupBy('kategori')
            ->get();

        // Data per kelas
        $per_kelas = Transaksi::join('kelas', 'transaksi.kelas_id', '=', 'kelas.id')
            ->select('kelas.nama')
            ->selectRaw('SUM(transaksi.nominal) as total, COUNT(*) as jumlah')
            ->where('transaksi.status', 'approved')
            ->whereBetween('transaksi.tanggal', [$dari, $sampai])
            ->groupBy('kelas.id', 'kelas.nama')
            ->get();

        return view('admin.statistik-transaksi', compact('stats', 'per_kategori', 'per_kelas', 'dari', 'sampai'));
    }
}
