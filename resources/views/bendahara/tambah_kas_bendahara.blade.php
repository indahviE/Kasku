<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kas Masuk - KASKU Online</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar{
            display:none;
        }

        /* Warna Navy Sangat Gelap Sesuai Foto */
        .sidebar {
            background: #0a0f1d; 
            overflow: hidden;
        }

        .sidebar-item {
            transition: all .25s ease;
            color: #64748b; 
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item:hover {
            background: rgba(255,255,255,.02);
            transform: translateX(4px);
            color: #94a3b8;
        }

        .sidebar-active {
            background: rgba(255, 255, 255, 0.05); 
            color: #ffffff; 
            font-weight: 500;
            position: relative;
        }

        /* Garis Indikator Hijau Toska di Samping Kiri Menu Aktif */
        .sidebar-active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 4px;
            background-color: #2dd4bf; 
            border-radius: 0 4px 4px 0;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all .25s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.9) 100%);
            backdrop-filter: blur(10px);
        }

        /* Efek Focus Border Lembut Berwarna Toska */
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.15), 0 0 0 1px #2dd4bf;
            border-color: #2dd4bf;
        }

        .btn-teal {
            background: linear-gradient(135deg, #2dd4bf 0%, #0d9488 100%);
            transition: all 0.3s ease;
        }

        .btn-teal:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(45, 212, 191, 0.25);
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .pulse-icon {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body>

<div class="flex h-screen overflow-hidden">

    <aside class="sidebar w-[250px] fixed h-screen text-white flex flex-col justify-between">
        <div>
            <div class="px-6 py-6 flex items-center gap-4 border-b border-white/5">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-500/20">
                    <iconify-icon icon="solar:wallet-bold"></iconify-icon>
                </div>
                <div>
                    <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">KASKU</h1>
                    <p class="text-[11px] text-slate-500 font-medium mt-1 flex items-center gap-1">Online</p>
                </div>
            </div>

            <div class="px-4 mt-6">
                <nav class="space-y-1">
                    <a href="#" class="sidebar-item">
                        <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="sidebar-item sidebar-active">
                        <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Masuk</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Keluar</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                        <span>Transaksi</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <iconify-icon icon="solar:document-bold" class="text-[18px]"></iconify-icon>
                        <span>Laporan</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-white/5">
            <a href="#" class="sidebar-item">
                <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                <span>Pengaturan</span>
            </a>
        </div>
    </aside>

    <div class="ml-[250px] flex-1 overflow-y-auto h-screen">

        <div class="h-[70px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <div>
                <p class="text-[12px] text-slate-400 font-medium">Pages / Kas Masuk / Tambah</p>
                <h1 class="text-[20px] font-bold text-slate-800 mt-1">Form Tambah Kas Masuk</h1>
            </div>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                    <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 pulse-icon"></div>
                </button>

                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3">
                        <div class="text-right">
                            <h1 class="text-[13px] font-bold text-slate-800">Melina Detiana</h1>
                            <p class="text-[11px] text-slate-400">Bendahara</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">M</div>
                        <iconify-icon icon="solar:alt-arrow-down-linear" class="text-[16px] text-slate-500"></iconify-icon>
                    </button>

                    <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                        <a href="#" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:user-linear"></iconify-icon>Profile
                        </a>
                        <a href="#" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:settings-linear"></iconify-icon>Pengaturan
                        </a>
                        <button class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                            <iconify-icon icon="solar:logout-2-linear"></iconify-icon>Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 max-w-4xl mx-auto fade-in">

            <div class="mb-6">
                <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm">
                    <iconify-icon icon="solar:alt-arrow-left-linear" class="text-[16px]"></iconify-icon>
                    Kembali ke Riwayat
                </a>
            </div>

            <div class="mb-8">
                <h1 class="text-[32px] font-bold text-slate-900 tracking-tight">Tambah Kas Masuk</h1>
                <p class="text-slate-500 text-sm mt-2">Masukkan detail informasi penerimaan dana kas kelas secara transparan.</p>
            </div>

            <div class="card-gradient rounded-3xl border border-slate-200/60 shadow-md p-8 bg-white/90">
                <form action="#" method="POST" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 flex items-center gap-2">
                                <iconify-icon icon="solar:user-bold" class="text-slate-400 text-[18px]"></iconify-icon>
                                Anggota / Pembayar
                            </label>
                            <div class="relative">
                                <select class="input-focus w-full h-12 rounded-xl border border-slate-200 bg-white px-4 outline-none appearance-none text-slate-700 text-sm transition">
                                    <option value="" disabled selected>Pilih nama anggota...</option>
                                    <option value="1">Andi Saputra (XI RPL 1)</option>
                                    <option value="2">Siti Nurhaliza (XI RPL 1)</option>
                                    <option value="3">Rini Handayani (XI RPL 2)</option>
                                    <option value="4">Bambang Sutrisno (XI RPL 2)</option>
                                </select>
                                <iconify-icon icon="solar:alt-arrow-down-linear" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></iconify-icon>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 flex items-center gap-2">
                                <iconify-icon icon="solar:calendar-date-bold" class="text-slate-400 text-[18px]"></iconify-icon>
                                Tanggal Masuk
                            </label>
                            <input type="date" class="input-focus w-full h-12 rounded-xl border border-slate-200 px-4 outline-none text-slate-700 text-sm transition" value="2026-05-22">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 flex items-center gap-2">
                                <iconify-icon icon="solar:card-transfer-bold" class="text-slate-400 text-[18px]"></iconify-icon>
                                Nominal Pembayaran
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">Rp</div>
                                <input type="number" placeholder="Contoh: 50000" class="input-focus w-full h-12 rounded-xl border border-slate-200 pl-11 pr-4 outline-none text-slate-700 text-sm font-semibold transition">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 flex items-center gap-2">
                                <iconify-icon icon="solar:tag-horizontal-bold" class="text-slate-400 text-[18px]"></iconify-icon>
                                Kategori Kas
                            </label>
                            <div class="relative">
                                <select class="input-focus w-full h-12 rounded-xl border border-slate-200 bg-white px-4 outline-none appearance-none text-slate-700 text-sm transition">
                                    <option value="mingguan">Kas Mingguan Wajib</option>
                                    <option value="bulanan">Kas Bulanan</option>
                                    <option value="sosial">Iuran Dana Sosial</option>
                                    <option value="lainnya">Lain-lain</option>
                                </select>
                                <iconify-icon icon="solar:alt-arrow-down-linear" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></iconify-icon>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 flex items-center gap-2">
                            <iconify-icon icon="solar:notes-bold" class="text-slate-400 text-[18px]"></iconify-icon>
                            Keterangan / Catatan
                        </label>
                        <textarea rows="4" placeholder="Tulis rincian catatan atau informasi tambahan di sini..." class="input-focus w-full rounded-xl border border-slate-200 p-4 outline-none text-slate-700 text-sm transition resize-none"></textarea>
                    </div>

                    <div class="border-t border-slate-100 pt-4"></div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" class="h-12 px-6 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 hover:border-slate-300 transition text-sm">
                            Batal
                        </button>
                        <button type="submit" class="btn-teal h-12 px-8 rounded-xl text-white font-bold shadow-md flex items-center gap-2 text-sm">
                            <iconify-icon icon="solar:diskette-bold" class="text-[18px]"></iconify-icon>
                            Simpan Transaksi
                        </button>
                    </div>

                </form>
            </div>

            <div class="mt-6 p-4 rounded-2xl bg-teal-50 border border-teal-100 flex items-start gap-3">
                <iconify-icon icon="solar:info-circle-bold" class="text-teal-600 text-[20px] mt-0.5 flex-shrink-0"></iconify-icon>
                <p class="text-xs text-teal-800 leading-relaxed">
                    <strong>Informasi otomatis:</strong> Setiap data kas masuk yang disimpan secara valid akan langsung mengakumulasi total saldo utama dan memperbarui diagram pelaporan di halaman Dashboard secara real-time.
                </p>
            </div>

        </div>
    </div>

</div>

<script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('show');
    }

    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        if (!e.target.closest('.relative')) {
            dropdown.classList.remove('show');
        }
    });
</script>

</body>
</html>