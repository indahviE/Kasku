<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Kelas - Laporan Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen text-slate-900 pb-24 md:pb-6 antialiased selection:bg-black selection:text-white">

<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="fixed top-0 left-0 right-0 bg-white/40 backdrop-blur-xl z-50 border-b border-slate-200/50 transition-all duration-300 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('siswa.index') }}" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-white/80 transition-all duration-300 bg-white/50 shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="font-extrabold text-lg text-slate-900 tracking-tight leading-tight">Laporan Kas Kelas</h1>
                    <p class="text-[11px] text-slate-500 font-semibold tracking-wide uppercase mt-0.5">Transparansi Keuangan Real-Time</p>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <div class="relative">
                    <button id="notificationBtn" class="w-11 h-11 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-white/80 transition-all duration-300 bg-white/50 shadow-sm relative active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if(($unreadCount ?? 0) > 0)
                            <span class="absolute top-3.5 right-3.5 flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                            </span>
                        @endif
                    </button>
                    <div id="notificationMenu" class="hidden absolute right-0 mt-3 w-80 bg-white/90 backdrop-blur-lg border border-slate-200/60 rounded-2xl shadow-xl overflow-hidden z-50 transform origin-top-right transition-all">
                        <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <p class="font-bold text-xs text-slate-900 uppercase tracking-wider">Notifikasi Terbaru</p>
                        </div>
                        <div class="max-h-60 overflow-y-auto divide-y divide-slate-100 text-xs">
                            @forelse($notifications ?? [] as $notif)
                                <div class="p-3.5 hover:bg-slate-50/80 transition {{ !$notif->is_read ? 'bg-blue-50/40 font-medium' : '' }}">
                                    <p class="font-semibold text-slate-900">{{ $notif->title }}</p>
                                    <p class="text-slate-500 mt-0.5 leading-relaxed">{{ $notif->message }}</p>
                                </div>
                            @empty
                                <div class="p-6 text-center text-slate-400 italic">Tidak ada notifikasi</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <button id="accountBtn" class="w-11 h-11 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-white/80 transition-all duration-300 bg-white/50 shadow-sm active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                    <div id="accountMenu" class="hidden absolute right-0 mt-3 w-52 bg-white/90 backdrop-blur-lg border border-slate-200/60 rounded-2xl shadow-xl overflow-hidden z-50">
                        <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/50 text-xs">
                            <p class="font-bold text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-slate-400 mt-0.5 overflow-hidden text-ellipsis">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('siswa.logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-rose-50 text-rose-600 text-xs font-semibold tracking-wide transition">
                                Logout Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-24 space-y-6">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white/60 backdrop-blur-md border border-slate-200/60 rounded-2xl p-5 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Saldo Awal</p>
                <h3 class="text-lg md:text-xl font-extrabold text-slate-900 mt-2 tracking-tight">Rp {{ number_format($saldoAwal, 0, ',', '.') }}</h3>
            </div>

            <div class="bg-emerald-50/40 backdrop-blur-md border border-emerald-200/50 rounded-2xl p-5 shadow-sm border-l-4 border-l-emerald-500">
                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Total Masuk</p>
                <h3 id="statTotalMasuk" class="text-lg md:text-xl font-black text-slate-900 mt-2 tracking-tight">Rp {{ number_format($kasMasuk, 0, ',', '.') }}</h3>
                <span id="badgeMasukCount" class="text-[11px] font-semibold text-emerald-600 inline-flex items-center gap-1 mt-1 bg-emerald-100/60 px-2 py-0.5 rounded-full">{{ $riwayatPemasukan->count() }} Transaksi</span>
            </div>

            <div class="bg-rose-50/40 backdrop-blur-md border border-rose-200/50 rounded-2xl p-5 shadow-sm border-l-4 border-l-rose-500">
                <p class="text-[10px] font-bold text-rose-600 uppercase tracking-widest">Total Keluar</p>
                <h3 id="statTotalKeluar" class="text-lg md:text-xl font-black text-slate-900 mt-2 tracking-tight">Rp {{ number_format($kasKeluar, 0, ',', '.') }}</h3>
                <span id="badgeKeluarCount" class="text-[11px] font-semibold text-rose-600 inline-flex items-center gap-1 mt-1 bg-rose-100/60 px-2 py-0.5 rounded-full">{{ $riwayatPengeluaran->count() }} Transaksi</span>
            </div>

            <div class="bg-blue-600/90 backdrop-blur-md border border-blue-700/30 rounded-2xl p-5 shadow-md text-white">
                <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest">Sisa Saldo Kas</p>
                <h3 id="statSaldoAkhir" class="text-xl font-black mt-2 tracking-tight text-white">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white/60 backdrop-blur-md border border-slate-200/60 rounded-2xl p-5 md:p-6 shadow-sm lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-xs text-slate-900 uppercase tracking-wider">Tren Aliran Kas</h3>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                </div>
                <div class="h-60">
                    <canvas id="kasLineChart"></canvas>
                </div>
            </div>

            <div class="bg-white/60 backdrop-blur-md border border-slate-200/60 rounded-2xl p-5 md:p-6 shadow-sm flex flex-col justify-between">
                <h3 class="font-bold text-xs text-slate-900 uppercase tracking-wider mb-4">Kategori Pengeluaran</h3>
                <div class="h-40 flex items-center justify-center relative">
                    <canvas id="kasPieChart"></canvas>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200/60 text-[11px] space-y-2.5">
                    @php
                        $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ec4899'];
                        $totalKeperluan = $riwayatPengeluaran->sum('nominal') ?: 1;
                        $kategoriData = $riwayatPengeluaran->groupBy('keperluan')->map(function ($group) use ($totalKeperluan) {
                            return [
                                'nominal' => $group->sum('nominal'),
                                'keterangan' => $group->first()->keperluan ?? 'Umum'
                            ];
                        });
                    @endphp
                    <div id="kategoriList" class="space-y-2 max-h-24 overflow-y-auto pr-1">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-md border border-slate-200/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200/60 bg-white/40 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-sm text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span> Jurnal Kas Kelas
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Pencarian mutasi tanggal dan teks terintegrasi otomatis</p>
                </div>

                <div class="flex flex-wrap items-center gap-2 w-full lg:w-auto">
                    <div class="relative w-full sm:w-auto">
                        <input id="filterTanggalMulai" type="date" class="w-full bg-white/80 border border-slate-200 text-xs px-3 py-2.5 rounded-xl outline-none font-semibold text-slate-600 focus:border-blue-500 transition cursor-pointer" title="Tanggal Mulai" />
                    </div>

                    <span class="text-xs font-bold text-slate-400 px-1 hidden sm:inline">s/d</span>

                    <div class="relative w-full sm:w-auto">
                        <input id="filterTanggalSelesai" type="date" class="w-full bg-white/80 border border-slate-200 text-xs px-3 py-2.5 rounded-xl outline-none font-semibold text-slate-600 focus:border-blue-500 transition cursor-pointer" title="Tanggal Selesai" />
                    </div>

                    <div class="relative flex-1 min-w-[180px]">
                        <input id="smartSearchInput" type="text" placeholder="Cari nama, keperluan..." class="w-full bg-white/80 border border-slate-200 focus:border-blue-500 focus:bg-white text-xs px-3.5 py-2.5 pl-9 rounded-xl outline-none transition duration-200 font-medium placeholder:text-slate-400" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <select id="filterJenis" class="bg-white/80 border border-slate-200 text-xs px-3 py-2.5 rounded-xl outline-none font-semibold text-slate-600 focus:border-blue-500 transition cursor-pointer">
                        <option value="semua">Semua Mutasi</option>
                        <option value="masuk">Uang Masuk</option>
                        <option value="keluar">Uang Keluar</option>
                    </select>
                    
                    <button id="btnResetFilter" type="button" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold px-3 py-2.5 rounded-xl transition active:scale-95" title="Bersihkan Filter">
                        Reset
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200/60 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                            <th class="px-6 py-3.5">Tanggal</th>
                            <th class="px-6 py-3.5">Keterangan / Deskripsi</th>
                            <th class="px-6 py-3.5 text-center">Jenis</th>
                            <th class="px-6 py-3.5 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody id="mutasiTableBody" class="divide-y divide-slate-100 text-xs bg-white/20">
                        @php
                            $allTransactions = collect();

                            foreach($riwayatPemasukan as $masuk) {
                                $allTransactions->push([
                                    'tanggal_raw' => $masuk->tanggal_bayar ?? $masuk->created_at,
                                    'tanggal' => \Carbon\Carbon::parse($masuk->tanggal_bayar ?? $masuk->created_at)->translatedFormat('d M Y'),
                                    'waktu' => \Carbon\Carbon::parse($masuk->tanggal_bayar ?? $masuk->created_at)->format('H:i'),
                                    'judul' => $masuk->siswa->name ?? 'Pembayaran Kas',
                                    'sub_judul' => 'Metode: ' . ucfirst($masuk->metode),
                                    'jenis' => 'masuk',
                                    'nominal' => (int)$masuk->jml_bayar
                                ]);
                            }

                            foreach($riwayatPengeluaran as $keluar) {
                                $allTransactions->push([
                                    'tanggal_raw' => $keluar->created_at,
                                    'tanggal' => \Carbon\Carbon::parse($keluar->created_at)->translatedFormat('d M Y'),
                                    'waktu' => \Carbon\Carbon::parse($keluar->created_at)->format('H:i'),
                                    'judul' => $keluar->keperluan ?? 'Pengeluaran Kas',
                                    'sub_judul' => 'Dana Keluar Kelas',
                                    'jenis' => 'keluar',
                                    'nominal' => (int)$keluar->nominal
                                ]);
                            }

                            $sortedTransactions = $allTransactions->sortByDesc('tanggal_raw')->values();
                        @endphp

                        @forelse($sortedTransactions as $tx)
                            <tr class="table-row-mutasi hover:bg-white/60 transition-colors duration-200 group" 
                                data-judul="{{ strtolower($tx['judul']) }}" 
                                data-sub="{{ strtolower($tx['sub_judul']) }}" 
                                data-jenis="{{ $tx['jenis'] }}" 
                                data-nominal="{{ $tx['nominal'] }}"
                                data-tanggal="{{ $tx['tanggal'] }}"
                                data-tanggal-raw="{{ \Carbon\Carbon::parse($tx['tanggal_raw'])->format('Y-m-d') }}">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium">
                                    {{ $tx['tanggal'] }}
                                    <span class="block text-[10px] text-slate-300 font-normal mt-0.5">{{ $tx['waktu'] }} WIB</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($tx['jenis'] === 'masuk')
                                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-[10px] border border-emerald-100/70">
                                                {{ substr($tx['judul'], 0, 2) }}
                                            </div>
                                        @else
                                            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100/70">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <span class="font-bold text-slate-900 block group-hover:text-blue-600 transition">{{ $tx['judul'] }}</span>
                                            <span class="text-[10px] text-slate-400 font-medium block mt-0.5">{{ $tx['sub_judul'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $tx['jenis'] === 'masuk' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ $tx['jenis'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-extrabold tracking-tight text-sm">
                                    <span class="{{ $tx['jenis'] === 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $tx['jenis'] === 'masuk' ? '+' : '-' }}Rp {{ number_format($tx['nominal'], 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRowPlaceholder">
                                <td colspan="4" class="text-center py-12 text-slate-400 italic bg-slate-50/10">Belum ada rekaman data transaksi kas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="noResultsAlert" class="hidden text-center py-12 bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-xs font-semibold text-slate-400">Kata kunci atau rentang tanggal tidak cocok dengan transaksi apa pun.</p>
            </div>
        </div>
    </div>
</div>

@if(view()->exists('components.footer'))
    @include('components.footer')
@endif

<script>
    const accountBtn = document.getElementById('accountBtn');
    const accountMenu = document.getElementById('accountMenu');
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationMenu = document.getElementById('notificationMenu');

    if(accountBtn && accountMenu) {
        accountBtn.addEventListener('click', (e) => { e.stopPropagation(); accountMenu.classList.toggle('hidden'); if(notificationMenu) notificationMenu.classList.add('hidden'); });
    }
    if(notificationBtn && notificationMenu) {
        notificationBtn.addEventListener('click', (e) => { e.stopPropagation(); notificationMenu.classList.toggle('hidden'); if(accountMenu) accountMenu.classList.add('hidden'); });
    }
    window.addEventListener('click', function() {
        if (accountMenu) accountMenu.classList.add('hidden');
        if (notificationMenu) notificationMenu.classList.add('hidden');
    });

    const rawData = @json($sortedTransactions);
    let lineChart, pieChart;

    function buildCharts(filteredData) {
        const datesMap = {};
        filteredData.forEach(item => {
            const dateStr = item.tanggal;
            if(!datesMap[dateStr]) datesMap[dateStr] = { masuk: 0, keluar: 0 };
            if(item.jenis === 'masuk') datesMap[dateStr].masuk += item.nominal;
            else datesMap[dateStr].keluar += item.nominal;
        });

        const sortedLabels = Object.keys(datesMap).reverse();
        const lineMasuk = sortedLabels.map(l => datesMap[l].masuk);
        const lineKeluar = sortedLabels.map(l => datesMap[l].keluar);

        const ctxLine = document.getElementById('kasLineChart').getContext('2d');
        if(lineChart) lineChart.destroy();
        
        lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: sortedLabels.length ? sortedLabels : ['Tidak Ada Data'],
                datasets: [
                    { label: 'Masuk', data: lineMasuk, borderColor: '#10b981', tension: 0.35, fill: false, borderWidth: 2.5, pointRadius: 2 },
                    { label: 'Keluar', data: lineKeluar, borderColor: '#f43f5e', tension: 0.35, fill: false, borderWidth: 2.5, pointRadius: 2 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8' } }, x: { grid: { display: false }, ticks: { color: '#94a3b8' } } } }
        });

        const kategoriMap = {};
        let totalKeluarTemp = 0;
        filteredData.filter(i => i.jenis === 'keluar').forEach(item => {
            const kat = item.judul || 'Umum';
            kategoriMap[kat] = (kategoriMap[kat] || 0) + item.nominal;
            totalKeluarTemp += item.nominal;
        });

        const pieLabels = Object.keys(kategoriMap);
        const pieValues = Object.values(kategoriMap);

        const ctxPie = document.getElementById('kasPieChart').getContext('2d');
        if(pieChart) pieChart.destroy();
        pieChart = new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: pieLabels.length ? pieLabels : ['Kosong'],
                datasets: [{ data: pieValues.length ? pieValues : [1], backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ec4899'], borderWidth: 2 }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
        });

        const katListContainer = document.getElementById('kategoriList');
        katListContainer.innerHTML = '';
        const colors = ['#3b82f6', '#10b981', '#f59e0b', '#ec4899'];
        
        if(pieLabels.length === 0) {
            katListContainer.innerHTML = '<div class="text-center text-slate-400 italic py-2">Tidak ada kategori pengeluaran</div>';
        } else {
            pieLabels.forEach((label, idx) => {
                const nominal = kategoriMap[label];
                const persen = Math.round((nominal / (totalKeluarTemp || 1)) * 100);
                const itemHtml = `
                    <div class="flex items-center justify-between text-slate-600 p-1 rounded-lg transition hover:bg-slate-50">
                        <span class="flex items-center gap-1.5 font-medium text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px]">
                            <span class="w-2 h-2 rounded-full inline-block shrink-0" style="background-color: ${colors[idx % 4]}"></span>
                            ${label}
                        </span>
                        <span class="font-bold text-slate-900 shrink-0">Rp ${nominal.toLocaleString('id-ID')} <span class="text-slate-400 font-normal">(${persen}%)</span></span>
                    </div>`;
                katListContainer.insertAdjacentHTML('beforeend', itemHtml);
            });
        }
    }

    const smartSearchInput = document.getElementById('smartSearchInput');
    const filterJenis = document.getElementById('filterJenis');
    const filterTanggalMulai = document.getElementById('filterTanggalMulai');
    const filterTanggalSelesai = document.getElementById('filterTanggalSelesai');
    const btnResetFilter = document.getElementById('btnResetFilter');
    const tableRows = document.querySelectorAll('.table-row-mutasi');
    const noResultsAlert = document.getElementById('noResultsAlert');

    function performSmartSearch() {
        const query = smartSearchInput.value.toLowerCase().trim();
        const jenisFilter = filterJenis.value;
        const tglMulai = filterTanggalMulai.value;
        const tglSelesai = filterTanggalSelesai.value;

        let matchingData = [];
        let totalMasuk = 0;
        let totalKeluar = 0;
        let countMasuk = 0;
        let countKeluar = 0;
        let visibleRowsCount = 0;

        tableRows.forEach(row => {
            const judul = row.getAttribute('data-judul');
            const sub = row.getAttribute('data-sub');
            const jenis = row.getAttribute('data-jenis');
            const nominal = parseInt(row.getAttribute('data-nominal'));
            const tanggalTeks = row.getAttribute('data-tanggal').toLowerCase();
            const tanggalRaw = row.getAttribute('data-tanggal-raw');

            const matchText = judul.includes(query) || sub.includes(query) || tanggalTeks.includes(query) || nominal.toString().includes(query);
            const matchJenis = (jenisFilter === 'semua') || (jenis === jenisFilter);

            let matchTanggal = true;
            if (tglMulai && tanggalRaw < tglMulai) matchTanggal = false;
            if (tglSelesai && tanggalRaw > tglSelesai) matchTanggal = false;

            if (matchText && matchJenis && matchTanggal) {
                row.classList.remove('hidden');
                visibleRowsCount++;
                
                matchingData.push({
                    tanggal: row.getAttribute('data-tanggal'),
                    judul: row.querySelector('.font-bold').innerText,
                    jenis: jenis,
                    nominal: nominal
                });

                if (jenis === 'masuk') {
                    totalMasuk += nominal;
                    countMasuk++;
                } else {
                    totalKeluar += nominal;
                    countKeluar++;
                }
            } else {
                row.classList.add('hidden');
            }
        });

        if(visibleRowsCount === 0 && tableRows.length > 0) {
            noResultsAlert.classList.remove('hidden');
        } else {
            noResultsAlert.classList.add('hidden');
        }

        const saldoAwal = {{ $saldoAwal }};
        const saldoAkhir = (saldoAwal + totalMasuk) - totalKeluar;

        document.getElementById('statTotalMasuk').innerText = 'Rp ' + totalMasuk.toLocaleString('id-ID');
        document.getElementById('statTotalKeluar').innerText = 'Rp ' + totalKeluar.toLocaleString('id-ID');
        document.getElementById('statSaldoAkhir').innerText = 'Rp ' + saldoAkhir.toLocaleString('id-ID');
        document.getElementById('badgeMasukCount').innerText = `${countMasuk} Transaksi`;
        document.getElementById('badgeKeluarCount').innerText = `${countKeluar} Transaksi`;

        buildCharts(matchingData);
    }

    smartSearchInput.addEventListener('input', performSmartSearch);
    filterJenis.addEventListener('change', performSmartSearch);
    filterTanggalMulai.addEventListener('change', performSmartSearch);
    filterTanggalSelesai.addEventListener('change', performSmartSearch);

    btnResetFilter.addEventListener('click', () => {
        smartSearchInput.value = '';
        filterJenis.value = 'semua';
        filterTanggalMulai.value = '';
        filterTanggalSelesai.value = '';
        performSmartSearch();
    });

    document.addEventListener('DOMContentLoaded', () => {
        buildCharts(rawData);
        performSmartSearch();
    });
</script>
</body>
</html>