<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Kas - Wali Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Outfit', sans-serif; }
        :root { --primary: #1B6578; --primary-light: #2a8fa3; }
        .bg-gradient-subtle { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); border: 1px solid rgba(15,23,42,0.05); }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(27,101,120,0.08); }
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
        tbody tr { transition: background-color 0.2s ease; }
        tbody tr:hover { background-color: rgba(27,101,120,0.03); }
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
                    ↪ Logout
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
                <span class="text-slate-900 font-semibold">Transaksi Kas</span>
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

                @if (session('success'))
                    <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium">{{ session('error') }}</div>
                @endif

                {{-- HEADER KELAS --}}
                <div class="bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10">
                        <p class="text-white/70 text-sm mb-1">Transaksi Kas</p>
                        <h2 class="text-3xl font-display font-bold">{{ $wali->kelas->nama_kelas }}</h2>
                    </div>
                </div>

                {{-- KARTU SALDO --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div class="bg-white rounded-2xl border border-slate-100 p-5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-[3px] bg-emerald-500 rounded-t-2xl"></div>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-500 mb-1">Total Masuk</p>
                        <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
                        <div class="mt-2 inline-flex text-[11px] bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full font-medium">Pemasukan</div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 p-5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-[3px] bg-red-500 rounded-t-2xl"></div>
                        <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-500 mb-1">Total Keluar</p>
                        <p class="text-lg font-bold text-red-500">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                        <div class="mt-2 inline-flex text-[11px] bg-red-50 text-red-500 px-2 py-0.5 rounded-full font-medium">Pengeluaran</div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 p-5 relative overflow-hidden border-l-4 border-l-blue-500">
                        <div class="absolute top-0 left-0 right-0 h-[3px] bg-blue-500 rounded-t-2xl"></div>
                        <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-500 mb-1">Saldo Kelas</p>
                        <p class="text-lg font-bold {{ $saldo >= 0 ? 'text-blue-600' : 'text-red-500' }}">
                            Rp {{ number_format($saldo, 0, ',', '.') }}
                        </p>
                        <div class="mt-2 inline-flex text-[11px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-medium">
                            {{ $saldo >= 0 ? 'Sehat' : 'Negatif' }}
                        </div>
                    </div>

                </div>

                {{-- TABEL TRANSAKSI --}}
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Riwayat Transaksi Kas</h3>
                        <p class="text-xs text-slate-500">Semua pemasukan dan pengeluaran kas kelas {{ $wali->kelas->nama_kelas }}</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Metode</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($transaksi as $i => $row)
                                <tr>
                                    <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ ($transaksi->currentPage() - 1) * $transaksi->perPage() + $i + 1 }}
                                </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-900">{{ $row['keterangan'] }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $row['nama'] }}</td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($row['tanggal'])->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($row['metode'] !== '-')
                                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-lg text-[11px] font-semibold uppercase">
                                                {{ $row['metode'] }}
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($row['tipe'] === 'masuk')
                                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-lg text-[11px] font-bold">Masuk</span>
                                        @else
                                            <span class="bg-red-50 text-red-500 px-3 py-1.5 rounded-lg text-[11px] font-bold">Keluar</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold {{ $row['tipe'] === 'masuk' ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $row['tipe'] === 'masuk' ? '+' : '-' }} Rp {{ number_format($row['nominal'], 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-slate-400 text-sm italic">
                                        Belum ada transaksi kas untuk kelas ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TARUH CODES INI DI LUAR / DI BAWAH CARD TABEL TRANSAKSI --}}
                @if ($transaksi->hasPages())
                    <div class="flex items-center justify-between pt-6 pb-4">
                        <p class="text-xs text-slate-400">
                            Menampilkan {{ $transaksi->firstItem() }}&ndash;{{ $transaksi->lastItem() }}
                            dari {{ $transaksi->total() }} rikap transaksi
                        </p>
                        <div class="flex items-center gap-1.5">

                            {{-- Tombol Previous --}}
                            @if ($transaksi->onFirstPage())
                                <span class="page-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $transaksi->previousPageUrl() }}" class="page-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- Logika Angka Penomoran Halaman --}}
                            @php
                                $start = max(1, $transaksi->currentPage() - 2);
                                $end   = min($transaksi->lastPage(), $transaksi->currentPage() + 2);
                            @endphp

                            {{-- Halaman Pertama & Titik-Titik Awal --}}
                            @if ($start > 1)
                                <a href="{{ $transaksi->url(1) }}" class="page-btn">1</a>
                                @if ($start > 2)
                                    <span class="text-slate-300 text-sm px-1">...</span>

                                @endif
                            @endif

                            {{-- Loop Angka Tengah --}}
                            @for ($p = $start; $p <= $end; $p++)
                                <a href="{{ $transaksi->url($p) }}"
                                   class="page-btn {{ $p === $transaksi->currentPage() ? 'active' : '' }}">
                                    {{ $p }}
                                </a>
                            @endfor

                            {{-- Titik-Titik Akhir & Halaman Terakhir --}}
                            @if ($end < $transaksi->lastPage())
                                @if ($end < $transaksi->lastPage() - 1)
                                    <span class="text-slate-300 text-sm px-1">...</span>
                                @endif
                                <a href="{{ $transaksi->url($transaksi->lastPage()) }}" class="page-btn">{{ $transaksi->lastPage() }}</a>
                            @endif

                            {{-- Tombol Next --}}
                            @if ($transaksi->hasMorePages())
                                <a href="{{ $transaksi->nextPageUrl() }}" class="page-btn">
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
</script>

</body>
</html>
