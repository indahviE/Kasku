<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tagihan Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50/50 min-h-screen text-gray-900 antialiased">

    <div class="max-w-6xl mx-auto px-4 py-8">
        
        {{-- ========================================== --}}
        {{-- HEADER NAVIGATION                          --}}
        {{-- ========================================== --}}
        <div class="flex items-center justify-between mb-10">
            <a href="{{ route('siswa.index') }}" class="w-12 h-12 rounded-2xl border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 hover:scale-105 active:scale-95 transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div class="relative">
                <button id="accountBtn" class="w-12 h-12 rounded-2xl border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 hover:scale-105 active:scale-95 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div id="accountMenu" class="hidden absolute right-0 mt-3 w-56 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">
                    <div class="px-4 py-3.5 border-b border-gray-100 bg-gray-50/50">
                        <p class="font-semibold text-sm text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                    </div>

                    <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium">Manage Account</span>
                    </a>

                    <form method="POST" action="{{ route('siswa.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 border-t border-gray-50 hover:bg-red-50 text-red-600 transition text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                            </svg>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TITLE & HERO SECTION                       --}}
        {{-- ========================================== --}}
        <div class="mb-8">
            <p class="uppercase tracking-[0.25em] text-xs text-blue-600 font-bold">Billing List</p>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 tracking-tight">Tagihan Kas Anda</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">Berikut adalah daftar seluruh tagihan kas yang tercatat di dalam sistem.</p>
        </div>

        {{-- ========================================== --}}
        {{-- NOTICE INFO PEMBAYARAN                     --}}
        {{-- ========================================== --}}
        <div class="mb-8 p-4 bg-blue-50/70 border border-blue-100 text-blue-900 rounded-2xl text-sm flex items-start gap-3.5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="font-bold text-blue-950">Petunjuk Pembayaran Kas:</p>
                <p class="text-blue-800/90 mt-1 leading-relaxed">
                    Tombol <strong class="text-blue-950 font-semibold">"Bayar (QRIS)"</strong> di bawah hanya digunakan untuk pembayaran online mandiri. Jika Anda ingin membayar secara <strong class="text-blue-950 font-semibold">Tunai (Cash)</strong>, silakan serahkan uang langsung ke Bendahara kelas agar diinputkan secara manual.
                </p>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- MAIN BILLING LIST                          --}}
        {{-- ========================================== --}}
        <div class="space-y-4">
            @forelse ($tunggakan as $item)
                @php
                    // Jika di kueri menggunakan model jembatan Tunggakan
                    $isJembatan = isset($item->tagihan);
                    
                    // Baca status lunas dari tabel penentu masing-masing
                    $lunas = $isJembatan ? ($item->status === 'lunas') : false;
                    
                    // Ambil detail target data berdasarkan model kueri yang aktif
                    $namaTagihan = $isJembatan ? ($item->tagihan->nama_tagihan ?? '-') : $item->nama_tagihan;
                    $periode     = $isJembatan ? ($item->tagihan->periode ?? now()) : $item->periode;
                    $batasBayar  = $isJembatan ? ($item->tagihan->batas_bayar ?? now()) : $item->batas_bayar;
                    $nominal     = $isJembatan ? ($item->tagihan->nominal ?? 0) : $item->nominal;
                    $tagihanId   = $isJembatan ? ($item->tagihan->id ?? $item->id) : $item->id;
                @endphp

                <div class="border border-gray-200/80 rounded-3xl p-5 bg-white hover:shadow-md hover:border-gray-300/70 transition duration-200">
                    <div class="flex flex-col md:grid md:grid-cols-12 md:items-center gap-4 md:gap-5">
                        
                        {{-- LEFT: Icon & Informasi Tagihan --}}
                        <div class="flex items-center gap-4 min-w-0 md:col-span-6">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 {{ $lunas ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-red-50 text-red-600 border border-red-100' }}">
                                @if($lunas)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @ immortality @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4m0 4h.01m8.99-4a9 9 0 11-17.98 0 9 9 0 0117.98 0z" />
                                    </svg>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h3 class="font-bold text-base sm:text-lg text-gray-900 truncate tracking-tight">
                                    {{ $namaTagihan }}
                                </h3>
                                <div class="flex flex-col gap-0.5 mt-1">
                                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                        Periode: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($periode)->translatedFormat('F Y') }}</span>
                                    </p>
                                    <p class="text-xs text-gray-400 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                        Deadline: <span class="font-medium text-gray-600">{{ \Carbon\Carbon::parse($batasBayar)->translatedFormat('d M Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- CENTER: Nominal & Status Badge Desktop --}}
                        <div class="hidden md:flex flex-col items-start px-2 md:col-span-3">
                            <span class="font-extrabold text-xl text-gray-900 tracking-tight">
                                Rp {{ number_format($nominal, 0, ',', '.') }}
                            </span>
                            @if($lunas)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-200/60 mt-1 tracking-wide uppercase">
                                    Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60 mt-1 tracking-wide uppercase">
                                    Belum Bayar
                                </span>
                            @endif
                        </div>

                        {{-- RIGHT: Container Action Buttons --}}
                        <div class="flex items-center justify-between md:justify-end gap-4 pt-4 md:pt-0 border-t border-gray-100 md:border-t-0 md:col-span-3">
                            {{-- Info Nominal khusus Tampilan Mobile --}}
                            <div class="md:hidden">
                                <span class="font-extrabold text-lg text-gray-900 block">
                                    Rp {{ number_format($nominal, 0, ',', '.') }}
                                </span>
                                <span class="text-xs font-bold tracking-wide uppercase mt-0.5 block {{ $lunas ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $lunas ? 'Lunas' : 'Belum Bayar' }}
                                </span>
                            </div>

                            {{-- Tombol Aksi Mandiri --}}
                            <div class="flex items-center gap-2 ml-auto md:ml-0">
                                @if(!$lunas)
                                    <a href="{{ route('siswa.transaksi', ['tagihan_id' => $tagihanId]) }}"
                                       class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-600 text-white text-xs font-bold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-100 active:scale-95 transition-all whitespace-nowrap">
                                        Bayar (QRIS)
                                    </a>
                                @endif
                                
                                <a href="{{ route('siswa.detail_tagihan', ['id' => $tagihanId]) }}"
                                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-xs font-bold hover:bg-gray-200 active:scale-95 transition-all whitespace-nowrap">
                                    Detail
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                {{-- State Kosong --}}
                <div class="border-2 border-dashed border-gray-200 rounded-3xl p-16 text-center bg-white shadow-sm">
                    <div class="w-16 h-16 bg-gray-50 border border-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Tagihan Bersih!</h3>
                    <p class="text-gray-400 max-w-sm mx-auto mt-1 text-sm">Bagus sekali! Tidak ada data tunggakan atau tagihan kas yang ditemukan untuk akun Anda.</p>
                </div>
            @endforelse
        </div>

    </div>

    @include('components.footer')

    {{-- ========================================== --}}
    {{-- INTERACTION SCRIPTS                        --}}
    {{-- ========================================== --}}
    <script>
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