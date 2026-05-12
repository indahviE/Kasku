
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-gray-900">

<div class="max-w-6xl mx-auto px-4 py-6">

<!-- TOP BAR -->
<div class="flex items-center justify-between mb-6">

    <!-- NOTIFICATION -->
    <button class="w-12 h-12 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 text-gray-700"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
    </button>

<div class="relative">

    <!-- BUTTON -->
    <button id="accountBtn"
        class="w-11 h-11 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 text-gray-700"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>

    </button>

    <!-- DROPDOWN -->
    <div id="accountMenu"
         class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">

        <!-- USER INFO -->
        <div class="px-4 py-3 border-b border-gray-100">
            <p class="font-semibold text-sm">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-gray-500">
                {{ auth()->user()->email }}
            </p>
        </div>

        <!-- MANAGE ACCOUNT -->
        <a href="/profile"
           class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 text-gray-600"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>

            <span class="text-sm font-medium">
                Manage Account
            </span>
        </a>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-500 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                </svg>

                <span class="text-sm font-medium">
                    Logout
                </span>

            </button>
        </form>

    </div>

</div>

</div>

    <!-- HEADER -->
    <div class="mb-6">
     <p class="text-gray-400 text-3xl font-bold capitalize">
    Hi {{ ucwords(strtolower(auth()->user()->name)) }},
</p>
        <h1 class="text-3xl md:text-4xl font-bold leading-tight mt-1">
            How can I help you today?
        </h1>

        <!-- SEARCH DESKTOP -->
        <div class="hidden md:flex mt-5 items-center gap-3">
            <div class="flex-1 relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                    </svg>
                </span>

                <input
                    type="text"
                    placeholder="Search"
                    class="w-full bg-gray-100 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-black"
                >
            </div>

            <!-- BLACK BUTTON -->
            <button class="w-14 h-14 rounded-2xl bg-black flex items-center justify-center text-white hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </div>


    <!-- GRID CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- CARD -->
        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
            </div>

            <h2 class="font-semibold text-lg">Riwayat</h2>
            <p class="text-sm text-gray-500 mt-1">
                Data Pembayaran KasMu
            </p>
        </div>


        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer">
          <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
    
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-6 h-6 text-gray-700"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 10h18M7 15h2m2 0h2m-7 4h12a2 2 0 002-2V7
              a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>

</div>

            <h2 class="font-semibold text-lg">Bayar</h2>
            <p class="text-sm text-gray-500 mt-1">
                Masukan Data Pembayaran
            </p>
        </div>


        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </div>

            <h2 class="font-semibold text-lg">Data Kas</h2>
            <p class="text-sm text-gray-500 mt-1">
             Pemasukan & Pengeluaran Kas
            </p>
        </div>


        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z" />
                </svg>
            </div>

            <h2 class="font-semibold text-lg">Pojok Diskusi</h2>
            <p class="text-sm text-gray-500 mt-1">
                Informasi Pengelolaan Saldo
            </p>
        </div>

    </div>

    <!-- LEADERBOARD CARD -->
<div class="bg-white border border-gray-200 rounded-[2rem] p-6 mt-6 overflow-hidden">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">

        <div>
            <h2 class="text-2xl font-bold">
                Top Kas Students
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Siswa paling rajin bayar kas bulan ini
            </p>
        </div>

        <!-- TROPHY -->
        <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 text-yellow-500"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 19V6l12-3v13M9 19c0 1.105-1.79 2-4 2s-4-.895-4-2
                      1.79-2 4-2 4 .895 4 2zm12-2c0 1.105-1.79 2-4 2s-4-.895-4-2
                      1.79-2 4-2 4 .895 4 2z"/>
            </svg>

        </div>

    </div>


    <!-- PODIUM -->
    <div class="flex items-end justify-center gap-4 md:gap-8">

        <!-- 2ND PLACE -->
        <div class="flex flex-col items-center">

            <!-- AVATAR -->
            <div class="w-16 h-16 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-8 h-8 text-gray-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>

            </div>

            <!-- NAME -->
            <h3 class="font-semibold mt-3">
                Fajar
            </h3>

            <p class="text-sm text-gray-500">
                11 Pembayaran
            </p>

            <!-- PODIUM -->
            <div class="mt-4 w-24 h-32 rounded-t-3xl bg-gray-200 flex flex-col items-center justify-center">

                <span class="text-3xl font-bold text-gray-700">
                    2
                </span>

            </div>

        </div>


        <!-- 1ST PLACE -->
        <div class="flex flex-col items-center -translate-y-6">

            <!-- CROWN -->
            <div class="mb-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-8 h-8 text-yellow-400"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 16L3 5l6 5 3-7 3 7 6-5-2 11H5z"/>
                </svg>

            </div>

            <!-- AVATAR -->
            <div class="w-20 h-20 rounded-3xl bg-yellow-100 border border-yellow-200 flex items-center justify-center shadow-lg">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-yellow-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>

            </div>

            <!-- NAME -->
            <h3 class="font-bold text-lg mt-3">
                Nixio
            </h3>

            <p class="text-sm text-gray-500">
                12 Pembayaran
            </p>

            <!-- PODIUM -->
            <div class="mt-4 w-28 h-44 rounded-t-[2rem] bg-black text-white flex flex-col items-center justify-center shadow-xl">

                <span class="text-5xl font-bold">
                    1
                </span>

                <span class="text-sm mt-2 text-gray-300">
                    Best Student
                </span>

            </div>

        </div>


        <!-- 3RD PLACE -->
        <div class="flex flex-col items-center">

            <!-- AVATAR -->
            <div class="w-16 h-16 rounded-2xl bg-orange-100 border border-orange-200 flex items-center justify-center shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-8 h-8 text-orange-500"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>

            </div>

            <!-- NAME -->
            <h3 class="font-semibold mt-3">
                Reyhan
            </h3>

            <p class="text-sm text-gray-500">
                10 Pembayaran
            </p>

            <!-- PODIUM -->
            <div class="mt-4 w-24 h-24 rounded-t-3xl bg-orange-200 flex flex-col items-center justify-center">

                <span class="text-3xl font-bold text-orange-700">
                    3
                </span>

            </div>

        </div>

    </div>

</div>

</div>




<!-- MOBILE BOTTOM SEARCH -->
<div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 md:hidden">

    <div class="flex items-center gap-3">

        <div class="flex-1 relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                </svg>
            </span>

            <input
                type="text"
                placeholder="Search"
                class="w-full bg-gray-100 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-black"
            >
        </div>

        <button class="w-14 h-14 rounded-2xl bg-black flex items-center justify-center text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>

    </div>

</div>

</body>

@include('components.footer')

</html>
<script>
    const accountBtn = document.getElementById('accountBtn');
    const accountMenu = document.getElementById('accountMenu');

    accountBtn.addEventListener('click', () => {
        accountMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
            accountMenu.classList.add('hidden');
        }
    });
</script>
