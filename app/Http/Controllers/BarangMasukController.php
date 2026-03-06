<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $barangMasuk = BarangMasuk::with('barang.kategori')->get();
    //     return view('admin.barangMasuk.index', compact('barangMasuk'));
    // }
    public function index(Request $request)
    {
        $query = BarangMasuk::with('barang.kategori');

        if ($request->filled('search')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barangMasuk = $query->orderBy('tanggal_masuk', 'desc')->get();
        $kategoris = Kategori::all();

        return view('admin.barangMasuk.index', compact('barangMasuk', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil semua barang untuk dropdown
        // Pastikan model Barang sudah ada dan memiliki relasi kategori
        $barangs = Barang::with('kategori')->get();
        return view('admin.barangMasuk.create', compact('barangs'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id'     => 'required|exists:barangs,id',
            'jumlah'        => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'catatan'       => 'nullable|string',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',

        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        // Simpan ke tabel barang_masuk
        $barangMasuk = BarangMasuk::create($validated);

        // Update stok barang
        $barang = Barang::find($validated['barang_id']);
        $barang->jumlah += $validated['jumlah'];
        $barang->save();

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil disimpan!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Cetak laporan barang masuk.
     *
     * @return \Illuminate\Http\Response
     */
    // public function cetak()
    // {
    //     $barangMasuk = BarangMasuk::with('barang.kategori')
    //         ->orderBy('tanggal_masuk', 'asc')
    //         ->get();

    //     // Debug: uncomment jika ingin memastikan data sudah benar
    //     // dd($barangMasuk->toArray());

    //     // Muat view Blade ke dalam PDF, atur orientasi landscape
    //     $pdf = PDF::loadView('admin.laporan.barang_masuk_cetak', compact('barangMasuk'))
    //         ->setPaper('a4', 'potrait')
    //         ->setOption('isHtml5ParserEnabled', true);

    //     // Tampilkan PDF di browser tanpa mengunduh
    //     return $pdf->stream('laporan-barang-masuk.pdf');
    // }

    // public function cetak(Request $request)
    // {
    //     $query = BarangMasuk::with('barang.kategori');

    //     if ($request->filled('category_id')) {
    //         $query->whereHas('barang', function ($q) use ($request) {
    //             $q->where('category_id', $request->category_id);
    //         });
    //     }

    //     if ($request->filled('bulan')) {
    //         $query->whereMonth('tanggal_masuk', $request->bulan);
    //     }

    //     if ($request->filled('tahun')) {
    //         $query->whereYear('tanggal_masuk', $request->tahun);
    //     }

    //     $barangMasuk = $query->orderBy('tanggal_masuk', 'asc')->get();
        

    //     $pdf = PDF::loadView('admin.laporan.barang_masuk_cetak', compact('barangMasuk'))
    //         ->setPaper('a4', 'portrait')
    //         ->setOption('isHtml5ParserEnabled', true);

    //     $pdf->getDomPDF()->setBasePath(public_path());

    //     return $pdf->stream('laporan-barang-masuk.pdf');
    // }

    public function cetak(Request $request)
{
    $query = BarangMasuk::with('barang.kategori');

    if ($request->filled('category_id')) {
        $query->whereHas('barang', function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });
    }

    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal_masuk', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_masuk', $request->tahun);
    }

    $barangMasuk = $query->orderBy('tanggal_masuk', 'asc')->get();

    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $bulanDipilih = $request->filled('bulan') ? $namaBulan[(int) $request->bulan] : null;
    $tahunDipilih = $request->tahun;

    $pdf = PDF::loadView('admin.laporan.barang_masuk_cetak', compact(
        'barangMasuk',
        'bulanDipilih',
        'tahunDipilih'
    ))->setPaper('a4', 'portrait')
      ->setOption('isHtml5ParserEnabled', true);

    return $pdf->stream('laporan-barang-masuk.pdf');
}
}
