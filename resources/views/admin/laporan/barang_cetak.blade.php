<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Laporan Data Barang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .kop {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .header-text h1 {
            font-size: 18px;
            margin: 0;
        }

        .header-text p {
            font-size: 12px;
            margin: 2px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .img-thumbnail {
            width: 60px;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- Kop Surat -->
    <<!-- Kop Surat -->
        <div class="kop">
            <div style="float: left;">
                {{-- Logo Poltekkes Surabaya --}}
                <img src="{{ public_path('logo/logo.png') }}" style="width: 190px; height: 70px;">
            </div>

            <div style="text-align: center;">
                <h2 style="margin: 0; font-size: 16px;">KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</h2>
                <h2 style="margin: 0; font-size: 14px;">POLITEKNIK KESEHATAN KEMENKES SURABAYA</h2>
                <p style="margin: 2px 0; font-size: 10px;">
                    Jl. Pucang Jajar Tengah No. 56, Kertajaya, Gubeng, Kota Surabaya, Jawa Timur 60282
                </p>
                <p style="margin: 2px 0; font-size: 10px;">
                    Telp: (031) 5027058 | Fax: (031) 5028141 | Email: humas@poltekkes-surabaya.ac.id
                </p>
                <p style="margin: 2px 0; font-size: 10px;">
                    Website: <span style="color: blue;">www.spmb.poltekkes-surabaya.ac.id</span>
                </p>
            </div>
        </div>


     <div style="text-align: center; margin-top: 10px; line-height: 1.2;">
    <h2 style="font-size: 16px; margin: 0;">LAPORAN DATA BARANG</h2>
    <h3 style="font-size: 14px; margin: 0;">Inventori Unit Teknologi Informasi</h3>
</div>

        @php $isPdf = request()->has('pdf'); @endphp

        <table>
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Kode Barang</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Kondisi</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td>{{ ucfirst($item->kondisi) }}</td>
                     <td>{{ $item->deskripsi }}</td>
                    <td class="text-center" style="border: 1px solid #000; padding: 4px;">
                        @if ($item->foto  && file_exists(public_path('storage/' . $item->bukti)))
                        <img src="{{ public_path('storage/' . $item->foto) }}"
                            alt="Foto Barang"
                            style="max-width: 80px; height: auto; display: block; margin: 0 auto;">
                        @else
                        Tidak ada foto
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>