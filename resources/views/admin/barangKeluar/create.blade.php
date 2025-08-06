@extends('layouts.app')
@section('title', 'Form Barang Keluar')

@section('content')
    <div class="container-fluid">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('barang-keluar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Pilih Barang --}}
                                <div class="mb-3">
                                    <label for="barang_id" class="form-label">Pilih Barang</label>
                                    <select name="barang_id" id="barang_id"
                                        class="form-control @error('barang_id') is-invalid @enderror">
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                                ({{ $barang->kode_barang }}) - {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jumlah --}}
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah', 0) }}" min="1">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tanggal Keluar --}}
                                <div class="mb-3">
                                    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                    <input type="date" name="tanggal_keluar" id="tanggal_keluar"
                                        class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                        value="{{ old('tanggal_keluar', now()->format('Y-m-d')) }}">
                                    @error('tanggal_keluar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Catatan --}}
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                        placeholder="Masukkan catatan tambahan">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Bukti Barang Keluar --}}
                                <div class="mb-4">
                                    <label for="bukti" class="form-label">Bukti Barang Keluar</label>
                                    <input type="file" name="bukti" id="bukti"
                                        class="form-control @error('bukti') is-invalid @enderror">
                                    @error('bukti')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol Simpan --}}
                                <div class="d-flex justify-content-start gap-2 mt-3">
                                    <button type="submit" class="btn btn-success btn-sm mr-2">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                    <a href="{{ route('barang-keluar.index') }}" class="btn btn-secondary btn-sm">
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
