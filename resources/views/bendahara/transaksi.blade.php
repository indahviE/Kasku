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
            background:linear-gradient(135deg,#f1f5f9 0%,#e2e8f0 100%);
            overflow:hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar{
            display:none;
        }

        /* SIDEBAR */
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
            color:#ffffff;
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

        /* CARD */
        .card{
            background:rgba(255,255,255,.92);
            border:1px solid rgba(226,232,240,.7);
            border-radius:24px;
            backdrop-filter:blur(12px);
            box-shadow:0 10px 30px rgba(15,23,42,.05);
        }

        .table-row{
            transition:.2s ease;
        }

        .table-row:hover{
            background:#f8fafc;
        }

        .badge-success{
            background:#dcfce7;
            color:#166534;
        }

        .badge-warning{
            background:#fef3c7;
            color:#92400e;
        }

        .badge-danger{
            background:#fee2e2;
            color:#b91c1c;
        }

        .btn-primary{
            background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);
            transition:all .3s ease;
        }

        .btn-primary:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 24px rgba(15,23,42,.15);
        }

        .dropdown-menu{
            opacity:0;
            visibility:hidden;
            transform:translateY(-10px);
            transition:all .25s ease;
        }

        .dropdown-menu.show{
            opacity:1;
            visibility:visible;
            transform:translateY(0);
        }

        .pulse-icon{
            animation:pulse 2s cubic-bezier(0.4,0,0.6,1) infinite;
        }

        @keyframes pulse{
            0%,100%{
                opacity:1;
            }

            50%{
                opacity:.5;
            }
        }

        .search-input:focus{
            box-shadow:0 0 0 3px rgba(45,212,191,.1),
            0 0 0 1px #2dd4bf;
        }
    </style>
</head>

<body>

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="sidebar w-[250px] fixed h-screen text-white flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="px-6 py-6 flex items-center gap-4 border-b border-white/5">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-500/20">
                    <iconify-icon icon="solar:wallet-bold"></iconify-icon>
                </div>

                <div>
                    <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">
                        KASKU
                    </h1>

                    <p class="text-[11px] text-slate-500 font-medium mt-1">
                        Online
                    </p>
                </div>

            </div>

            <!-- MENU -->
            <div class="px-4 mt-6">

                <nav class="space-y-1">

                    <a href="{{ route('bendahara.dashboard') }}"
                       class="sidebar-item">

                        <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                        <span>Dashboard</span>

                    </a>

                    <a href="{{ route('bendahara.kas_masuk') }}"
                       class="sidebar-item">

                        <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Masuk</span>

                    </a>

                    <a href="{{ route('bendahara.kas_keluar') }}"
                       class="sidebar-item">

                        <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Keluar</span>

                    </a>

                    <a href="{{ route('bendahara.transaksi') }}"
                       class="sidebar-item sidebar-active">

                        <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                        <span>Transaksi</span>

                    </a>

                    <a href="{{ route('bendahara.tagihan') }}"
                       class="sidebar-item">

                        <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                        <span>Tagihan</span>

                    </a>

                    <a href="{{ route('bendahara.laporan') }}"
                       class="sidebar-item">

                        <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                        <span>Laporan</span>

                    </a>

                </nav>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="p-4 border-t border-white/5">

            <a href="{{ route('bendahara.pengaturan') }}"
               class="sidebar-item">

                <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                <span>Pengaturan</span>

            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="ml-[250px] flex-1 overflow-y-auto">

        <!-- NAVBAR -->
        <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20 shadow-sm">

            <div>

                <p class="text-[12px] text-slate-400 font-medium">
                    Pages / Transaksi
                </p>

                <h1 class="text-[21px] font-bold text-slate-800 mt-1">
                    Data Transaksi
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

                        <iconify-icon icon="solar:alt-arrow-down-linear" class="text-[16px] text-slate-500"></iconify-icon>

                    </button>

                    <!-- DROPDOWN -->
                    <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

                        <a href="{{ route('bendahara.profile') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:user-linear"></iconify-icon>
                            Profile
                        </a>

                        <a href="{{ route('bendahara.pengaturan') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:settings-linear"></iconify-icon>
                            Pengaturan
                        </a>

                        <button class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                            <iconify-icon icon="solar:logout-2-linear"></iconify-icon>
                            Logout
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-7 space-y-6">

            <!-- HEADER -->
            <div>

                <h1 class="text-[30px] font-bold text-slate-900">
                    Transaksi Keuangan
                </h1>

                <p class="text-slate-500 text-sm mt-2">
                    Kelola seluruh transaksi pemasukan dan pengeluaran kelas.
                </p>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-4 gap-5">

                <div class="card p-5">

                    <div class="flex items-center justify-between mb-4">

                        <div>
                            <p class="text-sm text-slate-500">Total Transaksi</p>
                            <h1 class="text-[28px] font-bold text-slate-900 mt-2">128</h1>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-violet-100 text-violet-600 flex items-center justify-center">
                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[22px]"></iconify-icon>
                        </div>

                    </div>

                    <p class="text-xs text-emerald-600 font-semibold">
                        +12 transaksi minggu ini
                    </p>

                </div>

                <div class="card p-5">

                    <div class="flex items-center justify-between mb-4">

                        <div>
                            <p class="text-sm text-slate-500">Kas Masuk</p>
                            <h1 class="text-[28px] font-bold text-slate-900 mt-2">Rp 5JT</h1>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <iconify-icon icon="solar:wallet-money-bold" class="text-[22px]"></iconify-icon>
                        </div>

                    </div>

                    <p class="text-xs text-emerald-600 font-semibold">
                        Pemasukan meningkat
                    </p>

                </div>

                <div class="card p-5">

                    <div class="flex items-center justify-between mb-4">

                        <div>
                            <p class="text-sm text-slate-500">Kas Keluar</p>
                            <h1 class="text-[28px] font-bold text-slate-900 mt-2">Rp 2JT</h1>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center">
                            <iconify-icon icon="solar:card-send-bold" class="text-[22px]"></iconify-icon>
                        </div>

                    </div>

                    <p class="text-xs text-rose-600 font-semibold">
                        11 pengeluaran bulan ini
                    </p>

                </div>

                <div class="card p-5">

                    <div class="flex items-center justify-between mb-4">

                        <div>
                            <p class="text-sm text-slate-500">Saldo Akhir</p>
                            <h1 class="text-[28px] font-bold text-slate-900 mt-2">Rp 3JT</h1>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center">
                            <iconify-icon icon="solar:dollar-bold" class="text-[22px]"></iconify-icon>
                        </div>

                    </div>

                    <p class="text-xs text-sky-600 font-semibold">
                        Saldo stabil
                    </p>

                </div>

            </div>

            <!-- TABLE -->
            <div class="card overflow-hidden">

                <!-- TOP -->
                <div class="px-6 py-6 border-b border-slate-100 flex items-center justify-between flex-wrap gap-4">

                    <div>

                        <h2 class="text-[22px] font-bold text-slate-900">
                            Riwayat Transaksi
                        </h2>

                        <p class="text-sm text-slate-400 mt-1">
                            Daftar seluruh aktivitas keuangan kelas
                        </p>

                    </div>

                    <!-- BUTTON -->
                    <button class="btn-primary text-white px-5 py-3 rounded-xl font-semibold shadow-md flex items-center gap-2 text-sm">

                        <iconify-icon icon="solar:add-circle-bold" class="text-[18px]"></iconify-icon>
                        Tambah Transaksi

                    </button>

                </div>

                <!-- SEARCH -->
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between flex-wrap gap-4">

                    <div class="relative">

                        <iconify-icon icon="solar:magnifer-linear"
                                       class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]"></iconify-icon>

                        <input type="text"
                               placeholder="Cari transaksi..."
                               class="search-input w-[280px] h-12 rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm outline-none">

                    </div>

                    <button class="h-12 px-5 rounded-xl border border-slate-200 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 transition flex items-center gap-2">

                        <iconify-icon icon="solar:filter-bold"></iconify-icon>
                        Filter

                    </button>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-50">

                            <tr class="border-b border-slate-200">

                                <th class="text-left py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Nama
                                </th>

                                <th class="text-left py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Jenis
                                </th>

                                <th class="text-left py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Tanggal
                                </th>

                                <th class="text-left py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Nominal
                                </th>

                                <th class="text-left py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Status
                                </th>

                                <th class="text-center py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="table-row border-b border-slate-100">

                                <td class="py-5 px-6">

                                    <div>
                                        <h1 class="text-sm font-semibold text-slate-800">
                                            Kas Bulanan Mei
                                        </h1>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Melina Detiana
                                        </p>
                                    </div>

                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-success">
                                        Kas Masuk
                                    </span>

                                </td>

                                <td class="py-5 px-6 text-sm text-slate-600">
                                    25 Mei 2026
                                </td>

                                <td class="py-5 px-6 text-sm font-bold text-emerald-600">
                                    + Rp 50.000
                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-success">
                                        Selesai
                                    </span>

                                </td>

                                <td class="py-5 px-6">

                                    <div class="flex items-center justify-center gap-2">

                                        <button class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr class="table-row border-b border-slate-100">

                                <td class="py-5 px-6">

                                    <div>
                                        <h1 class="text-sm font-semibold text-slate-800">
                                            Pembelian ATK
                                        </h1>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Nafisah Adelia
                                        </p>
                                    </div>

                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-danger">
                                        Kas Keluar
                                    </span>

                                </td>

                                <td class="py-5 px-6 text-sm text-slate-600">
                                    24 Mei 2026
                                </td>

                                <td class="py-5 px-6 text-sm font-bold text-rose-600">
                                    - Rp 120.000
                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-warning">
                                        Diproses
                                    </span>

                                </td>

                                <td class="py-5 px-6">

                                    <div class="flex items-center justify-center gap-2">

                                        <button class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr class="table-row">

                                <td class="py-5 px-6">

                                    <div>
                                        <h1 class="text-sm font-semibold text-slate-800">
                                            Iuran Perpisahan
                                        </h1>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Syafa Inesya
                                        </p>
                                    </div>

                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-success">
                                        Kas Masuk
                                    </span>

                                </td>

                                <td class="py-5 px-6 text-sm text-slate-600">
                                    23 Mei 2026
                                </td>

                                <td class="py-5 px-6 text-sm font-bold text-emerald-600">
                                    + Rp 150.000
                                </td>

                                <td class="py-5 px-6">

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-success">
                                        Selesai
                                    </span>

                                </td>

                                <td class="py-5 px-6">

                                    <div class="flex items-center justify-center gap-2">

                                        <button class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                        </button>

                                        <button class="w-9 h-9 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center hover:scale-105 transition">
                                            <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

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