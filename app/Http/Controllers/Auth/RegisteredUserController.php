<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa; // 1. Model Siswa di-import untuk create profil otomatis
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Menyusun Aturan Validasi Utama
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'code' => ['required', 'string'], 
        ];

        // Ambil email untuk pengecekan kondisi sebelum validasi dijalankan
        $emailInput = strtolower(trim($request->email));

        // Tambahkan aturan validasi no_hp dan nis secara dinamis KHUSUS jika domain email adalah @siswa.com
        if (str_ends_with($emailInput, '@siswa.com')) {
            $rules['no_hp'] = ['required', 'string', 'max:20'];
            $rules['nis']  = ['required', 'string'];
        }

        // Jalankan Validasi gabungan
        $request->validate($rules);

        $email = $request->email;
        $role = '';

        // 2. Deteksi & Kunci Role Berdasarkan Domain Email
        if (str_ends_with($email, '@siswa.com')) {
            $role = 'siswa';
        } elseif (str_ends_with($email, '@guru.com')) {
            $role = 'guru';
        } elseif (str_ends_with($email, '@bendahara.com')) {
            $role = 'bendahara';
        } else {
            throw ValidationException::withMessages([
                'email' => 'Pendaftaran gagal. Email wajib menggunakan domain @siswa.com, @guru.com, atau @bendahara.com',
            ]);
        }

        // 3. Cek Apakah Kode Kelas Valid di Database
        $kelas = Kelas::where('code', $request->code)->first();

        if (!$kelas) {
            throw ValidationException::withMessages([
                'code' => 'Kode kelas tidak ditemukan! Silakan periksa kembali.',
            ]);
        }

        // 4. Daftarkan User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'kelas_id' => $kelas->id, 
        ]);

        // 5. Generate Profil Siswa Otomatis Beserta Input no_hp dan nisn dari Frontend
        if ($role === 'siswa') {
            Siswa::create([
                'user_id'  => $user->id,
                'kelas_id' => $kelas->id,
                'no_hp'    => $request->no_hp, // Diambil dari input dynamic frontend
                'nis'     => $request->nis,  // Diambil dari input dynamic frontend
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect berdasarkan role masing-masing
        if ($user->role === 'siswa') {
            return redirect()->route('siswa.index');
        } elseif ($user->role === 'bendahara') {
            return redirect()->route('bendahara.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        return redirect('/');
    }
}