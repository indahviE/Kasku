@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#ECEFF4] font-['Inter']">

    <!-- CONTENT -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <div class="w-full h-[72px] bg-white border-b border-gray-200 px-7 flex items-center justify-between shadow-sm">

            <!-- LEFT -->
            <div>
                <h1 class="text-[22px] font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-sm text-gray-400">
                    Welcome back
                </p>
            </div>



            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- NOTIF -->
                <button class="w-11 h-11 rounded-full bg-[#F5F7FA] flex items-center justify-center hover:bg-gray-100 transition">

                    <iconify-icon
                        icon="solar:bell-bold"
                        class="text-[22px] text-gray-700">
                    </iconify-icon>

                </button>



                <!-- DROPDOWN -->
                <div x-data="{ open: false }" class="relative">

                    <!-- BUTTON -->
                    <button
                        @click="open = !open"
                        class="flex items-center gap-3 hover:bg-gray-50 px-2 py-1 rounded-xl transition">

                        <!-- PHOTO -->
                        <div class="w-11 h-11 rounded-full bg-[#0F5D73]"></div>

                        <!-- USER -->
                        <div class="text-left">
                            <h1 class="text-[15px] font-bold text-gray-800 leading-none">
                                Bendahara
                            </h1>

                            <p class="text-[13px] text-gray-400 mt-1">
                                Admin Kas
                            </p>
                        </div>

                        <!-- ICON -->
                        <iconify-icon
                            icon="solar:alt-arrow-down-linear"
                            class="text-[18px] text-gray-500">
                        </iconify-icon>

                    </button>



                    <!-- MENU -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 top-16 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">

                        <!-- PROFILE -->
                        <a href="#"
                            class="flex items-center gap-3 px-5 py-4 text-sm text-gray-700 hover:bg-gray-50 transition">

                            <iconify-icon
                                icon="solar:user-linear"
                                class="text-[18px]">
                            </iconify-icon>

                            Profile
                        </a>



                        <!-- SETTINGS -->
                        <a href="#"
                            class="flex items-center gap-3 px-5 py-4 text-sm text-gray-700 hover:bg-gray-50 transition">

                            <iconify-icon
                                icon="solar:settings-linear"
                                class="text-[18px]">
                            </iconify-icon>

                            Settings
                        </a>



                        <!-- LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="w-full flex items-center gap-3 px-5 py-4 text-sm text-red-500 hover:bg-red-50 transition">

                                <iconify-icon
                                    icon="solar:logout-2-linear"
                                    class="text-[18px]">
                                </iconify-icon>

                                Logout
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>



        <!-- ISI -->
        <div class="px-7 py-6">

            <!-- HEADER -->
            <div>

                <h1 class="text-[32px] font-bold text-[#111827] tracking-tight">
                    Selamat datang, Bendahara
                </h1>

                <p class="text-gray-500 text-[15px] font-medium mt-2">
                    Berikut ringkasan keuangan kelas bulan ini.
                </p>
            </div>



            <!-- CARD -->
            <div class="grid grid-cols-4 gap-6 mt-8">

                <!-- CARD 1 -->
                <div class="bg-white rounded-2xl shadow-sm p-5 h-[145px]">

                    <div class="flex items-center gap-2 text-[16px] font-semibold text-gray-700">

                        <div class="w-10 h-10 rounded-xl bg-[#E8F1F3] flex items-center justify-center">
                            <iconify-icon
                                icon="solar:wallet-money-bold"
                                class="text-[22px] text-[#0F5D73]">
                            </iconify-icon>
                        </div>

                        Saldo Kas
                    </div>

                    <h1 class="text-[#2D5BE3] text-[32px] font-bold tracking-tight mt-8">
                        Rp 2.500.000
                    </h1>
                </div>



                <!-- CARD 2 -->
                <div class="bg-white rounded-2xl shadow-sm p-5 h-[145px]">

                    <div class="flex items-center gap-2 text-[16px] font-semibold text-gray-700">

                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                            <iconify-icon
                                icon="solar:arrow-down-bold"
                                class="text-[22px] text-green-600">
                            </iconify-icon>
                        </div>

                        Total Kas Masuk
                    </div>

                    <h1 class="text-green-600 text-[32px] font-bold tracking-tight mt-8">
                        Rp 2.000.000
                    </h1>
                </div>



                <!-- CARD 3 -->
                <div class="bg-white rounded-2xl shadow-sm p-5 h-[145px]">

                    <div class="flex items-center gap-2 text-[16px] font-semibold text-gray-700">

                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                            <iconify-icon
                                icon="solar:arrow-up-bold"
                                class="text-[22px] text-red-500">
                            </iconify-icon>
                        </div>

                        Total Kas Keluar
                    </div>

                    <h1 class="text-red-500 text-[32px] font-bold tracking-tight mt-8">
                        Rp 500.000
                    </h1>
                </div>



                <!-- CARD 4 -->
                <div class="bg-white rounded-2xl shadow-sm p-5 h-[145px]">

                    <div class="flex items-center gap-2 text-[16px] font-semibold text-gray-700">

                        <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                            <iconify-icon
                                icon="solar:clipboard-list-bold"
                                class="text-[22px] text-purple-600">
                            </iconify-icon>
                        </div>

                        Jumlah Transaksi
                    </div>

                    <h1 class="text-purple-600 text-[32px] font-bold tracking-tight mt-8">
                        29
                    </h1>
                </div>
            </div>



            <!-- GRAFIK -->
            <div class="grid grid-cols-[2fr_1fr] gap-6 mt-8">

                <!-- GRAFIK -->
                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <div class="flex justify-between items-center">

                        <div>
                            <h1 class="text-[20px] font-bold text-gray-800">
                                Grafik Arus Kas
                            </h1>

                            <p class="text-gray-400 text-sm mt-1">
                                Statistik kas masuk & keluar
                            </p>
                        </div>

                        <button class="border border-gray-200 rounded-xl px-5 py-2 text-sm text-gray-500 font-medium">
                            7 Hari Terakhir
                        </button>
                    </div>

                    <div class="flex items-center gap-6 mt-8 ml-3">

                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            Kas Masuk
                        </div>

                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            Kas Keluar
                        </div>
                    </div>

                    <div class="relative h-[300px] mt-5">

                        <div class="absolute inset-0 flex flex-col justify-between">
                            <div class="border-b border-gray-100"></div>
                            <div class="border-b border-gray-100"></div>
                            <div class="border-b border-gray-100"></div>
                            <div class="border-b border-gray-100"></div>
                            <div class="border-b border-gray-100"></div>
                        </div>

                        <svg class="absolute inset-0 w-full h-full"
                            viewBox="0 0 700 300"
                            fill="none">

                            <path
                                d="M40 220
                                   C90 180, 120 150, 170 160
                                   C220 170, 250 110, 300 85
                                   C350 110, 390 150, 430 160
                                   C480 170, 540 110, 620 80"

                                stroke="#3478F6"
                                stroke-width="4"
                                fill="none"
                                stroke-linecap="round" />

                            <path
                                d="M40 260
                                   C90 245, 120 220, 170 230
                                   C220 240, 260 140, 300 125
                                   C350 170, 390 230, 430 245
                                   C500 260, 560 235, 620 220"

                                stroke="#EF4444"
                                stroke-width="4"
                                fill="none"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                </div>



                <!-- RINGKASAN -->
                <div class="bg-white rounded-2xl shadow-sm p-5">

                    <h1 class="text-[20px] font-bold text-gray-800">
                        Ringkasan Bulan Ini
                    </h1>

                    <div class="space-y-8 mt-8">

                        <div class="flex justify-between text-[15px]">
                            <span class="text-gray-500">Saldo Awal</span>
                            <span class="font-semibold">Rp 1.000.000</span>
                        </div>

                        <div class="flex justify-between text-[15px]">
                            <span class="text-gray-500">Kas Masuk</span>
                            <span class="font-semibold text-[#2D5BE3]">
                                Rp 5.000.000
                            </span>
                        </div>

                        <div class="flex justify-between text-[15px]">
                            <span class="text-gray-500">Kas Keluar</span>
                            <span class="font-semibold text-red-500">
                                Rp 2.500.000
                            </span>
                        </div>
                    </div>

                    <div class="bg-[#F5F7FA] rounded-2xl p-5 mt-8">

                        <p class="text-gray-500 text-sm font-medium">
                            Saldo Akhir
                        </p>

                        <h1 class="text-[#2D5BE3] text-[30px] font-bold mt-2">
                            Rp 3.500.000
                        </h1>
                    </div>

                    <button class="w-full mt-6 py-3 rounded-xl border border-[#A7C5FF] text-[#2D5BE3] font-semibold hover:bg-blue-50 transition">
                        Lihat Laporan
                    </button>
                </div>
            </div>



            <!-- TRANSAKSI -->
            <div class="flex justify-between items-center mt-8 mb-4">

                <h1 class="text-[20px] font-bold text-gray-800">
                    Transaksi Terbaru
                </h1>

                <button class="text-[#2D5BE3] font-semibold text-sm">
                    Lihat Semua
                </button>
            </div>



            <!-- TABLE -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <table class="w-full">

                    <thead class="bg-[#F9FAFB] border-b border-gray-100">

                        <tr class="text-left text-gray-500 text-sm">

                            <th class="px-6 py-5 font-semibold">Tanggal</th>
                            <th class="px-6 py-5 font-semibold">Jenis</th>
                            <th class="px-6 py-5 font-semibold">Keterangan</th>
                            <th class="px-6 py-5 font-semibold">Kategori</th>
                            <th class="px-6 py-5 font-semibold">Nominal</th>
                            <th class="px-6 py-5 font-semibold">Oleh</th>

                        </tr>
                    </thead>

                    <tbody class="text-[15px] text-gray-700">

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                            <td class="px-6 py-5">01 Mei 2026</td>

                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                    Kas Masuk
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                Pembayaran kas siswa
                            </td>

                            <td class="px-6 py-5">Kas</td>

                            <td class="px-6 py-5 font-bold text-green-600">
                                + Rp 100.000
                            </td>

                            <td class="px-6 py-5">Bendahara</td>
                        </tr>

                    </tbody>
                </table>
            </div>



            <!-- FOOTER -->
            <div class="text-center py-8 text-sm text-gray-400 font-medium">
                © 2026 KASKU Online. All rights reserved.
            </div>

        </div>
    </main>
</div>

@endsection