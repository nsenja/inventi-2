<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    
    public function index()
    {
        $barangKeluar = BarangKeluar::with('barang')->latest()->get();
        return view('admin.barangKeluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('admin.barangKeluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal_keluar' => 'required|date',
        'catatan' => 'nullable|string',
        'bukti' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    
    $barang = Barang::findOrFail($request->barang_id);

    // ✅ Cek apakah stok mencukupi
    if ($request->jumlah > $barang->jumlah) {
        return back()->withErrors(['jumlah' => 'Stok barang tidak cukup!'])->withInput();
    }

    // ✅ Simpan file bukti jika ada
    $buktiPath = null;
    if ($request->hasFile('bukti')) {
        $buktiPath = $request->file('bukti')->store('bukti_keluar', 'public');
    }

    // ✅ Simpan barang keluar
    BarangKeluar::create([
        'barang_id' => $request->barang_id,
        'jumlah' => $request->jumlah,
        'tanggal_keluar' => $request->tanggal_keluar,
        'catatan' => $request->catatan,
        'bukti' => $buktiPath,
    ]);

    // ✅ Kurangi stok barang
    $barang->decrement('jumlah', $request->jumlah);

    return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil ditambahkan!');
}

    public function edit(BarangKeluar $barangKeluar)
    {
        $barangs = Barang::all();
        return view('admin.barangKeluar.edit', compact('barangKeluar', 'barangs'));
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Cek stok barang cukup
        $barang = Barang::findOrFail($validated['barang_id']);

        if ($barang->stok + $barangKeluar->jumlah < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok barang tidak cukup!'])->withInput();
        }

        // Upload bukti jika ada
        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti-barang-keluar', 'public');
        }

        // Update stok
        $barang->stok += $barangKeluar->jumlah - $validated['jumlah'];
        $barang->save();

        // Update transaksi barang keluar
        $barangKeluar->update($validated);

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil diperbarui.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        // Kembalikan stok barang
        $barang = Barang::findOrFail($barangKeluar->barang_id);
        $barang->stok += $barangKeluar->jumlah;
        $barang->save();

        // Hapus transaksi barang keluar
        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }       
}

