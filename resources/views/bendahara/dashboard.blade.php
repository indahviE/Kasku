<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>KASKU Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            color: #1e293b;
            overflow: hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar {
            background: #0a0f1d; 
            overflow: hidden;
        }

        .sidebar-item {
            transition: .25s ease;
            color: #64748b; 
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item:not(.sidebar-active):hover {
            background: rgba(255, 255, 255, .02);
            transform: translateX(4px);
            color: #94a3b8;
        }

        .sidebar-active {
            background: rgba(255, 255, 255, 0.05); 
            color: #ffffff; 
            font-weight: 500;
            position: relative;
        }

        .sidebar-active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 4px;
            background-color: #2dd4bf; 
            border-radius: 0 4px 4px 0;
        }

        .card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: .25s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .4; }
        }
    </style>
</head>

<body>

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="sidebar w-[250px] fixed h-screen text-white flex flex-col justify-between">
            <div>
                <div class="px-6 py-6 flex items-center gap-4 border-b border-white/5">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-500/20">
                        <iconify-icon icon="solar:wallet-bold"></iconify-icon>
                    </div>

                    <div>
                        <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">
                            KASKU
                        </h1>
                        <p class="text-[11px] text-slate-500 font-medium mt-1 flex items-center gap-1">
                            Online
                        </p>
                    </div>
                </div>

                <div class="px-4 mt-6">
                    <nav class="space-y-1">
                        <a href="{{ route('bendahara.dashboard') }}" class="sidebar-item sidebar-active">
                            <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('bendahara.kas_masuk') }}" class="sidebar-item">
                            <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Masuk</span>
                        </a>

                        <a href="{{ route('bendahara.kas_keluar') }}" class="sidebar-item">
                            <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Keluar</span>
                        </a>

                        <a href="{{ route('bendahara.transaksi') }}" class="sidebar-item">
                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Transaksi</span>
                        </a>

                        <a href="{{ route('bendahara.tagihan') }}" class="sidebar-item">
                            <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Tagihan</span>
                        </a>

                        <a href="{{ route('bendahara.laporan') }}" class="sidebar-item">
                            <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                            <span>Laporan</span>
                        </a>
                    </nav>
                </div>
            </div>

            <div class="p-4 border-t border-white/5">
                <a href="{{ route('bendahara.pengaturan') }}" class="sidebar-item">
                    <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                    <span>Pengaturan</span>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="ml-[250px] flex-1 overflow-y-auto h-screen">

            <!-- HEADER -->
            <div class="h-[70px] bg-white border-b border-slate-200 px-8 flex items-center justify-between shadow-sm">
                <div>
                    <p class="text-[12px] text-slate-400 font-medium">
                        Pages / Dashboard
                    </p>
                    <h1 class="text-[20px] font-bold text-slate-800 mt-1">
                        Dashboard Keuangan
                    </h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- NOTIFIKASI -->
                    <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                        <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                        <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 pulse-dot"></div>
                    </button>

                    <!-- PROFILE DROPDOWN -->
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center gap-3">
                            <div class="text-right">
                                <h1 class="text-[13px] font-bold text-slate-800">
                                    {{ Auth::user()->name ?? 'User' }}
                                </h1>
                                <p class="text-[11px] text-slate-400">
                                    {{ Auth::user()->role ?? 'Bendahara' }}
                                </p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                        </button>

                        <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                            <a href="{{ route('bendahara.profile') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                                <iconify-icon icon="solar:user-linear"></iconify-icon> Profile
                            </a>
                            <a href="{{ route('bendahara.pengaturan') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                                <iconify-icon icon="solar:settings-linear"></iconify-icon> Pengaturan
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                                    <iconify-icon icon="solar:logout-2-linear"></iconify-icon> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8 space-y-6">
                
                <!-- STAT CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    
                    <!-- Sisa Saldo Kas -->
                    <div class="rounded-2xl p-5 text-white flex flex-col justify-between shadow-sm bg-gradient-to-br from-cyan-400 to-emerald-400">
                        <div>
                            <span class="text-[11px] font-medium opacity-90 block">Sisa Saldo Kas</span>
                            <h2 class="text-2xl font-bold mt-1">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h2>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-medium">Terakumulasi saat ini</span>
                            <iconify-icon icon="solar:wallet-bold" class="text-xl opacity-40"></iconify-icon>
                        </div>
                    </div>

                    <!-- Total Kas Masuk -->
                    <div class="rounded-2xl p-5 text-white flex flex-col justify-between shadow-sm bg-gradient-to-br from-blue-400 to-indigo-400">
                        <div>
                            <span class="text-[11px] font-medium opacity-90 block">Total Kas Masuk</span>
                            <h2 class="text-2xl font-bold mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h2>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-medium">Keseluruhan dana masuk</span>
                            <iconify-icon icon="solar:alt-arrow-down-bold" class="text-xl opacity-40"></iconify-icon>
                        </div>
                    </div>

                    <!-- Total Kas Keluar -->
                    <div class="rounded-2xl p-5 text-white flex flex-col justify-between shadow-sm bg-gradient-to-br from-pink-400 to-rose-400">
                        <div>
                            <span class="text-[11px] font-medium opacity-90 block">Total Kas Keluar</span>
                            <h2 class="text-2xl font-bold mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h2>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-medium">Keseluruhan dana keluar</span>
                            <iconify-icon icon="solar:alt-arrow-up-bold" class="text-xl opacity-40"></iconify-icon>
                        </div>
                    </div>

                    <!-- Kas Sosial -->
                    <div class="rounded-2xl p-5 text-white flex flex-col justify-between shadow-sm bg-gradient-to-br from-purple-400 to-fuchsia-400">
                        <div>
                            <span class="text-[11px] font-medium opacity-90 block">Tabungan / Kas Sosial</span>
                            <h2 class="text-2xl font-bold mt-1">Rp {{ number_format($kasSosial, 0, ',', '.') }}</h2>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-medium">↑ {{ number_format($persenKasSosial, 1, ',', '.') }}% tercapai</span>
                            <iconify-icon icon="solar:safe-bold" class="text-xl opacity-40"></iconify-icon>
                        </div>
                    </div>

                </div>

                <!-- CHART & ALLOCATION -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Total Arus Kas Chart -->
                    <div class="lg:col-span-2 card p-6 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-1">
                                    Total Arus Kas <iconify-icon icon="solar:alt-arrow-down-linear" class="text-xs text-slate-400"></iconify-icon>
                                </h3>
                            </div>
                            <button class="text-xs bg-slate-50 border border-slate-200 text-slate-600 px-2.5 py-1 rounded-lg font-medium flex items-center gap-1">
                                7 Hari Terakhir <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>
                            </button>
                        </div>

                        <div class="h-60 relative">
                            <canvas id="cashChart"></canvas>
                        </div>
                    </div>

                    <!-- Alokasi Kas Keluar -->
                    <div class="card p-6 flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-bold text-slate-800">Alokasi Kas Keluar</h3>
                            <button class="text-xs text-slate-400 flex items-center gap-1">Bulan Ini <iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon></button>
                        </div>

                        <div class="flex items-center justify-center flex-1 gap-6">
                            
                            <div class="w-36 h-36 relative flex items-center justify-center flex-shrink-0">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-slate-100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-cyan-400" stroke-dasharray="51, 100" stroke-width="4" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div class="absolute text-center">
                                    <span class="text-[11px] text-slate-400 block font-medium leading-none mb-0.5">Terpakai</span>
                                    <span class="text-xl font-extrabold text-slate-800 leading-none">51%</span>
                                </div>
                            </div>

                            <div class="flex-1 space-y-2.5 text-[11px] font-semibold text-slate-500">
                                <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-cyan-400"></span> Fotocopy & ATK</span> <span class="text-slate-700">51%</span></div>
                                <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-pink-400"></span> Kas Sosial</span> <span class="text-slate-700">23%</span></div>
                                <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-400"></span> Konsumsi Rapat</span> <span class="text-slate-700">16%</span></div>
                                <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-indigo-400"></span> Event Kelas</span> <span class="text-slate-700">10%</span></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- TRANSACTION & GOALS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Riwayat Transaksi Terbaru -->
                    <div class="lg:col-span-2 card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-slate-800">Riwayat Transaksi Terbaru</h3>
                            <div class="flex gap-4 text-xs font-bold text-indigo-600">
                                <button class="border-b-2 border-indigo-600 pb-0.5">Terbaru</button>
                                <button class="text-slate-400">Tertunda</button>
                                <button class="text-slate-400">Semua</button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="pb-2">Deskripsi / Nama</th>
                                        <th class="pb-2">Kategori</th>
                                        <th class="pb-2">Tanggal</th>
                                        <th class="pb-2 text-right">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 text-xs text-slate-600">
                                    <tr>
                                        <td class="py-3 font-bold text-slate-800 flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><iconify-icon icon="solar:user-rounded-bold"></iconify-icon></div>
                                            Andi Saputra
                                        </td>
                                        <td class="py-3">Kas Mingguan</td>
                                        <td class="py-3 text-slate-400">28 Mei 2026</td>
                                        <td class="py-3 text-right font-bold text-emerald-500">+ Rp 50.000</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-bold text-slate-800 flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center"><iconify-icon icon="solar:notebook-bold"></iconify-icon></div>
                                            Fotocopy Modul Fisika
                                        </td>
                                        <td class="py-3">ATK Kelas</td>
                                        <td class="py-3 text-slate-400">26 Mei 2026</td>
                                        <td class="py-3 text-right font-bold text-rose-500">- Rp 120.000</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-bold text-slate-800 flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><iconify-icon icon="solar:user-rounded-bold"></iconify-icon></div>
                                            Siti Aminah
                                        </td>
                                        <td class="py-3">Kas Mingguan</td>
                                        <td class="py-3 text-slate-400">25 Mei 2026</td>
                                        <td class="py-3 text-right font-bold text-emerald-500">+ Rp 50.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Target Kas Kelas -->
                    <div class="card p-6 flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-bold text-slate-800">Target Kas Kelas</h3>
                            <button class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-bold px-2.5 py-1 rounded-lg transition">+ Target</button>
                        </div>

                        <div class="flex-1 flex flex-col justify-center space-y-4 py-2">
                            <div class="space-y-1">
                                <div class="flex justify-between items-center text-xs font-medium">
                                    <span class="text-slate-700 font-bold flex items-center gap-1.5">
                                        <iconify-icon icon="solar:palette-bold" class="text-blue-500"></iconify-icon> Dekorasi Kelas Baru
                                    </span>
                                    <span class="text-slate-400 text-[10px]">65%</span>
                                </div>
                                <p class="text-[10px] text-slate-400">Rp 650.000 dari Rp 1.000.000</p>
                                <div class="w-full h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full w-[65%] rounded-full bg-blue-500"></div>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between items-center text-xs font-medium">
                                    <span class="text-slate-700 font-bold flex items-center gap-1.5">
                                        <iconify-icon icon="solar:cup-first-bold" class="text-emerald-500"></iconify-icon> Dana Lomba & Event
                                    </span>
                                    <span class="text-slate-400 text-[10px]">40%</span>
                                </div>
                                <p class="text-[10px] text-slate-400">Rp 800.000 dari Rp 2.000.000</p>
                                <div class="w-full h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full w-[40%] rounded-full bg-emerald-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>

    </div>

    <script>
        // CHART CONFIGURATION
        const ctx = document.getElementById('cashChart').getContext('2d');

        const gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientFill.addColorStop(0, 'rgba(56, 189, 248, 0.25)'); 
        gradientFill.addColorStop(1, 'rgba(56, 189, 248, 0.00)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['22 Mei', '23 Mei', '24 Mei', '25 Mei', '26 Mei', '27 Mei', '28 Mei'],
                datasets: [{
                    label: 'Kas Kelas Masuk',
                    data: [150000, 320000, 240000, 680000, 410000, 520000, 890000],
                    borderColor: '#0284c7', 
                    backgroundColor: gradientFill,
                    fill: true,
                    tension: 0.4, 
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#0284c7',
                    borderWidth: 2.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    },
                    y: {
                        grid: { color: '#f1f5f9', drawBorder: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 10 },
                            callback: function(value) {
                                return 'Rp ' + (value / 1000) + 'k';
                            }
                        }
                    }
                }
            }
        });

        // DROPDOWN TOGGLE
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        // CLOSE DROPDOWN WHEN CLICKING OUTSIDE
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdownMenu');
            if (!e.target.closest('.relative')) {
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>

</html>