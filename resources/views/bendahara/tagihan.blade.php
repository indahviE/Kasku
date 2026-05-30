<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan - KASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            overflow: hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar {
            display: none;
        }

        .table-row {
            transition: .2s ease;
        }

        .table-row:hover {
            background: #f8fafc;
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

        .card-table {
            background: rgba(255, 255, 255, .95);
            border: 1px solid rgba(226, 232, 240, .8);
            border-radius: 24px;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(to right, #2dd4bf, #10b981);
            transition: .2s ease;
        }

        .btn-primary:hover {
            transform: scale(1.02);
        }

        .success-alert {
            animation: fadeIn .3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
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
                        Pages / Tagihan
                    </p>

                    <h1 class="text-[21px] font-bold text-slate-800 mt-1">
                        Data Tagihan
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
            <div class="p-7 space-y-6">

                @if(session('success'))
                <div class="success-alert bg-emerald-100 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl flex items-center gap-3">

                    <iconify-icon icon="solar:check-circle-bold" class="text-[22px]"></iconify-icon>

                    <span class="text-sm font-medium">
                        Tagihan berhasil dibuat
                    </span>

                </div>
                @endif

                <!-- HEADER -->
                <div class="flex items-center justify-between">

                    <div>

                        <h1 class="text-[30px] font-bold text-slate-900">
                            Tagihan Kelas
                        </h1>

                        <p class="text-slate-500 text-sm mt-2">
                            Kelola seluruh tagihan pembayaran kas siswa.
                        </p>

                    </div>

                    <a href="{{ route('bendahara.tagihan.create') }}"
                        class="h-12 px-5 rounded-2xl bg-gradient-to-r from-teal-400 to-emerald-500 text-slate-900 font-semibold flex items-center gap-2">

                        <iconify-icon icon="solar:add-circle-bold" class="text-[20px]"></iconify-icon>

                        Tambah Tagihan

                    </a>

                </div>

                <!-- TABLE -->
                <div class="card-table">

                    <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                        <div>

                            <h2 class="text-[22px] font-bold text-slate-900">
                                Daftar Tagihan
                            </h2>

                            <p class="text-sm text-slate-400 mt-1">
                                Seluruh tagihan pembayaran siswa
                            </p>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="text-left py-4 px-6 text-sm font-semibold text-slate-500">
                                        Nama Tagihan
                                    </th>

                                    <th class="text-left py-4 px-6 text-sm font-semibold text-slate-500">
                                        Periode
                                    </th>

                                    <th class="text-left py-4 px-6 text-sm font-semibold text-slate-500">
                                        Nominal
                                    </th>

                                    <th class="text-left py-4 px-6 text-sm font-semibold text-slate-500">
                                        Deadline
                                    </th>

                                    <th class="text-center py-4 px-6 text-sm font-semibold text-slate-500">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="bg-white">

                                <tr class="table-row border-b border-slate-100">

                                    <td class="py-5 px-6">

                                        <h1 class="text-sm font-semibold text-slate-800">
                                            Kas 1 Minggu
                                        </h1>

                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        Mei 2026
                                    </td>

                                    <td class="py-5 px-6 text-sm font-bold text-emerald-600">
                                        Rp 50.000
                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        30 Mei 2026
                                    </td>

                                    <td class="py-5 px-6">

                                        <div class="flex items-center justify-center gap-2">

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

                                        <h1 class="text-sm font-semibold text-slate-800">
                                            Iuran Perpisahan
                                        </h1>

                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        Juni 2026
                                    </td>

                                    <td class="py-5 px-6 text-sm font-bold text-emerald-600">
                                        Rp 150.000
                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        15 Juni 2026
                                    </td>

                                    <td class="py-5 px-6">

                                        <div class="flex items-center justify-center gap-2">

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

</body>

</html>