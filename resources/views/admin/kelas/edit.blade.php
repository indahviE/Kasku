<script src="https://cdn.tailwindcss.com"></script>

@include('components.styles')

<div class="flex min-h-screen bg-gradient-subtle font-sans text-slate-900">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        @include('components.header', ['pageTitle' => 'Edit Kelas'])

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-2xl mx-auto">

                <!-- Back Button -->
                <a href="{{ route('kelas') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 mb-8 font-medium">
                    <span>←</span> Kembali ke Daftar Kelas
                </a>

                <!-- Title -->
                <div class="mb-8">
                    <h1 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Edit Kelas</h1>
                    <p class="text-slate-500 mt-2">Update informasi kelas</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl border border-slate-200/50 shadow-sm p-8">

                    {{-- Error Messages --}}
                    @if ($errors->any())
                    <div class="alert-error">
                        <p class="text-red-700 font-semibold text-sm mb-2">Terjadi kesalahan:</p>
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('POST')

                        <!-- Nama Kelas -->
                        <div>
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input
                                type="text"
                                id="nama_kelas"
                                name="nama_kelas"
                                class="form-input @error('nama_kelas') border-red-500 @enderror"
                                value="{{ old('nama_kelas') ?? $kelas->nama_kelas }}"
                                placeholder="Contoh: Kelas XI RPL 1"
                                required>
                            @error('nama_kelas')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                    <!-- Kode Kelas -->
                    <div>
                        <label for="code" class="form-label">Kode Kelas</label>

                        <div class="flex gap-3 items-end">
                            <input
                                type="text"
                                id="code"
                                name="code"
                                class="flex-1 px-4 py-3 border border-slate-300 rounded-xl bg-slate-50 text-slate-600"
                                value="{{ $kelas->code }}"
                                readonly>

                            <button
                                type="button"
                                id="regenBtn"
                                class="px-4 py-3 bg-amber-100 hover:bg-amber-200 text-amber-700 rounded-xl font-semibold transition-all whitespace-nowrap text-sm">
                                Regenerate
                            </button>
                        </div>

                        <p class="text-xs text-slate-500 mt-2">
                            Klik regenerate untuk membuat kode baru.
                        </p>
                    </div>

                        <!-- Tahun Ajaran -->
                        <div>
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input
                                type="text"
                                id="tahun_ajaran"
                                name="tahun_ajaran"
                                class="form-input @error('tahun_ajaran') border-red-500 @enderror"
                                value="{{ old('tahun_ajaran') ?? $kelas->tahun_ajaran }}"
                                placeholder="Contoh: 2024/2025"
                                required>
                            @error('tahun_ajaran')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Info Box -->
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                            <p class="text-yellow-800 text-sm font-medium">
                                ⚠ Kode kelas tidak bisa diubah langsung. Gunakan tombol Regenerate jika perlu membuat kode baru.
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 btn-primary">
                                Update Kelas
                            </button>
                            <a href="{{ route('kelas') }}" class="flex-1 btn-secondary text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    document.getElementById('regenBtn').addEventListener('click', function () {

        const oldCode = document.getElementById('code').value;

        // ambil prefix sebelum dash terakhir
        const prefix = oldCode.substring(0, oldCode.lastIndexOf('-'));

        // random huruf + angka
        const letters = Math.random().toString(36).substring(2,4).toUpperCase();
        const numbers = Math.floor(Math.random() * 90 + 10);

        const newCode = `${prefix}-${letters}${numbers}`;

        document.getElementById('code').value = newCode;
    });
</script>
