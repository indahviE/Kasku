<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;

class KasController extends Controller
{
    // ==================== KAS MASUK (DASHBOARD) ====================

    public function viewKasMasuk()
    {
        $totalMasuk = Pembayaran::sum('jml_bayar') ?? 0;
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;
        $saldoAwal = 1000000;
        $saldoKas = $totalMasuk - $totalKeluar;
        $saldoAkhir = $saldoAwal + $saldoKas;
        $jumlahTransaksi = Pembayaran::count() + Pengeluaran::count();

        return view('bendahara.kas_masuk', compact(
            'totalMasuk', 'totalKeluar', 'saldoKas',
            'saldoAwal', 'saldoAkhir', 'jumlahTransaksi'
        ));
    }

    public function createKasMasuk()
    {
        return view('bendahara.kas_masuk_create');
    }

    public function editKasMasuk()
    {
        return view('bendahara.kas_masuk_edit');
    }

    public function storeKasMasuk(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tagihan_id' => 'nullable|exists:tagihan,id',
            'jml_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'metode' => 'required|in:tunai,transfer',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaFile = '-';
        if ($request->hasFile('bukti_bayar')) {
            $pathBukti = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');
            $namaFile = basename($pathBukti);
        }

        Pembayaran::create([
            'user_id' => $request->user_id,
            'tagihan_id' => $request->tagihan_id,
            'jml_bayar' => $request->jml_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'metode' => $request->metode,
            'status' => 'lunas',
            'dicatat_oleh' => auth()->id(),
            'bukti_bayar' => $namaFile,
        ]);

        return redirect()->route('bendahara.kas_masuk')->with('success', 'Kas masuk berhasil ditambahkan.');
    }

    public function updateKasMasuk(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tagihan_id' => 'nullable|exists:tagihan,id',
            'jml_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'metode' => 'required|in:tunai,transfer',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        
        $namaFile = $pembayaran->bukti_bayar;
        if ($request->hasFile('bukti_bayar')) {
            $pathBukti = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');
            $namaFile = basename($pathBukti);
        }

        $pembayaran->update([
            'user_id' => $request->user_id,
            'tagihan_id' => $request->tagihan_id,
            'jml_bayar' => $request->jml_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'metode' => $request->metode,
            'bukti_bayar' => $namaFile,
        ]);

        return redirect()->route('bendahara.kas_masuk')->with('success', 'Kas masuk berhasil diupdate.');
    }

    public function verifikasiKasMasuk(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status' => $request->status, // 'lunas' or 'ditolak'
            'dicatat_oleh' => auth()->id(), // Bendahara yang verifikasi
        ]);

        $message = $request->status == 'lunas' ? 'Pembayaran berhasil diverifikasi (Lunas).' : 'Pembayaran ditolak.';
        return redirect()->back()->with('success', $message);
    }

    public function deleteKasMasuk($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('bendahara.kas_masuk')->with('success', 'Kas masuk berhasil dihapus.');
    }


    // ==================== KAS KELUAR ====================

    public function viewKasKeluar()
    {
        $totalKeluar = Pengeluaran::sum('nominal') ?? 0;
        $pengeluaran = Pengeluaran::latest()->get();

        return view('bendahara.kas_keluar', compact('pengeluaran', 'totalKeluar'));
    }

    public function createKasKeluar()
    {
        return view('bendahara.kas_keluar_create');
    }

    public function editKasKeluar()
    {
        return view('bendahara.kas_keluar_edit');
    }

    public function storeKasKeluar(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

        Pengeluaran::create([
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'dicatat_oleh' => auth()->id(),
            'kelas_id' => auth()->user()->kelas_id ?? \App\Models\Kelas::first()->id,
        ]);

        return redirect()->route('bendahara.kas_keluar')->with('success', 'Kas keluar berhasil ditambahkan.');
    }

    public function updateKasKeluar(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

        Pengeluaran::findOrFail($id)->update([
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('bendahara.kas_keluar')->with('success', 'Kas keluar berhasil diupdate.');
    }

    public function deleteKasKeluar($id)
    {
        Pengeluaran::findOrFail($id)->delete();

        return redirect()->route('bendahara.kas_keluar')->with('success', 'Kas keluar berhasil dihapus.');
    }
}