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
            'jml_bayar' => 'required|numeric',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('kas_masuk')->with('success', 'Kas masuk berhasil ditambahkan.');
    }

    public function updateKasMasuk(Request $request, $id)
    {
        $request->validate([
            'jml_bayar' => 'required|numeric',
        ]);

        Pembayaran::findOrFail($id)->update($request->all());

        return redirect()->route('kas_masuk')->with('success', 'Kas masuk berhasil diupdate.');
    }

    public function deleteKasMasuk(Request $request)
    {
        $id = $request->input('id');
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('kas_masuk')->with('success', 'Kas masuk berhasil dihapus.');
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
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('kas_keluar')->with('success', 'Kas keluar berhasil ditambahkan.');
    }

    public function updateKasKeluar(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric',
        ]);

        Pengeluaran::findOrFail($id)->update($request->all());

        return redirect()->route('kas_keluar')->with('success', 'Kas keluar berhasil diupdate.');
    }

    public function deleteKasKeluar(Request $request)
    {
        $id = $request->input('id');
        Pengeluaran::findOrFail($id)->delete();

        return redirect()->route('kas_keluar')->with('success', 'Kas keluar berhasil dihapus.');
    }
}