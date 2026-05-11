<script src="https://cdn.tailwindcss.com"></script>

<div class="flex min-h-screen bg-[#f8fafc] font-sans text-slate-900">

    <div class="w-60 bg-[#0f172a] text-slate-400 flex flex-col sticky top-0 h-screen">
        <div class="p-5">
            <div class="flex items-center gap-3 text-white font-bold text-lg tracking-tight">
                <div class="w-8 h-8 bg-[#1B6578] rounded-lg flex items-center justify-center shadow-lg shadow-[#1B6578]/30">
                    <span class="text-sm">A</span>
                </div>
                Admin Panel
            </div>
        </div>

        <nav class="flex-1 px-3 space-y-1 mt-4">
            <a href="#" class="flex items-center gap-3 py-2.5 px-4 rounded-xl hover:bg-slate-800 transition-all group">
                <span class="text-sm font-medium group-hover:text-white">Dashboard</span>
            </a>
            <a href="#" class="flex items-center gap-3 py-2.5 px-4 rounded-xl bg-[#1B6578] text-white shadow-md shadow-[#1B6578]/20">
                <span class="text-sm font-medium">Kelola User</span>
            </a>
            <a href="#" class="flex items-center gap-3 py-2.5 px-4 rounded-xl hover:bg-slate-800 transition-all group">
                <span class="text-sm font-medium group-hover:text-white">Data Transaksi</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-medium">
            Logout
            </button>
            </form>
        </div>
    </div>

    <div class="flex-1">

        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 border-b border-slate-200 h-14 flex items-center justify-between px-8">
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Pages</span>
                <span>/</span>
                <span class="text-slate-800">Kelola User</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-800 leading-none">Admin User</p>
                    <p class="text-[10px] text-green-500 font-medium">Online</p>
                </div>
                <div class="w-8 h-8 rounded-full bg-[#1B6578] border border-white shadow-sm flex items-center justify-center">
                    <span class="text-[10px] font-bold text-white uppercase">AD</span>
                </div>
            </div>
        </header>

        <main class="p-6 max-w-[1400px] mx-auto">
            <div class="mb-6">
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Dashboard Admin</h1>
                <p class="text-sm text-slate-500">Manajemen data pengguna sistem.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total User</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-2xl font-black text-slate-800 leading-none">{{ $users->total() }}</h3>
                        <span class="text-[10px] bg-blue-50 text-[#1B6578] px-2 py-0.5 rounded font-bold uppercase">Users</span>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Role</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-2xl font-black text-slate-800 leading-none">{{ count($roles) }}</h3>
                        <span class="text-[10px] bg-purple-50 text-purple-600 px-2 py-0.5 rounded font-bold uppercase">Roles</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-white">
                    <h3 class="font-bold text-slate-800">Data List User</h3>

                    <form action="" method="GET" class="flex items-center gap-3">
                        <label class="text-xs font-semibold text-slate-400 uppercase">Filter</label>
                        <select name="role" onchange="this.form.submit()" class="border border-slate-200 rounded-lg px-3 py-1.5 text-xs font-medium focus:ring-2 focus:ring-[#1B6578]/20 focus:border-[#1B6578] outline-none bg-slate-50 transition-all cursor-pointer">
                            <option value="">Semua Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ $roleFilter == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 text-[10px] uppercase font-black tracking-[0.1em]">
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Lengkap</th>
                                <th class="px-6 py-3">Alamat Email</th>
                                <th class="px-6 py-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-3 text-xs text-slate-400 font-medium">#{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-7 h-7 rounded-full bg-[#1B6578]/10 text-[#1B6578] flex items-center justify-center text-[10px] font-bold uppercase">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-semibold text-slate-700">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-slate-500 italic">{{ $user->email }}</td>
                                    <td class="px-6 py-3 text-right">
                                        @php
                                            $isAdmin = strtolower($user->role) == 'admin';
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-wider {{ $isAdmin ? 'bg-[#1B6578]/10 text-[#1B6578] border border-[#1B6578]/20' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">!</div>
                                            <p class="text-xs italic text-slate-400 font-medium">Belum ada data user yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-slate-50/50 p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data user
                    </div>

                    <div class="flex items-center">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
