<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\HistoryBarangModel;
use App\Models\Master\BarangModel;
use App\Traits\HasStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    use HasStock;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $title = 'Data Barang';
    $satuans = ['pcs', 'kg', 'box', 'liter'];

    $query = BarangModel::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama_barang', 'like', '%' . $request->search . '%')
              ->orWhere('satuan', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
    }

    $data = $query->paginate(5)->withQueryString();

    return view('master.barang.index', compact('title', 'data', 'satuans'));

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
        $history = HistoryBarangModel::where('barang_id', $id)->paginate(5);
        return view('master.barang.show', compact('title', 'data', 'history'));
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

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function getStock($id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return response()->json(['stock' => 0]);
        }

        return response()->json(['stock' => $barang->stok]);
    }

    public static function updateStock($barangId, $quantity, $parentId = null, $note = null, $type = null, $from = null)
    {
        DB::beginTransaction();

        try {
            $barang = BarangModel::findOrFail($barangId);
            $stockAwal = $barang->stok;

            if ($type === 'in') {
                $stockAkhir = $stockAwal + $quantity;
            } elseif ($type === 'out') {
                $stockAkhir = $stockAwal - $quantity;
            } else {
                throw new \Exception("Tipe transaksi tidak valid: harus 'in' atau 'out'");
            }

            $barang->stok = $stockAkhir;
            $barang->save();

            HistoryBarangModel::create([
                'barang_id'    => $barangId,
                'user_id'      => Auth::id(),
                'parent_id'    => $parentId,
                'stock_awal'   => $stockAwal,
                'quantity'     => $quantity,
                'stock_akhir'  => $stockAkhir,
                'note'         => $note ?? 'Update stok otomatis',
                'from'         => $from ?? 'unknown',
                'type'         => $type,
                'created_at'   => now(),
            ]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            \log::error('Update stok gagal: ' . $e->getMessage());
            return false;
        }
    }



}
