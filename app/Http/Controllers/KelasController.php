<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function listKelas()
    {
        $kelas = Kelas::withCount('users')->paginate(5);
        return view('admin.kelas', ['kelas' => $kelas]);
    }
    public function createKelas()
    {
        return view('admin.create');
    }
    public function storeKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'tahun_ajaran' => 'required|string|max:10'
        ]);

        $code = Kelas::generateUniqueCode();

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'code' => $code,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);
        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan. Kode: ' . $code);
    }
    public function editKelas(Request $request)
    {
        $id = $request->get('id');
        $kelas = Kelas::findOrFail($id);
        return view('admin.update', ['kelas' => $kelas]);
    }
    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas' . $id,
            'tahun_ajaran' => 'required|string|max:10'
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);
        return redirect()->route('kelas')->with('succes', 'Kelas berhasil ter-update');
    }
}
