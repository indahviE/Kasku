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

<div class="max-w-6xl mx-auto px-4 py-6">
    
    {{-- HEADER BUTTONS --}}
    <div class="flex items-center justify-between mb-8">
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

    {{-- TITLE --}}
    <div class="mb-8">
        <p class="uppercase tracking-[0.2em] text-xs text-gray-400 font-semibold">BILLING LIST</p>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Tagihan Kas Anda</h1>
        <p class="text-gray-500 mt-2 text-sm md:text-base">Berikut adalah daftar seluruh tagihan kas yang tercatat di sistem.</p>
    </div>

    {{-- WARNING NOTICE ALUR PEMBAYARAN --}}
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-2xl text-sm flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-semibold">Petunjuk Pembayaran Kas:</p>
            <p class="text-blue-700 mt-1">
                Tombol <strong class="text-blue-900">"Bayar Sekarang"</strong> di bawah hanya digunakan untuk pembayaran online mandiri via <strong class="text-blue-900">QRIS</strong>. Jika Anda ingin membayar secara <strong class="text-blue-900">Tunai (Cash)</strong>, silakan serahkan uang langsung ke Bendahara kelas agar diinputkan oleh bendahara.
            </p>
        </div>
    </div>

    {{-- LIST TAGIHAN --}}
    <div class="space-y-4">
        @forelse ($tunggakan as $item)
            @php
                $lunas = $item->pembayaran->where('status', 'lunas')->count() > 0;
            @endphp

            <div class="border border-gray-200 rounded-3xl p-5 bg-white hover:shadow-md transition">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    {{-- LEFT: Icon & Info --}}
                    <div class="flex items-center gap-4 min-w-0">
                        {{-- ICON status --}}
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 {{ $lunas ? 'bg-green-100' : 'bg-red-100' }}">
                            @if($lunas)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4m0 4h.01m8.99-4a9 9 0 11-17.98 0 9 9 0 0117.98 0z" />
                                </svg>
                            @endif
                        </div>

                        {{-- INFO TEXT --}}
                        <div class="min-w-0">
                            <h3 class="font-bold text-base sm:text-lg text-gray-900 truncate">
                                {{ $item->nama_tagihan }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-0.5">
                                Periode: {{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Deadline: {{ \Carbon\Carbon::parse($item->batas_bayar)->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- CENTER: Nominal & Status (Desktop view) --}}
                    <div class="hidden sm:flex flex-col items-center text-center px-4">
                        <span class="font-bold text-xl text-gray-900 whitespace-nowrap">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </span>
                        @if($lunas)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200 mt-1">
                                Lunas
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200 mt-1">
                                Belum Bayar
                            </span>
                        @endif
                    </div>

                    {{-- RIGHT: Action Buttons --}}
                    <div class="flex items-center justify-between sm:justify-end gap-3 pt-3 sm:pt-0 border-t border-gray-100 sm:border-t-0">
                        {{-- Mobile view for price & status inside action container --}}
                        <div class="sm:hidden">
                            <span class="font-bold text-lg text-gray-900 block">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </span>
                            <span class="text-xs font-semibold {{ $lunas ? 'text-green-600' : 'text-red-500' }}">
                                {{ $lunas ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 ml-auto sm:ml-0">
                            @if(!$lunas)
                                <a href="{{ route('siswa.transaksi', ['tagihan_id' => $item->id, 'nominal' => $item->nominal]) }}"
                                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition shadow-sm shadow-blue-100">
                                    Bayar (QRIS)
                                </a>
                            @endif
                            
                            <a href="{{ route('siswa.detail_tagihan', ['id' => $item->id]) }}"
                               class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-gray-100 text-gray-800 text-xs font-semibold hover:bg-gray-200 transition">
                                Detail
                            </a>
                        </div>
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

@include('components.footer')

<script>
    // SCRIPT DROPDOWN PROFIL
    const accountBtn = document.getElementById('accountBtn');
    const accountMenu = document.getElementById('accountMenu');

    accountBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        accountMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
            accountMenu.classList.add('hidden');
        }
    });
</script>
</body>
</html>