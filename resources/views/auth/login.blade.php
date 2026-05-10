<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Kasku</title>
        <script src="https://cdn.tailwindcss.com"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-100 min-h-screen overflow-hidden">

    <div class="grid lg:grid-cols-2 min-h-screen">

        {{-- LEFT SIDE DESKTOP --}}
        <div class="hidden lg:flex flex-col justify-between bg-black text-white p-14 relative overflow-hidden">

           <div class="flex items-center justify-between w-full">

    <h1 class="text-2xl font-bold text-white">
        Kasku
    </h1>

    <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-xs font-semibold">
        #1 WEBSITE KAS KELAS
    </div>

</div>
        
        


            <div class="relative z-10 max-w-xl">
                <h2 class="text-6xl font-bold leading-tight">
                    Welcome Back.
                </h2>

                <p class="mt-6 text-zinc-400 text-xl leading-relaxed">
                    Login to continue using Kasku AI tools and your smart workspace.
                </p>
            </div>

            <div class="flex gap-3">
                <div class="w-3 h-3 rounded-full bg-white"></div>
                <div class="w-3 h-3 rounded-full bg-zinc-700"></div>
                <div class="w-3 h-3 rounded-full bg-zinc-700"></div>
            </div>

            {{-- Decoration --}}
            <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-zinc-800"></div>
            <div class="absolute top-10 right-10 w-24 h-24 rounded-full border border-zinc-700"></div>
        </div>



        {{-- RIGHT SIDE --}}
        <div class="flex items-center justify-center px-6 py-10 lg:px-20 bg-zinc-100">

            <div class="w-full max-w-md">

                {{-- MOBILE LOGO --}}
                <div class="lg:hidden flex items-center gap-4 mb-14">

                    <div class="w-14 h-14 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-2xl">
                        K
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold">
                            Kasku
                        </h1>

                        <p class="text-zinc-500">
                            AI Dashboard
                        </p>
                    </div>
                </div>

                {{-- HEADING --}}
                <div class="mb-10">
                    <h2 class="text-5xl font-bold text-black">
                        Login
                    </h2>

                    <p class="text-zinc-500 mt-3 text-lg">
                        Welcome back! Please enter your details.
                    </p>
                </div>

                {{-- STATUS --}}
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="mb-2 text-zinc-700"
                        />

                        <x-text-input
                            id="email"
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="mb-2 text-zinc-700"
                        />

                        <x-text-input
                            id="password"
                            class="w-full rounded-2xl border border-zinc-300 bg-white px-5 py-4 focus:ring-2 focus:ring-black focus:border-black"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    {{-- OPTIONS --}}
                    <div class="flex items-center justify-between">

                        <label class="inline-flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-zinc-300 text-black focus:ring-black"
                            >

                            <span class="text-sm text-zinc-600">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-zinc-600 hover:text-black transition"
                            >
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full bg-black text-white py-4 rounded-2xl font-semibold text-lg hover:opacity-90 transition"
                    >
                        Log In
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>