<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tagihan - KASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:linear-gradient(135deg,#f1f5f9 0%,#e2e8f0 100%);
            overflow:hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar{
            display:none;
        }

        .sidebar-item{
            transition:.2s ease;
        }

        .sidebar-item:hover{
            background:rgba(255,255,255,.05);
            transform:translateX(3px);
        }

        .input{
            width:100%;
            height:52px;
            border-radius:18px;
            border:1px solid #e2e8f0;
            background:#f8fafc;
            padding:0 18px;
            font-size:14px;
            outline:none;
            transition:.2s;
        }

        .input:focus{
            border-color:#14b8a6;
            background:white;
        }

        .textarea{
            width:100%;
            border-radius:18px;
            border:1px solid #e2e8f0;
            background:#f8fafc;
            padding:16px 18px;
            font-size:14px;
            outline:none;
            transition:.2s;
            resize:none;
        }

        .textarea:focus{
            border-color:#14b8a6;
            background:white;
        }

        .btn-primary{
            background:linear-gradient(to right,#2dd4bf,#10b981);
            transition:.2s ease;
        }

        .btn-primary:hover{
            transform:scale(1.02);
        }

        .form-wrapper{
            background:rgba(255,255,255,.96);
            border:1px solid rgba(226,232,240,.8);
            border-radius:28px;
        }
    </style>
</head>

<body>

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-[250px] bg-gradient-to-b from-slate-950 to-slate-900 text-white fixed h-screen flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="px-6 py-7 border-b border-white/10">

                <h1 class="text-[27px] font-extrabold tracking-wide">
                    KASKU
                </h1>

                <p class="text-[10px] text-slate-400 uppercase tracking-[3px] mt-2">
                    Management System
                </p>

            </div>

            <!-- MENU -->
            <div class="px-4 mt-6 space-y-2">

                <a href="{{ route('bendahara.dashboard') }}"
                   class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300">

                    <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                    <span class="text-[14px] font-medium">Dashboard</span>

                </a>

                <a href="{{ route('bendahara.kas_masuk') }}"
                   class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300">

                    <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                    <span class="text-[14px] font-medium">Kas Masuk</span>

                </a>

                <a href="{{ route('bendahara.kas_keluar') }}"
                   class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300">

                    <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                    <span class="text-[14px] font-medium">Kas Keluar</span>

                </a>

                <a href="{{ route('bendahara.transaksi') }}"
                   class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300">

                    <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                    <span class="text-[14px] font-medium">Transaksi</span>

                </a>

                <a href="{{ route('bendahara.tagihan') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 border-l-4 border-emerald-400 text-white font-semibold">

                    <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>

                    <span class="text-[14px]">
                        Tagihan
                    </span>

                </a>

                <a href="{{ route('bendahara.laporan') }}"
                   class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300">

                    <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                    <span class="text-[14px] font-medium">Laporan</span>

                </a>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="p-4 border-t border-white/10">

            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/5 transition">

                <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>

                <span class="text-[14px] font-medium">Pengaturan</span>

            </button>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="ml-[250px] flex-1 overflow-y-auto">

        <!-- NAVBAR -->
        <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-20">

            <div>

                <p class="text-[12px] text-slate-400 font-medium">
                    Pages / Tambah Tagihan
                </p>

                <h1 class="text-[21px] font-bold text-slate-800 mt-1">
                    Tambah Tagihan
                </h1>

            </div>

            <div class="flex items-center gap-4">

                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                    <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                </button>

                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <h1 class="text-[13px] font-bold text-slate-800">
                            Melina Detiana
                        </h1>

                        <p class="text-[11px] text-slate-400">
                            Bendahara
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">
                        M
                    </div>

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-8">

            <div class="max-w-4xl mx-auto">

                <div class="mb-7">

                    <h1 class="text-[34px] font-bold text-slate-900">
                        Buat Tagihan Baru
                    </h1>

                    <p class="text-slate-500 text-sm mt-2">
                        Tambahkan tagihan pembayaran baru untuk seluruh siswa kelas.
                    </p>

                </div>

                <!-- FORM -->
                <div class="form-wrapper p-8">

                 <form action="{{ route('bendahara.tagihan.store') }}" method="POST" class="space-y-6">

                        @csrf

                        <div class="grid grid-cols-2 gap-5">

                            <div>

                                <label class="text-sm font-semibold text-slate-700 block mb-2">
                                    Nama Tagihan
                                </label>

                                <input type="text"
                                       name="nama_tagihan"
                                       class="input"
                                       placeholder="Contoh: Kas Mingguan"
                                       required>

                            </div>

                            <div>

                                <label class="text-sm font-semibold text-slate-700 block mb-2">
                                    Periode
                                </label>

                                <input type="date"
                                       name="periode"
                                       class="input"
                                       placeholder="Contoh: Mei 2026"
                                       required>

                            </div>

                            <div>

                                <label class="text-sm font-semibold text-slate-700 block mb-2">
                                    Nominal
                                </label>

                                <input type="number"
                                       name="nominal"
                                       class="input"
                                       placeholder="50000"
                                       required>

                            </div>

                            <div>

                                <label class="text-sm font-semibold text-slate-700 block mb-2">
                                    Deadline
                                </label>

                                <input type="date"
                                       name="batas_bayar"
                                       class="input"
                                       required>

                            </div>

                        </div>

                        <div class="flex items-center justify-between pt-3">

                            <a href="{{ route('bendahara.tagihan') }}"
                               class="h-12 px-5 rounded-2xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 flex items-center gap-2 hover:bg-slate-50 transition">

                                <iconify-icon icon="solar:arrow-left-linear" class="text-[18px]"></iconify-icon>

                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn-primary h-12 px-6 rounded-2xl text-slate-900 font-semibold flex items-center gap-2">

                                <iconify-icon icon="solar:add-circle-bold" class="text-[20px]"></iconify-icon>

                                Simpan Tagihan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>