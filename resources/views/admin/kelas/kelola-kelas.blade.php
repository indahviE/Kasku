{{-- resources/views/admin/kelola-kelas.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            font-family:'Segoe UI', sans-serif;
        }

        body{
            margin:0;
            background:#eef2f7;
            font-size:13px;
        }

        /* SIDEBAR */
        .sidebar{
            width:220px;
            height:100vh;
            background:linear-gradient(180deg,#071739,#0d2456);
            position:fixed;
            left:0;
            top:0;
            padding-top:18px;
            box-shadow:4px 0 20px rgba(0,0,0,0.08);
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

        /* CONTENT */
        .content{
            margin-left:220px;
            padding:18px;
        }

        /* TOPBAR */
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

        /* --- UPDATED STATS DESIGN --- */
        .stats-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:25px;
        }

        .stats-card{
            background: white;
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.8);
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(31, 138, 165, 0.1);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(31, 138, 165, 0.1), transparent);
            top: -20px;
            right: -20px;
            border-radius: 50%;
        }

        .stats-content {
            z-index: 1;
        }

        .stats-title{
            color:#64748b;
            font-size:12px;
            font-weight: 600;
            margin-bottom:4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stats-value{
            font-size:28px;
            font-weight:800;
            color:#0f172a;
            line-height: 1;
        }

        .stats-sub{
            font-size:11px;
            margin-top:8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .sub-up { color: #10b981; font-weight: 600; }
        .sub-neutral { color: #94a3b8; }

        .stats-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            z-index: 1;
        }

        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-purple { background: #f5f3ff; color: #8b5cf6; }
        .icon-orange { background: #fff7ed; color: #f97316; }

        /* TABLE CARD */
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

        .filter-box{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .filter-text{
            color:#94a3b8;
            font-size:12px;
            font-weight:700;
        }

        .form-select{
            border-radius:10px;
            border:1px solid #dbe3ef;
            padding:7px 12px;
            font-size:12px;
            width:150px;
        }

        /* BUTTON TAMBAH KELAS */
        .btn-tambah {
            background: linear-gradient(135deg, #1f8aa5, #29b2d1);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(41, 178, 209, 0.2);
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(41, 178, 209, 0.3);
            color: white;
        }

        /* TABLE */
        thead{
            background:#f8fafc;
        }

        th{
            color:#94a3b8 !important;
            font-size:11px;
            font-weight:700;
            padding:14px 20px !important;
            border:none !important;
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

        .class-info{
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

        .badge-level{
            background:#eef2ff;
            color:#4f46e5;
            padding:6px 12px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .badge-active{
            background:#dcfce7;
            color:#16a34a;
            padding:6px 12px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .badge-nonactive{
            background:#fee2e2;
            color:#dc2626;
            padding:6px 12px;
            border-radius:20px;
            font-size:11px;
            font-weight:700;
        }

        .action-btn{
            width:28px;
            height:28px;
            border:none;
            border-radius:8px;
            background:#f1f5f9;
            font-size:11px;
            margin:0 2px;
        }

        .action-btn:hover{
            background:#dbeafe;
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
        <a href="#" class="menu active">Kelola Kelas</a>
        <a href="#" class="menu">Data Transaksi</a>
        <a href="#" class="logout">Logout</a>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="breadcrumb-custom">Pages / <span>Kelola Kelas</span></div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="profile-name">MELINA DETIANA</div>
                    <div class="profile-status">Online</div>
                </div>
                <div class="profile-avatar">M</div>
            </div>
        </div>

        {{-- STATISTIC SECTION --}}
        <div class="stats-grid">
            <div class="stats-card">
                <div class="stats-content">
                    <div class="stats-title">Total Kelas</div>
                    <div class="stats-value">12</div>
                    <div class="stats-sub sub-up">
                        <span>↑</span> +2 bulan ini
                    </div>
                </div>
                <div class="stats-icon-wrapper icon-blue">🏫</div>
            </div>

            <div class="stats-card">
                <div class="stats-content">
                    <div class="stats-title">Total Siswa</div>
                    <div class="stats-value">356</div>
                    <div class="stats-sub sub-neutral">
                        👤 Data Siswa Aktif
                    </div>
                </div>
                <div class="stats-icon-wrapper icon-purple">🎓</div>
            </div>

            <div class="stats-card">
                <div class="stats-content">
                    <div class="stats-title">Wali Kelas</div>
                    <div class="stats-value">12</div>
                    <div class="stats-sub sub-neutral">
                        ✅ Terdaftar Lengkap
                    </div>
                </div>
                <div class="stats-icon-wrapper icon-orange">👨‍🏫</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="card-table">
            <div class="card-header-custom">
                <div class="card-title">Data List Kelas</div>
                <div class="filter-box">
                    {{-- TOMBOL TAMBAH --}}
                    <a href="#" class="btn-tambah me-2">
                        <span>+</span> Tambah Kelas
                    </a>
                    
                    <div class="filter-text">FILTER</div>
                    <select class="form-select">
                        <option>Semua Tingkat</option>
                        <option>X</option>
                        <option>XI</option>
                        <option>XII</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA KELAS</th>
                            <th>TINGKAT</th>
                            <th>WALI KELAS</th>
                            <th>JUMLAH SISWA</th>
                            <th>STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>
                                <div class="class-info">
                                    <div class="avatar">X</div>
                                    X RPL 1
                                </div>
                            </td>
                            <td><span class="badge-level">X</span></td>
                            <td>Ibu Siti</td>
                            <td>32 Siswa</td>
                            <td><span class="badge-active">Aktif</span></td>
                            <td class="text-center">
                                <button class="action-btn">✏️</button>
                                <button class="action-btn">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>
                                <div class="class-info">
                                    <div class="avatar">XI</div>
                                    XI TKJ 2
                                </div>
                            </td>
                            <td><span class="badge-level">XI</span></td>
                            <td>Bapak Andi</td>
                            <td>30 Siswa</td>
                            <td><span class="badge-active">Aktif</span></td>
                            <td class="text-center">
                                <button class="action-btn">✏️</button>
                                <button class="action-btn">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#3</td>
                            <td>
                                <div class="class-info">
                                    <div class="avatar">XII</div>
                                    XII AKL 1
                                </div>
                            </td>
                            <td><span class="badge-level">XII</span></td>
                            <td>Ibu Rina</td>
                            <td>28 Siswa</td>
                            <td><span class="badge-nonactive">Nonaktif</span></td>
                            <td class="text-center">
                                <button class="action-btn">✏️</button>
                                <button class="action-btn">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>