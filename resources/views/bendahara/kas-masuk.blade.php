# `resources/views/bendahara/kasMasuk.blade.php`

```blade
@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#ECEFF4] font-['Inter']">

    <!-- MAIN CONTENT -->
    <main class="flex-1 px-7 pb-6 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="bg-white h-[72px] px-7 flex items-center justify-between border-b border-gray-200 -mx-7 mb-7">

            <!-- LEFT -->
            <div>
                <h1 class="text-[22px] font-bold text-gray-800">
                    Kas Masuk
                </h1>

                <p class="text-sm text-gray-400">
                    Kelola data pemasukan kas kelas
                </p>
            </div>


            <!-- RIGHT -->
            <div class="flex items-center gap-5">

                <!-- NOTIFICATION -->
                <button class="w-11 h-11 rounded-full bg-[#F5F7FA] flex items-center justify-center hover:bg-gray-100 transition">

                    <iconify-icon
                        icon="solar:bell-bold"
                        class="text-[20px] text-gray-700">
                    </iconify-icon>

                </button>


                <!-- PROFILE -->
                <div class="relative group">

                    <button class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-full bg-[#0F5D73]"></div>

                        <div class="text-left">

                            <h1 class="text-[15px] font-bold text-gray-800 leading-none">
                                Bendahara
                            </h1>

                            <p class="text-[13px] text-gray-400 mt-1">
                                Admin Kas
                            </p>
                        </div>

                        <iconify-icon
                            icon="solar:alt-arrow-down-linear"
                            class="text-[18px] text-gray-500">
                        </iconify-icon>

                    </button>


                    <!-- DROPDOWN -->
                    <div class="absolute right-0 top-14 w-44 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">

                        <a href="#"
                            class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-t-xl">

                            <iconify-icon icon="solar:user-linear"></iconify-icon>
                            Profile

                        </a>

                        <a href="#"
                            class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">

                            <iconify-icon icon="solar:settings-linear"></iconify-icon>
                            Settings

                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-500 hover:bg-red-50 rounded-b-xl">

                                <iconify-icon icon="solar:logout-2-linear"></iconify-icon>
                                Logout

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- HEADER -->
        <div class="flex justify-between items-center mb-7">

            <div>
                <h1 class="text-[32px] font-bold text-[#111827] tracking-tight">
                    Data Kas Masuk
                </h1>

                <p class="text-gray-500 text-[15px] font-medium mt-2">
                    Daftar seluruh pemasukan kas kelas.
                </p>
            </div>


            <!-- BUTTON -->
            <button class="bg-[#0F5D73] hover:bg-[#0B4A5B] transition text-white px-5 py-3 rounded-2xl font-semibold flex items-center gap-2 shadow-sm">

                <iconify-icon
                    icon="solar:add-circle-bold"
                    class="text-[20px]">
                </iconify-icon>

                Tambah Kas
            </button>
        </div>


        <!-- STATS -->
        <div class="grid grid-cols-3 gap-6 mb-7">

            <!-- CARD -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-400 text-sm font-medium">
                            Total Kas Hari Ini
                        </p>

                        <h1 class="text-[30px] font-bold text-[#2D5BE3] mt-3">
                            Rp 500K
                        </h1>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <iconify-icon
                            icon="solar:wallet-money-bold"
                            class="text-[26px] text-[#2D5BE3]">
                        </iconify-icon>

                    </div>
                </div>
            </div>


            <!-- CARD -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-400 text-sm font-medium">
                            Transaksi Bulan Ini
                        </p>

                        <h1 class="text-[30px] font-bold text-green-600 mt-3">
                            29
                        </h1>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                        <iconify-icon
                            icon="solar:clipboard-list-bold"
                            class="text-[26px] text-green-600">
                        </iconify-icon>

                    </div>
                </div>
            </div>


            <!-- CARD -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-gray-400 text-sm font-medium">
                            Total Pemasukan
                        </p>

                        <h1 class="text-[30px] font-bold text-[#0F5D73] mt-3">
                            Rp 5JT
                        </h1>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-[#E8F1F3] flex items-center justify-center">

                        <iconify-icon
                            icon="solar:chart-2-bold"
                            class="text-[26px] text-[#0F5D73]">
                        </iconify-icon>

                    </div>
                </div>
            </div>
        </div>


        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- TOP -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">

                <div>
                    <h1 class="text-[22px] font-bold text-gray-800">
                        Riwayat Kas Masuk
                    </h1>

                    <p class="text-sm text-gray-400 mt-1">
                        Semua transaksi pemasukan kas.
                    </p>
                </div>


                <!-- SEARCH -->
                <div class="relative">

                    <input
                        type="text"
                        placeholder="Cari transaksi..."
                        class="w-[280px] h-[46px] bg-[#F5F7FA] rounded-2xl pl-12 pr-4 text-sm outline-none border border-transparent focus:border-[#0F5D73] transition">

                    <iconify-icon
                        icon="solar:magnifer-linear"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-gray-400">
                    </iconify-icon>
                </div>
            </div>


            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-[#F9FAFB] text-gray-500 text-sm">

                        <tr>
                            <th class="px-6 py-5 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-5 text-left font-semibold">Nama</th>
                            <th class="px-6 py-5 text-left font-semibold">Keterangan</th>
                            <th class="px-6 py-5 text-left font-semibold">Nominal</th>
                            <th class="px-6 py-5 text-left font-semibold">Status</th>
                            <th class="px-6 py-5 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>


                    <tbody class="text-[15px] text-gray-700">

                        <!-- ROW -->
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-5">10 Mei 2026</td>

                            <td class="px-6 py-5 font-semibold">
                                Nafisah Adelia
                            </td>

                            <td class="px-6 py-5">
                                Pembayaran kas mingguan
                            </td>

                            <td class="px-6 py-5 font-bold text-green-600">
                                Rp 100.000
                            </td>

                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-600 text-sm px-4 py-2 rounded-full font-semibold">
                                    Success
                                </span>
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-3">

                                    <button class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-100 transition flex items-center justify-center text-[#2D5BE3]">

                                        <iconify-icon
                                            icon="solar:pen-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>

                                    <button class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500">

                                        <iconify-icon
                                            icon="solar:trash-bin-trash-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>
                                </div>
                            </td>
                        </tr>


                        <!-- ROW -->
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-5">09 Mei 2026</td>

                            <td class="px-6 py-5 font-semibold">
                                Chiara Putri
                            </td>

                            <td class="px-6 py-5">
                                Pembayaran kas bulanan
                            </td>

                            <td class="px-6 py-5 font-bold text-green-600">
                                Rp 250.000
                            </td>

                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-600 text-sm px-4 py-2 rounded-full font-semibold">
                                    Success
                                </span>
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-3">

                                    <button class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-100 transition flex items-center justify-center text-[#2D5BE3]">

                                        <iconify-icon
                                            icon="solar:pen-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>

                                    <button class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500">

                                        <iconify-icon
                                            icon="solar:trash-bin-trash-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>
                                </div>
                            </td>
                        </tr>


                        <!-- ROW -->
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-5">08 Mei 2026</td>

                            <td class="px-6 py-5 font-semibold">
                                Melina
                            </td>

                            <td class="px-6 py-5">
                                Pembayaran kegiatan kelas
                            </td>

                            <td class="px-6 py-5 font-bold text-green-600">
                                Rp 150.000
                            </td>

                            <td class="px-6 py-5">
                                <span class="bg-yellow-100 text-yellow-600 text-sm px-4 py-2 rounded-full font-semibold">
                                    Pending
                                </span>
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-3">

                                    <button class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-100 transition flex items-center justify-center text-[#2D5BE3]">

                                        <iconify-icon
                                            icon="solar:pen-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>

                                    <button class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 transition flex items-center justify-center text-red-500">

                                        <iconify-icon
                                            icon="solar:trash-bin-trash-bold"
                                            class="text-[18px]">
                                        </iconify-icon>

                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- FOOTER -->
        <div class="text-center py-8 text-sm text-gray-400 font-medium">
            © 2026 KASKU Online. All rights reserved.
        </div>
    </main>
</div>

@endsection
