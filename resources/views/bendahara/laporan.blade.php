<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - KASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            overflow: hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar {
            display: none;
        }

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
            background: rgba(255, 255, 255, .02);
            transform: translateX(4px);
            color: #94a3b8;
        }

        .sidebar-active {
            background: rgba(255, 255, 255, .05);
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

        .table-row {
            transition: .2s ease;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        .input {
            width: 100%;
            height: 48px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 0 16px;
            font-size: 14px;
            outline: none;
            transition: .2s ease;
            background: white;
        }

        .input:focus {
            border-color: #14b8a6;
        }

        .btn {
            height: 48px;
            padding: 0 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
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
            <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">

                <div>

                    <p class="text-[12px] text-slate-400 font-medium">
                        Pages / Laporan
                    </p>

                    <h1 class="text-[21px] font-bold text-slate-800 mt-1">
                        Laporan Keuangan
                    </h1>

                </div>

                <div class="flex items-center gap-4">

                    <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                        <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    </button>

                    <div class="flex items-center gap-3">

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

                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-8">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h1 class="text-[32px] font-bold text-slate-900">
                            Data Laporan
                        </h1>

                        <p class="text-slate-500 text-sm mt-2">
                            Rekap laporan keuangan kas kelas secara lengkap.
                        </p>

                    </div>

                    <button class="btn bg-slate-900 text-white flex items-center gap-2">

                        <iconify-icon icon="solar:download-bold" class="text-[18px]"></iconify-icon>
                        Export PDF

                    </button>

                </div>

                <!-- FILTER -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6">

                    <div class="grid grid-cols-4 gap-4">

                        <div>
                            <label class="text-sm font-medium text-slate-700 mb-2 block">
                                Dari Tanggal
                            </label>

                            <input type="date" class="input">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-700 mb-2 block">
                                Sampai
                            </label>

                            <input type="date" class="input">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-700 mb-2 block">
                                Jenis
                            </label>

                            <select class="input">
                                <option>Semua</option>
                                <option>Kas Masuk</option>
                                <option>Kas Keluar</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button class="btn w-full bg-teal-500 text-white">
                                Tampilkan Data
                            </button>
                        </div>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                        <div>

                            <h2 class="text-[22px] font-bold text-slate-900">
                                Riwayat Laporan
                            </h2>

                            <p class="text-sm text-slate-400 mt-1">
                                Seluruh data transaksi kas kelas
                            </p>

                        </div>

                        <div class="flex items-center gap-3">

                            <div class="relative">

                                <iconify-icon icon="solar:magnifer-linear"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]"></iconify-icon>

                                <input type="text"
                                    placeholder="Cari laporan..."
                                    class="w-[250px] h-11 pl-11 pr-4 rounded-xl border border-slate-200 bg-slate-50 text-sm outline-none focus:border-teal-400">

                            </div>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-slate-50 border-b border-slate-200">

                                <tr>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">
                                        Nama Transaksi
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">
                                        Jenis
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">
                                        Tanggal
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">
                                        Nominal
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">
                                        Status
                                    </th>

                                    <th class="text-center px-6 py-4 text-sm font-semibold text-slate-500">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr class="table-row border-b border-slate-100">

                                    <td class="px-6 py-5">

                                        <div>

                                            <h1 class="text-sm font-semibold text-slate-800">
                                                Kas Mingguan
                                            </h1>

                                            <p class="text-xs text-slate-400 mt-1">
                                                Bendahara Kelas
                                            </p>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                            Kas Masuk
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-sm text-slate-600">
                                        25 Mei 2026
                                    </td>

                                    <td class="px-6 py-5 text-sm font-bold text-emerald-600">
                                        + Rp 500.000
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-semibold">
                                            Berhasil
                                        </span>
                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition">
                                                <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                            </button>

                                            <button class="w-9 h-9 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 flex items-center justify-center transition">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                                <tr class="table-row border-b border-slate-100">

                                    <td class="px-6 py-5">

                                        <div>

                                            <h1 class="text-sm font-semibold text-slate-800">
                                                Pembelian ATK
                                            </h1>

                                            <p class="text-xs text-slate-400 mt-1">
                                                Pengeluaran Kelas
                                            </p>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold">
                                            Kas Keluar
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-sm text-slate-600">
                                        24 Mei 2026
                                    </td>

                                    <td class="px-6 py-5 text-sm font-bold text-rose-600">
                                        - Rp 120.000
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                            Diproses
                                        </span>
                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition">
                                                <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                            </button>

                                            <button class="w-9 h-9 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 flex items-center justify-center transition">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                                <tr class="table-row">

                                    <td class="px-6 py-5">

                                        <div>

                                            <h1 class="text-sm font-semibold text-slate-800">
                                                Iuran Perpisahan
                                            </h1>

                                            <p class="text-xs text-slate-400 mt-1">
                                                Siswa Kelas
                                            </p>

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                            Kas Masuk
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-sm text-slate-600">
                                        23 Mei 2026
                                    </td>

                                    <td class="px-6 py-5 text-sm font-bold text-emerald-600">
                                        + Rp 300.000
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-semibold">
                                            Berhasil
                                        </span>
                                    </td>

                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition">
                                                <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                            </button>

                                            <button class="w-9 h-9 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 flex items-center justify-center transition">
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

</body>

</html>