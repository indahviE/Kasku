<!-- Sidebar Component -->
<div class="w-64 bg-slate-900 text-slate-400 flex flex-col sticky top-0 h-screen border-r border-slate-800/50">

    <!-- Logo Section -->
    <div class="p-6 border-b border-slate-800/50">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] flex items-center justify-center shadow-lg shadow-cyan-900/20">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-white"
                    viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M20 7H4C2.9 7 2 7.9 2 9V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V9C22 7.9 21.1 7 20 7ZM20 17H4V9H20V17ZM16 11C14.9 11 14 11.9 14 13C14 14.1 14.9 15 16 15C17.1 15 18 14.1 18 13C18 11.9 17.1 11 16 11ZM18 5H6V3H18V5Z"/>
                </svg>
            </div>
            <div>
                <div class="text-white font-display font-bold text-base tracking-tight">KASKU</div>
                <div class="text-[10px] text-slate-500 font-medium">Online</div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 space-y-1 py-6 overflow-y-auto">
        <a href="{{ route('dashboard.admin') }}" class="sidebar-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l-4-4m4 4l4 4m0 0V9"/>
            </svg>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <a href="{{ route('kelas') }}" class="sidebar-item {{ request()->routeIs('kelas*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span class="text-sm font-medium">Kelola Kelas</span>
        </a>

        <a href="{{ route('admin.daftar-transaksi') }}" class="sidebar-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="text-sm font-medium">Data Transaksi</span>
        </a>
    </nav>

    <!-- Logout Section -->
    <div class="p-4 border-t border-slate-800/50">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all font-medium">
                ↪ Logout
            </button>
        </form>
    </div>
</div>
