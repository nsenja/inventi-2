<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk</title>
</head>
<body>
    <h2>Data Barang Masuk</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->barang->nama_barang ?? 'Barang NULL' }}</td>
                <td>{{ $item->barang->kategori->nama_kategori ?? 'Kategori NULL' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->tanggal_masuk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
