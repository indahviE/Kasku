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
                        <a href="{{ route('bendahara.dashboard') }}" class="sidebar-item {{ request()->routeIs('bendahara.dashboard') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('bendahara.kas_masuk') }}" class="sidebar-item {{ request()->routeIs('bendahara.kas_masuk') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Masuk</span>
                        </a>

                        <a href="{{ route('bendahara.kas_keluar') }}" class="sidebar-item {{ request()->routeIs('bendahara.kas_keluar') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                            <span>Kas Keluar</span>
                        </a>

                        <a href="{{ route('bendahara.transaksi') }}" class="sidebar-item {{ request()->routeIs('bendahara.transaksi') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Transaksi</span>
                        </a>

                        <a href="{{ route('bendahara.tagihan') }}" class="sidebar-item {{ request()->routeIs('bendahara.tagihan') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                            <span>Tagihan</span>
                        </a>

                        <a href="{{ route('bendahara.laporan') }}" class="sidebar-item {{ request()->routeIs('bendahara.laporan') ? 'sidebar-active' : '' }}">
                            <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                            <span>Laporan</span>
                        </a>
                    </nav>
                </div>
            </div>

            <div class="p-4 border-t border-white/5">
                <a href="{{ route('bendahara.pengaturan') }}" class="sidebar-item {{ request()->routeIs('bendahara.pengaturan') ? 'sidebar-active' : '' }}">
                    <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                    <span>Pengaturan</span>
                </a>
            </div>
        </aside>

        <main class="ml-[250px] flex-1 overflow-y-auto h-screen">

            <div class="h-[70px] bg-white border-b border-slate-200 px-8 flex items-center justify-between shadow-sm sticky top-0 z-10">
                <div>
                    <p class="text-[12px] text-slate-400 font-medium">
                        Pages / Dashboard
                    </p>
                    <h1 class="text-[20px] font-bold text-slate-800 mt-1 whitespace-nowrap">
                        Dashboard Keuangan
                    </h1>
                </div>

                <div class="flex-1 max-w-md mx-8 hidden md:block">
                    <div class="relative flex items-center">
                        <iconify-icon icon="solar:magnifer-linear" class="absolute left-4 text-slate-400 text-lg"></iconify-icon>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Cari nama siswa atau kategori transaksi..." 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-2 text-xs focus:outline-none focus:border-teal-500 focus:bg-white transition"
                        />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                        <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                        <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 pulse-dot"></div>
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

            <div class="p-8 space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

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

                <div class="card p-6">
                    <div class="mb-4">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-1">
                            Total Arus Kas <iconify-icon icon="solar:alt-arrow-down-linear" class="text-xs text-slate-400"></iconify-icon>
                        </h3>
                    </div>

                    <div class="h-80 relative">
                        <canvas id="cashChart"></canvas>
                    </div>
                </div>

                <div class="card p-6">
                    <div class="mb-4">
                        <h3 class="text-sm font-bold text-slate-800">Riwayat Transaksi Terbaru</h3>
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
                            <tbody id="transactionTable" class="divide-y divide-slate-50 text-xs text-slate-600">
                                @forelse($pembayaran->take(5) as $item)
                                <tr class="transaction-row">
                                    <td class="py-3 font-bold text-slate-800 flex items-center gap-2 search-name">
                                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                            <iconify-icon icon="solar:user-rounded-bold"></iconify-icon>
                                        </div>
                                        {{ $item->siswa->name ?? 'User' }}
                                    </td>
                                    <td class="py-3 search-category">{{ $item->tagihan->nama_tagihan ?? 'Kas Umum' }}</td>
                                    <td class="py-3 text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}</td>
                                    <td class="py-3 text-right font-bold text-emerald-500">+ Rp {{ number_format($item->jml_bayar, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr id="emptyRow">
                                    <td colspan="4" class="py-6 text-center text-slate-400">Belum ada transaksi</td>
                                </tr>
                                @endforelse

                                <tr id="noResultRow" class="hidden">
                                    <td colspan="4" class="py-6 text-center text-slate-400">Transaksi tidak ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>

    </div>

<script>
    const ctx = document.getElementById('cashChart').getContext('2d');

    const gradientFillMasuk = ctx.createLinearGradient(0, 0, 0, 300);
    gradientFillMasuk.addColorStop(0, 'rgba(34, 197, 94, 0.25)');
    gradientFillMasuk.addColorStop(1, 'rgba(34, 197, 94, 0.00)');

    const gradientFillKeluar = ctx.createLinearGradient(0, 0, 0, 300);
    gradientFillKeluar.addColorStop(0, 'rgba(239, 68, 68, 0.25)');
    gradientFillKeluar.addColorStop(1, 'rgba(239, 68, 68, 0.00)');

    const pembayaranData = @json($pembayaran->sortBy('tanggal_bayar')->values());
    const pengeluaranData = @json(\App\Models\Pengeluaran::orderBy('tanggal')->get());

    // Buat 7 hari terakhir
    const last7Days = [];
    const dailyMasuk = {};
    const dailyKeluar = {};

    for (let i = 6; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const dateKey = `${year}-${month}-${day}`;

        const label = date.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' });
        last7Days.push(label);
        dailyMasuk[dateKey] = 0;
        dailyKeluar[dateKey] = 0;
    }

    // Sum pembayaran
    pembayaranData.forEach(item => {
        const dateKey = item.tanggal_bayar.substring(0, 10);
        if (dailyMasuk.hasOwnProperty(dateKey)) {
            dailyMasuk[dateKey] += parseFloat(item.jml_bayar);
        }
    });

    // Sum pengeluaran
    pengeluaranData.forEach(item => {
        const dateKey = item.tanggal.substring(0, 10);
        if (dailyKeluar.hasOwnProperty(dateKey)) {
            dailyKeluar[dateKey] += parseFloat(item.nominal);
        }
    });

    // Ambil values dalam urutan 7 hari
    const masukanValues = [];
    const keluaranValues = [];
    for (let i = 6; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const dateKey = `${year}-${month}-${day}`;

        masukanValues.push(dailyMasuk[dateKey] || 0);
        keluaranValues.push(dailyKeluar[dateKey] || 0);
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: last7Days,
            datasets: [
                {
                    label: 'Kas Masuk',
                    data: masukanValues,
                    borderColor: '#22c55e',
                    backgroundColor: gradientFillMasuk,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#22c55e',
                    borderWidth: 2.5
                },
                {
                    label: 'Kas Keluar',
                    data: keluaranValues,
                    borderColor: '#ef4444',
                    backgroundColor: gradientFillKeluar,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#ef4444',
                    borderWidth: 2.5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
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

    // --- LOGIKA TOGGLE DROPDOWN PROFIL ---
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('show');
    }

    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        if (!e.target.closest('.relative')) {
            dropdown.classList.remove('show');
        }
    });

    // --- LOGIKA FILTER PENCARIAN REAL-TIME (BARU) ---
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const keyword = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.transaction-row');
        const noResultRow = document.getElementById('noResultRow');
        const emptyRow = document.getElementById('emptyRow');
        let foundAny = false;

        // Jika data dari backend bawaannya kosong, lewati pencarian
        if (emptyRow) return;

        rows.forEach(row => {
            const nameText = row.querySelector('.search-name').textContent.toLowerCase();
            const categoryText = row.querySelector('.search-category').textContent.toLowerCase();

            // Cek kesesuaian kata kunci pada Kolom Nama Siswa ATAU Kategori Tagihan
            if (nameText.includes(keyword) || categoryText.includes(keyword)) {
                row.style.display = ''; // Tampilkan baris (menggunakan bawaan table style)
                foundAny = true;
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });

        // Tampilkan pesan "Tidak ditemukan" jika semua data tersembunyi
        if (!foundAny && keyword !== '') {
            noResultRow.classList.remove('hidden');
        } else {
            noResultRow.classList.add('hidden');
        }
    });
</script>

</body>

</html>