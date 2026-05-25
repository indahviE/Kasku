<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Masuk - KASKU Online</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar{
            display:none;
        }

        /* Warna Navy Sangat Gelap Sesuai Foto */
        .sidebar {
            background: #0a0f1d; 
            overflow: hidden;
        }

        .sidebar-item {
            transition: all .25s ease;
            color: #64748b; 
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item:hover {
            background: rgba(255,255,255,.02);
            transform: translateX(4px);
            color: #94a3b8;
        }

        .sidebar-active {
            background: rgba(255, 255, 255, 0.05); 
            color: #ffffff; 
            font-weight: 500;
            position: relative;
        }

        /* Garis Indikator Hijau Toska di Samping Kiri Menu Aktif */
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

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all .25s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .table-hover:hover {
            background: linear-gradient(90deg, #f0fdf4 0%, #f8fafc 100%);
        }

        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.9) 100%);
            backdrop-filter: blur(10px);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(226, 232, 240, 0.5);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: rgba(45, 212, 191, 0.3);
        }

        .badge-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        }

        .badge-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .action-button {
            transition: all 0.2s ease;
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .table-header {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1), 0 0 0 1px #2dd4bf;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.15);
        }

        .amount-positive {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #047857;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-icon {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
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

    <div class="ml-[250px] flex-1 overflow-y-auto h-screen">

        <div class="h-[70px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20 shadow-sm">

            <div>
                <p class="text-[12px] text-slate-400 font-medium">
                    Pages / Kas Masuk
                </p>
                <h1 class="text-[20px] font-bold text-slate-800 mt-1">
                    Data Kas Masuk
                </h1>
            </div>

            <div class="flex items-center gap-4">

                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                    <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 pulse-icon"></div>
                </button>

                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3">
                        <div class="text-right">
                            <h1 class="text-[13px] font-bold text-slate-800">Melina Detiana</h1>
                            <p class="text-[11px] text-slate-400">Bendahara</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">
                            M
                        </div>
                        <iconify-icon icon="solar:alt-arrow-down-linear" class="text-[16px] text-slate-500"></iconify-icon>
                    </button>

                    <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                        <a href="#" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:user-linear"></iconify-icon>Profile
                        </a>
                        <a href="#" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:settings-linear"></iconify-icon>Pengaturan
                        </a>
                        <button class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                            <iconify-icon icon="solar:logout-2-linear"></iconify-icon>Logout
                        </button>
                    </div>
                </div>

            </div>

        </div>

        <div class="p-8">

            <div class="mb-10 fade-in">
                <h1 class="text-[32px] font-bold text-slate-900">Kelola Kas Masuk</h1>
                <p class="text-slate-500 text-sm mt-2">
                    Kelola data pemasukan kas kelas dengan mudah dan efisien
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stat-card rounded-2xl p-6 shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-sm font-medium">Total Kas Masuk</p>
                            <h3 class="text-[28px] font-bold text-slate-900 mt-2">Rp 3.250.000</h3>
                            <p class="text-emerald-600 text-xs font-semibold mt-3 flex items-center gap-1">
                                <iconify-icon icon="solar:arrow-up-linear" class="text-[14px]"></iconify-icon>
                                12% dari bulan lalu
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <iconify-icon icon="solar:money-bag-bold" class="text-[28px] text-emerald-600"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-sm font-medium">Transaksi Berhasil</p>
                            <h3 class="text-[28px] font-bold text-slate-900 mt-2">24</h3>
                            <p class="text-blue-600 text-xs font-semibold mt-3 flex items-center gap-1">
                                <iconify-icon icon="solar:check-circle-linear" class="text-[14px]"></iconify-icon>
                                Transaksi aktif
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center">
                            <iconify-icon icon="solar:check-circle-bold" class="text-[28px] text-blue-600"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 shadow-sm border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-sm font-medium">Rata-rata per Transaksi</p>
                            <h3 class="text-[28px] font-bold text-slate-900 mt-2">Rp 135.416</h3>
                            <p class="text-purple-600 text-xs font-semibold mt-3 flex items-center gap-1">
                                <iconify-icon icon="solar:calculator-linear" class="text-[14px]"></iconify-icon>
                                Dari total kas
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                            <iconify-icon icon="solar:calculator-bold" class="text-[28px] text-purple-600"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-gradient rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">
                    <div class="relative w-full lg:w-[400px]">
                        <iconify-icon icon="solar:magnifier-linear" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]"></iconify-icon>
                        <input type="text" placeholder="Cari nama atau keterangan kas masuk..." class="search-input w-full h-12 rounded-xl border border-slate-200 pl-12 pr-4 outline-none focus:ring-2 focus:ring-teal-500/20 text-slate-700 placeholder-slate-400">
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="h-12 px-6 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:border-slate-300 transition flex items-center gap-2">
                            <iconify-icon icon="solar:filter-linear" class="text-[18px]"></iconify-icon>Filter
                        </button>
                        <button class="h-12 px-6 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:border-slate-300 transition flex items-center gap-2">
                            <iconify-icon icon="solar:download-linear" class="text-[18px]"></iconify-icon>Export
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-gradient rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                <div class="px-6 py-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-[18px] font-bold text-slate-900">Riwayat Kas Masuk</h2>
                        <p class="text-sm text-slate-400 mt-1">
                            <span class="font-semibold text-slate-600">24 data</span> kas masuk tersedia
                        </p>
                    </div>

                    <div>
                        <button class="btn-primary text-white px-5 py-3 rounded-xl font-semibold shadow-md flex items-center gap-2 hover:text-white text-sm">
                            <iconify-icon icon="solar:add-circle-bold" class="text-[18px]"></iconify-icon>
                            Tambah Kas
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="table-header">
                            <tr class="text-left">
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-right">Nominal</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-center">Status</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center font-bold text-white shadow-md">A</div>
                                        <div>
                                            <h3 class="font-semibold text-slate-800 text-sm">Andi Saputra</h3>
                                            <p class="text-xs text-slate-400 mt-0.5">XI RPL 1</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <iconify-icon icon="solar:wallet-linear" class="text-teal-600 text-[16px]"></iconify-icon>
                                        <span class="text-slate-600 text-sm">Pembayaran kas mingguan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600 text-sm">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400"></iconify-icon>20 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-positive font-bold px-3 py-1.5 rounded-lg text-sm">+ Rp 50.000</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="badge-success text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-linear" class="text-[14px]"></iconify-icon>Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="action-button w-10 h-10 rounded-lg bg-slate-100 hover:bg-blue-100 transition flex items-center justify-center text-slate-600 hover:text-blue-600" title="Edit">
                                            <iconify-icon icon="solar:pen-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                        <button class="action-button w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500 hover:text-red-600" title="Hapus">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center font-bold text-white shadow-md">S</div>
                                        <div>
                                            <h3 class="font-semibold text-slate-800 text-sm">Siti Nurhaliza</h3>
                                            <p class="text-xs text-slate-400 mt-0.5">XI RPL 1</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <iconify-icon icon="solar:calendar-bold" class="text-amber-600 text-[16px]"></iconify-icon>
                                        <span class="text-slate-600 text-sm">Pembayaran kas bulanan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600 text-sm">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400"></iconify-icon>18 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-positive font-bold px-3 py-1.5 rounded-lg text-sm">+ Rp 18.000</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="badge-success text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-linear" class="text-[14px]"></iconify-icon>Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="action-button w-10 h-10 rounded-lg bg-slate-100 hover:bg-blue-100 transition flex items-center justify-center text-slate-600 hover:text-blue-600" title="Edit">
                                            <iconify-icon icon="solar:pen-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                        <button class="action-button w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500 hover:text-red-600" title="Hapus">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center font-bold text-white shadow-md">R</div>
                                        <div>
                                            <h3 class="font-semibold text-slate-800 text-sm">Rini Handayani</h3>
                                            <p class="text-xs text-slate-400 mt-0.5">XI RPL 2</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <iconify-icon icon="solar:gift-linear" class="text-pink-600 text-[16px]"></iconify-icon>
                                        <span class="text-slate-600 text-sm">Iuran dana sosial</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600 text-sm">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400"></iconify-icon>19 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-positive font-bold px-3 py-1.5 rounded-lg text-sm">+ Rp 75.000</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="badge-success text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-linear" class="text-[14px]"></iconify-icon>Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="action-button w-10 h-10 rounded-lg bg-slate-100 hover:bg-blue-100 transition flex items-center justify-center text-slate-600 hover:text-blue-600" title="Edit">
                                            <iconify-icon icon="solar:pen-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                        <button class="action-button w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500 hover:text-red-600" title="Hapus">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center font-bold text-white shadow-md">B</div>
                                        <div>
                                            <h3 class="font-semibold text-slate-800 text-sm">Bambang Sutrisno</h3>
                                            <p class="text-xs text-slate-400 mt-0.5">XI RPL 2</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <iconify-icon icon="solar:book-linear" class="text-orange-600 text-[16px]"></iconify-icon>
                                        <span class="text-slate-600 text-sm">Pembayaran buku tulis</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600 text-sm">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400"></iconify-icon>17 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-positive font-bold px-3 py-1.5 rounded-lg text-sm">+ Rp 25.000</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="badge-success text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-linear" class="text-[14px]"></iconify-icon>Berhasil
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="action-button w-10 h-10 rounded-lg bg-slate-100 hover:bg-blue-100 transition flex items-center justify-center text-slate-600 hover:text-blue-600" title="Edit">
                                            <iconify-icon icon="solar:pen-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                        <button class="action-button w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500 hover:text-red-600" title="Hapus">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-5 border-t border-slate-100 flex items-center justify-between bg-slate-50">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-semibold text-slate-700">4 dari 24</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        <button class="w-10 h-10 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition font-medium">‹</button>
                        <button class="w-10 h-10 rounded-lg bg-teal-500 text-white font-medium">1</button>
                        <button class="w-10 h-10 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition font-medium">2</button>
                        <button class="w-10 h-10 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition font-medium">3</button>
                        <button class="w-10 h-10 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition font-medium">›</button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
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