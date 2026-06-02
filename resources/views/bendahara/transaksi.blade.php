<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - KASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background: #f1f5f9;
            overflow:hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar{
            display:none;
        }

        .sidebar{
            background:#0a0f1d;
            overflow:hidden;
        }

        .sidebar-item{
            transition:all .25s ease;
            color:#64748b;
            font-size:14px;
            padding:12px 16px;
            border-radius:12px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .sidebar-item:hover{
            background:rgba(255,255,255,.02);
            transform:translateX(4px);
            color:#94a3b8;
        }

        .sidebar-active{
            background:rgba(255,255,255,.05);
            color:#fff;
            font-weight:500;
            position:relative;
        }

        .sidebar-active::before{
            content:"";
            position:absolute;
            left:0;
            top:25%;
            height:50%;
            width:4px;
            background-color:#2dd4bf;
            border-radius:0 4px 4px 0;
        }

        /* CARD STYLE DARI LAPORAN */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px 22px;
            border: 1px solid #e2e8f0;
            transition: .2s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
        }

        .stat-card .arrow-btn {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            transition: .2s;
            cursor: pointer;
            border: none;
        }

        .stat-card .arrow-btn:hover {
            background: #e2e8f0;
        }

        .badge-green { background: #dcfce7; color: #16a34a; }
        .badge-red   { background: #fee2e2; color: #dc2626; }

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
    </style>
</head>
<body>

<div class="flex h-screen overflow-hidden">

    <aside class="sidebar w-[250px] fixed h-screen text-white flex flex-col justify-between z-10">
        <div>
            <div class="px-6 py-6 flex items-center gap-4 border-b border-white/5">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-500/20">
                    <iconify-icon icon="solar:wallet-bold"></iconify-icon>
                </div>
                <div>
                    <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">KASKU</h1>
                    <p class="text-[11px] text-slate-500 font-medium mt-1 flex items-center gap-1">Online</p>
                </div>
            </div>

            <div class="px-4 mt-6">
                <nav class="space-y-1">
                    <a href="{{ route('bendahara.dashboard') }}" class="sidebar-item">
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
                    <a href="{{ route('bendahara.transaksi') }}" class="sidebar-item sidebar-active">
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

    <main class="ml-[250px] flex-1 overflow-y-auto h-screen flex flex-col">

        <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between shadow-sm sticky top-0 z-20 flex-shrink-0">
            <div>
                <p class="text-[12px] text-slate-400 font-medium">Pages / Transaksi</p>
                <h1 class="text-[20px] font-bold text-slate-800 mt-1">Jurnal Arus Kas</h1>
            </div>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                    <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></div>
                </button>

                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3">
                        <div class="text-right">
                            <h1 class="text-[13px] font-bold text-slate-800">Melina Detiana</h1>
                            <p class="text-[11px] text-slate-400">Bendahara</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">M</div>
                    </button>

                    <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                        <a href="{{ route('bendahara.profile') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:user-linear"></iconify-icon> Profile
                        </a>
                        <a href="{{ route('bendahara.pengaturan') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:settings-linear"></iconify-icon> Pengaturan
                        </a>
                        <button class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                            <iconify-icon icon="solar:logout-2-linear"></iconify-icon> Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-7 space-y-6 flex-1">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Riwayat Mutasi Transaksi</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Jurnal log akuntansi pencatatan kas masuk dan keluar keseluruhan secara real-time.</p>
                </div>
                <div class="flex bg-white border border-slate-200 rounded-xl p-1 shadow-sm h-11 items-center">
                    <button class="px-4 h-full text-xs font-bold rounded-lg bg-slate-950 text-white shadow-sm">Semua</button>
                    <button class="px-4 h-full text-xs font-semibold text-slate-500 hover:text-slate-800 transition">Masuk</button>
                    <button class="px-4 h-full text-xs font-semibold text-slate-500 hover:text-slate-800 transition">Keluar</button>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Dana Masuk</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">Rp 12.450<span class="text-slate-400">.000</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold badge-green">↑ 12.1%</span>
                        <span class="text-[11px] text-slate-400">vs bulan lalu</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Dana Keluar</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">Rp 4.120<span class="text-slate-400">.000</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold badge-red">↑ 2.4%</span>
                        <span class="text-[11px] text-slate-400">vs bulan lalu</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Log Jurnal</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">158 <span class="text-slate-400">Log</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold badge-green">↑ 6.3%</span>
                        <span class="text-[11px] text-slate-400">Aktif</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Verifikasi Tertunda</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-amber-600">3 <span class="text-amber-500/60">Log</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold badge-red">Perlu Cek</span>
                        <span class="text-[11px] text-slate-400">Belum disetujui</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center justify-between gap-4 shadow-sm">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon></span>
                    <input type="text" placeholder="Cari ID transaksi, nama, kategori mutasi..." class="w-full h-11 pl-11 pr-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-slate-800 outline-none transition font-medium text-slate-700">
                </div>
                <div class="flex items-center gap-2">
                    <input type="date" class="h-11 px-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 outline-none focus:bg-white transition cursor-pointer">
                    <button class="h-11 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition flex items-center gap-2">
                        <iconify-icon icon="solar:export-linear" class="text-lg"></iconify-icon> Export Excel
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200">
                                <th class="px-6 py-4">ID Transaksi / Deskripsi</th>
                                <th class="px-6 py-4">Kategori Jurnal</th>
                                <th class="px-6 py-4">Tanggal & Waktu</th>
                                <th class="px-6 py-4 text-right">Jumlah Mutasi</th>
                                <th class="px-6 py-4 text-center">Aksi / CRUD</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-600 font-medium">
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg shadow-sm"><iconify-icon icon="solar:long-arrow-down-left-bold"></iconify-icon></div>
                                        <div>
                                            <span class="font-bold text-slate-800 block text-[13px]">Andi Saputra membayar kas wajib</span>
                                            <span class="text-[10px] text-slate-400 font-medium">Operator: Melina Detiana</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-lg bg-teal-50 text-teal-600 text-[10px] font-bold border border-teal-100">Kas Masuk</span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">28 Mei 2026, 14:20 PM</td>
                                <td class="px-6 py-4 text-right font-extrabold text-emerald-500 text-sm">+ Rp 50.000</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button title="Detail" class="w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-500 flex items-center justify-center transition"><iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon></button>
                                        <button title="Ubah" class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center transition"><iconify-icon icon="solar:pen-linear" class="text-base"></iconify-icon></button>
                                        <button title="Hapus" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition"><iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg shadow-sm"><iconify-icon icon="solar:long-arrow-up-right-bold"></iconify-icon></div>
                                        <div>
                                            <span class="font-bold text-slate-800 block text-[13px]">Fotocopy Modul Fisika</span>
                                            <span class="text-[10px] text-slate-400 font-medium">Operator: Melina Detiana</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-600 text-[10px] font-bold border border-rose-100">Kas Keluar</span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">26 Mei 2026, 09:15 AM</td>
                                <td class="px-6 py-4 text-right font-extrabold text-rose-500 text-sm">- Rp 120.000</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button title="Detail" class="w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-500 flex items-center justify-center transition"><iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon></button>
                                        <button title="Ubah" class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center transition"><iconify-icon icon="solar:pen-linear" class="text-base"></iconify-icon></button>
                                        <button title="Hapus" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition"><iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-200 flex items-center justify-between bg-slate-50/50">
                    <p class="text-xs text-slate-400 font-medium">Menampilkan <span class="font-semibold text-slate-700">1-2 dari 158</span> transaksi keseluruhan</p>
                    <div class="flex items-center gap-1">
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-100 text-xs font-semibold transition">‹</button>
                        <button class="px-3 py-1.5 bg-slate-950 text-white rounded-lg text-xs font-bold shadow-sm">1</button>
                        <button class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-100 text-xs font-semibold transition">›</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    function toggleDropdown() { document.getElementById('dropdownMenu').classList.toggle('show'); }
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) { document.getElementById('dropdownMenu').classList.remove('show'); }
    });
</script>
</body>
</html>