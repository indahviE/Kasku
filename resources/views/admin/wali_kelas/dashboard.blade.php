<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');
    * { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-display { font-family: 'Outfit', sans-serif; }
    :root { --primary: #1B6578; --primary-light: #2a8fa3; }
    .bg-gradient-subtle { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
    .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(15,23,42,0.05); }
    .card-hover:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(27,101,120,0.08); }
    .sidebar-item { position: relative; transition: all 0.2s ease; }
    .sidebar-item::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 0; background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 0 3px 3px 0; transition: height 0.3s ease; }
    .sidebar-item.active::before { height: 20px; }
    .avatar-gradient { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); }
    .dropdown-menu { display: none; position: absolute; top: 100%; right: 0; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); z-index: 50; min-width: 200px; margin-top: 0.5rem; }
    .dropdown-menu.active { display: block; }
    .dropdown-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; color: #475569; text-decoration: none; font-size: 0.875rem; transition: all 0.2s ease; border-bottom: 1px solid #f1f5f9; }
    .dropdown-item:first-child { border-radius: 12px 12px 0 0; }
    .dropdown-item:last-child { border-bottom: none; border-radius: 0 0 12px 12px; }
    .dropdown-item:hover { background-color: #f8fafc; color: #1B6578; }
    .dropdown-item.logout:hover { background-color: #fee2e2; color: #dc2626; }
    tbody tr { transition: background-color 0.2s ease; }
    tbody tr:hover { background-color: rgba(27,101,120,0.03); }
</style>

<div class="flex min-h-screen bg-gradient-subtle">

    {{-- SIDEBAR --}}
    <div class="w-64 bg-slate-900 text-slate-400 flex flex-col sticky top-0 h-screen border-r border-slate-800/50">

        <div class="p-6 border-b border-slate-800/50">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 7H4C2.9 7 2 7.9 2 9V17C2 18.1 2.9 19 4 19H20C21.1 19 22 18.1 22 17V9C22 7.9 21.1 7 20 7ZM20 17H4V9H20V17ZM16 11C14.9 11 14 11.9 14 13C14 14.1 14.9 15 16 15C17.1 15 18 14.1 18 13C18 11.9 17.1 11 16 11ZM18 5H6V3H18V5Z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-white font-display font-bold text-base tracking-tight">KASKU</div>
                    <div class="text-[10px] text-slate-500 font-medium">Online</div>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-3 space-y-1 py-6">
            <a href="{{ route('wali.dashboard') }}"
               class="sidebar-item active flex items-center gap-3 py-3 px-4 rounded-xl bg-slate-800/50 text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-sm font-medium">Daftar Siswa</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all font-medium">
                    ↪ Logout
                </button>
            </form>
        </div>

    </div>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- NAVBAR --}}
        <header class="bg-white/60 backdrop-blur-xl sticky top-0 z-40 border-b border-slate-200/50 h-16 flex items-center justify-between px-8 shadow-sm">
            <div class="flex items-center gap-2 text-sm">
                <span class="text-slate-500 font-medium">Pages</span>
                <span class="text-slate-300">/</span>
                <span class="text-slate-900 font-semibold">Dashboard Wali Kelas</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="relative">
                    <button id="profileBtn" class="flex items-center gap-3 hover:bg-slate-100 p-2 rounded-lg transition-all">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 text-right">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-green-600 font-medium text-right">Wali Kelas</p>
                        </div>
                        <div class="w-10 h-10 avatar-gradient rounded-full border-2 border-white shadow-sm flex items-center justify-center">
                            <span class="text-sm font-display font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </button>

                    <div id="dropdownMenu" class="dropdown-menu">
                        <form method="POST" action="{{ route('logout') }}">
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

        {{-- CONTENT --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-5xl mx-auto space-y-6">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- INFO KELAS --}}
                <div class="bg-gradient-to-br from-[#1B6578] to-[#2a8fa3] rounded-2xl p-6 text-white shadow-lg">
                    <p class="text-white/70 text-sm mb-1">Kelas yang Anda ampu</p>
                    <h2 class="text-3xl font-display font-bold mb-4">{{ $wali->kelas->nama_kelas }}</h2>
                    <div class="flex items-center gap-6">
                        <div>
                            <p class="text-white/60 text-xs">Tahun Ajaran</p>
                            <p class="text-white font-semibold text-sm">{{ $wali->kelas->tahun_ajaran }}</p>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs">Total Siswa</p>
                            <p class="text-white font-semibold text-sm">{{ $siswa->count() }} orang</p>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs">Bendahara</p>
                            <p class="text-white font-semibold text-sm">{{ $jumlahBendahara }}/2 orang</p>
                        </div>
                    </div>
                </div>

                {{-- TABEL SISWA --}}
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm overflow-hidden">

                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Daftar Siswa</h3>
                        <p class="text-xs text-slate-500">Klik "Jadikan Bendahara" untuk menunjuk bendahara kelas. Maksimal 2 orang.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No HP</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($siswa as $i => $s)
                                <tr>
                                    <td class="px-6 py-4 text-slate-500 font-medium">{{ $i + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full avatar-gradient flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($s->user->name, 0, 1) }}
                                            </div>
                                            <span class="font-semibold text-slate-900">{{ $s->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $s->nis }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $s->no_hp }}</td>
                                    <td class="px-6 py-4">
                                        @if ($s->user->role === 'bendahara')
                                            <span class="bg-purple-50 text-purple-700 border border-purple-200 px-3 py-1.5 rounded-lg text-[11px] font-bold uppercase tracking-wider">
                                                Bendahara
                                            </span>
                                        @else
                                            <span class="bg-slate-100 text-slate-600 border border-slate-200 px-3 py-1.5 rounded-lg text-[11px] font-bold uppercase tracking-wider">
                                                Siswa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" action="{{ route('wali.jadikan-bendahara', $s->id) }}">
                                            @csrf
                                            @if ($s->user->role === 'bendahara')
                                                <button type="submit"
                                                    onclick="return confirm('Kembalikan {{ $s->user->name }} menjadi siswa biasa?')"
                                                    class="px-3 py-1.5 bg-slate-100 text-slate-600 text-xs font-semibold rounded-lg hover:bg-slate-200 transition-all">
                                                    Batalkan
                                                </button>
                                            @else
                                                <button type="submit"
                                                    onclick="return confirm('Jadikan {{ $s->user->name }} sebagai bendahara?')"
                                                    class="px-3 py-1.5 bg-purple-50 text-purple-600 text-xs font-semibold rounded-lg hover:bg-purple-100 transition-all
                                                    {{ $jumlahBendahara >= 2 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ $jumlahBendahara >= 2 ? 'disabled' : '' }}>
                                                    Jadikan Bendahara
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-400 text-sm italic">
                                        Belum ada siswa di kelas ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </main>

    </div>
</div>

<script>
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


