{{-- resources/views/admin/kelas/create.blade.php --}}
@extends('layouts.admin') {{-- Sesuaikan dengan layout kamu --}}

@section('content')
<div class="card-table p-4">
    <h5 class="fw-bold mb-4">Tambah Data Kelas</h5>
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: X RPL 1" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tingkat</label>
                <select name="tingkat" class="form-select">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Wali Kelas</label>
                <input type="text" name="wali_kelas" class="form-control" placeholder="Nama Guru" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn-tambah border-0 px-4">Simpan Data</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-light ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection