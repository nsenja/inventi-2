<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('admin.barang.index', compact('barang'));
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Kategori::all();
        return view('admin.barang.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
        'category_id' => 'required|exists:categories,id',
        'nama_barang' => 'required|string|max:255',
        'kode_barang' => 'required|string|max:100|unique:barangs,kode_barang',
        'jumlah' => 'required|integer|min:0',
        'kondisi' => 'required|in:baik,rusak,diperbaiki',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi untuk foto
    ]);

    Barang::create([
            'category_id'   => $request->category_id,
            'nama_barang'   => $request->nama_barang,
            'kode_barang'   => $request->kode_barang,
            'jumlah'        => $request->jumlah,
            'kondisi'       => $request->kondisi,
            'deskripsi'     => $request->deskripsi,
            'foto'         => $request->file('foto') ? $request->file('foto')->store('foto', 'public') : null,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
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
    $categories = Kategori::all();
    $barang = Barang::with('kategori')->findOrFail($id);

    return view('admin.barang.edit', compact('barang', 'categories'));
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
    $request->validate([
        'category_id'   => 'required|exists:categories,id',
        'nama_barang'   => 'required|string|max:255',
        'kode_barang'   => 'required|string|max:100|unique:barangs,kode_barang,' . $id,
        'jumlah'        => 'required|integer|min:0',
        'kondisi'       => 'required|in:baik,rusak,diperbaiki',
        'deskripsi'     => 'nullable|string',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048', // max dalam KB (2MB)
    ]);

    $barang = Barang::findOrFail($id);
    $barang->update([
        'category_id'   => $request->category_id,
        'nama_barang'   => $request->nama_barang,
        'kode_barang'   => $request->kode_barang,
        'jumlah'        => $request->jumlah,
        'kondisi'       => $request->kondisi,
        'deskripsi'     => $request->deskripsi,
        'foto'          => $request->file('foto') ? $request->file('foto')->store('foto', 'public') : $barang->foto,
    ]);

    return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

   public function cetak(Request $request)
{
    $query = Barang::with('kategori');

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $barang = $query->orderBy('nama_barang')->get();

    $pdf = PDF::loadView('admin.laporan.barang_cetak', compact('barang'))
              ->setPaper('a4', 'portrait');

    return $pdf->download('laporan-barang.pdf'); // pakai download supaya muncul unduhan langsung
}

}
