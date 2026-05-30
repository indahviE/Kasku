<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tagihan Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-gray-900">

<div class="max-w-4xl mx-auto px-4 py-8">
    
       <div class="flex items-center justify-between mb-6">
        <a href="{{ route('siswa.index') }}" class="w-12 h-12 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="relative">
            <button id="accountBtn" class="w-11 h-11 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>

            <div id="accountMenu" class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <a href="/profile" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium">Manage Account</span>
                </a>

                <form method="POST" action="{{ route('siswa.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                        </svg>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tagihan Kas Anda</h1>
        <p class="text-gray-500 mt-1">Berikut adalah daftar seluruh tagihan kas yang tercatat di sistem.</p>
    </div>

    <div class="space-y-4">
        @forelse ($tunggakan as $item)
            @php
                // Cek status pembayaran berdasarkan relasi ke tabel pembayaran
                $lunas = $item->pembayaran->where('status', 'lunas')->count() > 0;
            @endphp

          <div class="border border-gray-200 rounded-3xl p-5 bg-white hover:shadow-sm transition">

    <div class="flex items-center justify-between gap-4">

        <!-- LEFT -->
        <div class="flex items-center gap-4 min-w-0">

            <!-- ICON -->
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-red-100 flex-shrink-0
                {{ $lunas ? 'bg-green-50' : 'bg-gray-100' }}">

                @if($lunas)

                    <!-- CHECK ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-green-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7" />

                    </svg>

                @else

                    <!-- WARNING ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-red-700"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M12 8v4m0 4h.01m8.99-4a9 9 0 11-17.98 0 9 9 0 0117.98 0z" />

                    </svg>

                @endif

            </div>


            <!-- INFO -->
            <div class="min-w-0">

                <!-- TITLE -->
                <h3 class="font-semibold text-base sm:text-lg text-gray-900 truncate">
                    {{ $item->nama_tagihan }}
                </h3>

                <!-- PERIODE -->
                <p class="text-sm text-gray-500 mt-1">
                    {{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}
                </p>

                <!-- DEADLINE -->
                <p class="text-xs text-gray-400 mt-1">
                    Deadline:
                    {{ \Carbon\Carbon::parse($item->batas_bayar)->translatedFormat('d M Y') }}
                </p>

            </div>

        </div>


        <!-- CENTER -->
        <div class="hidden sm:block text-center px-6">

            <!-- NOMINAL -->
            <h3 class="font-bold text-lg text-gray-900 whitespace-nowrap">
                Rp {{ number_format($item->nominal, 0, ',', '.') }}
            </h3>

            <!-- STATUS -->
            @if($lunas)

                <p class="text-sm font-semibold text-green-600 mt-1">
                    Lunas
                </p>

            @else

                <p class="text-sm font-semibold text-red-400 mt-1">
                    Belum Bayar
                </p>

            @endif

        </div>


        <!-- RIGHT -->
        <div class="flex-shrink-0">

            <a href="{{ route('siswa.detail_tagihan', ['id' => $item->id]) }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-gray-100 text-gray-800 text-sm font-medium hover:bg-gray-200 transition">

                Detail

            </a>

        </div>

    </div>


    <!-- MOBILE INFO -->
    <div class="sm:hidden mt-4 flex items-center justify-between">

        <div>

            <h3 class="font-bold text-base text-gray-900">
                Rp {{ number_format($item->nominal, 0, ',', '.') }}
            </h3>

            @if($lunas)

                <p class="text-sm font-semibold text-green-600 mt-1">
                    Lunas
                </p>

            @else

                <p class="text-sm font-semibold text-red-500 mt-1">
                    Belum Bayar
                </p>

            @endif

        </div>

    </div>

</div>
        @empty
            <div class="border border-dashed border-gray-200 rounded-3xl p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-500 font-medium">Bagus sekali! Tidak ada data tagihan kas yang ditemukan.</p>
            </div>
        @endforelse
    </div>

</div>

</body>
@include('components.footer')
</html>