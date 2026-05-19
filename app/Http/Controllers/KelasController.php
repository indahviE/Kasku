<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'tahun_ajaran' => 'required|string|max:10',
            'code_prefix' => 'required|string|max:50'
        ]);

        // Generate code dengan prefix custom
        $code = $this->generateUniqueCode($request->code_prefix);

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

    public function updateKelas(Request $request, int $id)
    {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id,
            'tahun_ajaran' => 'required|string|max:10'
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ter-update');
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Cek apakah kelas punya user/siswa
        if ($kelas->users()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus kelas yang masih memiliki siswa');
        }

        $kelas->delete();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus');
    }

    /**
     * Generate unique code dengan custom prefix
     * @param string $prefix - Prefix dari admin (contoh: XI-RPL)
     * @return string - Kode lengkap (contoh: XI-RPL-A7K2)
     */
    public function generateUniqueCode(string $prefix): string
    {
        // Clean prefix: remove trailing dash
        $prefix = rtrim($prefix, '-');

        do {
            // Generate 4 karakter random (2 huruf + 2 digit)
            $suffix = strtoupper(
                Str::random(2) .     // 2 huruf random
                rand(10, 99)         // 2 digit random
            );

            // Gabungkan: prefix + dash + suffix
            $code = $prefix . '-' . $suffix;
        } while (Kelas::where('code', $code)->exists());

        return $code;
    }

    /**
     * Regenerate code dengan prefix yang sama
     * @param string $oldCode - Kode lama (contoh: XI-RPL-A7K2)
     * @return string - Kode baru dengan prefix sama (contoh: XI-RPL-M5K8)
     */
    public function regenerateCode(string $oldCode): string
    {
        // Extract prefix dari kode lama
        // Contoh: dari "XI-RPL-A7K2" ambil "XI-RPL"
        $parts = explode('-', $oldCode);

        if (count($parts) < 2) {
            return $this->generateUniqueCode('KELAS');
        }

        // Ambil semua bagian kecuali yang terakhir (yang terakhir adalah suffix)
        $prefix = implode('-', array_slice($parts, 0, -1));

        // Generate kode baru dengan prefix yang sama
        return $this->generateUniqueCode($prefix);
    }
}
