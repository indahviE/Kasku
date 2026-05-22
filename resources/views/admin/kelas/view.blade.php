<script src="https://cdn.tailwindcss.com"></script>

@include('components.styles')

<div class="flex min-h-screen bg-gradient-subtle font-sans text-slate-900">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        @include('components.header', ['pageTitle' => 'Kelola Kelas'])

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto">

                <!-- Alert Messages -->
                @if ($errors->any())
                    <div class="alert-error">
                        <p class="text-red-700 text-sm font-medium">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-red-600 text-sm mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-success">
                        <p class="text-green-700 text-sm font-medium">✓ {{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-error">
                        <p class="text-red-700 text-sm font-medium">✗ {{ session('error') }}</p>
                    </div>
                @endif

                <!-- Title & Button -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Kelola Kelas</h1>
                        <p class="text-sm text-slate-500 mt-1">Manajemen data kelas dan kode akses</p>
                    </div>
                    <a href="{{ route('kelas.create') }}" class="btn-primary">
                        + Tambah Kelas
                    </a>
                </div>

                <!-- Table Section -->
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm overflow-hidden">

                    <!-- Table Header -->
                    <div class="p-6 border-b border-slate-100 bg-white/50 backdrop-blur-sm">
                        <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Daftar Kelas</h3>
                        <p class="text-xs text-slate-500">Kelola semua kelas yang tersedia</p>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nama Kelas</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Kode Kelas</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Tahun Ajaran</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($kelas as $k)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 text-xs text-slate-400 font-semibold">#{{ ($kelas->currentPage() - 1) * $kelas->perPage() + $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-[#1B6578] to-[#0f4a5a] flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($k->nama_kelas, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-800">{{ $k->nama_kelas }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <code class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold tracking-wide">{{ $k->code }}</code>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $k->tahun_ajaran }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('kelas.edit', ['id' => $k->id]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-lg text-xs font-semibold transition-colors">
                                                ✎ Edit
                                            </a>
                                            <form action="{{ route('kelas.delete', $k->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs font-semibold transition-colors" onclick="return confirm('Yakin hapus kelas ini?')">
                                                    🗑 Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <p class="text-sm font-medium text-slate-500">Belum ada kelas yang dibuat</p>
                                            <a href="{{ route('kelas.create') }}" class="text-[#1B6578] text-sm font-semibold hover:underline">
                                                Buat kelas sekarang →
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-slate-50/50 px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-slate-600 font-medium">
                            Menampilkan <span class="font-semibold">{{ $kelas->firstItem() ?? 0 }}</span> - <span class="font-semibold">{{ $kelas->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $kelas->total() }}</span> kelas
                        </div>
                        <div class="flex items-center gap-2">
                            {{ $kelas->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
