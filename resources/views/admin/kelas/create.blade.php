<script src="https://cdn.tailwindcss.com"></script>

@include('components.styles')

<div class="flex min-h-screen bg-slate-50 font-sans text-slate-900">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        @include('components.header', ['pageTitle' => 'Tambah Kelas'])

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-2xl mx-auto">

                <!-- Back Button -->
                <a href="{{ route('kelas') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 mb-8 font-medium">
                    <span>←</span> Kembali ke Daftar Kelas
                </a>

                <!-- Title -->
                <div class="mb-8">
                    <h1 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Tambah Kelas Baru</h1>
                    <p class="text-slate-500 mt-2">Isi data kelas dan sistem akan auto-generate kode unik</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">

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

                    <form action="{{ route('kelas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama Kelas -->
                        <div>
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-input"
                                   placeholder="Contoh: Kelas XI RPL 1"
                                   value="{{ old('nama_kelas') }}" required>
                            @error('nama_kelas')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Code Prefix -->
                        <div>
                            <label class="form-label">Prefix Kode Kelas</label>
                            <input type="text" name="code_prefix" class="form-input"
                                   placeholder="Contoh: XI-RPL atau X-IPA"
                                   value="{{ old('code_prefix') }}" required>
                            <p class="text-xs text-slate-500 mt-2">Kode lengkap akan menjadi: PREFIX-XXXX (4 karakter random)</p>
                            @error('code_prefix')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tahun Ajaran -->
                        <div>
                            <label class="form-label">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-input"
                                   placeholder="Contoh: 2024/2025"
                                   value="{{ old('tahun_ajaran') }}" required>
                            @error('tahun_ajaran')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Info Box -->
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
                            <p class="text-blue-800 text-sm font-medium">
                                ℹ Kode kelas akan dibuat otomatis dan unik. Contoh hasil: XI-RPL-A7K3
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 btn-primary">
                                Simpan Kelas
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
