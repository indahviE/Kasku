<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-gray-900 pb-24 md:pb-6">

<div class="max-w-6xl mx-auto px-4 py-6">

<div class="fixed top-0 left-0 right-0 bg-white z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">

        <div class="relative">
            <button id="notificationBtn" class="w-12 h-12 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition bg-white shadow-sm relative">
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

                @if($unreadCount > 0)
                    <span class="absolute top-3 right-3 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                @endif
            </button>

            <div id="notificationMenu" class="hidden absolute left-0 mt-3 w-80 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <p class="font-semibold text-sm text-gray-900">Notifikasi Terbaru</p>
                    @if($unreadCount > 0)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-medium">
                            {{ $unreadCount }} Baru
                        </span>
                    @endif
                </div>

                <div class="max-h-80 overflow-y-auto divide-y divide-gray-100">
                    @forelse($notifications as $notif)
                        @php
                            $titleLower = strtolower($notif->title);

                            $bgColor = 'bg-white hover:bg-gray-50/50';
                            $borderColor = 'border-gray-100';
                            $textColor = 'text-gray-900';
                            $msgColor = 'text-gray-500';
                            $dotColor = 'bg-gray-400';
                            $btnColor = 'text-gray-600';

                            if (!$notif->is_read) {
                                if (str_contains($titleLower, 'tunggakan') || str_contains($titleLower, 'menunggak')) {
                                    $bgColor = 'bg-red-50 border-red-100 hover:bg-red-100/50'; $borderColor = 'border-red-200'; $textColor = 'text-red-900 font-bold';
                                    $msgColor = 'text-red-700 font-medium'; $dotColor = 'bg-red-500'; $btnColor = 'text-red-600';
                                } elseif (str_contains($titleLower, 'deadline') || str_contains($titleLower, 'dekat')) {
                                    $bgColor = 'bg-amber-50 border-amber-100 hover:bg-amber-100/50'; $borderColor = 'border-amber-200'; $textColor = 'text-amber-900 font-bold';
                                    $msgColor = 'text-amber-700 font-medium'; $dotColor = 'bg-amber-500'; $btnColor = 'text-amber-700';
                                } elseif (str_contains($titleLower, 'menunggu') || str_contains($titleLower, 'verifikasi')) {
                                    $bgColor = 'bg-indigo-50/80 border-indigo-100 hover:bg-indigo-100/60'; $borderColor = 'border-indigo-200'; $textColor = 'text-indigo-900 font-bold';
                                    $msgColor = 'text-indigo-700 font-medium'; $dotColor = 'bg-indigo-500'; $btnColor = 'text-indigo-600';
                                } elseif (str_contains($titleLower, 'berhasil') || str_contains($titleLower, 'lunas') || str_contains($titleLower, 'ditolak')) {
                                    if (str_contains($titleLower, 'ditolak')) {
                                        $bgColor = 'bg-rose-50 border-rose-100 hover:bg-rose-100/50'; $borderColor = 'border-rose-200'; $textColor = 'text-rose-900 font-bold';
                                        $msgColor = 'text-rose-700 font-medium'; $dotColor = 'bg-rose-500'; $btnColor = 'text-rose-600';
                                    } else {
                                        $bgColor = 'bg-emerald-50 border-emerald-100 hover:bg-emerald-100/50'; $borderColor = 'border-emerald-200'; $textColor = 'text-emerald-900 font-bold';
                                        $msgColor = 'text-emerald-700 font-medium'; $dotColor = 'bg-emerald-500'; $btnColor = 'text-emerald-600';
                                    }
                                } elseif (str_contains($titleLower, 'baru') || str_contains($titleLower, 'info')) {
                                    $bgColor = 'bg-blue-50 border-blue-100 hover:bg-blue-100/50'; $borderColor = 'border-blue-200'; $textColor = 'text-blue-900 font-bold';
                                    $msgColor = 'text-blue-700 font-medium'; $dotColor = 'bg-blue-500'; $btnColor = 'text-blue-600';
                                }
                            }
                        @endphp

                        <div class="block px-4 py-3.5 border-b last:border-b-0 transition relative {{ $bgColor }} {{ !$notif->is_read ? 'border-l-4' : '' }} {{ $borderColor }}">
                            <div class="flex items-start gap-2.5">
                                @if(!$notif->is_read)
                                    <span class="w-2 h-2 mt-1.5 rounded-full {{ $dotColor }} shrink-0 animate-pulse"></span>
                                @endif
                                
                                <div class="flex-1">
                                    <p class="text-sm leading-snug {{ $textColor }}">
                                        {{ $notif->title }}
                                    </p>
                                    <p class="text-xs mt-0.5 leading-normal {{ $msgColor }}">
                                        {{ $notif->message }}
                                    </p>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-[10px] text-gray-400 font-medium">
                                            {{ $notif->created_at?->diffForHumans() ?? 'Baru saja' }}
                                        </span>
                                        
                                        @if(!$notif->is_read)
                                            <form method="POST" action="/siswa/notifikasi/read/{{ $notif->id }}" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-[11px] font-bold hover:underline {{ $btnColor }}">
                                                    Tandai dibaca
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-8 text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4m-8 0H4" />
                            </svg>
                            <p class="text-xs font-medium">Belum ada notifikasi saat ini</p>
                        </div>
                    @endforelse
                </div>

                <a href="{{ route('siswa.notifikasi') }}" class="block text-center py-3 border-t border-gray-100 text-xs font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100 transition shadow-inner">
                    Lihat Semua Notifikasi
                </a>
            </div>
        </div>

        <div class="relative">
            <button id="accountBtn"
                class="w-11 h-11 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition bg-white shadow-sm">
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

            <div id="accountMenu"
                 class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">

                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="font-semibold text-sm">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>

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

                <form method="POST" action="{{ route('siswa.logout') }}">
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
</div>

    <div class="mb-6 pt-20">
        <p class="text-gray-400 text-3xl font-bold capitalize">
            Hi {{ ucwords(strtolower(auth()->user()->name)) }},
        </p>
        <h1 class="text-3xl md:text-4xl font-bold leading-tight mt-1">
            How can I help you today?
        </h1>

        <div class="hidden md:flex mt-5 items-center gap-3">
            <div class="flex-1 relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                    </svg>
                </span>
<div class="flex-1">

    <div class="relative">

        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
            </svg>
        </span>

        <input
            id="searchInputDesktop"
            type="text"
            name="q"
            autocomplete="off"
            value="{{ request('q') }}"
            placeholder="Cari tagihan, pembayaran, kas..."
            class="w-full bg-gray-100 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-black">

    </div>
     <div id="searchResultsDesktop"
         class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-3xl overflow-hidden z-50">

    </div>

</div>
            </div>

            <button class="w-14 h-14 rounded-2xl bg-black flex items-center justify-center text-white hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </div>


    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

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

        <a href="{{ route('siswa.tunggakan') }}" class="block bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg hover:border-gray-300 transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Tagihan</h2>
            <p class="text-sm text-gray-500 mt-1">
                Lihat Sisa Tagihan Kas
            </p>
        </a>    

        <a href="{{ route('siswa.laporan_kas') }}" class="block bg-white border border-gray-200 rounded-3xl p-5 hover:shadow-lg hover:border-gray-300 transition cursor-pointer">
            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </div>
            <h2 class="font-semibold text-lg text-gray-900">Data Kas</h2>
            <p class="text-sm text-gray-500 mt-1">
                Pemasukan & Pengeluaran Kas
            </p>
        </a>

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

<div class="relative overflow-hidden rounded-[2rem] border border-gray-200 bg-white p-6 mt-6 shadow-sm">

    <div class="absolute -top-20 -right-20 w-64 h-64 bg-gray-100 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-gray-100 rounded-full blur-3xl opacity-60"></div>

    <div class="relative flex items-start justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold leading-tight text-gray-900">
                Weekly <br> Leaderboard
            </h2>
            <p class="text-gray-500 mt-3 text-sm md:text-base">
                Siswa paling rajin bayar kas minggu ini
            </p>
        </div>

        <div class="w-40 h-40 flex items-center justify-center">
            <img 
                src="{{ asset('images/3D Trophy Icon Held by Hand in Isometric View.png') }}"
                alt="Trophy"
                class="w-full h-full object-contain"
            >
        </div>
    </div>


    <div class="relative space-y-4">

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

<div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 md:hidden z-40">

    <div class="relative">

        <div class="flex items-center gap-3">

            <div class="flex-1 relative">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>

                    </svg>

                </span>

                <input
                    id="searchInputMobile"
                    type="text"
                    autocomplete="off"
                    placeholder="Cari tagihan, pembayaran, kas..."
                    class="w-full bg-gray-100 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-black">

            </div>

            <button class="w-14 h-14 rounded-2xl bg-black flex items-center justify-center text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4" />

                </svg>

            </button>

        </div>

        <!-- SEARCH RESULT -->
        <div id="searchResultsMobile"
             class="hidden absolute bottom-full left-0 right-0 mb-3 bg-white border border-gray-200 rounded-3xl max-h-80 overflow-y-auto z-[9999]">

        </div>

    </div>

</div>



</body>

@include('components.footer')

</html>

<script>
    const accountBtn = document.getElementById('accountBtn');
    const accountMenu = document.getElementById('accountMenu');
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationMenu = document.getElementById('notificationMenu');

    // Toggle Menu Akun
    accountBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        accountMenu.classList.toggle('hidden');
        notificationMenu.classList.add('hidden'); 
    });

    // Toggle Menu Notifikasi
    notificationBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationMenu.classList.toggle('hidden');
        accountMenu.classList.add('hidden'); 
    });

    // Otomatis tutup menu apapun jika user klik di luar elemen dropdown
    window.addEventListener('click', function(e) {
        if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
            accountMenu.classList.add('hidden');
        }
        if (!notificationBtn.contains(e.target) && !notificationMenu.contains(e.target)) {
            notificationMenu.classList.add('hidden');
        }
    });

    //LIVE SEARCH




const searchInput = document.getElementById('searchInput');
const results = document.getElementById('searchResults');


searchInput.addEventListener('keydown', function(e){

    if(e.key === 'Enter'){
        e.preventDefault();
    }

});

searchInput.addEventListener('keyup', function(){

    let keyword = this.value.trim();

    if(keyword.length < 2){

        results.classList.add('hidden');
        results.innerHTML = '';
        return;

    }

    fetch(`/siswa/search?q=${keyword}`)

        .then(response => response.json())

        .then(data => {

            let html = '';

            // ======================
            // TAGIHAN
            // ======================

            if(data.tagihan.length){

                html += `
                    <div class="px-4 pt-4 pb-2 text-xs font-bold uppercase text-gray-400">
                        Tagihan
                    </div>
                `;

                data.tagihan.forEach(item => {

                    html += `
                        <a href="/siswa/detail-tunggakan/${item.id}"
                           class="block px-4 py-3 hover:bg-gray-50 transition border-t border-gray-100">

                            <div class="font-semibold text-gray-900">
                                ${item.nama_tagihan}
                            </div>

                            <div class="text-sm text-gray-500 mt-1">
                                Rp ${new Intl.NumberFormat('id-ID').format(item.nominal)}
                            </div>

                        </a>
                    `;

                });

            }

            // ======================
            // PEMBAYARAN
            // ======================

            if(data.pembayaran.length){

                html += `
                    <div class="px-4 pt-4 pb-2 text-xs font-bold uppercase text-gray-400">
                        Riwayat Pembayaran
                    </div>
                `;

                data.pembayaran.forEach(item => {

                    html += `
                        <a href="/siswa/riwayat"
                           class="block px-4 py-3 hover:bg-gray-50 transition border-t border-gray-100">

                            <div class="font-semibold text-gray-900">
                                ${item.metode}
                            </div>

                            <div class="text-sm text-gray-500 mt-1">
                                Status: ${item.status}
                            </div>

                        </a>
                    `;

                });

            }

            // ======================
            // DATA KAS
            // ======================

            if(data.kas.length){

                html += `
                    <div class="px-4 pt-4 pb-2 text-xs font-bold uppercase text-gray-400">
                        Data Kas
                    </div>
                `;

                data.kas.forEach(item => {

                    html += `
                        <a href="/siswa/laporan-kas"
                           class="block px-4 py-3 hover:bg-gray-50 transition border-t border-gray-100">

                            <div class="font-semibold text-gray-900">
                                ${item.keterangan}
                            </div>

                            <div class="text-sm text-gray-500 mt-1">
                                Rp ${new Intl.NumberFormat('id-ID').format(item.nominal)}
                            </div>

                        </a>
                    `;

                });

            }

            // ======================
            // KOSONG
            // ======================

            if(
                data.tagihan.length === 0 &&
                data.pembayaran.length === 0 &&
                data.kas.length === 0
            ){

                html = `
                    <div class="p-6 text-center">

                        <p class="text-sm text-gray-500">
                            Data tidak ditemukan
                        </p>

                    </div>
                `;

            }

            console.log(data);
            console.log(results);

            results.innerHTML = html;
            results.classList.remove('hidden');

        })

        .catch(error => {

            console.error(error);

        });

});

// Tutup dropdown saat klik luar

document.addEventListener('click', function(e){

    if(
        !searchInput.contains(e.target) &&
        !results.contains(e.target)
    ){

        results.classList.add('hidden');

    }

});

// Buka lagi saat fokus ke input

searchInput.addEventListener('focus', function(){

    if(results.innerHTML.trim() !== ''){

        results.classList.remove('hidden');

    }

});

</script>