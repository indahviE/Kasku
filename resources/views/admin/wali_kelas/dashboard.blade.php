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
                --teal-light: #12A09F;
                --teal-pale: #E6F4F4;
                --ink: #0F1923;
                --muted: #64748B;
                --border: #E2E8F0;
                --surface: #FFFFFF;
                --bg: #F8FAFC;
            }
            * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
            html { -ms-overflow-style: none; scrollbar-width: none; }
            html::-webkit-scrollbar { display: none; }
            .font-display { font-family: 'Sora', sans-serif; }

            .app-shell { display: flex; min-height: 100vh; background: var(--bg); }

            /* ── SIDEBAR ── */
            .sidebar {
                width: 220px;
                background: #1A2332;
                display: flex; flex-direction: column;
                position: sticky; top: 0; height: 100vh; flex-shrink: 0;
                border-right: 1px solid rgba(255,255,255,0.05);
            }
            .sidebar-brand {
                padding: 20px 16px;
                border-bottom: 1px solid rgba(255,255,255,0.05);
                display: flex; align-items: center; gap: 10px;
            }
            .brand-icon {
                width: 36px; height: 36px;
                background: var(--teal);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 0 0 3px rgba(14,124,123,0.15);
                flex-shrink: 0;
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
                cursor: pointer; transition: all 0.15s ease;
                position: relative; text-decoration: none;
            }
            .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8); }
            .nav-item.active {
                background: rgba(14,124,123,0.15);
                color: #5DD6D5;
            }
            .nav-item.active::before {
                content: '';
                position: absolute; left: 0; top: 50%; transform: translateY(-50%);
                width: 3px; height: 18px; background: #0E7C7B;
                border-radius: 0 3px 3px 0;
            }
            .nav-item svg { width: 15px; height: 15px; flex-shrink: 0; }

            .sidebar-footer {
                padding: 10px;
                border-top: 1px solid rgba(255,255,255,0.05);
            }
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

            /* ── ALERTS ── */
            .alert {
                padding: 12px 16px; border-radius: 12px;
                font-size: 13px; font-weight: 500;
            }
            .alert-success {
                background: #F0FDF4; border: 1px solid #BBEE8D;
                color: #166534;
            }
            .alert-error {
                background: #FEF2F2; border: 1px solid #FCA5A5;
                color: #C53030;
            }

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

            .hero-badge {
                display: inline-flex; align-items: center; gap: 5px;
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.18);
                border-radius: 20px; padding: 4px 12px;
                font-size: 10.5px; font-weight: 600; color: rgba(255,255,255,0.8);
                margin-bottom: 10px; position: relative; z-index: 1;
            }
            .hero-badge svg { width: 10px; height: 10px; }

            .hero-title {
                font-size: 26px; font-weight: 800; letter-spacing: -0.5px;
                margin-bottom: 4px; font-family: 'Sora', sans-serif; position: relative; z-index: 1;
            }
            .hero-sub { font-size: 12px; color: rgba(255,255,255,0.5); margin-bottom: 20px; position: relative; z-index: 1; }

            .hero-stats { display: flex; gap: 0; position: relative; z-index: 1; }
            .hero-stat {
                padding: 0 24px 0 0; margin: 0 24px 0 0;
                border-right: 1px solid rgba(255,255,255,0.1);
            }
            .hero-stat:last-child { border-right: none; margin: 0; padding: 0; }
            .hs-label { font-size: 10px; color: rgba(255,255,255,0.5); margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.5px; }
            .hs-val { font-size: 16px; font-weight: 700; }

            /* ── STAT GRID ── */
            .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
            @media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }

            .stat-card {
                background: #fff; border-radius: 14px;
                border: 1px solid var(--border);
                padding: 18px; position: relative; overflow: hidden;
                transition: box-shadow 0.2s, transform 0.2s;
                cursor: pointer;
            }
            .stat-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.06); transform: translateY(-2px); }

            .stat-bar { position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 14px 14px 0 0; }

            .stat-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px; gap: 12px; }
            .stat-icon {
                width: 38px; height: 38px; border-radius: 10px;
                display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            }
            .stat-icon svg { width: 18px; height: 18px; }

            .stat-trend {
                font-size: 10px; font-weight: 700;
                padding: 3px 8px; border-radius: 6px;
                display: flex; align-items: center; gap: 3px; flex-shrink: 0;
            }

            .stat-label { font-size: 10.5px; color: var(--muted); font-weight: 600; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.4px; }
            .stat-value { font-size: 24px; font-weight: 800; font-family: 'Sora', sans-serif; margin-bottom: 2px; }
            .stat-foot { font-size: 11px; color: var(--muted); }

            /* ── TABLE ── */
            .table-card {
                background: #fff; border-radius: 16px;
                border: 1px solid var(--border); overflow: hidden;
            }
            .table-head {
                padding: 18px 22px 14px;
                border-bottom: 1px solid var(--border);
                display: flex; align-items: center; justify-content: space-between;
            }
            .th-title { font-size: 14px; font-weight: 700; color: var(--ink); margin-bottom: 2px; font-family: 'Sora'; }
            .th-sub { font-size: 11.5px; color: var(--muted); }

            table { width: 100%; border-collapse: collapse; }
            thead tr { background: #F8FAFC; }
            th {
                padding: 10px 18px; text-align: left;
                font-size: 10px; font-weight: 700; letter-spacing: 0.7px;
                text-transform: uppercase; color: var(--muted);
                border-bottom: 1px solid var(--border);
            }
            td { padding: 13px 18px; font-size: 13px; color: #374151; border-bottom: 1px solid #F3F6F9; }
            tbody tr:last-child td { border-bottom: none; }
            tbody tr:hover td { background: #F8FEFE; }

            .td-num { color: #CBD5E1; font-weight: 600; font-size: 11px; }
            .td-wrap { display: flex; align-items: center; gap: 10px; }
            .td-av {
                width: 32px; height: 32px; border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 12px; font-weight: 700; color: #fff; flex-shrink: 0;
            }
            .td-name { font-weight: 600; color: var(--ink); }
            .td-muted { color: var(--muted); font-size: 12.5px; }

            .badge {
                display: inline-flex; align-items: center; gap: 4px;
                padding: 4px 9px; border-radius: 6px;
                font-size: 10.5px; font-weight: 700;
            }
            .badge-bendahara { background: #EEF2FF; color: #3730A3; }
            .badge-siswa { background: #F1F5F9; color: #64748B; }

            .btn-sm {
                padding: 6px 13px; border-radius: 7px;
                font-size: 11.5px; font-weight: 600;
                cursor: pointer; border: none; transition: all 0.15s;
            }
            .btn-primary { background: var(--teal-pale); color: var(--teal); }
            .btn-primary:hover { background: #D1E9E9; }
            .btn-secondary { background: #F1F5F9; color: #475569; }
            .btn-secondary:hover { background: #E2E8F0; }
            .btn-disabled { background: #F8FAFC; color: #CBD5E1; cursor: not-allowed; opacity: 0.5; }

            .empty-row td { padding: 40px 20px; text-align: center; color: var(--muted); font-size: 13px; font-style: italic; }
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

        /* ── MAIN ── */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .content { flex: 1; padding: 24px 28px; padding-top: 80px; overflow-y: auto; }
        .content-inner { max-width: 960px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }
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
                    <span class="bc-current">Dashboard</span>
                </div>
                <div class="topbar-right">
                    <div class="notif-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <div class="notif-dot"></div>
                    </div>
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
                </div>
            </header>

            {{-- CONTENT --}}
            <main class="content">
                <div class="content-inner">

                    {{-- ALERTS --}}
                    @if (session('success'))
                        <div class="alert alert-success">✓ {{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error">⚠ {{ session('error') }}</div>
                    @endif

                    {{-- HERO --}}
                    <div class="hero">
                        <div class="hero-badge">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                            Kelas yang Anda Ampu
                        </div>
                        <div class="hero-title">{{ $wali->kelas->nama_kelas }}</div>
                        <div class="hero-sub">Tahun Ajaran {{ $wali->kelas->tahun_ajaran }}</div>
                        <div class="hero-stats">
                            <div class="hero-stat">
                                <div class="hs-label">Total Siswa</div>
                                <div class="hs-val">{{ $siswa->count() }} orang</div>
                            </div>
                            <div class="hero-stat">
                                <div class="hs-label">Bendahara</div>
                                <div class="hs-val">{{ $jumlahBendahara }}/2 orang</div>
                            </div>
                            <div class="hero-stat">
                                <div class="hs-label">Tahun Ajaran</div>
                                <div class="hs-val">{{ $wali->kelas->tahun_ajaran }}</div>
                            </div>
                        </div>
                    </div>
                    {{-- STAT GRID --}}
                    <div class="stat-grid">
                        {{-- Total Siswa --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#10B981;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#ECFDF5;">
                                    <svg fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#ECFDF5; color:#059669;">↑ {{ $jumlahBendahara }}/2</div>
                            </div>
                            <div class="stat-label">Total Siswa</div>
                            <div class="stat-value" style="color:#059669;">{{ $siswa->count() }}</div>
                            <div class="stat-foot">Aktif di kelas</div>
                        </div>

                        {{-- Sudah Bayar --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#3B82F6;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#EFF6FF;">
                                    <svg fill="none" stroke="#2563EB" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#EFF6FF; color:#2563EB;">{{ $siswa->count() > 0 ? round($jumlahLunas / $siswa->count() * 100) : 0 }}%</div>
                            </div>
                            <div class="stat-label">Sudah Bayar</div>
                            <div class="stat-value" style="color:#2563EB;">{{ $jumlahLunas }}</div>
                            <div class="stat-foot">Lunas bulan ini</div>
                        </div>

                        {{-- Belum Bayar --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#F59E0B;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#FFFBEB;">
                                    <svg fill="none" stroke="#D97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#FFFBEB; color:#D97706;">Perlu ditagih</div>
                            </div>
                            <div class="stat-label">Belum Bayar</div>
                            <div class="stat-value" style="color:#D97706;">{{ $jumlahBelumBayar }}</div>
                            <div class="stat-foot">Siswa menunggak</div>
                        </div>

                        {{-- Kas Masuk --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#10B981;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#ECFDF5;">
                                    <svg fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#ECFDF5; color:#059669;">Total lunas</div>
                            </div>
                            <div class="stat-label">Kas Masuk</div>
                            <div class="stat-value" style="color:#059669; font-size:18px;">Rp {{ number_format($kasMasuk, 0, ',', '.') }}</div>
                            <div class="stat-foot">Dari siswa</div>
                        </div>

                        {{-- Kas Keluar --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#EF4444;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#FEF2F2;">
                                    <svg fill="none" stroke="#DC2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#FEF2F2; color:#DC2626;">Pengeluaran</div>
                            </div>
                            <div class="stat-label">Kas Keluar</div>
                            <div class="stat-value" style="color:#DC2626; font-size:18px;">Rp {{ number_format($kasKeluar, 0, ',', '.') }}</div>
                            <div class="stat-foot">Total digunakan</div>
                        </div>

                        {{-- Tagihan Aktif --}}
                        <div class="stat-card">
                            <div class="stat-bar" style="background:#8B5CF6;"></div>
                            <div class="stat-top">
                                <div class="stat-icon" style="background:#F5F3FF;">
                                    <svg fill="none" stroke="#7C3AED" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <div class="stat-trend" style="background:#F5F3FF; color:#7C3AED;">Bulan ini</div>
                            </div>
                            <div class="stat-label">Tagihan Aktif</div>
                            <div class="stat-value" style="color:#7C3AED;">{{ $jumlahTagihanAktif }}</div>
                            <div class="stat-foot">Tagihan berjalan</div>
                        </div>
                    </div>
                    {{-- search --}}
                    <form method="GET" action="{{ route('wali.dashboard') }}" class="filters-card">
                    <div class="filter-group" style="flex: 1; min-width: 200px;">
                        <label class="filter-label">Cari Data</label>
                        <input type="text" name="search" class="filter-input" placeholder="Cari sesuatu..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>
                    <a href="{{ route('wali.dashboard') }}" class="btn-reset">Reset</a>
                </form>
                    {{-- TABLE --}}
                    <div class="table-card">
                        <div class="table-head">
                            <div>
                                <div class="th-title">Daftar Siswa</div>
                                <div class="th-sub">Klik "Jadikan Bendahara" untuk menunjuk bendahara kelas (maks. 2 orang)</div>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:44px;">No</th>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>No HP</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siswa as $i => $s)
                                    <tr>
                                        <td class="td-num">{{ ($siswa->currentPage() - 1) * 5 + $i + 1 }}</td>
                                        <td>
                                            <div class="td-wrap">
                                                <div class="td-av" style="background:{{ ['#0E7C7B','#3B82F6','#8B5CF6','#F59E0B','#EF4444'][$i % 5] }};">{{ substr($s->user->name, 0, 1) }}</div>
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
                                        <td style="text-align:center;">
                                            <form method="POST" action="{{ route('wali.jadikan-bendahara', $s->id) }}" style="display:inline;">
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

                        {{-- PAGINATION --}}
                        @if ($siswa->hasPages())
                        <div style="padding: 16px 22px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                            <p style="font-size: 12px; color: var(--muted);">
                                Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
                            </p>
                            <div style="display: flex; align-items: center; gap: 4px;">
                                {{-- Prev --}}
                                @if ($siswa->onFirstPage())
                                    <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); opacity: 0.35; cursor: not-allowed;">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </span>
                                @else
                                    <a href="{{ $siswa->previousPageUrl() }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); text-decoration: none; transition: all 0.15s; background: #fff;" onmouseover="this.style.background='var(--teal-pale)'; this.style.color='var(--teal)'; this.style.borderColor='#B2DEDE';" onmouseout="this.style.background='#fff'; this.style.color='var(--muted)'; this.style.borderColor='var(--border)';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </a>
                                @endif

                                @php $start = max(1, $siswa->currentPage()-2); $end = min($siswa->lastPage(), $siswa->currentPage()+2); @endphp

                                {{-- First page --}}
                                @if ($start > 1)
                                    <a href="{{ $siswa->url(1) }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 6px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); text-decoration: none; transition: all 0.15s; background: #fff; font-size: 13px; font-weight: 600;" onmouseover="this.style.background='var(--teal-pale)'; this.style.color='var(--teal)'; this.style.borderColor='#B2DEDE';" onmouseout="this.style.background='#fff'; this.style.color='var(--muted)'; this.style.borderColor='var(--border)';">1</a>
                                    @if ($start > 2) <span style="color: #CBD5E1; font-size: 13px; padding: 0 4px;">…</span> @endif
                                @endif

                                {{-- Page numbers --}}
                                @for ($p = $start; $p <= $end; $p++)
                                    <a href="{{ $siswa->url($p) }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 6px; border-radius: 8px; border: 1px solid {{ $p === $siswa->currentPage() ? 'var(--teal)' : 'var(--border)' }}; color: {{ $p === $siswa->currentPage() ? '#fff' : 'var(--muted)' }}; background: {{ $p === $siswa->currentPage() ? 'var(--teal)' : '#fff' }}; text-decoration: none; transition: all 0.15s; font-size: 13px; font-weight: 600;" @if ($p !== $siswa->currentPage()) onmouseover="this.style.background='var(--teal-pale)'; this.style.color='var(--teal)'; this.style.borderColor='#B2DEDE';" onmouseout="this.style.background='#fff'; this.style.color='var(--muted)'; this.style.borderColor='var(--border)';" @endif>{{ $p }}</a>
                                @endfor

                                {{-- Last page --}}
                                @if ($end < $siswa->lastPage())
                                    @if ($end < $siswa->lastPage()-1) <span style="color: #CBD5E1; font-size: 13px; padding: 0 4px;">…</span> @endif
                                    <a href="{{ $siswa->url($siswa->lastPage()) }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 6px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); text-decoration: none; transition: all 0.15s; background: #fff; font-size: 13px; font-weight: 600;" onmouseover="this.style.background='var(--teal-pale)'; this.style.color='var(--teal)'; this.style.borderColor='#B2DEDE';" onmouseout="this.style.background='#fff'; this.style.color='var(--muted)'; this.style.borderColor='var(--border)';">{{ $siswa->lastPage() }}</a>
                                @endif

                                {{-- Next --}}
                                @if ($siswa->hasMorePages())
                                    <a href="{{ $siswa->nextPageUrl() }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); text-decoration: none; transition: all 0.15s; background: #fff;" onmouseover="this.style.background='var(--teal-pale)'; this.style.color='var(--teal)'; this.style.borderColor='#B2DEDE';" onmouseout="this.style.background='#fff'; this.style.color='var(--muted)'; this.style.borderColor='var(--border)';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; border-radius: 8px; border: 1px solid var(--border); color: var(--muted); opacity: 0.35; cursor: not-allowed;">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

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
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) dropdownMenu.classList.remove('open');
    });
    </script>
    </body>
    </html>
