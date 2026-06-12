<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
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
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'code' => ['required', 'string'], 
        ];

        $emailInput = strtolower(trim($request->email));

        if (str_ends_with($emailInput, '@siswa.com')) {
            $rules['no_hp'] = ['required', 'string', 'max:20'];
            $rules['nis']  = ['required', 'string'];
        }

        if (str_ends_with($emailInput, '@walikelas.com')) {
            $rules['nip'] = ['required', 'string'];
            $rules['no_hp_walkel'] = ['required', 'string', 'max:20'];
        }

        $request->validate($rules);

        $role = '';

        if (str_ends_with($emailInput, '@siswa.com')) {
            $role = 'siswa';
        } elseif (str_ends_with($emailInput, '@guru.com')) {
            $role = 'guru';
        } elseif (str_ends_with($emailInput, '@bendahara.com')) {
            $role = 'bendahara';
        } elseif (str_ends_with($emailInput, '@walikelas.com')) {
            $role = 'wali_kelas';
        } else {
            throw ValidationException::withMessages([
                'email' => 'Pendaftaran gagal. Email wajib menggunakan domain @siswa.com, @guru.com, @bendahara.com, atau @walikelas.com',
            ]);
        }

        $kelas = Kelas::where('code', $request->code)->first();

        if (!$kelas) {
            throw ValidationException::withMessages([
                'code' => 'Kode kelas tidak ditemukan! Silakan periksa kembali.',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $emailInput,
            'password' => Hash::make($request->password),
            'role' => $role,
            'kelas_id' => $kelas->id, 
        ]);

        if ($role === 'siswa') {
            Siswa::create([
                'user_id'  => $user->id,
                'kelas_id' => $kelas->id,
                'no_hp'    => $request->no_hp,
                'nis'      => $request->nis,
            ]);
        }

        if ($role === 'wali_kelas') {
            WaliKelas::create([
                'user_id'  => $user->id,
                'kelas_id' => $kelas->id,
                'nip'      => $request->nip,
                'no_hp'    => $request->no_hp_walkel, 
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'siswa') {
            return redirect()->route('siswa.index');
        } elseif ($user->role === 'bendahara') {
            return redirect()->route('bendahara.dashboard');
        } elseif ($user->role === 'wali_kelas') {
            return redirect()->route('wali.dashboard'); 
        } elseif ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        return redirect('/');
    }
}