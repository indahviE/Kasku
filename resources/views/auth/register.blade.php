<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Kasku</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-100 min-h-screen overflow-hidden">

    <div class="grid lg:grid-cols-2 min-h-screen" 
         x-data="{ 
            email: '{{ old('email') }}',
            get showKodeKelas() {
                let e = this.email.toLowerCase().trim();
                return e.endsWith('@siswa.com') || e.endsWith('@guru.com') || e.endsWith('@bendahara.com');
            },
            get labelCodeKelas() {
                let e = this.email.toLowerCase().trim();
                if (e.endsWith('@siswa.com')) return 'Kode Kelas (Siswa)';
                if (e.endsWith('@guru.com')) return 'Kode Kelas (Guru)';
                if (e.endsWith('@bendahara.com')) return 'Kode Kelas (Bendahara)';
                return 'Kode Kelas';
            }
         }">

        {{-- LEFT SIDE DESKTOP --}}
        <div class="hidden lg:flex flex-col justify-between bg-black text-white p-14 relative overflow-hidden">

            <div class="flex items-center justify-between w-full">
                <h1 class="text-2xl font-bold text-white">
                    Kasku
                </h1>
                <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-xs font-semibold">
                    1 WEBSITE KAS KELAS
                </div>
            </div>
            
            <div class="relative z-10 max-w-xl">
                <h2 class="text-6xl font-bold leading-tight">
                    Get Started.
                </h2>
                <p class="mt-6 text-zinc-400 text-xl leading-relaxed">
                    Create an account to simplify your classroom finance management with Kasku.
                </p>
            </div>

            <div class="flex gap-3">
                <div class="w-3 h-3 rounded-full bg-zinc-700"></div>
                <div class="w-3 h-3 rounded-full bg-white"></div>
                <div class="w-3 h-3 rounded-full bg-zinc-700"></div>
            </div>

            {{-- Decoration --}}
            <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-zinc-800"></div>
            <div class="absolute top-10 right-10 w-24 h-24 rounded-full border border-zinc-700"></div>
        </div>


        {{-- RIGHT SIDE --}}
        <div class="flex items-center justify-center px-6 py-10 lg:px-20 bg-zinc-100 overflow-y-auto max-h-screen">

            <div class="w-full max-w-md my-auto">

                {{-- MOBILE LOGO --}}
                <div class="lg:hidden flex items-center gap-4 mb-10">
                    <div class="w-14 h-14 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-2xl">
                        K
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">
                            Kasku
                        </h1>
                        <p class="text-zinc-500">
                            Classroom Finance Dashboard
                        </p>
                    </div>
                </div>

                {{-- HEADING --}}
                <div class="mb-8">
                    <h2 class="text-5xl font-bold text-black">
                        Register
                    </h2>
                    <p class="text-zinc-500 mt-3 text-lg">
                        Manage your class finance smartly.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- NAME --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="name" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name" 
                            placeholder="Enter your full name" 
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="email" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="email" 
                            name="email" 
                            x-model="email" 
                            required 
                            autocomplete="username" 
                            placeholder="Enter your email" 
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- KODE KELAS (DYNAMIC VIA ALPINE.JS) --}}
                    <div x-show="showKodeKelas" x-transition style="display: none;">
                        <x-input-label for="code" ::value="labelCodeKelas" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="code" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="text" 
                            name="code" 
                            :value="old('code')" 
                            ::required="showKodeKelas" 
                            placeholder="Masukkan kode kelas Anda" 
                        />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    {{-- NOMOR HP (KHUSUS SISWA VIA ALPINE.JS) --}}
                    <div x-show="email.toLowerCase().trim().endsWith('@siswa.com')" x-transition style="display: none;">
                        <x-input-label for="no_hp" :value="__('Nomor HP')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="no_hp" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="text" 
                            name="no_hp" 
                            :value="old('no_hp')" 
                            ::required="email.toLowerCase().trim().endsWith('@siswa.com')" 
                            placeholder="Contoh: 081234567890" 
                        />
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>

                    {{-- NISN (KHUSUS SISWA VIA ALPINE.JS) --}}
                    <div x-show="email.toLowerCase().trim().endsWith('@siswa.com')" x-transition style="display: none;">
                        <x-input-label for="nis" :value="__('NIS')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="nis" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="text" 
                            name="nis" 
                            :value="old('nis')" 
                            ::required="email.toLowerCase().trim().endsWith('@siswa.com')" 
                            placeholder="Masukkan NIS Anda" 
                        />
                        <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="password" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password" 
                            placeholder="Create a password" 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-2 text-zinc-700" />
                        <x-text-input 
                            id="password_confirmation" 
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" 
                            placeholder="Confirm your password" 
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <button
                        type="submit"
                        class="w-full bg-black text-white py-4 rounded-2xl font-semibold text-lg hover:opacity-90 transition mt-2"
                    >
                        Register
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-sm text-zinc-600">
                            Already registered? 
                            <a href="{{ route('login') }}" class="font-semibold text-black hover:underline transition">
                                Login here
                            </a>
                        </p>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>