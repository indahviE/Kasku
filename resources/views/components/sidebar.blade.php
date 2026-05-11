<aside class="w-[250px] bg-white px-7 py-8 shadow-sm flex flex-col justify-between">

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div>
            <h1 class="text-[24px] font-extrabold text-[#0F5D73] leading-none">
                KASKU
            </h1>
            <p class="text-gray-400 text-sm font-semibold mt-1">
                Online
            </p>
        </div>

        <!-- MENU -->
        <nav class="mt-16 space-y-3 text-[15px] font-semibold">

            <!-- DASHBOARD -->
            <a href="{{ route('kas_masuk') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('kas_masuk') ? 'bg-[#E8F1F3] text-[#0F5D73]' : 'text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73]' }}">
                <iconify-icon icon="solar:home-2-bold" class="text-[20px]"></iconify-icon>
                Dashboard
            </a>

            <!-- KAS MASUK -->
            <a href="{{ route('kas_masuk') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('kas_masuk*') ? 'bg-[#E8F1F3] text-[#0F5D73]' : 'text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73]' }}">
                <iconify-icon icon="solar:wallet-money-bold" class="text-[20px]"></iconify-icon>
                Kas Masuk
            </a>

            <!-- KAS KELUAR -->
            <a href="{{ route('kas_keluar') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('kas_keluar*') ? 'bg-[#E8F1F3] text-[#0F5D73]' : 'text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73]' }}">
                <iconify-icon icon="solar:card-send-bold" class="text-[20px]"></iconify-icon>
                Kas Keluar
            </a>

            <!-- TRANSAKSI -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73]">
                <iconify-icon icon="solar:clipboard-list-bold" class="text-[20px]"></iconify-icon>
                Transaksi
            </a>

            <!-- LAPORAN -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73]">
                <iconify-icon icon="solar:document-bold" class="text-[20px]"></iconify-icon>
                Laporan
            </a>

        </nav>
    </div>

    <!-- BOTTOM -->
    <div class="space-y-3">

        <!-- SETTINGS -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 text-gray-500 hover:bg-[#F4F7F8] hover:text-[#0F5D73] px-4 py-3 rounded-xl transition font-semibold text-[15px]">
            <iconify-icon icon="solar:settings-bold" class="text-[20px]"></iconify-icon>
            Pengaturan
        </a>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
               class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl transition font-semibold text-[15px]">
                <iconify-icon icon="solar:logout-2-bold" class="text-[20px]"></iconify-icon>
                Logout
            </button>
        </form>

    </div>
</aside>