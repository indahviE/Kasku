<!-- Navbar -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<nav class="w-full py-6 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
            <h1 class="text-2xl font-bold text-gray-900">
                Kasku
            </h1>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex items-center gap-10 text-sm font-medium text-gray-600">
            <li>
                <a href="#" class="hover:text-black transition">
                    Home
                </a>
            </li>
            <li>
                <a href="#fitur" class="hover:text-black transition">
                    Features
                </a>
            </li>
            <li>
                <a href="#tentang" class="hover:text-black transition">
                    About
                </a>
            </li>
            <li>
                <a href="#kontak" class="hover:text-black transition">
                    Contact
                </a>
            </li>
        </ul>

        <!-- Button / Profile -->
        <div class="flex items-center gap-3">
            @auth
                <!-- Profile Dropdown -->
                <div class="relative group">
                    <!-- Profile Button -->
                    <button class="flex items-center gap-2 px-3 py-1 rounded-full hover:bg-gray-100 transition" onclick="toggleDropdown()">
                        <x-user-avatar :user="Auth::user()" size="md" />
                        <div class="flex items-center gap-1">
                            <span class="text-xs text-gray-500" style="font-family: 'Poppins', sans-serif;">Hey,</span>
                            <span class="text-sm font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">{{ Auth::user()->name }}</span>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <!-- User Info -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Menu Items -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                            Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                            Settings
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <!-- Sign In & Sign Up -->
                <a href="/login" class="px-6 py-2 rounded-full border border-gray-300 text-sm font-medium hover:bg-gray-100 transition inline-block">
                    Sign In
                </a>
                <a href="/register" class="px-6 py-2 rounded-full bg-black text-white text-sm font-medium hover:bg-gray-800 transition inline-block">
                    Sign Up
                </a>
            @endguest
        </div>
    </div>
</nav>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('hidden');
}

// Close dropdown ketika klik di luar
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const button = event.target.closest('button');

    if (!button && dropdown && !dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
    }
});
</script>

<style>
#dropdown-menu {
    transition: opacity 0.2s ease-in-out;
}
</style>
