<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pembayaran — KASKU</title>
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

        .profile-wrap { position: relative; }
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

        /* ── MAIN ── */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .content { flex: 1; padding: 24px 28px; padding-top: 80px; overflow-y: auto; }
        .content-inner { max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }

        /* ── PAGE HEADER ── */
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; }
        .page-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: var(--ink); letter-spacing: -0.4px; }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* ── REKAP LIST ── */
        .rekap-list { display: flex; flex-direction: column; gap: 12px; }

        .rekap-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px 24px;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative; overflow: hidden;
        }
        .rekap-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.06); transform: translateY(-2px); }

        .rekap-card::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 4px; border-radius: 16px 0 0 16px;
        }
        .rekap-card.status-full::before { background: #10B981; }
        .rekap-card.status-warn::before { background: #EF4444; }
        .rekap-card.status-half::before { background: #F59E0B; }
        .rekap-card.status-ok::before { background: #3B82F6; }

        .rekap-top {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 14px; gap: 16px;
        }
        .rekap-info { flex: 1; min-width: 0; }
        .rekap-name { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
        .rekap-meta { font-size: 12px; color: var(--muted); display: flex; flex-wrap: wrap; gap: 10px; }
        .rekap-meta-dot { color: #D1D5DB; }

        .rekap-persen {
            font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800;
            line-height: 1; text-align: right; flex-shrink: 0;
        }
        .rekap-persen-sub { font-size: 11px; color: var(--muted); font-weight: 500; text-align: right; margin-top: 3px; }

        .progress-track {
            height: 7px; background: #F1F5F9;
            border-radius: 99px; overflow: hidden; margin-bottom: 14px;
        }
        .progress-fill {
            height: 100%; border-radius: 99px;
            transition: width 0.7s cubic-bezier(0.4,0,0.2,1);
        }

        .rekap-bottom { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .rekap-stat {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; font-weight: 600;
        }
        .rekap-stat .dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }

        .rekap-badge {
            margin-left: auto; display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 20px;
            font-size: 11px; font-weight: 700; letter-spacing: 0.2px;
        }
        .badge-full { background: #ECFDF5; color: #065F46; }
        .badge-warn { background: #FEF2F2; color: #C53030; }
        .badge-half { background: #FFFBEB; color: #92400E; }
        .badge-ok { background: #EFF6FF; color: #1D4ED8; }

        .empty-state {
            background: #fff; border: 1px solid var(--border); border-radius: 16px;
            padding: 60px 24px; text-align: center;
        }
        .empty-icon {
            width: 52px; height: 52px; background: #F1F5F9; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .empty-icon svg { width: 24px; height: 24px; color: #94A3B8; }
        .empty-title { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
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
        .page-btn:hover { background: var(--teal-pale); color: var(--teal); border-color: #B2DEDE; }
        .page-btn.active { background: var(--teal); color: #fff; border-color: var(--teal); }
        .page-btn.disabled { opacity: 0.35; pointer-events: none; }
        .page-ellipsis { color: #CBD5E1; font-size: 13px; padding: 0 4px; }
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

        /* Style Filter Card (Diambil dari halaman transaksi) */
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
                <span class="bc-current">Rekap Pembayaran</span>
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

                {{-- PAGE HEADER --}}
                <div class="page-header">
                    <div>
                        <div class="page-title">Rekap Pembayaran</div>
                        <div class="page-sub">Pantau progres pembayaran setiap tagihan kelas Anda</div>
                    </div>
                </div>
                <form method="GET" action="{{ route('wali.rekap-pembayaran') }}" class="filters-card">
                    <div class="filter-group" style="flex: 1; min-width: 200px;">
                        <label class="filter-label">Cari Tagihan</label>
                        <input type="text" name="search" class="filter-input" placeholder="Cari tagihan..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn-filter">Cari</button>
                    <a href="{{ route('wali.rekap-pembayaran') }}" class="btn-reset">Reset</a>
                </form>

                {{-- REKAP LIST --}}
                <div class="rekap-list">
                    @forelse ($rekapTagihan as $item)

                    @php
                        $persen = $item['persen'];
                        $isPast = \Carbon\Carbon::parse($item['tagihan']->batas_bayar)->isPast();

                        if ($persen == 100) {
                            $cardClass = 'status-full';
                            $persenColor = '#059669';
                            $fillColor = '#10B981';
                            $badgeClass = 'badge-full';
                            $badgeIcon = '✓';
                            $badgeText = 'Lunas Semua';
                        } elseif ($isPast) {
                            $cardClass = 'status-warn';
                            $persenColor = '#DC2626';
                            $fillColor = '#EF4444';
                            $badgeClass = 'badge-warn';
                            $badgeIcon = '⚠';
                            $badgeText = 'Lewat Jatuh Tempo';
                        } elseif ($persen >= 50) {
                            $cardClass = 'status-half';
                            $persenColor = '#D97706';
                            $fillColor = '#F59E0B';
                            $badgeClass = 'badge-half';
                            $badgeIcon = '◑';
                            $badgeText = 'Sebagian Lunas';
                        } else {
                            $cardClass = 'status-ok';
                            $persenColor = '#2563EB';
                            $fillColor = '#3B82F6';
                            $badgeClass = 'badge-ok';
                            $badgeIcon = '●';
                            $badgeText = 'Aktif';
                        }
                    @endphp

                    <div class="rekap-card {{ $cardClass }}">
                        <div class="rekap-top">
                            <div class="rekap-info">
                                <div class="rekap-name">{{ $item['tagihan']->nama_tagihan }}</div>
                                <div class="rekap-meta">
                                    <span>Periode: {{ \Carbon\Carbon::parse($item['tagihan']->periode)->translatedFormat('d F Y') }}</span>
                                    <span class="rekap-meta-dot">·</span>
                                    <span>Batas: {{ \Carbon\Carbon::parse($item['tagihan']->batas_bayar)->translatedFormat('d F Y') }}</span>
                                    <span class="rekap-meta-dot">·</span>
                                    <span style="font-weight:600; color:var(--ink);">Rp {{ number_format($item['tagihan']->nominal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="rekap-persen" style="color:{{ $persenColor }};">{{ $persen }}%</div>
                                <div class="rekap-persen-sub">{{ $item['sudah_bayar'] }}/{{ $item['total_siswa'] }} siswa</div>
                            </div>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $persen }}%; background:{{ $fillColor }};"></div>
                        </div>

                        <div class="rekap-bottom">
                            <div class="rekap-stat" style="color:#059669;">
                                <span class="dot" style="background:#10B981;"></span>
                                {{ $item['sudah_bayar'] }} lunas
                            </div>
                            <div class="rekap-stat" style="color:#DC2626;">
                                <span class="dot" style="background:#EF4444;"></span>
                                {{ $item['belum_bayar'] }} belum bayar
                            </div>
                            <span class="rekap-badge {{ $badgeClass }}">
                                {{ $badgeIcon }} {{ $badgeText }}
                            </span>
                        </div>
                    </div>

                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="empty-title">Belum ada tagihan</div>
                        <div class="empty-sub">Belum ada tagihan yang dibuat untuk kelas ini</div>
                    </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                @if ($rekapTagihan->hasPages())
                <div class="pagination-wrap">
                    <p class="pagination-info">
                        Menampilkan {{ $rekapTagihan->firstItem() }}–{{ $rekapTagihan->lastItem() }}
                        dari {{ $rekapTagihan->total() }} rekap pembayaran
                    </p>
                    <div class="pagination-btns">
                        @if ($rekapTagihan->onFirstPage())
                            <span class="page-btn disabled">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </span>
                        @else
                            <a href="{{ $rekapTagihan->previousPageUrl() }}" class="page-btn">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </a>
                        @endif

                        @php $start = max(1, $rekapTagihan->currentPage()-2); $end = min($rekapTagihan->lastPage(), $rekapTagihan->currentPage()+2); @endphp

                        @if ($start > 1)
                            <a href="{{ $rekapTagihan->url(1) }}" class="page-btn">1</a>
                            @if ($start > 2) <span class="page-ellipsis">…</span> @endif
                        @endif

                        @for ($p = $start; $p <= $end; $p++)
                            <a href="{{ $rekapTagihan->url($p) }}" class="page-btn {{ $p === $rekapTagihan->currentPage() ? 'active' : '' }}">{{ $p }}</a>
                        @endfor

                        @if ($end < $rekapTagihan->lastPage())
                            @if ($end < $rekapTagihan->lastPage()-1) <span class="page-ellipsis">…</span> @endif
                            <a href="{{ $rekapTagihan->url($rekapTagihan->lastPage()) }}" class="page-btn">{{ $rekapTagihan->lastPage() }}</a>
                        @endif

                        @if ($rekapTagihan->hasMorePages())
                            <a href="{{ $rekapTagihan->nextPageUrl() }}" class="page-btn">
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
