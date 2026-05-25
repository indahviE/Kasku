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
    /* Warna navy yang jauh lebih gelap dan pekat sesuai foto */
    background: #0a0f1d; 
    overflow: hidden;
}

.sidebar-item {
    transition: .25s ease;
    /* Warna teks menu bawaan dibuat sedikit redup agar menu aktif lebih menonjol */
    color: #64748b; 
    font-size: 14px;
    padding: 12px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-item:hover {
    background: rgba(255, 255, 255, .02);
    transform: translateX(4px);
    color: #94a3b8;
}

.sidebar-active {
    /* Background menu aktif dibuat kontras tipis di atas warna super gelap */
    background: rgba(255, 255, 255, 0.05); 
    /* Warna teks menu aktif putih bersih */
    color: #ffffff; 
    font-weight: 500;
    position: relative;
}

/* Garis indikator hijau toska di sebelah kiri menu aktif */
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
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, .95) 0%,
                    rgba(248, 250, 252, .9) 100%);

            border: 1px solid rgba(226, 232, 240, .5);
            border-radius: 22px;
            backdrop-filter: blur(10px);

            box-shadow:
                0 4px 6px rgba(0, 0, 0, .03),
                0 10px 30px rgba(15, 23, 42, .04);
        }

        .stat-card {
            transition: .3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .gradient-emerald {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #065f46;
        }

        .gradient-sky {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0c4a6e;
        }

        .gradient-rose {
            background: linear-gradient(135deg, #ffe4e6 0%, #fbcfe8 100%);
            color: #831843;
        }

        .gradient-violet {
            background: linear-gradient(135deg, #f5e6ff 0%, #e9d5ff 100%);
            color: #581c87;
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

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .4;
            }
        }

        .summary-item {
            transition: .25s ease;
        }

        .summary-item:hover {
            transform: translateX(4px);
            background: rgba(45, 212, 191, .05);
        }

        .glow-emerald {
            background: rgba(16, 185, 129, .08);
            border: 1px solid rgba(16, 185, 129, .15);
        }

        .glow-rose {
            background: rgba(244, 63, 94, .08);
            border: 1px solid rgba(244, 63, 94, .15);
        }

        .fade-in {
            animation: fade .5s ease;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

                        <a href="#" class="sidebar-item sidebar-active">
                            <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                            <span>Dashboard</span>
                        </a>

                        <a href="#" class="sidebar-item">
                            <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Masuk</span>
                        </a>

                        <a href="#" class="sidebar-item">
                            <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Keluar</span>
                        </a>

                        <a href="#" class="sidebar-item">
                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Transaksi</span>
                        </a>

                        <a href="#" class="sidebar-item">
                            <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Tagihan</span>
                        </a>

                        <a href="#" class="sidebar-item">
                            <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                            <span>Laporan</span>
                        </a>

                    </nav>
                </div>
            </div>

            <div class="p-4 border-t border-white/5">
                <a href="#" class="sidebar-item">
                    <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                    <span>Pengaturan</span>
                </a>
            </div>

        </aside>

        <!-- MAIN -->
        <main class="ml-[250px] flex-1 overflow-y-auto h-screen">

            <!-- NAVBAR -->
            <div class="h-[70px] bg-white border-b border-slate-200 px-8 flex items-center justify-between shadow-sm">

                <div>

                    <p class="text-[12px] text-slate-400 font-medium">
                        Pages / Dashboard
                    </p>

                    <h1 class="text-[20px] font-bold text-slate-800 mt-1">
                        Dashboard Keuangan
                    </h1>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <!-- NOTIF -->
                    <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">

                        <iconify-icon
                            icon="solar:bell-bold"
                            class="text-[18px] text-slate-700">
                        </iconify-icon>

                        <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 pulse-dot"></div>

                    </button>

                    <!-- PROFILE -->
                    <div class="relative">

                        <button
                            onclick="toggleDropdown()"
                            class="flex items-center gap-3">

                            <div class="text-right">

                                <h1 class="text-[13px] font-bold text-slate-800">
                                    Melina Detiana
                                </h1>

                                <p class="text-[11px] text-slate-400">
                                    Bendahara
                                </p>

                            </div>

                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">
                                M
                            </div>

                        </button>

                        <!-- DROPDOWN -->
                        <div id="dropdownMenu"
                            class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

                            <a href="#"
                                class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">

                                <iconify-icon icon="solar:user-linear"></iconify-icon>
                                Profile

                            </a>

                            <a href="#"
                                class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">

                                <iconify-icon icon="solar:settings-linear"></iconify-icon>
                                Pengaturan

                            </a>

                            <button
                                class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">

                                <iconify-icon icon="solar:logout-2-linear"></iconify-icon>
                                Logout

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-8">

                <!-- HERO SECTION -->
                <div class="mb-10 fade-in">

                    <div class="flex items-center justify-between">

                        <div>

                            <h1 class="text-[36px] font-bold text-slate-900 leading-tight">
                                Selamat Datang Kembali
                            </h1>

                            <p class="text-slate-500 text-base mt-3">
                                Pantau seluruh aktivitas keuangan kelas secara realtime dengan dashboard modern.
                            </p>

                        </div>

                        <div class="hidden lg:flex items-center gap-3 px-5 py-3 rounded-2xl bg-teal-50 border border-teal-200">

                            <div class="w-2 h-2 rounded-full bg-emerald-500 pulse-dot"></div>

                            <span class="text-sm font-semibold text-teal-700">Update Realtime</span>

                        </div>

                    </div>

                </div>

                <!-- STAT CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                    <!-- CARD 1: Saldo Kas -->
                    <div class="card stat-card p-6 fade-in-delay-1">

                        <div class="flex items-start justify-between mb-4">

                            <div>

                                <p class="text-sm text-slate-500 font-medium">
                                    Saldo Kas
                                </p>

                            </div>

                            <div class="icon-wrapper gradient-emerald">
                                <iconify-icon icon="solar:wallet-money-bold"></iconify-icon>
                            </div>

                        </div>

                        <h1 class="text-[32px] font-bold text-slate-900 mb-3">
                            Rp 2,5JT
                        </h1>

                        <div class="flex items-center gap-2 text-sm font-semibold text-emerald-600">

                            <iconify-icon icon="solar:arrow-up-bold" class="text-[16px]"></iconify-icon>

                            <span>+12% bulan ini</span>

                        </div>

                    </div>

                    <!-- CARD 2: Kas Masuk -->
                    <div class="card stat-card p-6 fade-in-delay-2">

                        <div class="flex items-start justify-between mb-4">

                            <div>

                                <p class="text-sm text-slate-500 font-medium">
                                    Kas Masuk
                                </p>

                            </div>

                            <div class="icon-wrapper gradient-sky">
                                <iconify-icon icon="solar:arrow-down-bold"></iconify-icon>
                            </div>

                        </div>

                        <h1 class="text-[32px] font-bold text-slate-900 mb-3">
                            Rp 5JT
                        </h1>

                        <div class="flex items-center gap-2 text-sm font-semibold text-sky-600">

                            <iconify-icon icon="solar:check-circle-bold" class="text-[16px]"></iconify-icon>

                            <span>18 transaksi</span>

                        </div>

                    </div>

                    <!-- CARD 3: Kas Keluar -->
                    <div class="card stat-card p-6 fade-in-delay-3">

                        <div class="flex items-start justify-between mb-4">

                            <div>

                                <p class="text-sm text-slate-500 font-medium">
                                    Kas Keluar
                                </p>

                            </div>

                            <div class="icon-wrapper gradient-rose">
                                <iconify-icon icon="solar:arrow-up-bold"></iconify-icon>
                            </div>

                        </div>

                        <h1 class="text-[32px] font-bold text-slate-900 mb-3">
                            Rp 2JT
                        </h1>

                        <div class="flex items-center gap-2 text-sm font-semibold text-rose-600">

                            <iconify-icon icon="solar:card-send-bold" class="text-[16px]"></iconify-icon>

                            <span>11 pengeluaran</span>

                        </div>

                    </div>

                    <!-- CARD 4: Total Transaksi -->
                    <div class="card stat-card p-6 fade-in-delay-4">

                        <div class="flex items-start justify-between mb-4">

                            <div>

                                <p class="text-sm text-slate-500 font-medium">
                                    Total Transaksi
                                </p>

                            </div>

                            <div class="icon-wrapper gradient-violet">
                                <iconify-icon icon="solar:clipboard-list-bold"></iconify-icon>
                            </div>

                        </div>

                        <h1 class="text-[32px] font-bold text-slate-900 mb-3">
                            29
                        </h1>

                        <div class="flex items-center gap-2 text-sm font-semibold text-violet-600">

                            <iconify-icon icon="solar:refresh-bold" class="text-[16px]"></iconify-icon>

                            <span>Update realtime</span>

                        </div>

                    </div>

                </div>

                <!-- MAIN GRID -->
                <div class="grid grid-cols-3 gap-6">

                    <!-- CHART SECTION -->
                    <div class="col-span-2 card p-8 fade-in-delay-1">

                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <h2 class="text-[22px] font-bold text-slate-900">
                                    Grafik Arus Kas
                                </h2>

                                <p class="text-sm text-slate-400 mt-2">
                                    Statistik pemasukan dan pengeluaran 7 hari terakhir
                                </p>

                            </div>

                            <div class="flex items-center gap-2">

                                <button class="h-11 px-5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-50 transition flex items-center gap-2">
                                    <iconify-icon icon="solar:calendar-linear" class="text-[18px]"></iconify-icon>
                                    7 Hari
                                </button>

                            </div>

                        </div>

                        <div class="chart-container h-[340px] relative">
                            <canvas id="cashChart"></canvas>
                        </div>

                        <!-- CHART INFO -->
                        <div class="grid grid-cols-2 gap-4 mt-8 pt-6 border-t border-slate-100">

                            <div>
                                <p class="text-xs text-slate-400 font-medium">Rata-rata Kas Masuk</p>
                                <h3 class="text-lg font-bold text-emerald-600 mt-2">Rp 1,057 Ribu</h3>
                            </div>

                            <div>
                                <p class="text-xs text-slate-400 font-medium">Rata-rata Kas Keluar</p>
                                <h3 class="text-lg font-bold text-rose-600 mt-2">Rp 500 Ribu</h3>
                            </div>

                        </div>

                    </div>

                    <!-- SUMMARY SECTION -->
                    <div class="card p-8 fade-in-delay-2">

                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <h2 class="text-[22px] font-bold text-slate-900">
                                    Ringkasan
                                </h2>

                                <p class="text-sm text-slate-400 mt-2">
                                    Bulan Mei 2026
                                </p>

                            </div>

                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center text-slate-600">

                                <iconify-icon icon="solar:chart-square-bold" class="text-[24px]"></iconify-icon>

                            </div>

                        </div>

                        <!-- ITEMS -->
                        <div class="space-y-1">

                            <!-- Saldo Awal -->
                            <div class="summary-item p-4 rounded-lg border border-transparent">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <p class="text-xs text-slate-400 font-medium">Saldo Awal</p>

                                        <h3 class="text-sm font-bold text-slate-800 mt-2">
                                            Rp 1.000.000
                                        </h3>

                                    </div>

                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">

                                        <iconify-icon icon="solar:wallet-bold"></iconify-icon>

                                    </div>

                                </div>

                            </div>

                            <!-- Kas Masuk -->
                            <div class="summary-item p-4 rounded-lg border border-transparent glow-emerald">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <p class="text-xs text-emerald-600 font-medium">Kas Masuk</p>

                                        <h3 class="text-sm font-bold text-emerald-700 mt-2">
                                            + Rp 5.000.000
                                        </h3>

                                    </div>

                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">

                                        <iconify-icon icon="solar:arrow-down-bold"></iconify-icon>

                                    </div>

                                </div>

                            </div>

                            <!-- Kas Keluar -->
                            <div class="summary-item p-4 rounded-lg border border-transparent glow-rose">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <p class="text-xs text-rose-600 font-medium">Kas Keluar</p>

                                        <h3 class="text-sm font-bold text-rose-700 mt-2">
                                            - Rp 2.500.000
                                        </h3>

                                    </div>

                                    <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600">

                                        <iconify-icon icon="solar:arrow-up-bold"></iconify-icon>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- DIVIDER -->
                        <div class="my-6 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

                        <!-- TOTAL SECTION -->
                        <div class="rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 p-6 text-white">

                            <div class="flex items-center justify-between mb-4">

                                <p class="text-xs text-slate-300 font-medium uppercase tracking-wide">
                                    Saldo Akhir
                                </p>

                                <div class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/30">

                                    <span class="text-xs font-bold text-emerald-300">+2,1JT</span>

                                </div>

                            </div>

                            <h1 class="text-[40px] font-bold mb-2">
                                Rp 3.5JT
                            </h1>

                            <p class="text-xs text-slate-400 mb-6">
                                Peningkatan dari saldo awal
                            </p>

                            <button class="w-full h-11 rounded-xl bg-gradient-to-r from-teal-400 to-emerald-500 text-slate-900 font-semibold text-sm hover:shadow-lg hover:shadow-emerald-500/30 transition">
                                Lihat Detail Lengkap
                            </button>

                        </div>

                    </div>

                </div>

                <!-- ADDITIONAL METRICS -->
                <div class="grid grid-cols-3 gap-6 mt-8 fade-in-delay-3">

                    <!-- Recent Activity -->
                    <div class="card p-6">

                        <div class="flex items-center justify-between mb-6">

                            <h3 class="text-[18px] font-bold text-slate-900">
                                Aktivitas Terbaru
                            </h3>

                            <iconify-icon icon="solar:arrow-right-linear" class="text-slate-400 text-[20px]"></iconify-icon>

                        </div>

                        <div class="space-y-4">

                            <div class="flex items-start gap-3 pb-4 border-b border-slate-100">

                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                    <iconify-icon icon="solar:arrow-down-bold"></iconify-icon>
                                </div>

                                <div class="flex-1">

                                    <p class="text-sm font-semibold text-slate-800">
                                        Pembayaran Kas Masuk
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Andi Saputra - 20 Mei
                                    </p>

                                </div>

                                <p class="text-sm font-bold text-emerald-600">
                                    + Rp 50K
                                </p>

                            </div>

                            <div class="flex items-start gap-3 pb-4 border-b border-slate-100">

                                <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600">
                                    <iconify-icon icon="solar:arrow-up-bold"></iconify-icon>
                                </div>

                                <div class="flex-1">

                                    <p class="text-sm font-semibold text-slate-800">
                                        Pengeluaran Kas
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Pembelian ATK - 19 Mei
                                    </p>

                                </div>

                                <p class="text-sm font-bold text-rose-600">
                                    - Rp 200K
                                </p>

                            </div>

                            <div class="flex items-start gap-3">

                                <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center text-sky-600">
                                    <iconify-icon icon="solar:check-circle-bold"></iconify-icon>
                                </div>

                                <div class="flex-1">

                                    <p class="text-sm font-semibold text-slate-800">
                                        Verifikasi Transaksi
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        18 transaksi - 18 Mei
                                    </p>

                                </div>

                                <p class="text-sm font-bold text-sky-600">
                                    18 item
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- Performance -->
                    <div class="card p-6">

                        <div class="flex items-center justify-between mb-6">

                            <h3 class="text-[18px] font-bold text-slate-900">
                                Performa
                            </h3>

                            <div class="px-3 py-1 rounded-full bg-emerald-100">
                                <span class="text-xs font-bold text-emerald-700">+12%</span>
                            </div>

                        </div>

                        <div class="space-y-5">

                            <div>

                                <div class="flex items-center justify-between mb-2">

                                    <p class="text-sm font-semibold text-slate-700">
                                        Target Kas Masuk
                                    </p>

                                    <p class="text-xs font-bold text-emerald-600">
                                        83%
                                    </p>

                                </div>

                                <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">

                                    <div class="h-full w-[83%] rounded-full bg-gradient-to-r from-emerald-400 to-teal-500"></div>

                                </div>

                            </div>

                            <div>

                                <div class="flex items-center justify-between mb-2">

                                    <p class="text-sm font-semibold text-slate-700">
                                        Target Kas Keluar
                                    </p>

                                    <p class="text-xs font-bold text-rose-600">
                                        45%
                                    </p>

                                </div>

                                <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">

                                    <div class="h-full w-[45%] rounded-full bg-gradient-to-r from-rose-400 to-pink-500"></div>

                                </div>

                            </div>

                            <div>

                                <div class="flex items-center justify-between mb-2">

                                    <p class="text-sm font-semibold text-slate-700">
                                        Efisiensi Keuangan
                                    </p>

                                    <p class="text-xs font-bold text-sky-600">
                                        92%
                                    </p>

                                </div>

                                <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">

                                    <div class="h-full w-[92%] rounded-full bg-gradient-to-r from-sky-400 to-cyan-500"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Quick Actions -->
                    <div class="card p-6">

                        <div class="flex items-center justify-between mb-6">

                            <h3 class="text-[18px] font-bold text-slate-900">
                                Aksi Cepat
                            </h3>

                            <iconify-icon icon="solar:bolt-circle-bold" class="text-slate-400 text-[20px]"></iconify-icon>

                        </div>

                        <div class="space-y-3">

                            <button class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-teal-300 transition group">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg bg-teal-100 group-hover:bg-teal-200 flex items-center justify-center text-teal-600 transition">
                                        <iconify-icon icon="solar:plus-circle-bold"></iconify-icon>
                                    </div>

                                    <span class="text-sm font-semibold text-slate-800">Tambah Kas Masuk</span>

                                </div>

                                <iconify-icon icon="solar:arrow-right-linear" class="text-slate-400"></iconify-icon>

                            </button>

                            <button class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-rose-300 transition group">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg bg-rose-100 group-hover:bg-rose-200 flex items-center justify-center text-rose-600 transition">
                                        <iconify-icon icon="solar:minus-circle-bold"></iconify-icon>
                                    </div>

                                    <span class="text-sm font-semibold text-slate-800">Tambah Kas Keluar</span>

                                </div>

                                <iconify-icon icon="solar:arrow-right-linear" class="text-slate-400"></iconify-icon>

                            </button>

                            <button class="w-full flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-sky-300 transition group">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg bg-sky-100 group-hover:bg-sky-200 flex items-center justify-center text-sky-600 transition">
                                        <iconify-icon icon="solar:download-linear"></iconify-icon>
                                    </div>

                                    <span class="text-sm font-semibold text-slate-800">Export Laporan</span>

                                </div>

                                <iconify-icon icon="solar:arrow-right-linear" class="text-slate-400"></iconify-icon>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

    <script>
        const ctx = document.getElementById('cashChart').getContext('2d');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: [
                    '17 Mei',
                    '18 Mei',
                    '19 Mei',
                    '20 Mei',
                    '21 Mei',
                    '22 Mei',
                    '23 Mei'
                ],

                datasets: [

                    {
                        label: 'Kas Masuk',
                        data: [500, 900, 700, 1200, 950, 1400, 1100],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.08)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        borderWidth: 3
                    },

                    {
                        label: 'Kas Keluar',
                        data: [300, 500, 400, 850, 600, 700, 500],
                        borderColor: '#F43F5E',
                        backgroundColor: 'rgba(244, 63, 94, 0.05)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#F43F5E',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        borderWidth: 3
                    }

                ]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 25,
                            color: '#64748B',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },

                    filler: {
                        propagate: true
                    }

                },

                scales: {

                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 12
                            }
                        }
                    },

                    y: {
                        grid: {
                            color: 'rgba(148, 163, 184, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 12
                            }
                        }
                    }

                }

            }

        });

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdownMenu');
            if (!e.target.closest('.relative')) {
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>

</html>