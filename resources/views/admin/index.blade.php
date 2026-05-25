@section('title', 'Dashboard Admin')

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');

    * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .font-display {
        font-family: 'Outfit', sans-serif;
    }

    :root {
        --primary: #1B6578;
        --primary-light: #2a8fa3;
        --slate-dark: #0f172a;
        --slate-light: #f8fafc;
    }

    body {
        transition: background-color 0.3s ease;
    }

    .bg-gradient-subtle {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(15, 23, 42, 0.05);
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(27, 101, 120, 0.08);
        border-color: rgba(27, 101, 120, 0.1);
    }

    .sidebar-item {
        position: relative;
        transition: all 0.2s ease;
    }

    .sidebar-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 0 3px 3px 0;
        transition: height 0.3s ease;
    }

    .sidebar-item.active::before {
        height: 20px;
    }

    @keyframes slideInNumber {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-number {
        animation: slideInNumber 0.5s ease 0.2s both;
    }

    .avatar-gradient {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    }

    html {
        scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .filter-select {
        position: relative;
    }

    .filter-select select {
        appearance: none;
        padding-right: 28px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23475569' d='M1 4.5l5 5 5-5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-color: #f1f5f9;
        cursor: pointer;
    }

    .filter-select select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(27, 101, 120, 0.1);
        border-color: #1B6578;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 3rem 1.5rem;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(27, 101, 120, 0.1) 0%, rgba(27, 101, 120, 0.05) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #cbd5e1;
    }

    .rupiah {
        font-variant-numeric: tabular-nums;
    }

    /* Profile Dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 50;
        min-width: 200px;
        margin-top: 0.5rem;
        animation: slideDown 0.3s ease;
    }

    .dropdown-menu.active {
        display: block;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #475569;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .dropdown-item:first-child {
        border-radius: 12px 12px 0 0;
    }

    .dropdown-item:last-child {
        border-bottom: none;
        border-radius: 0 0 12px 12px;
    }

    .dropdown-item:hover {
        background-color: #f8fafc;
        color: #1B6578;
    }

    .dropdown-item.logout:hover {
        background-color: #fee2e2;
        color: #dc2626;
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #1B6578 0%, #2a8fa3 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(27, 101, 120, 0.15);
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        z-index: 0;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    /* Charts */
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 1rem;
    }

    .gradient-bar-chart {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(15, 23, 42, 0.05);
    }

    tbody tr {
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: rgba(27, 101, 120, 0.03);
    }
</style>

<div class="flex min-h-screen bg-gradient-subtle font-sans text-slate-900">

    <!-- Sidebar -->
    <div class="w-64 bg-slate-900 text-slate-400 flex flex-col sticky top-0 h-screen border-r border-slate-800/50">

        <!-- Logo Section -->
        <div class="p-6 border-b border-slate-800/50">
            <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] flex items-center justify-center shadow-lg shadow-cyan-900/20">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-white"
                    viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M20 7H4C2.9 7 2 7.9 2 9V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V9C22 7.9 21.1 7 20 7ZM20 17H4V9H20V17ZM16 11C14.9 11 14 11.9 14 13C14 14.1 14.9 15 16 15C17.1 15 18 14.1 18 13C18 11.9 17.1 11 16 11ZM18 5H6V3H18V5Z"/>

                </svg>

            </div>
                <div>
                    <div class="text-white font-display font-bold text-base tracking-tight">KASKU</div>
                    <div class="text-[10px] text-slate-500 font-medium">Online</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 space-y-1 py-6 overflow-y-auto">
            <a href="{{ route('dashboard.admin') }}" class="sidebar-item active flex items-center gap-3 py-3 px-4 rounded-xl bg-slate-800/50 text-white transition-all group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l-4-4m4 4l4 4m0 0V9"/>
                </svg>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a href="{{ route('kelas') }}" class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span class="text-sm font-medium">Kelola Kelas</span>
            </a>

            <a href="{{ route('data.transaksi') }}"
   class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
    </svg>

    <span class="text-sm font-medium">
        Data Transaksi
    </span>

</a>
        </nav>

        <!-- Logout Section -->
        <div class="p-4 border-t border-slate-800/50">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all font-medium">
                    ↪ Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white/60 backdrop-blur-xl sticky top-0 z-40 border-b border-slate-200/50 h-16 flex items-center justify-between px-8 shadow-sm">
            <div class="flex items-center gap-2 text-sm">
                <span class="text-slate-500 font-medium">Pages</span>
                <span class="text-slate-300">/</span>
                <span class="text-slate-900 font-semibold">Dashboard Admin</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-8 w-px bg-slate-200"></div>

                <!-- Profile Dropdown -->
                <div class="relative group">
                    <button id="profileBtn" class="flex items-center gap-3 hover:bg-slate-100 p-2 rounded-lg transition-all">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 text-right">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-green-600 font-medium text-right">Admin</p>
                        </div>
                        <div class="w-10 h-10 avatar-gradient rounded-full border-2 border-white shadow-sm flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-display font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profil
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="dropdown-item logout w-full text-left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto">

                <!-- Alert Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-700 text-sm font-medium">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-red-600 text-sm mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Welcome Section with Chart -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

                    <!-- Welcome Card -->
                    <div class="lg:col-span-1 welcome-card flex flex-col justify-between">
                        <div class="welcome-content">
                            <p class="text-white/80 text-sm font-medium mb-1">Selamat datang kembali,</p>
                            <h1 class="text-4xl font-display font-bold mb-6">Welcome Admin</h1>

                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.488 5.951 1.488a1 1 0 001.169-1.409l-7-14z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-white/90">Total User: <strong>{{ $users->total() }}</strong></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-white/90">Total Kelas: <strong>{{ $jumlahKelas }}</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-white/70 text-xs mt-6">Kelola sistem kasir sekolah Anda</div>
                    </div>

                    <!-- Chart Container -->
                    <div class="lg:col-span-2">
                        <div class="gradient-bar-chart">
                            <h3 class="text-lg font-display font-bold text-slate-900 mb-4">Grafik Keuangan Bulan Ini</h3>
                            <div class="chart-container">
                                <canvas id="financialChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Total Masuk -->
                    <div class="card-hover bg-white p-6 rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Total Masuk</p>
                                <h3 class="text-3xl font-display font-bold text-slate-900 stat-number rupiah">
                                    Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                                </h3>
                            </div>
                            <div class="p-3 bg-green-50 rounded-xl">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-block px-3 py-1 bg-green-50 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-md">Pemasukan</div>
                        </div>
                    </div>

                    <!-- Total Keluar -->
                    <div class="card-hover bg-white p-6 rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Total Keluar</p>
                                <h3 class="text-3xl font-display font-bold text-slate-900 stat-number rupiah">
                                    Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                                </h3>
                            </div>
                            <div class="p-3 bg-red-50 rounded-xl">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-block px-3 py-1 bg-red-50 text-red-700 text-[10px] font-bold uppercase tracking-wider rounded-md">Pengeluaran</div>
                        </div>
                    </div>

                    <!-- Saldo Total -->
                    <div class="card-hover bg-white p-6 rounded-2xl border-l-4 border-blue-500">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Saldo Total</p>
                                <h3 class="text-3xl font-display font-bold text-slate-900 stat-number rupiah">
                                    Rp {{ number_format($saldoKeseluruhan, 0, ',', '.') }}
                                </h3>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold uppercase tracking-wider rounded-md">Saldo</div>
                            <span class="text-xs text-blue-600 font-medium">
                                @if ($saldoKeseluruhan >= 0) Sehat @else Negatif @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kelola User Section -->
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm overflow-hidden">

                    <!-- Table Header -->
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-white/50 backdrop-blur-sm">
                        <div>
                            <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Kelola User</h3>
                            <p class="text-xs text-slate-500">Lihat dan kelola informasi semua user terdaftar</p>
                        </div>

                        <div class="filter-select">
                            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mb-2">Filter by Role</label>
                            <form action="{{ route('dashboard.admin') }}" method="GET" class="inline">
                                <select name="role" onchange="this.form.submit()" class="border border-slate-200 rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                    <option value="">Semua Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $roleFilter == $role ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nama Lengkap</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No HP</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider text-right">Role</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-slate-500 font-medium">#{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $colors = [
                                                        'A' => 'bg-blue-100 text-blue-600',
                                                        'B' => 'bg-green-100 text-green-600',
                                                        'C' => 'bg-purple-100 text-purple-600',
                                                        'D' => 'bg-orange-100 text-orange-600',
                                                        'E' => 'bg-red-100 text-red-600',
                                                    ];
                                                    $firstChar = substr($user->name, 0, 1);
                                                    $colorClass = $colors[$firstChar] ?? 'avatar-gradient text-white';
                                                @endphp
                                                <div class="w-8 h-8 rounded-full {{ $colorClass }} flex items-center justify-center text-xs font-semibold">
                                                    {{ $firstChar }}
                                                </div>
                                                <span class="font-semibold text-slate-900">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ $user->no_hp ?? '-' }}</td>
                                        <td class="px-6 py-4 text-right">
                                            @php
                                                $roleColors = [
                                                    'admin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                    'bendahara' => 'bg-purple-50 text-purple-700 border-purple-200',
                                                    'wali_kelas' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                                    'siswa' => 'bg-slate-100 text-slate-700 border-slate-200',
                                                ];
                                                $roleColor = $roleColors[strtolower($user->role)] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                            @endphp
                                            <span class="inline-block px-3 py-1.5 {{ $roleColor }} text-xs font-bold uppercase tracking-wider rounded-lg border">
                                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-state">
                                                <div class="empty-icon">!</div>
                                                <p class="text-xs italic text-slate-400 font-medium">Belum ada data user yang terdaftar.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer with Pagination -->
                    <div class="bg-slate-50/50 px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-slate-600 font-medium">
                            Menampilkan <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span> - <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $users->total() }}</span> data user
                        </div>

                        <div class="flex items-center gap-2">
                            {{ $users->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    // Profile Dropdown Toggle
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.classList.toggle('active');
    });

    document.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });

    // Financial Chart
    window.addEventListener('load', () => {
        const ctx = document.getElementById('financialChart');
        if (ctx) {
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(27, 101, 120, 0.3)');
            gradient.addColorStop(1, 'rgba(27, 101, 120, 0.01)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: [12000000, 15500000, 14200000, 16800000, 13500000, 17200000, 15800000, 18500000, 16200000, 17800000, 19200000, 20500000],
                            backgroundColor: '#10b981',
                            borderColor: '#059669',
                            borderWidth: 0,
                            borderRadius: 8,
                            borderSkipped: false,
                        },
                        {
                            label: 'Pengeluaran',
                            data: [5000000, 6200000, 5800000, 7100000, 5500000, 6800000, 6200000, 7500000, 6800000, 7200000, 7800000, 8500000],
                            backgroundColor: '#ef4444',
                            borderColor: '#dc2626',
                            borderWidth: 0,
                            borderRadius: 8,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 12, family: "'Plus Jakarta Sans', sans-serif" },
                                color: '#64748b',
                                padding: 20,
                                usePointStyle: true,
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: { size: 11, family: "'Plus Jakarta Sans', sans-serif" },
                                color: '#94a3b8',
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
                                }
                            },
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false
                            }
                        },
                        x: {
                            ticks: {
                                font: { size: 11, family: "'Plus Jakarta Sans', sans-serif" },
                                color: '#94a3b8',
                            },
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    }
                }
            });
        }

        // Animate stat numbers
        document.querySelectorAll('.stat-number').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
