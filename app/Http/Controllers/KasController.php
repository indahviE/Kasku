<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Storage;

class KasController extends Controller
{
    // =========================
    // KAS MASUK - CREATE
    // =========================
    public function createKasMasuk()
    {
        $siswaList = \App\Models\User::where('role', 'siswa')->get();
        $tagihanList = Tagihan::latest()->get();
        return view('bendahara.kas_masuk.create', compact('siswaList', 'tagihanList'));
    }

    // =========================
    // KAS MASUK - STORE
    // =========================
public function storeKasMasuk(Request $request)
{
    $request->validate([
        'user_id'       => 'required|exists:users,id',
        'tagihan_id'    => 'nullable|exists:tagihan,id',
        'jml_bayar'     => 'required|numeric|min:1',
        'tanggal_bayar' => 'required|date',
        'metode'        => 'required|in:tunai,transfer',
        'bukti_bayar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $namaFile = null;
    if ($request->hasFile('bukti_bayar')) {
        $pathBukti = $request->file('bukti_bayar')
            ->store('bukti_pembayaran', 'public');
        $namaFile = basename($pathBukti);
    }

    Pembayaran::create([
        'user_id'       => $request->user_id,
        'tagihan_id'    => $request->tagihan_id,
        'jml_bayar'     => $request->jml_bayar,
        'tanggal_bayar' => $request->tanggal_bayar,
        'metode'        => $request->metode,
        'status'        => 'lunas', // ✅ LANGSUNG LUNAS
        'bukti_bayar'   => $namaFile,
    ]);

    return redirect()
        ->route('bendahara.kas_masuk')
        ->with('success', 'Kas masuk berhasil dicatat & diverifikasi.');
}

    // =========================
    // KAS MASUK - EDIT
    // =========================
    public function editKasMasuk($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $siswaList = \App\Models\User::where('role', 'siswa')->get();
        $tagihanList = Tagihan::latest()->get();
        return view('bendahara.kas_masuk.edit', compact('pembayaran', 'siswaList', 'tagihanList'));
    }

    // =========================
    // KAS MASUK - UPDATE
    // =========================
public function updateKasMasuk(Request $request, $id)
{
    $request->validate([
        'user_id'       => 'required|exists:users,id',
        'tagihan_id'    => 'nullable|exists:tagihan,id',
        'jml_bayar'     => 'required|numeric|min:1',
        'tanggal_bayar' => 'required|date',
        'metode'        => 'required|in:tunai,transfer',
        'bukti_bayar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // ✅ OPTIONAL
    ]);

    $pembayaran = Pembayaran::findOrFail($id);

    $namaFile = $pembayaran->bukti_bayar; // Keep old file

if ($request->hasFile('bukti_bayar')) {
    // Hapus file lama (optional)
    if ($pembayaran->bukti_bayar) {
        @unlink(public_path('storage/bukti_pembayaran/' . $pembayaran->bukti_bayar));
    }

    $pathBukti = $request->file('bukti_bayar')
        ->store('bukti_pembayaran', 'public');
    $namaFile = basename($pathBukti);
}

    $pembayaran->update([
        'user_id'       => $request->user_id,
        'tagihan_id'    => $request->tagihan_id,
        'jml_bayar'     => $request->jml_bayar,
        'tanggal_bayar' => $request->tanggal_bayar,
        'metode'        => $request->metode,
        'bukti_bayar'   => $namaFile, // ✅ Bisa null
    ]);

    return redirect()
        ->route('bendahara.kas_masuk')
        ->with('success', 'Kas masuk berhasil diperbarui.');
}

    // =========================
    // KAS MASUK - DELETE
    // =========================
    public function deleteKasMasuk($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()
            ->route('bendahara.kas_masuk')
            ->with('success', 'Kas masuk berhasil dihapus.');
    }

    // =========================
    // KAS MASUK - VERIFIKASI
    // =========================
    public function verifikasiKasMasuk(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:lunas,ditolak'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => $request->status
        ]);

        $pesan = $request->status == 'lunas'
            ? 'Pembayaran berhasil diverifikasi dan diterima.'
            : 'Pembayaran ditolak.';

        return redirect()
            ->route('bendahara.kas_masuk')
            ->with('success', $pesan);
    }

    // =========================
    // KAS KELUAR - CREATE
    // =========================
    public function createKasKeluar()
    {
        return view('bendahara.kas_keluar.create');
    }

    // =========================
    // KAS KELUAR - STORE
    // =========================
    public function storeKasKeluar(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'nominal'    => 'required|numeric|min:1',
            'tanggal'    => 'required|date'
        ]);

        Pengeluaran::create([
            'keterangan' => $request->keterangan,
            'nominal'    => $request->nominal,
            'tanggal'    => $request->tanggal
        ]);

        return redirect()
            ->route('bendahara.kas_keluar')
            ->with('success', 'Kas keluar berhasil dicatat.');
    }

    // =========================
    // KAS KELUAR - EDIT
    // =========================
    public function editKasKeluar($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('bendahara.kas_keluar.edit', compact('pengeluaran'));
    }

    // =========================
    // KAS KELUAR - UPDATE
    // =========================
    public function updateKasKeluar(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'nominal'    => 'required|numeric|min:1',
            'tanggal'    => 'required|date'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'keterangan' => $request->keterangan,
            'nominal'    => $request->nominal,
            'tanggal'    => $request->tanggal
        ]);

        return redirect()
            ->route('bendahara.kas_keluar')
            ->with('success', 'Kas keluar berhasil diperbarui.');
    }

    // =========================
    // KAS KELUAR - DELETE
    // =========================
    public function deleteKasKeluar($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()
            ->route('bendahara.kas_keluar')
            ->with('success', 'Kas keluar berhasil dihapus.');
    }
}
