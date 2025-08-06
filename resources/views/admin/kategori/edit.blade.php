@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Konten dashboard di sini -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Kategori</h6>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                                @csrf
                                @method('PUT') {{-- penting untuk update --}}

                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Edit Kategori</label>
                                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                        id="nama_kategori" name="nama_kategori"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                        placeholder="Masukkan nama kategori">

                                    @error('nama_kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i> Update
                                </button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </form>
                        </div>
                </div>
            </div>
        @endsection
