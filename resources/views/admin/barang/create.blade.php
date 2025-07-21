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
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('barang.store') }}" method="POST">
                                @csrf

                                {{-- Kategori Barang --}}
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Pilih Kategori</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        <option value=" ">-- Pilih Kategori --</option>
                                        @foreach ($categories as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ old('category_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nama Barang --}}
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang"
                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                        value="{{ old('nama_barang') }}" placeholder="Masukkan nama barang">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kode Barang --}}
                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <input type="text" name="kode_barang" id="kode_barang"
                                        class="form-control @error('kode_barang') is-invalid @enderror"
                                        value="{{ old('kode_barang') }}" placeholder="Masukkan kode unik barang">
                                    @error('kode_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jumlah --}}
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah', 0) }}" min="0">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kondisi --}}
                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi Barang</label>
                                    <select name="kondisi" id="kondisi"
                                        class="form-control @error('kondisi') is-invalid @enderror">
                                        <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik
                                        </option>
                                        <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak
                                        </option>
                                        <option value="diperbaiki" {{ old('kondisi') == 'diperbaiki' ? 'selected' : '' }}>
                                            Diperbaiki</option>
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"
                                        placeholder="Opsional...">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="d-flex justify-content-start gap-2 mt-3">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                    <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm">
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
