<!-- Header/Navbar Component -->
<header class="bg-white/60 backdrop-blur-xl sticky top-0 z-40 border-b border-slate-200/50 h-16 flex items-center justify-between px-8 shadow-sm">
    <div class="flex items-center gap-2 text-sm">
        <span class="text-slate-500 font-medium">Pages</span>
        <span class="text-slate-300">/</span>
        <span class="text-slate-900 font-semibold">{{ $pageTitle ?? 'Admin' }}</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="h-8 w-px bg-slate-200"></div>

        <!-- Profile Dropdown -->
        <div class="relative group">
            <button id="profileBtn" class="flex items-center gap-3 hover:bg-slate-100 p-2 rounded-lg transition-all">
                <div>
                    <p class="text-sm font-semibold text-slate-900 text-right">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-green-600 font-medium text-right">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
                <div class="w-10 h-10 avatar-gradient rounded-full border-2 border-white shadow-sm flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-display font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="dropdown-menu">
                <a href="#" class="dropdown-item">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <a href="#" class="dropdown-item">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="dropdown-item logout w-full text-left">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    // Profile Dropdown Toggle
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.classList.toggle('active');
    });

    document.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });
</script>
