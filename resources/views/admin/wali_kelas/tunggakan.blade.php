<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tunggakan — KASKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --teal: #0E7C7B;
            --ink: #0F1923;
            --muted: #64748B;
            --border: #E2E8F0;
            --bg: #F8FAFC;
        }
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        html { -ms-overflow-style: none; scrollbar-width: none; }
        html::-webkit-scrollbar { display: none; }
        .font-display { font-family: 'Sora', sans-serif; }

        .app-shell { display: flex; min-height: 100vh; background: var(--bg); }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 220px; background: #1A2332;
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh; flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-brand {
            padding: 20px 16px; border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex; align-items: center; gap: 10px;
        }
        .brand-icon {
            width: 36px; height: 36px;
            background: var(--teal);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 3px rgba(14,124,123,0.15); flex-shrink: 0;
        }
        .brand-icon svg { width: 18px; height: 18px; color: #fff; }
        .brand-name { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 14px; color: #fff; letter-spacing: -0.3px; }
        .brand-sub { font-size: 10px; color: rgba(255,255,255,0.25); margin-top: 1px; }

        .sidebar-nav { flex: 1; padding: 14px 10px; display: flex; flex-direction: column; gap: 2px; }
        .nav-section { font-size: 9px; font-weight: 700; letter-spacing: 1.1px; color: rgba(255,255,255,0.18); text-transform: uppercase; padding: 8px 10px 4px; }
        .nav-item {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 11px; border-radius: 9px;
            color: rgba(255,255,255,0.4); font-size: 13px; font-weight: 500;
            text-decoration: none; transition: all 0.15s ease; position: relative;
        }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8); }
        .nav-item.active { background: rgba(14,124,123,0.15); color: #5DD6D5; }
        .nav-item.active::before {
            content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 18px; background: #0E7C7B; border-radius: 0 3px 3px 0;
        }
        .nav-item svg { width: 15px; height: 15px; flex-shrink: 0; }

        .sidebar-footer { padding: 10px; border-top: 1px solid rgba(255,255,255,0.05); }
        .logout-btn {
            width: 100%; display: flex; align-items: center; gap: 9px;
            padding: 9px 11px; border-radius: 9px;
            background: none; border: none; cursor: pointer;
            color: rgba(255,80,80,0.6); font-size: 12.5px; font-weight: 500;
            transition: all 0.15s ease; text-align: left;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.08); color: #ff6666; }
        .logout-btn svg { width: 14px; height: 14px; }

        /* ── TOPBAR ── */
        .topbar {
            height: 56px; background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: fixed; top: 0; left: 220px; right: 0; z-index: 50;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12.5px; }
        .bc-root { color: var(--muted); }
        .bc-sep { color: #CBD5E1; font-size: 11px; }
        .bc-current { font-weight: 700; color: var(--ink); }

        .profile-pill {
            display: flex; align-items: center; gap: 9px;
            padding: 5px 10px 5px 5px; border-radius: 22px;
            background: var(--bg); border: 1px solid var(--border);
            cursor: pointer; transition: all 0.15s;
        }
        .profile-pill:hover { background: #EFF6FF; border-color: #BAE6FD; }
        .avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--teal);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 11px; color: #fff; flex-shrink: 0;
        }
        .p-name { font-size: 12.5px; font-weight: 600; color: var(--ink); }
        .p-role { font-size: 10px; color: var(--teal); font-weight: 600; }

        .dropdown {
            display: none; position: absolute; top: calc(100% + 8px); right: 0;
            background: #fff; border: 1px solid var(--border);
            border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            min-width: 160px; z-index: 100; overflow: hidden;
        }
        .dropdown.open { display: block; }
        .dropdown-btn {
            display: flex; align-items: center; gap: 9px;
            padding: 10px 14px; font-size: 13px; color: #E53E3E;
            background: none; border: none; cursor: pointer; width: 100%;
            transition: background 0.15s;
        }
        .dropdown-btn:hover { background: #FEF2F2; }
        .dropdown-btn svg { width: 14px; height: 14px; }
        .profile-wrap { position: relative; }

        /* ── MAIN ── */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .content { flex: 1; padding: 24px 28px; padding-top: 80px; overflow-y: auto; }
        .content-inner { max-width: 960px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }

        /* ── HERO ── */
        .hero {
            background: var(--teal);
            border-radius: 16px; padding: 26px 28px;
            position: relative; overflow: hidden;
            color: #fff;
        }
        .hero::before {
            content: '';
            position: absolute; top: -50px; right: -50px;
            width: 200px; height: 200px; border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        .hero::after {
            content: '';
            position: absolute; bottom: -70px; right: 80px;
            width: 240px; height: 240px; border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .hero-title {
            font-size: 24px; font-weight: 800; letter-spacing: -0.5px;
            margin-bottom: 4px; font-family: 'Sora', sans-serif; position: relative; z-index: 1;
        }
        .hero-sub { font-size: 12px; color: rgba(255,255,255,0.5); position: relative; z-index: 1; }

        /* ── FILTERS ── */
        .filters-card {
            background: #fff; border-radius: 14px;
            border: 1px solid var(--border);
            padding: 16px; display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;
        }
        .filter-group { display: flex; flex-direction: column; gap: 4px; }
        .filter-label { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        .filter-input {
            padding: 8px 12px; border: 1px solid var(--border);
            border-radius: 8px; font-size: 13px; color: var(--ink);
            background: #fff; transition: all 0.15s;
        }
        .filter-input:focus { outline: none; border-color: var(--teal); background: #fff; }
        .filter-input::placeholder { color: #CBD5E1; }
        .btn-filter {
            padding: 8px 16px; border: none; border-radius: 8px;
            font-size: 12px; font-weight: 600; cursor: pointer;
            transition: all 0.15s; background: var(--teal); color: #fff;
        }
        .btn-filter:hover { background: #0D6B6A; }
        .btn-reset {
            padding: 8px 16px; border: 1px solid var(--border); border-radius: 8px;
            font-size: 12px; font-weight: 600; cursor: pointer;
            transition: all 0.15s; background: #fff; color: var(--muted);
        }
        .btn-reset:hover { background: var(--bg); border-color: #94A3B8; }

        /* ── ACCORDION ── */
        .tunggakan-list { display: flex; flex-direction: column; gap: 12px; }
        .tunggakan-card {
            background: #fff; border-radius: 14px;
            border: 1px solid var(--border); overflow: hidden;
            transition: all 0.2s;
        }
        .tunggakan-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

        .accordion-header {
            padding: 18px; display: flex; align-items: center; justify-content: space-between;
            cursor: pointer; transition: all 0.15s;
        }
        .accordion-header:hover { background: #F8FAFC; }

        .header-left { display: flex; align-items: center; gap: 14px; flex: 1; min-width: 0; }
        .header-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: #FEF2F2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .header-icon svg { width: 20px; height: 20px; color: #DC2626; }

        .header-info { flex: 1; min-width: 0; }
        .header-title { font-size: 14px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
        .header-meta { font-size: 11px; color: var(--muted); }

        .header-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .badge-warning {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 6px;
            background: #FEF2F2; color: #C53030;
            font-size: 11px; font-weight: 700;
        }

        .accordion-body {
            display: none; padding: 0 18px 18px;
            border-top: 1px solid var(--border);
        }
        .accordion-body.open { display: block; }

        .siswa-list { display: flex; flex-direction: column; gap: 0; }
        .siswa-item {
            padding: 12px 0; display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #F3F6F9; transition: all 0.15s;
        }
        .siswa-item:last-child { border-bottom: none; }
        .siswa-item:hover { background: #FFFBF8; }

        .siswa-left { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
        .siswa-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #FEF2F2; display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #DC2626; flex-shrink: 0;
        }
        .siswa-name { font-size: 13px; font-weight: 600; color: var(--ink); }
        .siswa-email { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .badge-unpaid {
            display: inline-flex;
            padding: 4px 10px; border-radius: 6px;
            background: #FEF2F2; color: #C53030;
            font-size: 10.5px; font-weight: 700;
        }

        .empty-state {
            background: #fff; border: 1px solid var(--border); border-radius: 14px;
            padding: 60px 24px; text-align: center;
        }
        .empty-icon {
            width: 52px; height: 52px; background: #ECFDF5; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;
        }
        .empty-icon svg { width: 24px; height: 24px; color: #10B981; }
        .empty-title { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
        .empty-sub { font-size: 13px; color: var(--muted); }

        /* ── PAGINATION ── */
        .pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 4px 0; flex-wrap: wrap; gap: 12px;
        }
        .pagination-info { font-size: 12px; color: var(--muted); }
        .pagination-btns { display: flex; align-items: center; gap: 4px; }
        .page-btn {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 6px;
            border-radius: 8px; font-size: 13px; font-weight: 600;
            border: 1px solid var(--border); color: var(--muted);
            text-decoration: none; transition: all 0.15s ease; background: #fff;
        }
        .page-btn:hover { background: var(--bg); border-color: #94A3B8; }
        .page-btn.active { background: var(--teal); color: #fff; border-color: var(--teal); }
        .page-btn.disabled { opacity: 0.35; pointer-events: none; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .notif-btn {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--bg); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; position: relative; transition: all 0.15s;
        }
        .notif-btn:hover { background: #EFF6FF; border-color: #BAE6FD; }
        .notif-btn svg { width: 15px; height: 15px; color: var(--muted); }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 6px; height: 6px; border-radius: 50%;
            background: #EF4444; border: 2px solid #fff;
        }
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
            <div class="nav-section">Menu</div>
            <a href="{{ route('wali.dashboard') }}" class="nav-item {{ request()->routeIs('wali.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('wali.transaksi-kas') }}" class="nav-item {{ request()->routeIs('wali.transaksi-kas') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Transaksi Kas
            </a>
            <a href="{{ route('wali.rekap-pembayaran') }}" class="nav-item {{ request()->routeIs('wali.rekap-pembayaran') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Rekap Pembayaran
            </a>
            <a href="{{ route('wali.tunggakan') }}" class="nav-item {{ request()->routeIs('wali.tunggakan') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Tunggakan
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
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
                <span class="bc-root">Wali Kelas</span>
                <span class="bc-sep">/</span>
                <span class="bc-current">Tunggakan</span>
            </div>
                <div class="topbar-right">
                <button class="notif-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="notif-dot"></span>
                </button>
                <div class="profile-wrap">
                    <div class="profile-pill" id="profileBtn">
                        <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <div>
                            <div class="p-name">{{ auth()->user()->name }}</div>
                            <div class="p-role">Wali Kelas</div>
                        </div>
                    </div>
                <div class="dropdown" id="dropdownMenu">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="content">
            <div class="content-inner">

                {{-- HERO --}}
                <div class="hero">
                    <div class="hero-title">{{ $wali->kelas->nama_kelas }}</div>
                    <div class="hero-sub">Daftar tagihan yang melewati batas bayar</div>
                </div>

                {{-- FILTERS --}}
                <form method="GET" action="{{ route('wali.tunggakan') }}" class="filters-card">
                    <div class="filter-group" style="flex: 1; min-width: 200px;">
                        <label class="filter-label">Cari Tagihan</label>
                        <input type="text" name="search" class="filter-input" placeholder="Cari..." value="{{ request('search') }}">
                    </div>
                    <div class="filter-group" style="min-width: 140px;">
                        <label class="filter-label">Dari Tanggal</label>
                        <input type="date" name="dari" class="filter-input" value="{{ request('dari') }}">
                    </div>
                    <div class="filter-group" style="min-width: 140px;">
                        <label class="filter-label">Sampai Tanggal</label>
                        <input type="date" name="sampai" class="filter-input" value="{{ request('sampai') }}">
                    </div>
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="{{ route('wali.tunggakan') }}" class="btn-reset">Reset</a>
                </form>

                {{-- TUNGGAKAN LIST --}}
                @if ($tunggakan->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="empty-title">Tidak ada tunggakan</div>
                    <div class="empty-sub">Semua siswa sudah membayar tepat waktu</div>
                </div>
                @else
                <div class="tunggakan-list">
                    @foreach ($tunggakan as $idx => $item)
                    <div class="tunggakan-card">
                        <div class="accordion-header" onclick="toggleAccordion({{ $idx }})">
                            <div class="header-left">
                                <div class="header-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                </div>
                                <div class="header-info">
                                    <div class="header-title">{{ $item['tagihan']->nama_tagihan }}</div>
                                    <div class="header-meta">
                                        Batas: {{ \Carbon\Carbon::parse($item['tagihan']->batas_bayar)->translatedFormat('d F Y') }} ·
                                        Rp {{ number_format($item['tagihan']->nominal, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="header-right">
                                <span class="badge-warning">{{ $item['siswa']->count() }} siswa menunggak</span>
                                <svg id="chevron-{{ $idx }}" style="width:18px; height:18px; color:#64748B; transition:transform 0.25s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                        <div id="accordion-body-{{ $idx }}" class="accordion-body">
                            <div class="siswa-list">
                                @foreach ($item['siswa'] as $siswa)
                                <div class="siswa-item">
                                    <div class="siswa-left">
                                        <div class="siswa-avatar">{{ strtoupper(substr($siswa->user->name ?? $siswa->name ?? '?', 0, 1)) }}</div>
                                        <div>
                                            <div class="siswa-name">{{ $siswa->user->name ?? $siswa->name ?? '-' }}</div>
                                            <div class="siswa-email">{{ $siswa->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <span class="badge-unpaid">Belum Bayar</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                @if ($tunggakan->hasPages())
                <div class="pagination-wrap">
                    <p class="pagination-info">
                        Menampilkan {{ $tunggakan->firstItem() }}–{{ $tunggakan->lastItem() }} dari {{ $tunggakan->total() }} tagihan
                    </p>
                    <div class="pagination-btns">
                        @if ($tunggakan->onFirstPage())
                            <span class="page-btn disabled">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </span>
                        @else
                            <a href="{{ $tunggakan->previousPageUrl() }}" class="page-btn">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </a>
                        @endif

                        @php $start = max(1, $tunggakan->currentPage()-2); $end = min($tunggakan->lastPage(), $tunggakan->currentPage()+2); @endphp

                        @if ($start > 1)
                            <a href="{{ $tunggakan->url(1) }}" class="page-btn">1</a>
                            @if ($start > 2) <span style="color:#CBD5E1; font-size:13px; padding:0 4px;">…</span> @endif
                        @endif

                        @for ($p = $start; $p <= $end; $p++)
                            <a href="{{ $tunggakan->url($p) }}" class="page-btn {{ $p === $tunggakan->currentPage() ? 'active' : '' }}">{{ $p }}</a>
                        @endfor

                        @if ($end < $tunggakan->lastPage())
                            @if ($end < $tunggakan->lastPage()-1) <span style="color:#CBD5E1; font-size:13px; padding:0 4px;">…</span> @endif
                            <a href="{{ $tunggakan->url($tunggakan->lastPage()) }}" class="page-btn">{{ $tunggakan->lastPage() }}</a>
                        @endif

                        @if ($tunggakan->hasMorePages())
                            <a href="{{ $tunggakan->nextPageUrl() }}" class="page-btn">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @else
                            <span class="page-btn disabled">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
                @endif

            </div>
        </main>
    </div>
</div>

<script>
const profileBtn = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');
profileBtn.addEventListener('click', e => { e.stopPropagation(); dropdownMenu.classList.toggle('open'); });
document.addEventListener('click', e => {
    if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) dropdownMenu.classList.remove('open');
});

function toggleAccordion(index) {
    const body = document.getElementById('accordion-body-' + index);
    const chevron = document.getElementById('chevron-' + index);
    body.classList.toggle('open');
    chevron.style.transform = body.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0)';
}
</script>
</body>
</html>
