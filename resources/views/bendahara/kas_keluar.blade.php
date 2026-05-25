<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Keluar - KASKU Online</title>

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

        .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            overflow: hidden;
        }

        .sidebar-item {
            transition: all .25s ease;
            color: #cbd5e1; 
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item:hover {
            background: rgba(255,255,255,.05);
            transform: translateX(4px);
            color: #ffffff;
        }

        .sidebar-active {
            background: linear-gradient(135deg, rgba(45, 212, 191, 0.15) 0%, rgba(16, 185, 129, 0.1) 100%);
            color: #2dd4bf;
            font-weight: 600;
            border-left: 4px solid #2dd4bf;
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

        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.9) 100%);
            backdrop-filter: blur(10px);
        }

        .stat-card {
            background: white;
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.04);
        }

        .table-header {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .table-hover:hover {
            background: linear-gradient(90deg, #fef2f2 0%, #f8fafc 100%);
        }

        .amount-negative {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #dc2626;
        }

        .btn-primary-dark {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            transition: all 0.3s ease;
        }

        .btn-primary-dark:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.15);
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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
                <p class="text-[12px] text-slate-400 font-medium">Pages / Kas Keluar</p>
                <h1 class="text-[20px] font-bold text-slate-800 mt-1">Data Kas Keluar</h1>
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
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">M</div>
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

        <div class="p-8 max-w-7xl mx-auto fade-in space-y-8">

            <div>
                <h1 class="text-[32px] font-bold text-slate-900 tracking-tight">Kas Keluar</h1>
                <p class="text-slate-500 text-sm mt-2">Daftar semua alokasi pembiayaan operasional beserta monitoring sisa anggaran bulanan.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="stat-card rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-sm font-medium">Total Pengeluaran</p>
                            <h3 class="text-[28px] font-bold text-red-600 mt-2">Rp 1.420.000</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-500 text-2xl">
                            <iconify-icon icon="solar:card-send-bold"></iconify-icon>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-400 flex items-center gap-1">
                        <iconify-icon icon="solar:calendar-linear"></iconify-icon> Periode bulan ini
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-500 text-sm font-medium">Item Pengeluaran</p>
                            <h3 class="text-[28px] font-bold text-slate-900 mt-2">12 Transaksi</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 text-2xl">
                            <iconify-icon icon="solar:bill-list-bold"></iconify-icon>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-400 flex items-center gap-1">
                        <iconify-icon icon="solar:check-circle-linear" class="text-emerald-500"></iconify-icon> Semua berkas tervalidasi
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 shadow-sm bg-gradient-to-br from-slate-900 to-slate-800 text-white border-0">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-slate-400 text-sm font-medium">Batas Anggaran Bulanan</p>
                        <span class="px-2 py-0.5 rounded bg-amber-500/20 text-amber-400 text-[11px] font-bold tracking-wide uppercase">71% Terpakai</span>
                    </div>
                    <h3 class="text-[22px] font-bold text-white">Rp 1.420.000 <span class="text-xs text-slate-400 font-normal">/ Rp 2.000.000</span></h3>
                    
                    <div class="w-full bg-slate-700 h-2 rounded-full mt-4 overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-400 to-red-500 h-full rounded-full" style="width: 71%"></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-3">Sisa kuota aman anggaran bulan ini: <span class="text-slate-200 font-semibold">Rp 580.000</span></p>
                </div>

            </div>

            <div class="p-4 rounded-2xl bg-white border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 text-xl flex-shrink-0">
                        <iconify-icon icon="solar:pie-chart-3-bold"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Analisis Pengeluaran Tertinggi</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Alokasi dana paling banyak bulan ini diserap oleh kategori <strong class="text-slate-700">Kebutuhan ATK & Sarana Kelas (45%)</strong>.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 border border-slate-200 rounded-xl transition flex items-center gap-1.5">
                        <iconify-icon icon="solar:printer-linear"></iconify-icon> Cetak Log
                    </button>
                    <button class="px-4 py-2 text-xs font-semibold text-white btn-primary-dark rounded-xl transition flex items-center gap-1.5">
                        <iconify-icon icon="solar:download-linear"></iconify-icon> Ekspor Excel
                    </button>
                </div>
            </div>

            <div class="card-gradient rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden bg-white">

                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h2 class="text-[18px] font-bold text-slate-900">Riwayat Pengeluaran Real-time</h2>
                        <p class="text-sm text-slate-400 mt-1">Daftar transparansi penggunaan dana kas keluar fisik dan digital.</p>
                    </div>

                    <div>
                        <a href="#" class="btn-primary-dark text-white px-5 py-3 rounded-xl font-semibold shadow-md flex items-center gap-2 text-sm hover:text-white">
                            <iconify-icon icon="solar:add-circle-bold" class="text-[18px]"></iconify-icon>
                            Tambah Kas Keluar
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-header">
                            <tr class="text-left">
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-center w-16">No</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider">Keterangan Penggunaan Dana</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-right">Nominal</th>
                                <th class="px-6 py-4 text-[12px] font-bold text-slate-600 uppercase tracking-wider text-center w-28">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5 text-center text-slate-500 font-medium">1</td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-700 font-medium">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400 text-[16px]"></iconify-icon>
                                        22 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <iconify-icon icon="solar:notes-linear" class="text-slate-400 text-[16px]"></iconify-icon>
                                        <span>Pembelian Spidol, Tinta Isi Ulang, & Penghapus Papan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-negative font-bold px-3 py-1.5 rounded-lg text-xs inline-block">
                                        - Rp 35.000
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center">
                                        <button onclick="return confirm('Hapus data pengeluaran ini?')" class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="table-hover border-t border-slate-100 transition">
                                <td class="px-6 py-5 text-center text-slate-500 font-medium">2</td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-700 font-medium">
                                        <iconify-icon icon="solar:calendar-linear" class="text-slate-400 text-[16px]"></iconify-icon>
                                        15 Mei 2026
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <iconify-icon icon="solar:notes-linear" class="text-slate-400 text-[16px]"></iconify-icon>
                                        <span>Foto kopi Lembar Kerja Bahan Materi Ujian Kelompok</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="amount-negative font-bold px-3 py-1.5 rounded-lg text-xs inline-block">
                                        - Rp 120.000
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center">
                                        <button onclick="return confirm('Hapus data pengeluaran ini?')" class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-[18px]"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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