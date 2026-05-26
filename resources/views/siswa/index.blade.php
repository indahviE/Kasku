<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-gray-900 pb-24 md:pb-6"> <!-- Ditambahkan pb-24 agar konten bawah tidak tertutup search bar mobile -->

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
    <!-- Mengubah grid dari md:grid-cols-2 atau lg:grid-cols-4 ke sistem flex-wrap atau penyesuaian grid yang responsif untuk 5 item -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

        <!-- MENU 1: RIWAYAT -->
        <a href="{{ route('siswa.riwayat') }}" class="block bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg hover:border-gray-300 transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Riwayat</h2>
            <p class="text-sm text-gray-500 mt-1">
                Data Pembayaran KasMu
            </p>
        </a>

        <!-- MENU 2: BAYAR -->
        <a href="{{ route('siswa.transaksi') }}" class="block bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg hover:border-gray-300 transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h2m2 0h2m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Bayar</h2>
            <p class="text-sm text-gray-500 mt-1">
                Masukan Data Pembayaran
            </p>
        </a>

        <!-- MENU 3: TAGIHAN (BARU) -->
        <a href="{{ route('siswa.tunggakan') }}" class="block bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg hover:border-gray-300 transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <!-- Menggunakan ikon eksklamasi lingkaran / pengingat tagihan -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Tagihan</h2>
            <p class="text-sm text-gray-500 mt-1">
                Lihat Sisa Tagihan Kas
            </p>
        </a>

        <!-- MENU 4: DATA KAS -->
        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Data Kas</h2>
            <p class="text-sm text-gray-500 mt-1">
                Pemasukan & Pengeluaran Kas
            </p>
        </div>

        <!-- MENU 5: POJOK DISKUSI -->
        <div class="bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg transition cursor-pointer col-span-2 md:col-span-1">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Pojok Diskusi</h2>
            <p class="text-sm text-gray-500 mt-1">
                Informasi Pengelolaan Saldo
            </p>
        </div>

    </div>

<!-- LEADERBOARD -->
<div class="relative overflow-hidden rounded-[2rem] border border-gray-200 bg-white p-6 mt-6 shadow-sm">

    <!-- BACKGROUND EFFECT -->
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-gray-100 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-gray-100 rounded-full blur-3xl opacity-60"></div>

    <!-- HEADER -->
    <div class="relative flex items-start justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold leading-tight text-gray-900">
                Weekly <br> Leaderboard
            </h2>
            <p class="text-gray-500 mt-3 text-sm md:text-base">
                Siswa paling rajin bayar kas minggu ini
            </p>
        </div>

        <!-- TROPHY -->
        <div class="w-40 h-40 flex items-center justify-center">
            <img 
                src="{{ asset('images/3D Trophy Icon Held by Hand in Isometric View.png') }}"
                alt="Trophy"
                class="w-full h-full object-contain"
            >
        </div>
    </div>


    <!-- LIST -->
    <div class="relative space-y-4">

        <!-- ITEM 1 -->
        <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <span class="text-4xl font-black text-black">#1</span>
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">Nixio</h3>
                    <p class="text-gray-500 text-sm">XII RPL 1</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-bold text-xl text-gray-900">12x</p>
                <p class="text-gray-500 text-sm">pembayaran</p>
            </div>
        </div>

        <!-- ITEM 2 -->
        <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <span class="text-4xl font-black text-gray-500">#2</span>
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">Fajar</h3>
                    <p class="text-gray-500 text-sm">XI TKJ 2</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-bold text-xl text-gray-900">11x</p>
                <p class="text-gray-500 text-sm">pembayaran</p>
            </div>
        </div>

        <!-- ITEM 3 -->
        <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <span class="text-4xl font-black text-orange-400">#3</span>
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">Reyhan</h3>
                    <p class="text-gray-500 text-sm">XI RPL 2</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-bold text-xl text-gray-900">10x</p>
                <p class="text-gray-500 text-sm">pembayaran</p>
            </div>
        </div>

    </div>


    <!-- FOOTER -->
    <div class="relative mt-8 text-center">
        <p class="text-gray-400 text-sm">
            Update leaderboard setiap bulan
        </p>
        <p class="font-semibold mt-1 text-gray-900">
            Kasku.com
        </p>
    </div>

</div>

</div>




<!-- MOBILE BOTTOM SEARCH -->
<div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 md:hidden z-40">
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