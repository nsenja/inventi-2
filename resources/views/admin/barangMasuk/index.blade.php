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
                                <h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
                                <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="kategoriTable" class="table table-bordered">
                                    <table id="kategoriTable" class="table table-striped table-bordered table-hover">
                                        <thead class="table-white">
                                            <tr>
                                                <th class="text-center" style="width: 50px;">No</th>
                                                {{-- <th class="text-center">id_barang</th> --}}
                                                 <th class="text-center">Tanggal Masuk</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center">Kode Barang</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Catatan</th>
                                                <th class="text-center">Bukti</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>

                                        @foreach ($barangMasuk as $index => $item)
                                            <tr>
                                                <td class="text-center" style="width: 50px;">{{ $index + 1 }}</td>
                                                {{-- <td class="text-center">{{ $item->barang->id }}</td> --}}
                                                <td class="text-center">{{ $item->tanggal_masuk }}</td>
                                                <td class="text-center">{{ $item->barang->kategori->nama_kategori }}</td>
                                                <td class="text-center">{{ $item->barang->nama_barang }}</td>
                                                <td class="text-center">{{ $item->barang->kode_barang }}</td>
                                                <td class="text-center">{{ $item->barang->jumlah }}</td>
                                                <td class="text-center">{{ $item->catatan }}</td>
                                                <td class="text-center">
                                                    @if ($item->bukti)
                                                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $item->bukti) }}"
                                                                alt="Bukti Barang Masuk" style="width: 80px; height: 60px;">
                                                        </a>
                                                    @else
                                                        Tidak ada bukti
                                                    @endif
                                                
                                                <td class="text-center" style="width: 150px;">
                                                    <div class="d-flex justify-content-center ">
                                                        <a href="{{ route('barang-masuk.edit', $item->id) }}"
                                                            class="btn btn-warning btn-sm mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('barang-masuk.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- End of Main Content -->
                @endsection

                @section('scripts')
                    <!-- Bootstrap core JavaScript-->
                    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
                    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

                    <!-- Page level plugins -->
                    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

                    <!-- Page level custom scripts -->
                    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
                    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
                @endsection
