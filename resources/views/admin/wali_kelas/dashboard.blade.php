<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — KASKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --teal: #0E7C7B;
            --teal-light: #14A3A2;
            --teal-pale: #E6F4F4;
            --ink: #0F1923;
            --muted: #64748B;
            --border: #E8EDF2;
            --surface: #FFFFFF;
            --bg: #F4F7FA;
        }
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        .font-display { font-family: 'Sora', sans-serif; }

        /* Layout */
        .app-shell { display: flex; min-height: 100vh; background: var(--bg); }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-name { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 15px; color: #fff; letter-spacing: -0.3px; }
        .brand-sub { font-size: 10px; color: rgba(255,255,255,0.3); font-weight: 500; margin-top: 1px; }

        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; }
        .nav-label { font-size: 9px; font-weight: 700; letter-spacing: 1.2px; color: rgba(255,255,255,0.2); text-transform: uppercase; padding: 8px 10px 4px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            color: rgba(255,255,255,0.45); font-size: 13.5px; font-weight: 500;
            text-decoration: none; transition: all 0.18s ease;
            position: relative;
        }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-item.active {
            background: linear-gradient(90deg, rgba(14,124,123,0.25), rgba(14,124,123,0.08));
            color: #5DD6D5;
        }
        .nav-item.active::before {
            content: '';
            position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 20px;
            background: var(--teal-light);
            border-radius: 0 3px 3px 0;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .logout-btn {
            width: 100%; display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: none; border: none; cursor: pointer;
            color: rgba(255,100,100,0.6); font-size: 13px; font-weight: 500;
            transition: all 0.18s ease; text-align: left;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.08); color: #ff6b6b; }
        .logout-btn svg { width: 15px; height: 15px; }

        /* Topbar */
        .topbar {
            height: 60px; background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; position: sticky; top: 0; z-index: 40;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; }
        .breadcrumb-sep { color: #C8D0D8; }
        .breadcrumb-current { font-weight: 600; color: var(--ink); }
        .breadcrumb-root { color: var(--muted); }

        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .profile-trigger {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 10px; border-radius: 10px;
            cursor: pointer; background: none; border: none;
            transition: background 0.15s;
        }
        .profile-trigger:hover { background: var(--bg); }
        .profile-name { font-size: 13px; font-weight: 600; color: var(--ink); text-align: right; line-height: 1.3; }
        .profile-role { font-size: 10px; color: var(--teal); font-weight: 600; text-align: right; }
        .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 13px; color: #fff;
        }
        .dropdown {
            display: none; position: absolute; top: calc(100% + 8px); right: 0;
            background: #fff; border: 1px solid var(--border);
            border-radius: 12px; box-shadow: 0 12px 40px rgba(0,0,0,0.1);
            min-width: 180px; z-index: 100; overflow: hidden;
        }
        .dropdown.open { display: block; }
        .dropdown-item-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 16px; font-size: 13px; color: #e53e3e;
            background: none; border: none; cursor: pointer; width: 100%;
            transition: background 0.15s;
        }
        .dropdown-item-btn:hover { background: #fff5f5; }
        .dropdown-item-btn svg { width: 14px; height: 14px; }
        .profile-wrap { position: relative; }

        /* Main */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .content { flex: 1; padding: 28px 32px; overflow-y: auto; }
        .content-inner { max-width: 1040px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px; }

        /* Alert */
        .alert-success {
            padding: 14px 18px; border-radius: 12px;
            background: #f0fdf9; border: 1px solid #a7f3d0;
            color: #065f46; font-size: 13.5px; font-weight: 500;
        }
        .alert-error {
            padding: 14px 18px; border-radius: 12px;
            background: #fff5f5; border: 1px solid #fed7d7;
            color: #c53030; font-size: 13.5px; font-weight: 500;
        }

        /* Hero card */
        .hero-card {
            background: linear-gradient(135deg, #0B5E5D 0%, #0E7C7B 50%, #12A09F 100%);
            border-radius: 18px; padding: 28px 32px;
            color: #fff; position: relative; overflow: hidden;
        }
        .hero-card::before {
            content: '';
            position: absolute; top: -40px; right: -40px;
            width: 180px; height: 180px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .hero-card::after {
            content: '';
            position: absolute; bottom: -60px; right: 80px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
        }
        .hero-label { font-size: 11.5px; font-weight: 500; color: rgba(255,255,255,0.55); margin-bottom: 6px; letter-spacing: 0.3px; }
        .hero-title { font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 20px; }
        .hero-meta { display: flex; gap: 32px; position: relative; z-index: 1; }
        .hero-meta-item {}
        .hero-meta-label { font-size: 10.5px; color: rgba(255,255,255,0.5); margin-bottom: 3px; }
        .hero-meta-value { font-size: 14px; font-weight: 700; color: #fff; }

        /* Stat cards */
        .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        @media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.07); transform: translateY(-1px); }
        .stat-top-bar { position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 14px 14px 0 0; }
        .stat-icon {
            width: 36px; height: 36px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }
        .stat-icon svg { width: 18px; height: 18px; }
        .stat-label { font-size: 11.5px; color: var(--muted); font-weight: 500; margin-bottom: 5px; }
        .stat-value { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
        .stat-badge {
            display: inline-flex; align-items: center;
            font-size: 10.5px; font-weight: 600;
            padding: 3px 9px; border-radius: 20px;
        }

        /* Table section */
        .section-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }
        .section-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: flex-start; justify-content: space-between;
        }
        .section-title { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
        .section-sub { font-size: 12px; color: var(--muted); }

        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #F8FAFB; }
        th {
            padding: 11px 20px; text-align: left;
            font-size: 10.5px; font-weight: 700; letter-spacing: 0.7px;
            text-transform: uppercase; color: var(--muted);
            border-bottom: 1px solid var(--border);
        }
        th.center { text-align: center; }
        td { padding: 14px 20px; font-size: 13.5px; color: #374151; border-bottom: 1px solid #F3F6F9; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #FAFCFC; }

        .td-num { color: var(--muted); font-weight: 600; font-size: 12px; }
        .td-name-wrap { display: flex; align-items: center; gap: 10px; }
        .td-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .td-name { font-weight: 600; color: var(--ink); font-size: 13.5px; }
        .td-muted { color: var(--muted); font-size: 13px; }
        .td-center { text-align: center; }

        .badge {
            display: inline-flex; align-items: center;
            padding: 4px 10px; border-radius: 20px;
            font-size: 10.5px; font-weight: 700; letter-spacing: 0.4px;
        }
        .badge-bendahara { background: #EEF2FF; color: #4338CA; border: 1px solid #C7D2FE; }
        .badge-siswa { background: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; }

        .btn-sm {
            padding: 6px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            border: none; cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-primary { background: var(--teal-pale); color: var(--teal); }
        .btn-primary:hover { background: #CCE9E9; }
        .btn-secondary { background: #F1F5F9; color: #475569; }
        .btn-secondary:hover { background: #E2E8F0; }
        .btn-disabled { background: #F8FAFC; color: #CBD5E1; cursor: not-allowed; opacity: 0.6; }

        .empty-row td { padding: 40px 20px; text-align: center; color: var(--muted); font-size: 13px; font-style: italic; }
    </style>
</head>
<body>

<div class="app-shell">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                    <path d="M20 7H4C2.9 7 2 7.9 2 9V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V9C22 7.9 21.1 7 20 7ZM20 17H4V9H20V17ZM16 11C14.9 11 14 11.9 14 13C14 14.1 14.9 15 16 15C17.1 15 18 14.1 18 13C18 11.9 17.1 11 16 11ZM18 5H6V3H18V5Z"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">KASKU</div>
                <div class="brand-sub">Wali Kelas</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Menu</div>
            <a href="{{ route('wali.dashboard') }}"
               class="nav-item {{ request()->routeIs('wali.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Daftar Siswa
            </a>
            <a href="{{ route('wali.transaksi-kas') }}"
               class="nav-item {{ request()->routeIs('wali.transaksi-kas') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Transaksi Kas
            </a>
            <a href="{{ route('wali.rekap-pembayaran') }}"
               class="nav-item {{ request()->routeIs('wali.rekap-pembayaran') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Rekap Pembayaran
            </a>
            <a href="{{ route('wali.tunggakan') }}"
               class="nav-item {{ request()->routeIs('wali.tunggakan') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Tunggakan
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="breadcrumb">
                <span class="breadcrumb-root">Wali Kelas</span>
                <span class="breadcrumb-sep">/</span>
                <span class="breadcrumb-current">Dashboard</span>
            </div>
            <div class="topbar-right">
                <div class="profile-wrap">
                    <button class="profile-trigger" id="profileBtn">
                        <div>
                            <div class="profile-name">{{ auth()->user()->name }}</div>
                            <div class="profile-role">Wali Kelas</div>
                        </div>
                        <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    </button>
                    <div class="dropdown" id="dropdownMenu">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="content">
            <div class="content-inner">

                {{-- FLASH MESSAGES --}}
                @if (session('success'))
                    <div class="alert-success">✓ {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert-error">⚠ {{ session('error') }}</div>
                @endif

                {{-- HERO --}}
                <div class="hero-card">
                    <div class="hero-label">Kelas yang Anda ampu</div>
                    <div class="hero-title font-display">{{ $wali->kelas->nama_kelas }}</div>
                    <div class="hero-meta">
                        <div class="hero-meta-item">
                            <div class="hero-meta-label">Tahun Ajaran</div>
                            <div class="hero-meta-value">{{ $wali->kelas->tahun_ajaran }}</div>
                        </div>
                        <div class="hero-meta-item">
                            <div class="hero-meta-label">Total Siswa</div>
                            <div class="hero-meta-value">{{ $siswa->count() }} orang</div>
                        </div>
                        <div class="hero-meta-item">
                            <div class="hero-meta-label">Bendahara</div>
                            <div class="hero-meta-value">{{ $jumlahBendahara }}/2 orang</div>
                        </div>
                    </div>
                </div>

                {{-- STAT GRID --}}
                <div class="stat-grid">

                    {{-- Total Siswa --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#10B981;"></div>
                        <div class="stat-icon" style="background:#ECFDF5;">
                            <svg fill="none" stroke="#059669" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="stat-label">Total Siswa</div>
                        <div class="stat-value" style="color:#059669;">{{ $siswa->count() }}</div>
                        <span class="stat-badge" style="background:#ECFDF5; color:#059669;">{{ $jumlahBendahara }}/2 bendahara</span>
                    </div>

                    {{-- Sudah Bayar --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#3B82F6;"></div>
                        <div class="stat-icon" style="background:#EFF6FF;">
                            <svg fill="none" stroke="#2563EB" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="stat-label">Sudah Bayar</div>
                        <div class="stat-value" style="color:#2563EB;">{{ $jumlahLunas }}</div>
                        <span class="stat-badge" style="background:#EFF6FF; color:#2563EB;">{{ $siswa->count() > 0 ? round($jumlahLunas / $siswa->count() * 100) : 0 }}% siswa</span>
                    </div>

                    {{-- Belum Bayar --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#F59E0B;"></div>
                        <div class="stat-icon" style="background:#FFFBEB;">
                            <svg fill="none" stroke="#D97706" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="stat-label">Belum Bayar</div>
                        <div class="stat-value" style="color:#D97706;">{{ $jumlahBelumBayar }}</div>
                        <span class="stat-badge" style="background:#FFFBEB; color:#D97706;">perlu ditagih</span>
                    </div>

                    {{-- Kas Masuk --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#10B981;"></div>
                        <div class="stat-icon" style="background:#ECFDF5;">
                            <svg fill="none" stroke="#059669" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div class="stat-label">Kas Masuk</div>
                        <div class="stat-value" style="color:#059669; font-size:17px;">Rp {{ number_format($kasMasuk, 0, ',', '.') }}</div>
                        <span class="stat-badge" style="background:#ECFDF5; color:#059669;">total lunas</span>
                    </div>

                    {{-- Kas Keluar --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#EF4444;"></div>
                        <div class="stat-icon" style="background:#FFF5F5;">
                            <svg fill="none" stroke="#DC2626" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="stat-label">Kas Keluar</div>
                        <div class="stat-value" style="color:#DC2626; font-size:17px;">Rp {{ number_format($kasKeluar, 0, ',', '.') }}</div>
                        <span class="stat-badge" style="background:#FFF5F5; color:#DC2626;">pengeluaran</span>
                    </div>

                    {{-- Tagihan Aktif --}}
                    <div class="stat-card">
                        <div class="stat-top-bar" style="background:#8B5CF6;"></div>
                        <div class="stat-icon" style="background:#F5F3FF;">
                            <svg fill="none" stroke="#7C3AED" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="stat-label">Tagihan Aktif</div>
                        <div class="stat-value" style="color:#7C3AED;">{{ $jumlahTagihanAktif }}</div>
                        <span class="stat-badge" style="background:#F5F3FF; color:#7C3AED;">bulan ini</span>
                    </div>

                </div>

                {{-- TABEL SISWA --}}
                <div class="section-card">
                    <div class="section-header">
                        <div>
                            <div class="section-title">Daftar Siswa</div>
                            <div class="section-sub">Klik "Jadikan Bendahara" untuk menunjuk bendahara kelas. Maksimal 2 orang.</div>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:48px;">No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th class="center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa as $i => $s)
                                <tr>
                                    <td class="td-num">{{ $i + 1 }}</td>
                                    <td>
                                        <div class="td-name-wrap">
                                            <div class="td-avatar">{{ substr($s->user->name, 0, 1) }}</div>
                                            <span class="td-name">{{ $s->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="td-muted">{{ $s->nis }}</td>
                                    <td class="td-muted">{{ $s->no_hp }}</td>
                                    <td>
                                        @if ($s->user->role === 'bendahara')
                                            <span class="badge badge-bendahara">Bendahara</span>
                                        @else
                                            <span class="badge badge-siswa">Siswa</span>
                                        @endif
                                    </td>
                                    <td class="td-center">
                                        <form method="POST" action="{{ route('wali.jadikan-bendahara', $s->id) }}">
                                            @csrf
                                            @if ($s->user->role === 'bendahara')
                                                <button type="submit"
                                                    onclick="return confirm('Kembalikan {{ $s->user->name }} menjadi siswa biasa?')"
                                                    class="btn-sm btn-secondary">
                                                    Batalkan
                                                </button>
                                            @else
                                                <button type="submit"
                                                    onclick="return confirm('Jadikan {{ $s->user->name }} sebagai bendahara?')"
                                                    class="btn-sm {{ $jumlahBendahara >= 2 ? 'btn-disabled' : 'btn-primary' }}"
                                                    {{ $jumlahBendahara >= 2 ? 'disabled' : '' }}>
                                                    Jadikan Bendahara
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="6">Belum ada siswa di kelas ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
const profileBtn = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');
profileBtn.addEventListener('click', e => { e.stopPropagation(); dropdownMenu.classList.toggle('open'); });
document.addEventListener('click', e => {
    if (!profileBtn.contains(e.target)) dropdownMenu.classList.remove('open');
});
</script>
</body>
</html>
