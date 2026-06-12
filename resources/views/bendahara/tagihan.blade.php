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

        .sidebar-item:not(.sidebar-active):hover {
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
                            class="sidebar-item">

                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Transaksi</span>

                        </a>

                        <a href="{{ route('bendahara.tagihan') }}"
                            class="sidebar-item sidebar-active">

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
                                <h1 class="text-[13px] font-bold text-slate-800">
                                    {{ auth()->user()->name ?? 'Bendahara' }}
                                </h1>
                                <p class="text-[11px] text-slate-400">
                                    Bendahara
                                </p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}
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
            <div class="p-7 space-y-6">

                @if(session('success'))
                <div class="success-alert bg-emerald-100 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl flex items-center gap-3">

                    <iconify-icon icon="solar:check-circle-bold" class="text-[22px]"></iconify-icon>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
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

                                @forelse($tagihan as $item)
                                <tr class="table-row border-b border-slate-100">

                                    <td class="py-5 px-6">
                                        <h1 class="text-sm font-semibold text-slate-800">
                                            {{ $item->nama_tagihan }}
                                        </h1>
                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        {{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}
                                    </td>

                                    <td class="py-5 px-6 text-sm font-bold text-emerald-600">
                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>

                                    <td class="py-5 px-6 text-sm text-slate-600">
                                        {{ \Carbon\Carbon::parse($item->batas_bayar)->translatedFormat('d F Y') }}
                                    </td>

                                    <td class="py-5 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('bendahara.tagihan.edit', $item->id) }}" class="w-9 h-9 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:scale-105 transition">
                                                <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                            </a>
                                            <form action="{{ route('bendahara.tagihan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?');" class="m-0 p-0 inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-9 h-9 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center hover:scale-105 transition">
                                                    <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-slate-500">
                                        Belum ada data tagihan kelas.
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>

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
