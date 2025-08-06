<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .img-thumbnail {
            width: 60px;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Laporan Barang Masuk</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Nama Kategori</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Jumlah</th>
                <th>Catatan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_masuk }}</td>
                    <td>{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->barang->kode_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                    <td>
                        @if ($item->bukti && file_exists(public_path('storage/' . $item->bukti)))
                            @php
                                $path = public_path('storage/' . $item->bukti);
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" class="img-thumbnail" />
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
