<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tunggakan - Wali Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Outfit', sans-serif; }
        :root { --primary: #1B6578; --primary-light: #2a8fa3; }
        .bg-gradient-subtle { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .sidebar-item { position: relative; transition: all 0.2s ease; }
        .sidebar-item::before { content:''; position:absolute; left:0; top:50%; transform:translateY(-50%); width:3px; height:0; background:linear-gradient(180deg,var(--primary) 0%,var(--primary-light) 100%); border-radius:0 3px 3px 0; transition:height 0.3s ease; }
        .sidebar-item.active::before { height: 20px; }
        .avatar-gradient { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); }
        .dropdown-menu { display:none; position:absolute; top:100%; right:0; background:white; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.1); z-index:50; min-width:200px; margin-top:0.5rem; }
        .dropdown-menu.active { display: block; }
        .dropdown-item { display:flex; align-items:center; gap:0.75rem; padding:0.75rem 1rem; color:#475569; text-decoration:none; font-size:0.875rem; transition:all 0.2s ease; border-bottom:1px solid #f1f5f9; }
        .dropdown-item:first-child { border-radius: 12px 12px 0 0; }
        .dropdown-item:last-child { border-bottom:none; border-radius:0 0 12px 12px; }
        .dropdown-item:hover { background-color:#f8fafc; color:#1B6578; }
        .dropdown-item.logout:hover { background-color:#fee2e2; color:#dc2626; }
        .siswa-row { transition: background 0.15s ease; }
        .siswa-row:hover { background: #fef2f2; }
        .accordion-btn { cursor: pointer; transition: all 0.2s ease; }
        .accordion-body { display: none; }
        .accordion-body.open { display: block; }
        .chevron { transition: transform 0.25s ease; }
        .chevron.rotated { transform: rotate(180deg); }
        .page-btn { display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:8px; font-size:0.8125rem; font-weight:600; transition:all 0.15s ease; border:1px solid #e2e8f0; color:#64748b; }
        .page-btn:hover { background:#f1f5f9; color:#1B6578; border-color:#cbd5e1; }
        .page-btn.active { background:#1B6578; color:white; border-color:#1B6578; }
        .page-btn.disabled { opacity:0.35; pointer-events:none; }
    </style>
</head>
<body>

<div class="flex min-h-screen bg-gradient-subtle">

    {{-- SIDEBAR --}}
    <div class="w-64 bg-slate-900 text-slate-400 flex flex-col sticky top-0 h-screen border-r border-slate-800/50">
        <div class="p-6 border-b border-slate-800/50">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 7H4C2.9 7 2 7.9 2 9V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V9C22 7.9 21.1 7 20 7ZM20 17H4V9H20V17ZM16 11C14.9 11 14 11.9 14 13C14 14.1 14.9 15 16 15C17.1 15 18 14.1 18 13C18 11.9 17.1 11 16 11ZM18 5H6V3H18V5Z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-white font-display font-bold text-base tracking-tight">KASKU</div>
                    <div class="text-[10px] text-slate-500 font-medium">Wali Kelas</div>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-3 space-y-1 py-6">
            <a href="{{ route('wali.dashboard') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('wali.dashboard') ? 'active bg-slate-800/50 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-sm font-medium">Daftar Siswa</span>
            </a>

            <a href="{{ route('wali.transaksi-kas') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('wali.transaksi-kas') ? 'active bg-slate-800/50 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-sm font-medium">Transaksi Kas</span>
            </a>

            <a href="{{ route('wali.rekap-pembayaran') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('wali.rekap-pembayaran') ? 'active bg-slate-800/50 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="text-sm font-medium">Rekap Pembayaran</span>
            </a>

            <a href="{{ route('wali.tunggakan') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('wali.tunggakan') ? 'active bg-slate-800/50 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-sm font-medium">Tunggakan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all font-medium">
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- NAVBAR --}}
        <header class="bg-white/60 backdrop-blur-xl sticky top-0 z-40 border-b border-slate-200/50 h-16 flex items-center justify-between px-8 shadow-sm">
            <div class="flex items-center gap-2 text-sm">
                <span class="text-slate-500 font-medium">Pages</span>
                <span class="text-slate-300">/</span>
                <span class="text-slate-900 font-semibold">Tunggakan</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="relative">
                    <button id="profileBtn" class="flex items-center gap-3 hover:bg-slate-100 p-2 rounded-lg transition-all">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 text-right">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-green-600 font-medium text-right">Wali Kelas</p>
                        </div>
                        <div class="w-10 h-10 avatar-gradient rounded-full border-2 border-white shadow-sm flex items-center justify-center">
                            <span class="text-sm font-display font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </button>
                    <div id="dropdownMenu" class="dropdown-menu">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout w-full text-left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-5xl mx-auto space-y-6">

                {{-- HEADER BANNER --}}
                <div class="bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-32 w-32 h-32 bg-white/5 rounded-full translate-y-1/2"></div>
                    <div class="relative z-10 flex items-start justify-between">
                        <div>
                            <p class="text-white/70 text-sm mb-1">Tunggakan</p>
                            <h2 class="text-3xl font-display font-bold">{{ $wali->kelas->nama_kelas }}</h2>
                            <p class="text-white/60 text-sm mt-2">Daftar tagihan yang melewati batas bayar</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-5 py-3 text-right shrink-0">
                            <p class="text-white/70 text-xs mb-0.5">Total Tagihan Menunggak</p>
                            <p class="text-3xl font-display font-bold">{{ $tunggakan->total() }}</p>
                            <p class="text-white/60 text-[11px] mt-0.5">jenis tagihan</p>
                        </div>
                    </div>
                </div>

                {{-- EMPTY STATE --}}
                @if ($tunggakan->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-slate-700 font-bold text-base">Tidak ada tunggakan</p>
                    <p class="text-slate-400 text-sm mt-1">Semua siswa sudah membayar tepat waktu</p>
                </div>

                @else

                {{-- TUNGGAKAN LIST --}}
                <div class="space-y-4">
                    @foreach ($tunggakan as $item)
                    @php $idx = $loop->index; @endphp
                    <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm overflow-hidden">

                        {{-- ACCORDION HEADER --}}
                        <div class="accordion-btn px-6 py-4 flex items-center justify-between gap-4"
                             onclick="toggleAccordion({{ $idx }})">

                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $item['tagihan']->nama_tagihan }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Batas: {{ \Carbon\Carbon::parse($item['tagihan']->batas_bayar)->translatedFormat('d F Y') }}
                                        &middot; Rp {{ number_format($item['tagihan']->nominal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold bg-red-50 text-red-500 px-3 py-1.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>
                                    {{ $item['siswa']->count() }} siswa menunggak
                                </span>
                                <svg id="chevron-{{ $idx }}" class="chevron w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        {{-- INFO BAR --}}
                        <div class="px-6 pb-3 flex flex-wrap gap-x-6 gap-y-1 border-b border-slate-100">
                            <span class="text-xs text-slate-500">
                                Periode:
                                <span class="font-semibold text-slate-700">
                                    {{ \Carbon\Carbon::parse($item['tagihan']->periode)->translatedFormat('F Y') }}
                                </span>
                            </span>
                            <span class="text-xs text-red-500 font-semibold">
                                Lewat {{ \Carbon\Carbon::parse($item['tagihan']->batas_bayar)->diffForHumans(null, true) }} yang lalu
                            </span>
                            <span class="text-xs text-slate-500">
                                Total tunggakan:
                                <span class="font-semibold text-slate-700">
                                    Rp {{ number_format($item['tagihan']->nominal * $item['siswa']->count(), 0, ',', '.') }}
                                </span>
                            </span>
                        </div>

                        {{-- ACCORDION BODY: DAFTAR SISWA --}}
                        <div id="accordion-body-{{ $idx }}" class="accordion-body">
                            <div class="px-6 pt-3 pb-2">
                                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest mb-2">Daftar Siswa Belum Bayar</p>
                            </div>
                            <div class="divide-y divide-slate-50">
                                @foreach ($item['siswa'] as $siswa)
                                <div class="siswa-row flex items-center justify-between px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-red-500">
                                                {{ strtoupper(substr($siswa->user->name ?? $siswa->name ?? '?', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800">{{ $siswa->user->name ?? $siswa->name ?? '-' }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $siswa->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-red-400 bg-red-50 px-2.5 py-1 rounded-full">Belum Bayar</span>
                                </div>
                                @endforeach
                            </div>
                            <div class="h-3"></div>
                        </div>

                    </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="flex items-center justify-between pt-2">
                    <p class="text-xs text-slate-400">
                        Menampilkan {{ $tunggakan->firstItem() }}&ndash;{{ $tunggakan->lastItem() }}
                        dari {{ $tunggakan->total() }} tagihan
                    </p>
                    <div class="flex items-center gap-1.5">

                        {{-- Prev --}}
                        @if ($tunggakan->onFirstPage())
                            <span class="page-btn disabled">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $tunggakan->previousPageUrl() }}" class="page-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </a>
                        @endif

                        {{-- Page numbers --}}
                        @php
                            $start = max(1, $tunggakan->currentPage() - 2);
                            $end   = min($tunggakan->lastPage(), $tunggakan->currentPage() + 2);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $tunggakan->url(1) }}" class="page-btn">1</a>
                            @if ($start > 2)
                                <span class="text-slate-300 text-sm px-1">...</span>
                            @endif
                        @endif

                        @for ($p = $start; $p <= $end; $p++)
                            <a href="{{ $tunggakan->url($p) }}"
                               class="page-btn {{ $p === $tunggakan->currentPage() ? 'active' : '' }}">
                                {{ $p }}
                            </a>
                        @endfor

                        @if ($end < $tunggakan->lastPage())
                            @if ($end < $tunggakan->lastPage() - 1)
                                <span class="text-slate-300 text-sm px-1">...</span>
                            @endif
                            <a href="{{ $tunggakan->url($tunggakan->lastPage()) }}" class="page-btn">{{ $tunggakan->lastPage() }}</a>
                        @endif

                        {{-- Next --}}
                        @if ($tunggakan->hasMorePages())
                            <a href="{{ $tunggakan->nextPageUrl() }}" class="page-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            <span class="page-btn disabled">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        @endif

                    </div>
                </div>

                @endif

            </div>
        </main>
    </div>
</div>

<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    profileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.classList.toggle('active');
    });
    document.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });

    function toggleAccordion(index) {
        const body = document.getElementById('accordion-body-' + index);
        const chevron = document.getElementById('chevron-' + index);
        body.classList.toggle('open');
        chevron.classList.toggle('rotated');
    }
</script>

</body>
</html>
