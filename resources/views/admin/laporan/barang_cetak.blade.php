<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang</title>
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

        h2 {
            text-align: center;
        }

        .img-thumbnail {
            width: 60px;
            height: auto;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Data Barang</h2>

    <table>
        <thead>
            <tr>
                <th class="text-center">Nama Kategori</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Kondisi</th>
                <th class="text-center">Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
            <tr>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td class="text-center">{{ $item->jumlah }}</td>
                <td>{{ ucfirst($item->kondisi) }}</td>
                <td class="text-center">
                    @if ($item->foto && file_exists(public_path('storage/' . $item->foto)))
                    @php
                    $path = public_path('storage/' . $item->foto);
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    @endphp
                    <img src="{{ $base64 }}" class="img-thumbnail" />
                    @else
                    -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>