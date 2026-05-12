{{-- resources/views/admin/kelas/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="card-table p-4">
    <h5 class="fw-bold mb-4">Edit Data Kelas: {{ $kelas->nama_kelas }}</h5>
    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tingkat</label>
                <select name="tingkat" class="form-select">
                    <option value="X" {{ $kelas->tingkat == 'X' ? 'selected' : '' }}>X</option>
                    <option value="XI" {{ $kelas->tingkat == 'XI' ? 'selected' : '' }}>XI</option>
                    <option value="XII" {{ $kelas->tingkat == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Wali Kelas</label>
                <input type="text" name="wali_kelas" class="form-control" value="{{ $kelas->wali_kelas }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Aktif" {{ $kelas->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ $kelas->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn-tambah border-0 px-4">Update Data</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-light ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection