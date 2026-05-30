{{-- resources/views/admin/data-transaksi.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');

        *{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display{
            font-family: 'Outfit', sans-serif;
        }

        :root{
            --primary:#1B6578;
            --primary-light:#2a8fa3;
        }

        body{
            background: #F4F7FE;
        }

        .sidebar-item{
            position:relative;
            transition:0.2s;
        }

        /* Indikator Garis Aktif di Kiri Menu */
        .sidebar-item::before{
            content:'';
            position:absolute;
            left:0;
            top:50%;
            transform:translateY(-50%);
            width:4px;
            height:0;
            background: #23CCD8;
            border-radius:0 4px 4px 0;
            transition:0.3s;
        }

        .sidebar-item.active::before{
            height:24px;
        }

        .card-hover{
            transition:0.3s;
        }

        .card-hover:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 24px rgba(27,101,120,0.05);
        }

        .dropdown-menu{
            display:none;
            position:absolute;
            top:100%;
            right:0;
            background:white;
            border:1px solid #e2e8f0;
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            min-width:180px;
            margin-top:10px;
            z-index:50;
        }

        .dropdown-menu.active{
            display:block;
        }

        .dropdown-item{
            display:block;
            width:100%;
            padding:12px 16px;
            text-decoration:none;
            color:#475569;
            transition:0.2s;
        }

        .dropdown-item:hover{
            background:#f8fafc;
            color:#1B6578;
        }

        .chart-container{
            position:relative;
            height:320px;
        }

        tbody tr:hover{
            background:rgba(27,101,120,0.02);
        }
    </style>
</head>

<body>

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <div class="w-64 bg-[#0F172A] text-slate-400 flex flex-col h-full sticky top-0 shadow-xl z-50 shrink-0">

        {{-- LOGO BRAND KASKU --}}
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#1B6578] flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>

            <div>
                <h1 class="text-white font-display font-bold text-base tracking-wider">KASKU</h1>
                <p class="text-[11px] text-slate-500 font-medium">Online</p>
            </div>
        </div>

        {{-- MENU UTAMA DENGAN ROUTE LINK OTOMATIS --}}
        <nav class="flex-1 px-4 py-4 space-y-1">

            {{-- Dashboard Menu --}}
            <a href="{{ route('dashboard.admin') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('dashboard.admin') ? 'active bg-slate-800/60 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/40 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            {{-- Kelola Kelas Menu (Aktif jika berada di halaman list, create, atau edit kelas) --}}
            <a href="{{ route('kelas') }}"
               class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl transition-all
               {{ request()->routeIs('kelas*') ? 'active bg-slate-800/60 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/40 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 114 0v2m-4 0h4m-4 0H5m12 0h3M12 7h1" />
                </svg>
                <span class="text-sm">Kelola Kelas</span>
            </a>

            {{-- Data Transaksi Menu (Saat ini diasumsikan menggunakan route dashboard atau pasif sementara) --}}
            <a href="#"
               class="sidebar-item active flex items-center gap-3 py-3 px-4 rounded-xl bg-slate-800/60 text-white font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm">Data Transaksi</span>
            </a>

        </nav>

        {{-- LOGOUT BUTTON --}}
        <div class="p-4">
            <button class="w-full flex items-center gap-2 px-4 py-3 text-sm font-medium text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </div>

    </div>

    
    {{-- KONTEN UTAMA --}}
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">

        {{-- NAVBAR ATAS --}}
        <header class="h-20 flex items-center justify-between px-8 bg-[#F4F7FE]/90 backdrop-blur-md sticky top-0 z-40 shrink-0">

            <div class="flex flex-col">
                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                    <span>Pages</span>
                    <span class="text-slate-400">/</span>
                    <span class="text-slate-800 font-normal">Dashboard Admin</span>
                </div>
                <h2 class="text-slate-800 font-bold font-display text-lg mt-0.5">Data Transaksi</h2>
            </div>

            {{-- PROFILE AREA --}}
            <div class="relative">
                <button id="profileBtn" class="flex items-center gap-3 hover:bg-slate-200/50 p-1.5 rounded-xl transition-all">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-700 tracking-wide uppercase">
                            MELINA DETIANA
                        </p>
                        <p class="text-[11px] text-emerald-500 font-semibold text-right">
                            Admin
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-[#1B6578] flex items-center justify-center text-white font-bold text-sm shadow-md">
                        M
                    </div>
                </button>

                <div id="dropdownMenu" class="dropdown-menu">
                    <a href="#" class="dropdown-item font-medium">Profil</a>
                    <a href="#" class="dropdown-item font-medium">Pengaturan</a>
                    <hr class="border-slate-100">
                    <a href="#" class="dropdown-item font-medium text-red-500">Logout</a>
                </div>
            </div>

        </header>

        {{-- AREA SCROLL KONTEN --}}
        <main class="flex-1 p-8 pt-2 overflow-y-auto">
            <div class="max-w-7xl mx-auto space-y-6 pb-8">

                {{-- GRAFIK KEUANGAN --}}
                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-slate-100">
                    <h3 class="text-base font-bold text-slate-800 mb-6">
                        Grafik Keuangan Bulan Ini
                    </h3>
                    <div class="chart-container">
                        <canvas id="financialChart"></canvas>
                    </div>
                </div>

                {{-- CARD INFORMASI SALDO --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Total Masuk --}}
                    <div class="card-hover bg-white p-6 rounded-[24px] shadow-sm flex justify-between items-center relative overflow-hidden">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">TOTAL MASUK</p>
                            <h3 class="text-2xl font-extrabold text-slate-800">Rp 2.450.000</h3>
                            <span class="text-[10px] text-emerald-500 font-bold bg-emerald-50 px-2 py-0.5 rounded mt-2 inline-block">PEMASUKAN</span>
                        </div>
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center text-lg font-bold">+</div>
                    </div>

                    {{-- Total Keluar --}}
                    <div class="card-hover bg-white p-6 rounded-[24px] shadow-sm flex justify-between items-center relative overflow-hidden">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">TOTAL KELUAR</p>
                            <h3 class="text-2xl font-extrabold text-slate-800">Rp 850.000</h3>
                            <span class="text-[10px] text-red-500 font-bold bg-red-50 px-2 py-0.5 rounded mt-2 inline-block">PENGELUARAN</span>
                        </div>
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-lg font-bold">−</div>
                    </div>

                    {{-- Saldo --}}
                    <div class="card-hover bg-white p-6 rounded-[24px] shadow-sm border-2 border-blue-500/10 flex justify-between items-center relative overflow-hidden">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">SALDO TOTAL</p>
                            <h3 class="text-2xl font-extrabold text-slate-800">Rp 1.600.000</h3>
                            <span class="text-[10px] text-blue-500 font-bold bg-blue-50 px-2 py-0.5 rounded mt-2 inline-block">SALDO SEHAT</span>
                        </div>
                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-sm">💵</div>
                    </div>

                </div>

                {{-- TABEL TRANSAKSI --}}
                <div class="bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Riwayat Transaksi</h3>
                            <p class="text-xs text-slate-400">Semua transaksi terbaru sistem kas sekolah</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50/70 border-b border-slate-100 text-slate-500 font-bold text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">No</th> <th class="px-6 py-4">Transaksi</th>
                                <th class="px-6 py-4">Tanggal</th> <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Kategori</th> <th class="px-6 py-4">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium"> {{-- TRANSAKSI MASUK --}} <tr>
                                <td class="px-6 py-4 text-slate-400">1</td> <td class="px-6 py-4">
                                    <div> <p class="text-slate-900 font-semibold"> Bayar Kas Kelas XII </p> <p class="text-xs text-slate-400 mt-1"> Pembayaran kas bulanan siswa </p>
                                    </div> </td>
                                    <td class="px-6 py-4 text-slate-500"> 22 Mei 2026 </td> <td class="px-6 py-4"> <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[11px] font-bold"> Uang Masuk </span> </td>
                                    <td class="px-6 py-4"> <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-bold"> Kas </span> </td>
                                    <td class="px-6 py-4 text-emerald-600 font-bold"> + Rp 50.000 </td> </tr> {{-- TRANSAKSI KELUAR --}} <tr> <td class="px-6 py-4 text-slate-400">2</td>
                                        <td class="px-6 py-4"> <div> <p class="text-slate-900 font-semibold"> Pembelian Sapu Kelas </p> <p class="text-xs text-slate-400 mt-1"> Pengeluaran alat kebersihan kelas </p> </div> </td> <td class="px-6 py-4 text-slate-500"> 23 Mei 2026 </td> <td class="px-6 py-4"> <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[11px] font-bold"> Uang Keluar </span> </td> <td class="px-6 py-4"> <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-full text-[11px] font-bold"> Pengeluaran </span> </td> <td class="px-6 py-4 text-red-500 font-bold"> - Rp 20.000 </td> </tr>
                                                        </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </main>

                                        </div>
                                    </div>

<script>
// Logic Dropdown Profile
const profileBtn = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');

profileBtn.addEventListener('click', function(e){
    e.stopPropagation();
    dropdownMenu.classList.toggle('active');
});

document.addEventListener('click', function(){
    dropdownMenu.classList.remove('active');
});

// Render Chart.js
window.addEventListener('load', () => {
    const ctx = document.getElementById('financialChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [
                {
                    label: 'Pemasukan',
                    data: [12,16,11,17,13,17,16,18,17,17,18,19],
                    backgroundColor: '#10B981',
                    borderRadius: 6,
                    barThickness: 14
                },
                {
                    label: 'Pengeluaran',
                    data: [5,6,4,7,6,7,6,6,7,7,7,8],
                    backgroundColor: '#EF4444',
                    borderRadius: 6,
                    barThickness: 14
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
                        boxWidth: 12,
                        font: { size: 12, weight: '500' }
                    }
                }
            },
            scales: {
                y: {
                    grid: { color: '#F1F5F9' },
                    ticks: {
                        callback: function(value) { return 'Rp ' + value + 'M'; },
                        font: { size: 10 }
                    }
                },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>

</body>
</html>
