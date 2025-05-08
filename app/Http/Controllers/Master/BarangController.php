<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\HistoryBarangModel;
use App\Models\Master\BarangModel;
use App\Traits\HasStock;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    use HasStock;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang';
        $data = BarangModel::all();
        return view('master.barang.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Barang';
        return view('master.barang.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        BarangModel::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Barang';
        $data = BarangModel::findOrFail($id);
        return view('master.barang.show', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Barang';
        $data = BarangModel::findOrFail($id);
        return view('master.barang.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = BarangModel::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $barang->update($request->all());

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = BarangModel::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }

    public function getStock($id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return response()->json(['stock' => 0]);
        }

        return response()->json(['stock' => $barang->stok]);
    }

    public static function updateStock($barangId, $quantity, $type = 'Transaksi', $direction = 'in', $referenceId = null, $description = null)
    {
        (new self)->updateStock($barangId, $quantity, $type, $direction, $referenceId, $description);
    }


}
