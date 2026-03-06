@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>

                  <div class="d-flex align-items-center">
                    <form action="{{ route('barang-keluar.index') }}" method="GET" class="form-inline mr-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Search" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('barang-keluar.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('barang-keluar.cetak') }}" method="GET" target="_blank" class="mb-4">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-2">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">Semua Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Semua Tahun</option>
                            @for ($tahun = date('Y'); $tahun >= 2020; $tahun--)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="barangKeluarTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th class="text-center">Tanggal Keluar</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Catatan</th>
                            <th class="text-center">Bukti</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangKeluar as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}
                                </td>
                                <td class="text-center">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                                <td class="text-center">{{ $item->barang->nama_barang ?? '-' }}</td>
                                <td class="text-center">{{ $item->barang->kode_barang ?? '-' }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td class="text-center">{{ $item->catatan }}</td>
                                <td class="text-center">
                                    @if ($item->bukti)
                                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->bukti) }}"
                                                alt="Bukti Barang Keluar"
                                                style="width: 80px; height: 60px; object-fit: cover;">
                                        </a>
                                    @else
                                        Tidak ada bukti
                                    @endif
                                </td>
                                <td class="text-center" style="width: 150px;">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('barang-keluar.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('barang-keluar.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Data barang keluar belum ada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection