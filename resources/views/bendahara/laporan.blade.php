<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - KASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
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

        .chart-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 22px 24px;
        }

        .donut-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 22px 24px;
        }

        .table-row { transition: .15s ease; }
        .table-row:hover { background: #f8fafc; }

        .btn { height: 44px; padding: 0 18px; border-radius: 12px; font-size: 13px; font-weight: 600; transition: .2s ease; display: flex; align-items: center; gap: 8px; cursor: pointer; border: none; }
        .btn:hover { transform: translateY(-1px); }

        .input {
            height: 42px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0 14px;
            font-size: 13px;
            outline: none;
            transition: .2s ease;
            background: white;
            font-family: 'Inter', sans-serif;
        }
        .input:focus { border-color: #14b8a6; }

        .filter-bar {
            background: white;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            padding: 16px 20px;
        }

        select.input { cursor: pointer; }

        .period-btn {
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: .15s;
            background: transparent;
            color: #64748b;
        }
        .period-btn.active {
            background: #0f172a;
            color: white;
        }
        .period-btn:not(.active):hover {
            background: #f1f5f9;
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
                        <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">KASKU</h1>
                        <p class="text-[11px] text-slate-500 font-medium mt-1">Online</p>
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
                        <a href="{{ route('bendahara.transaksi') }}" class="sidebar-item">
                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Transaksi</span>
                        </a>
                        <a href="{{ route('bendahara.tagihan') }}" class="sidebar-item">
                            <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Tagihan</span>
                        </a>
                        <a href="{{ route('bendahara.laporan') }}" class="sidebar-item sidebar-active">
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

        <!-- MAIN -->
        <main class="ml-[250px] flex-1 overflow-y-auto">

            <!-- NAVBAR -->
            <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">
                <div>
                    <p class="text-[12px] text-slate-400 font-medium">Pages / Laporan</p>
                    <h1 class="text-[21px] font-bold text-slate-800 mt-1">Laporan Keuangan</h1>
                </div>
                <div class="flex items-center gap-4">
                    <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                        <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    </button>
                    <div class="flex items-center gap-3">
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
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-7">

                <!-- PAGE HEADER -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-[26px] font-bold text-slate-900">Data Laporan</h1>
                        <p class="text-slate-400 text-sm mt-1">Rekap laporan keuangan kas kelas secara lengkap.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1 bg-white border border-slate-200 rounded-xl p-1">
                            <button class="period-btn active" onclick="setPeriod(this,'Bulan Ini')">Bulan Ini</button>
                            <button class="period-btn" onclick="setPeriod(this,'3 Bulan')">3 Bulan</button>
                            <button class="period-btn" onclick="setPeriod(this,'Tahun Ini')">Tahun Ini</button>
                        </div>
                        <a href="{{ route('bendahara.laporan.export_pdf') }}" class="btn bg-slate-900 text-white">
                            <iconify-icon icon="solar:download-bold" class="text-[16px]"></iconify-icon>
                            Export PDF
                        </a>
                    </div>
                </div>

                <!-- STAT CARDS -->
                <div class="grid grid-cols-4 gap-4 mb-6">

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Saldo Kas</p>
                            </div>
                            <button class="arrow-btn">
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon>
                            </button>
                        </div>
                        <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $saldoAkhir >= 0 ? 'badge-green' : 'bg-rose-50 text-rose-600' }}">{{ $saldoAkhir >= 0 ? 'Aman' : 'Defisit' }}</span>
                            <span class="text-[11px] text-slate-400">Total kas tersisa</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-4">
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Masuk</p>
                            <button class="arrow-btn">
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon>
                            </button>
                        </div>
                        <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $persenMasuk >= 0 ? 'badge-green' : 'bg-rose-50 text-rose-600' }}">
                                {{ $persenMasuk >= 0 ? '↑' : '↓' }} {{ number_format(abs($persenMasuk), 1, ',', '.') }}%
                            </span>
                            <span class="text-[11px] text-slate-400">vs bulan lalu</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-4">
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Keluar</p>
                            <button class="arrow-btn">
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon>
                            </button>
                        </div>
                        <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $persenKeluar > 0 ? 'bg-rose-50 text-rose-600' : 'badge-green' }}">
                                {{ $persenKeluar > 0 ? '↑' : '↓' }} {{ number_format(abs($persenKeluar), 1, ',', '.') }}%
                            </span>
                            <span class="text-[11px] text-slate-400">vs bulan lalu</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-4">
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Tagihan</p>
                            <button class="arrow-btn">
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon>
                            </button>
                        </div>
                        <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold badge-green">Keseluruhan</span>
                            <span class="text-[11px] text-slate-400">Tagihan terdata</span>
                        </div>
                    </div>

                </div>

                <!-- CHART ROW -->
                <div class="grid grid-cols-3 gap-4 mb-6">

                    <!-- BAR CHART -->
                    <div class="chart-card col-span-2">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-[15px] font-bold text-slate-900">Arus Kas</h2>
                                <p class="text-xs text-slate-400 mt-0.5">Kas masuk & keluar per bulan</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-teal-400 inline-block"></span>
                                    <span class="text-xs text-slate-500">Masuk</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-400 inline-block"></span>
                                    <span class="text-xs text-slate-500">Keluar</span>
                                </div>
                                <select class="input text-xs" style="height:34px; padding: 0 10px; font-size:12px;">
                                    <option>Semua Akun</option>
                                    <option>Kas Kelas</option>
                                </select>
                            </div>
                        </div>
                        <canvas id="arusKasChart" height="160"></canvas>
                    </div>

                    <!-- DONUT CHART -->
                    <div class="donut-card">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-[15px] font-bold text-slate-900">Kategori</h2>
                                <p class="text-xs text-slate-400 mt-0.5">Distribusi pengeluaran</p>
                            </div>
                            <button class="arrow-btn">
                                <iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon>
                            </button>
                        </div>

                        <div class="flex items-center justify-center" style="height:140px;">
                            <canvas id="donutChart"></canvas>
                        </div>

                        <div class="mt-4 space-y-2.5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-teal-400 inline-block"></span>
                                    <span class="text-xs text-slate-600">Kas Mingguan</span>
                                </div>
                                <span class="text-xs font-semibold text-slate-700">45%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-cyan-400 inline-block"></span>
                                    <span class="text-xs text-slate-600">Iuran</span>
                                </div>
                                <span class="text-xs font-semibold text-slate-700">30%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-rose-400 inline-block"></span>
                                    <span class="text-xs text-slate-600">ATK & Logistik</span>
                                </div>
                                <span class="text-xs font-semibold text-slate-700">15%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span>
                                    <span class="text-xs text-slate-600">Lainnya</span>
                                </div>
                                <span class="text-xs font-semibold text-slate-700">10%</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FILTER + TABLE -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

                    <!-- FILTER BAR inside card -->
                    <div class="px-6 pt-5 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-3 flex-1">
                                <div class="flex flex-col gap-1">
                                    <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Dari</label>
                                    <input type="date" class="input" style="height:38px; font-size:13px;">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Sampai</label>
                                    <input type="date" class="input" style="height:38px; font-size:13px;">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Jenis</label>
                                    <select class="input" style="height:38px; font-size:13px; padding-right:32px;">
                                        <option>Semua</option>
                                        <option>Kas Masuk</option>
                                        <option>Kas Keluar</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Status</label>
                                    <select class="input" style="height:38px; font-size:13px; padding-right:32px;">
                                        <option>Semua</option>
                                        <option>Berhasil</option>
                                        <option>Diproses</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide opacity-0">x</label>
                                    <button class="btn bg-teal-500 text-white" style="height:38px;">
                                        <iconify-icon icon="solar:filter-bold" class="text-[14px]"></iconify-icon>
                                        Tampilkan
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1 ml-auto">
                                <label class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide opacity-0">x</label>
                                <div class="relative">
                                    <iconify-icon icon="solar:magnifer-linear" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[16px]"></iconify-icon>
                                    <input type="text" placeholder="Cari transaksi..." class="input pl-9" style="height:38px; width:220px; font-size:13px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABLE HEADER -->
                    <div class="px-6 py-4 flex items-center justify-between border-b border-slate-100">
                        <div>
                            <h2 class="text-[16px] font-bold text-slate-900">Riwayat Transaksi</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Seluruh data transaksi kas kelas</p>
                        </div>
                        <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-3 py-1.5 rounded-full">{{ $transaksiList->count() }} transaksi</span>
                    </div>

                    <!-- TABLE -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="text-left px-6 py-3.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Nama Transaksi</th>
                                    <th class="text-left px-6 py-3.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Jenis</th>
                                    <th class="text-left px-6 py-3.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Tanggal</th>
                                    <th class="text-left px-6 py-3.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Nominal</th>
                                    <th class="text-left px-6 py-3.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiList as $transaksi)
                                    <tr class="table-row border-b border-slate-50 hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if($transaksi->jenis == 'masuk')
                                                    <div class="w-9 h-9 rounded-xl bg-teal-50 flex items-center justify-center">
                                                        <iconify-icon icon="solar:wallet-money-bold" class="text-teal-500 text-[17px]"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-slate-800">{{ $transaksi->siswa->name ?? 'Kas Masuk' }}</p>
                                                        <p class="text-xs text-slate-400 mt-0.5">{{ $transaksi->tagihan ? 'Tagihan Wajib' : 'Lainnya' }}</p>
                                                    </div>
                                                @else
                                                    <div class="w-9 h-9 rounded-xl bg-rose-50 flex items-center justify-center">
                                                        <iconify-icon icon="solar:card-send-bold" class="text-rose-500 text-[17px]"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-slate-800">{{ \Illuminate\Support\Str::limit($transaksi->keterangan, 20) }}</p>
                                                        <p class="text-xs text-slate-400 mt-0.5">Pengeluaran Kelas</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($transaksi->jenis == 'masuk')
                                                <span class="px-2.5 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-semibold">Kas Masuk</span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold">Kas Keluar</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-sm text-slate-700">{{ \Carbon\Carbon::parse($transaksi->tanggal_sort)->translatedFormat('d M Y') }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($transaksi->jenis == 'masuk')
                                                <p class="text-sm font-bold text-teal-600">+ Rp {{ number_format($transaksi->jml_bayar, 0, ',', '.') }}</p>
                                            @else
                                                <p class="text-sm font-bold text-rose-500">- Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($transaksi->jenis == 'masuk' && $transaksi->status == 'lunas')
                                                <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 text-xs font-semibold">Berhasil</span>
                                            @elseif($transaksi->jenis == 'masuk' && $transaksi->status == 'pending')
                                                <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">Diproses</span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">Tercatat</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center justify-center text-slate-400">
                                                <iconify-icon icon="solar:inbox-line-duotone" class="text-5xl mb-3 opacity-50"></iconify-icon>
                                                <p class="text-sm font-medium">Belum ada riwayat transaksi tercatat.</p>
                                            </div>
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
        // BAR CHART
        const ctx = document.getElementById('arusKasChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul'],
                datasets: [
                    {
                        label: 'Kas Masuk',
                        data: [1200000,900000,1500000,2000000,2800000,1800000,2200000],
                        backgroundColor: 'rgba(45,212,191,0.85)',
                        borderRadius: 8,
                        borderSkipped: false,
                        barPercentage: 0.5,
                        categoryPercentage: 0.6
                    },
                    {
                        label: 'Kas Keluar',
                        data: [300000,450000,200000,600000,620000,380000,520000],
                        backgroundColor: 'rgba(251,113,133,0.85)',
                        borderRadius: 8,
                        borderSkipped: false,
                        barPercentage: 0.5,
                        categoryPercentage: 0.6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' Rp ' + (ctx.raw/1000).toFixed(0) + '.000'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 11 } }
                    },
                    y: {
                        grid: { color: '#f1f5f9' },
                        border: { display: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            callback: v => 'Rp' + (v/1000000).toFixed(1) + 'jt'
                        }
                    }
                }
            }
        });

        // DONUT CHART
        const dCtx = document.getElementById('donutChart').getContext('2d');
        new Chart(dCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [45, 30, 15, 10],
                    backgroundColor: ['#2dd4bf','#22d3ee','#fb7185','#fbbf24'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                cutout: '72%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ctx.raw + '%' } } }
            }
        });

        // Period toggle
        function setPeriod(btn, label) {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        // Export PDF (placeholder)
        function exportPDF() {
            alert('Export PDF sedang diproses...');
        }
    </script>

</body>
</html>
