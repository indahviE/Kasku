{{-- resources/views/admin/data-transaksi.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Admin Panel</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            margin:0;
            background:#eef2f7;
            font-size:13px;
            color: #334155;
        }

        /* --- SIDEBAR --- */
        .sidebar{
            width:220px;
            height:100vh;
            background:linear-gradient(180deg,#071739,#0d2456);
            position:fixed;
            left:0;
            top:0;
            padding-top:18px;
            box-shadow:4px 0 20px rgba(0,0,0,0.08);
            z-index: 100;
        }

        .logo-box{
            padding:0 18px;
            margin-bottom:30px;
        }

        .logo-icon{
            width:36px;
            height:36px;
            border-radius:10px;
            background:linear-gradient(135deg,#1f8aa5,#29b2d1);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:16px;
        }

        .logo-title{
            color:white;
            font-size:16px;
            font-weight:700;
        }

        .menu{
            display:block;
            margin:5px 12px;
            padding:10px 15px;
            border-radius:12px;
            text-decoration:none;
            color:#dbe5f1;
            font-size:13px;
            transition:.2s;
        }

        .menu:hover{
            background:#10264f;
            color:white;
        }

        .menu.active{
            background:linear-gradient(90deg,#1f8aa5,#29b2d1);
            color:white;
            font-weight:600;
            box-shadow:0 5px 14px rgba(41,178,209,.25);
        }

        .logout{
            position:absolute;
            bottom:22px;
            left:20px;
            color:#ff5c5c;
            text-decoration:none;
            font-weight:600;
            font-size:13px;
        }

        /* --- CONTENT AREA --- */
        .content{
            margin-left:220px;
            padding:18px;
        }

        /* --- TOPBAR --- */
        .topbar{
            background:white;
            padding:14px 22px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin:-18px -18px 20px -18px;
            border-bottom:1px solid #e9eef5;
        }

        .breadcrumb-custom{
            color:#94a3b8;
            font-size:13px;
        }

        .breadcrumb-custom span{
            color:#0f172a;
            font-weight:700;
        }

        .profile-name{
            font-size:13px;
            font-weight:700;
            color:#0f172a;
        }

        .profile-status{
            color:#22c55e;
            font-size:11px;
        }

        .profile-avatar{
            width:36px;
            height:36px;
            border-radius:50%;
            background:linear-gradient(135deg,#1f8aa5,#29b2d1);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
        }

        /* --- DASHBOARD HEADER (GRAPH & STATS) --- */
        .header-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: stretch;
        }
        
        .graph-card{
            background:white;
            border-radius:20px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.04);
            flex: 2; /* Mengambil ruang lebih besar */
        }

        .stats-side {
            flex: 1.2; /* Mengambil ruang di kanan */
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-small-card {
            background: white;
            border-radius: 18px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }

        .stat-small-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-in { background: #dcfce7; color: #16a34a; }
        .icon-out { background: #fee2e2; color: #dc2626; }
        .icon-bal { background: #e0f2fe; color: #0369a1; }
        
        .stat-label { color: #94a3b8; font-size: 11px; font-weight: 600; margin-bottom: 2px; text-transform: uppercase; }
        .stat-value { color: #0f172a; font-size: 16px; font-weight: 700; }

        .graph-title{
            font-size:14px;
            font-weight:700;
            color:#0f172a;
            margin-bottom:15px;
        }

        .chart-container {
            position: relative;
            height: 160px;
            width: 100%;
        }

        /* --- TABLE CARD --- */
        .card-table{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.04);
        }

        .card-header-custom{
            padding:18px 22px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:1px solid #eef2f7;
        }

        .card-title{
            font-size:15px;
            font-weight:700;
            color:#0f172a;
        }

        .form-select{
            border-radius:10px;
            border:1px solid #dbe3ef;
            padding:7px 12px;
            font-size:12px;
            width:160px;
            outline: none;
        }

        /* --- TABLE STYLING --- */
        thead{
            background:#f8fafc;
        }

        th{
            color:#94a3b8 !important;
            font-size:11px;
            font-weight:700;
            padding:14px 20px !important;
            border:none !important;
            text-transform: uppercase;
        }

        td{
            padding:14px 20px !important;
            border-top:1px solid #f1f5f9 !important;
            vertical-align:middle;
            font-size:13px;
            color:#334155;
        }

        tbody tr:hover{
            background:#f8fbff;
        }

        .trans-info{
            display:flex;
            align-items:center;
            gap:12px;
            font-weight:600;
        }

        .avatar{
            width:32px;
            height:32px;
            border-radius:50%;
            background:#e0f2fe;
            color:#0369a1;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:12px;
            font-weight:700;
        }

        .badge-masuk{
            background:#dcfce7;
            color:#16a34a;
            padding:6px 12px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .badge-keluar{
            background:#fee2e2;
            color:#dc2626;
            padding:6px 12px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .action-btn{
            width:30px;
            height:30px;
            border:none;
            border-radius:8px;
            background:#f1f5f9;
            font-size:12px;
            margin:0 2px;
            transition: 0.2s;
        }

        .action-btn:hover{
            background:#dbeafe;
            transform: scale(1.1);
        }

    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="logo-box d-flex align-items-center gap-3">
            <div class="logo-icon">A</div>
            <div class="logo-title">Admin Panel</div>
        </div>

        <a href="#" class="menu">Dashboard</a>
        <a href="#" class="menu">Kelola User</a>
        <a href="#" class="menu">Kelola Kelas</a>
        <a href="#" class="menu active">Data Transaksi</a>
        
        <a href="#" class="logout">Logout</a>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="content">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="breadcrumb-custom">
                Pages / <span>Data Transaksi</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="profile-name">MELINA DETIANA</div>
                    <div class="profile-status">Online</div>
                </div>
                <div class="profile-avatar">M</div>
            </div>
        </div>

        {{-- HEADER SECTION: GRAPH & QUICK STATS --}}
        <div class="header-row">
            
            {{-- GRAPH CARD --}}
            <div class="graph-card">
                <div class="graph-title">Grafik Arus Kas Bulanan</div>
                <div class="chart-container">
                    <canvas id="transaksiChart"></canvas>
                </div>
            </div>

            {{-- QUICK STATS SIDE --}}
            <div class="stats-side">
                <div class="stat-small-card">
                    <div class="stat-icon icon-in">💰</div>
                    <div>
                        <div class="stat-label">Total Pemasukan</div>
                        <div class="stat-value">Rp 2.450.000</div>
                    </div>
                </div>

                <div class="stat-small-card">
                    <div class="stat-icon icon-out">💸</div>
                    <div>
                        <div class="stat-label">Total Pengeluaran</div>
                        <div class="stat-value">Rp 840.000</div>
                    </div>
                </div>

                <div class="stat-small-card">
                    <div class="stat-icon icon-bal">🏦</div>
                    <div>
                        <div class="stat-label">Saldo Saat Ini</div>
                        <div class="stat-value">Rp 1.610.000</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- DATA TABLE CARD --}}
        <div class="card-table">
            <div class="card-header-custom">
                <div class="card-title">Riwayat Transaksi Terkini</div>
                <div class="d-flex align-items-center gap-2">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8;">FILTER:</span>
                    <select class="form-select">
                        <option selected>Semua Jenis</option>
                        <option>Masuk</option>
                        <option>Keluar</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA TRANSAKSI</th>
                            <th>TANGGAL</th>
                            <th>JENIS</th>
                            <th>NOMINAL</th>
                            <th>STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>
                                <div class="trans-info">
                                    <div class="avatar">S</div>
                                    Sumbangan Kelas
                                </div>
                            </td>
                            <td>12 Mei 2026</td>
                            <td><span class="badge-masuk">Masuk</span></td>
                            <td class="text-success fw-semibold">Rp 150.000</td>
                            <td>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Berhasil</span>
                            </td>
                            <td class="text-center">
                                <button class="action-btn" title="Edit">✏️</button>
                                <button class="action-btn" title="Hapus">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>
                                <div class="trans-info">
                                    <div class="avatar">A</div>
                                    Beli ATK
                                </div>
                            </td>
                            <td>11 Mei 2026</td>
                            <td><span class="badge-keluar">Keluar</span></td>
                            <td class="text-danger fw-semibold">Rp 50.000</td>
                            <td>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Berhasil</span>
                            </td>
                            <td class="text-center">
                                <button class="action-btn" title="Edit">✏️</button>
                                <button class="action-btn" title="Hapus">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Chart.js Library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        
        // Membuat gradien warna untuk background grafik
        const chartGradient = ctx.createLinearGradient(0, 0, 0, 160);
        chartGradient.addColorStop(0, 'rgba(31, 138, 165, 0.4)');
        chartGradient.addColorStop(1, 'rgba(31, 138, 165, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [15, 25, 18, 35, 28, 45],
                    borderColor: '#1f8aa5',
                    backgroundColor: chartGradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4, // Melengkungkan garis
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#1f8aa5',
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Sembunyikan label dataset
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { 
                            font: { size: 10 },
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { size: 10 },
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>