<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Data Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9; 
        }

        .sidebar {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            transition: all 0.3s ease;
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item.active {
            background-color: rgba(45, 212, 191, 0.15); 
            border-left: 4px solid #2dd4bf;
            padding-left: calc(1.5rem - 4px);
            color: #2dd4bf;
        }

        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            padding-left: 1.75rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px; 
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f1f5f9;
        }

        .stat-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .stat-icon.balance-kas { background-color: #f0fdf4; color: #16a34a; }
        .stat-icon.income { background-color: #ecfdf5; color: #059669; }
        .stat-icon.expense { background-color: #fff1f2; color: #e11d48; }
        .stat-icon.transaction { background-color: #f5f3ff; color: #4f46e5; }

        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            margin-top: 8px;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #475569;
        }

        .dropdown-item:hover {
            background-color: #f8fafc;
            color: #0f172a;
        }

        .dropdown-item.logout {
            color: #ef4444;
            border-top: 1px solid #f1f5f9;
        }

        .dropdown-item.logout:hover {
            background-color: #fef2f2;
        }

        .chart-container {
            position: relative;
            height: 320px;
            margin-bottom: 10px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card { animation: slideIn 0.4s ease forwards; }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }
        .content-card { animation: slideIn 0.5s ease forwards 0.25s both; }
    </style>
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <div class="sidebar w-64 h-screen fixed left-0 top-0 text-white overflow-y-auto z-10">
            <div class="p-6 border-b border-white border-opacity-5">
                <div>
                    <h1 class="font-bold text-base tracking-widest text-white">KASKU <span class="font-light text-teal-400">ONLINE</span></h1>
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mt-0.5">Management System</p>
                </div>
            </div>

            <nav class="p-4">
                <div class="space-y-1.5">
                    <div class="sidebar-item active px-4 py-3 rounded-xl cursor-pointer">
                        <span class="flex items-center gap-3 font-medium text-sm">
                            <iconify-icon icon="lucide:layout-dashboard" width="18"></iconify-icon>
                            Dashboard
                        </span>
                    </div>

                    <div class="sidebar-item px-4 py-3 rounded-xl cursor-pointer text-slate-400 hover:text-white">
                        <span class="flex items-center gap-3 font-medium text-sm">
                            <iconify-icon icon="lucide:users" width="18"></iconify-icon>
                            Kelola User
                        </span>
                    </div>

                    <div class="sidebar-item px-4 py-3 rounded-xl cursor-pointer text-slate-400 hover:text-white">
                        <span class="flex items-center gap-3 font-medium text-sm">
                            <iconify-icon icon="lucide:graduation-cap" width="18"></iconify-icon>
                            Kelola Kelas
                        </span>
                    </div>

                    <div class="sidebar-item px-4 py-3 rounded-xl cursor-pointer text-slate-400 hover:text-white">
                        <span class="flex items-center gap-3 font-medium text-sm">
                            <iconify-icon icon="lucide:arrow-left-right" width="18"></iconify-icon>
                            Data Transaksi
                        </span>
                    </div>
                </div>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white border-opacity-5 text-center">
                <p class="text-[11px] text-slate-500 font-medium">© 2026 Admin Panel</p>
            </div>
        </div>

        <div class="ml-64 w-full flex flex-col h-screen overflow-y-auto">
            <nav class="navbar h-24 px-10 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-md z-20">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-semibold text-slate-800 tracking-tight">Data Transaksi</h2>
                </div>

                <div class="profile-dropdown">
                    <button class="flex items-center gap-4 cursor-pointer focus:outline-none" onclick="toggleDropdown()">
                        <div class="text-right">
                            <p class="text-slate-800 font-semibold text-xs tracking-wide uppercase" id="profileName">MELINA DETIANA</p>
                            <p class="text-emerald-500 font-semibold text-[10px] flex items-center justify-end gap-1 mt-0.5">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block animate-pulse"></span> Online
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-tr from-teal-400 to-emerald-400 rounded-full flex items-center justify-center font-semibold text-slate-900 text-sm shadow-md shadow-teal-500/10" id="profileInitial">M</div>
                        <iconify-icon icon="lucide:chevron-down" width="16" class="text-slate-400"></iconify-icon>
                    </button>

                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="dropdown-item">
                            <iconify-icon icon="lucide:user" width="16"></iconify-icon>
                            <span class="text-sm font-medium">Profil Saya</span>
                        </div>
                        <div class="dropdown-item">
                            <iconify-icon icon="lucide:settings" width="16"></iconify-icon>
                            <span class="text-sm font-medium">Pengaturan</span>
                        </div>
                        <div class="dropdown-item logout" onclick="handleLogout()">
                            <iconify-icon icon="lucide:log-out" width="16"></iconify-icon>
                            <span class="text-sm font-medium">Logout</span>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex-1 p-8 max-w-[1600px] w-full mx-auto">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight mb-1">Selamat datang, Bendahara</h1>
                    <p class="text-sm text-slate-500 font-medium">Berikut ringkasan manajemen keuangan bulan ini secara real-time.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card">
                        <div class="flex items-center gap-4">
                            <div class="stat-icon balance-kas shadow-sm">
                                <iconify-icon icon="lucide:wallet" width="22"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs font-semibold tracking-wider uppercase mb-0.5">Saldo Kas</p>
                                <p class="text-xl font-bold text-slate-800 tracking-tight">Rp 2.500.000</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center gap-4">
                            <div class="stat-icon income shadow-sm">
                                <iconify-icon icon="lucide:arrow-down-left" width="22"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs font-semibold tracking-wider uppercase mb-0.5">Total Kas Masuk</p>
                                <p class="text-xl font-bold text-emerald-600 tracking-tight">Rp 2.000.000</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center gap-4">
                            <div class="stat-icon expense shadow-sm">
                                <iconify-icon icon="lucide:arrow-up-right" width="22"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs font-semibold tracking-wider uppercase mb-0.5">Total Kas Keluar</p>
                                <p class="text-xl font-bold text-rose-600 tracking-tight">Rp 500.000</p>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center gap-4">
                            <div class="stat-icon transaction shadow-sm">
                                <iconify-icon icon="lucide:activity" width="22"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs font-semibold tracking-wider uppercase mb-0.5">Jumlah Transaksi</p>
                                <p class="text-xl font-bold text-indigo-600 tracking-tight">29</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 content-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold text-slate-800 tracking-tight">Grafik Arus Kas</h3>
                            <span class="text-[11px] font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full uppercase tracking-wider">7 Hari Terakhir</span>
                        </div>
                        <div class="chart-container">
                            <canvas id="cashFlowChart"></canvas>
                        </div>
                    </div>

                    <div class="content-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-slate-800 tracking-tight mb-5">Ringkasan Bulan Ini</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-1">
                                    <p class="text-slate-500 text-sm font-medium">Saldo Awal</p>
                                    <p class="text-base font-bold text-slate-800">Rp 1.000.000</p>
                                </div>
                                <div class="flex justify-between items-center py-1">
                                    <p class="text-slate-500 text-sm font-medium">Total Kas Masuk</p>
                                    <p class="text-base font-bold text-emerald-600">Rp 5.000.000</p>
                                </div>
                                <div class="flex justify-between items-center py-1">
                                    <p class="text-slate-500 text-sm font-medium">Total Kas Keluar</p>
                                    <p class="text-base font-bold text-rose-600">Rp 2.500.000</p>
                                </div>
                                <div class="border-t border-dashed border-slate-200 my-2"></div>
                                <div class="flex justify-between items-center py-1">
                                    <p class="text-slate-900 text-sm font-bold">Saldo Akhir</p>
                                    <p class="text-lg font-bold text-slate-900">Rp 3.500.000</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-6 px-4 py-3 bg-slate-900 text-white hover:bg-slate-800 rounded-xl font-semibold text-sm transition-all duration-200 shadow-md shadow-slate-900/10">
                            Lihat Laporan Keuangan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const currentUser = {
            name: document.getElementById('profileName').textContent,
            initial: document.getElementById('profileInitial').textContent
        };

        (function setupDropdown() {
            window.toggleDropdown = function() {
                document.getElementById('dropdownMenu').classList.toggle('active');
            };

            document.addEventListener('click', function(event) {
                const profileDropdown = document.querySelector('.profile-dropdown');
                if (profileDropdown && !profileDropdown.contains(event.target)) {
                    document.getElementById('dropdownMenu').classList.remove('active');
                }
            });
        })();

        function handleLogout() {
            alert('Anda telah logout. Sampai jumpa!');
        }

        const ctx = document.getElementById('cashFlowChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['17 Mei', '18 Mei', '19 Mei', '20 Mei', '21 Mei', '22 Mei', '23 Mei'],
                datasets: [
                    {
                        label: 'Kas Masuk',
                        data: [500000, 750000, 750000, 1250000, 1000000, 900000, 1100000],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.01)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'Kas Keluar',
                        data: [250000, 400000, 250000, 850000, 250000, 200000, 350000],
                        borderColor: '#f43f5e',
                        backgroundColor: 'rgba(244, 63, 94, 0.01)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#f43f5e',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>