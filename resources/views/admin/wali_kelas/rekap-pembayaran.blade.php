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

        .app-shell { display: flex; min-height: 100vh; background: var(--bg); }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px; background: var(--ink);
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh; flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex; align-items: center; gap: 12px;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .brand-name { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 15px; color: #fff; letter-spacing: -0.3px; }
        .brand-sub  { font-size: 10px; color: rgba(255,255,255,0.3); font-weight: 500; margin-top: 1px; }

        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; }
        .nav-label { font-size: 9px; font-weight: 700; letter-spacing: 1.2px; color: rgba(255,255,255,0.2); text-transform: uppercase; padding: 8px 10px 4px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            color: rgba(255,255,255,0.45); font-size: 13.5px; font-weight: 500;
            text-decoration: none; transition: all 0.18s ease; position: relative;
        }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-item.active { background: linear-gradient(90deg, rgba(14,124,123,0.25), rgba(14,124,123,0.08)); color: #5DD6D5; }
        .nav-item.active::before {
            content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 20px; background: var(--teal-light); border-radius: 0 3px 3px 0;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        .sidebar-footer { padding: 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .logout-btn {
            width: 100%; display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: none; border: none; cursor: pointer;
            color: rgba(255,100,100,0.6); font-size: 13px; font-weight: 500;
            transition: all 0.18s ease; text-align: left;
        }
        .logout-btn:hover { background: rgba(255,80,80,0.08); color: #ff6b6b; }
        .logout-btn svg { width: 15px; height: 15px; }

        /* ── TOPBAR ── */
        .topbar {
            height: 60px; background: rgba(255,255,255,0.85); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; position: sticky; top: 0; z-index: 40;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; }
        .breadcrumb-sep { color: #C8D0D8; }
        .breadcrumb-current { font-weight: 600; color: var(--ink); }
        .breadcrumb-root { color: var(--muted); }

        .profile-wrap { position: relative; }
        .profile-trigger {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 10px; border-radius: 10px;
            cursor: pointer; background: none; border: none; transition: background 0.15s;
        }
        .profile-trigger:hover { background: var(--bg); }
        .profile-name { font-size: 13px; font-weight: 600; color: var(--ink); text-align: right; }
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
            background: none; border: none; cursor: pointer; width: 100%; transition: background 0.15s;
        }
        .dropdown-item-btn:hover { background: #fff5f5; }
        .dropdown-item-btn svg { width: 14px; height: 14px; }

        /* ── MAIN ── */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .content { flex: 1; padding: 28px 32px; overflow-y: auto; }
        .content-inner { max-width: 860px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px; }

        /* ── PAGE HEADER ── */
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; }
        .page-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: var(--ink); letter-spacing: -0.4px; }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* ── REKAP CARD ── */
        .rekap-list { display: flex; flex-direction: column; gap: 12px; }

        .rekap-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px 24px;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .rekap-card:hover { box-shadow: 0 6px 28px rgba(0,0,0,0.07); transform: translateY(-1px); }

        /* left accent bar based on status */
        .rekap-card::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 4px; border-radius: 16px 0 0 16px;
        }
        .rekap-card.status-full::before   { background: #10B981; }
        .rekap-card.status-warn::before   { background: #EF4444; }
        .rekap-card.status-half::before   { background: #F59E0B; }
        .rekap-card.status-ok::before     { background: #3B82F6; }

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
        .rekap-persen-sub { font-size: 11px; color: var(--muted); font-weight: 500; text-align: right; margin-top: 3px; font-family: 'DM Sans'; }

        /* Progress bar */
        .progress-track {
            height: 7px; background: #F1F5F9;
            border-radius: 99px; overflow: hidden; margin-bottom: 14px;
        }
        .progress-fill {
            height: 100%; border-radius: 99px;
            transition: width 0.7s cubic-bezier(0.4,0,0.2,1);
        }

        /* Bottom row */
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
        .badge-full   { background: #ECFDF5; color: #065F46; }
        .badge-warn   { background: #FFF5F5; color: #C53030; }
        .badge-half   { background: #FFFBEB; color: #92400E; }
        .badge-ok     { background: #EFF6FF; color: #1D4ED8; }

        /* Empty state */
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
        .page-btn:hover { background: var(--teal-pale); color: var(--teal); border-color: #b2dede; }
        .page-btn.active { background: var(--teal); color: #fff; border-color: var(--teal); }
        .page-btn.disabled { opacity: 0.35; pointer-events: none; }
        .page-ellipsis { color: #CBD5E1; font-size: 13px; padding: 0 4px; }
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
                <span class="breadcrumb-current">Rekap Pembayaran</span>
            </div>
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
        </header>

        {{-- CONTENT --}}
        <main class="content">
            <div class="content-inner">

                {{-- PAGE HEADER --}}
                <div class="page-header">
                    <div>
                        <div class="page-title font-display">Rekap Pembayaran</div>
                        <div class="page-sub">Pantau progres pembayaran setiap tagihan kelas Anda.</div>
                    </div>
                </div>

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

                        {{-- Top: info + persentase --}}
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

                        {{-- Progress bar --}}
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $persen }}%; background:{{ $fillColor }};"></div>
                        </div>

                        {{-- Bottom: stats + badge --}}
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
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:24px;height:24px;color:#94A3B8;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="empty-title">Belum ada tagihan</div>
                        <div class="empty-sub">Belum ada tagihan yang dibuat untuk kelas ini.</div>
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

                        {{-- Prev --}}
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

                        {{-- Next --}}
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
const profileBtn   = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');
profileBtn.addEventListener('click', e => { e.stopPropagation(); dropdownMenu.classList.toggle('open'); });
document.addEventListener('click', e => { if (!profileBtn.contains(e.target)) dropdownMenu.classList.remove('open'); });
</script>
</body>
</html>
