<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaksi\BarangKeluarRequest;
use App\Models\Master\BarangModel;
use App\Models\Transaksi\BarangKeluarItemModel;
use App\Models\Transaksi\BarangKeluarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang Keluar';
        $data = BarangKeluarModel::latest()->paginate(10);
        return view('transaksi.out.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Barang Keluar';
        $data = BarangModel::all();
        return view('transaksi.out.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangKeluarRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = BarangKeluarModel::create($request->all());

            $model->barangKeluarItems()->createMany($request->input('barang_items'));

            DB::commit();

            Alert::success('Berhasil','Barang Keluar berhasil dibuat!');

            return redirect()->route('barang-keluar.view', ['id' => $model->id]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error create Barang Keluar : '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to create Barang Keluar: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'View';
        $data = BarangKeluarModel::findOrFail($id); 
        return view('transaksi.out.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update';
        $transaksi = BarangKeluarModel::findOrFail($id); 
        $transaksiItems = $transaksi->barangKeluarItems()->get(); 
        $data = BarangModel::all();
        return view('transaksi.out.update', compact('title', 'data', 'transaksi', 'transaksiItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(BarangKeluarRequest $request, string $id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $transaksi = BarangKeluarModel::findOrFail($id);
    //         $transaksi->update([
    //             'tanggal' => $request->tanggal,
    //             'deskripsi' => $request->deskripsi,
    //         ]);

    //         if ($request->has('barang_items')) {
    //             $existingItemIds = [];
                
    //             foreach ($request->barang_items as $item) {
    //                 if (isset($item['id']) && !empty($item['id'])) {
    //                     $barangItem = BarangKeluarItemModel::findOrFail($item['id']);
    //                     $barangItem->update([
    //                         'barang_id' => $item['barang_id'],
    //                         'quantity' => $item['quantity'],
    //                         'deskripsi' => $item['deskripsi'] ?? null
    //                     ]);
                        
    //                     $existingItemIds[] = $item['id'];
    //                 } else {
    //                     $transaksi->barangKeluarItems()->create([
    //                         'barang_id' => $item['barang_id'],
    //                         'quantity' => $item['quantity'],
    //                         'deskripsi' => $item['deskripsi'] ?? null
    //                     ]);
    //                 }
    //             }
                
    //             $transaksi->barangKeluarItems()
    //                 ->whereNotIn('id', $existingItemIds);
    //         }

    //         DB::commit();

    //         Alert::success('Berhasil', 'Barang Keluar berhasil diperbarui!');

    //         return redirect()->route('barang-keluar.view', ['id' => $transaksi->id]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Error update Barang Keluar : '.$e->getMessage());

    //         return redirect()->back()->withErrors(['error' => 'Gagal memperbarui Barang Keluar: ' . $e->getMessage()]);
    //     }
    // }

    public function update(BarangKeluarRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $barangKeluar = BarangKeluarModel::findOrFail($id);
            
            $barangKeluar->update($request->all());
        
            $barangKeluarItems = $request->input('barang_items', []);
            
            $keyed = collect($barangKeluarItems)
                ->mapWithKeys(function ($item) {
                    return [$item['id'] ?? null => $item['id'] ?? null];
                })
                ->filter()
                ->all();

                // dd($keyed);
        
            $barangKeluar->barangKeluarItems()->whereNotIn("id", $keyed)->delete();
        
            foreach ($barangKeluarItems as $item) {
                if (isset($item['id'])) {
                    $barangKeluar->barangKeluarItems()->updateOrCreate(
                        ['id' => $item['id']],
                        $item
                    );
                } else {
                    $barangKeluar->barangKeluarItems()->create($item);
                }
            }
        
            DB::commit();
        
            Alert::success('Berhasil', 'Barang Keluar berhasil diperbarui!');
            return redirect()->route('barang-keluar.view', ['id' => $barangKeluar->id]);
    
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
    
        try {
            $barangKeluar = BarangKeluarModel::findOrFail($id);
    
            $barangKeluar->barangKeluarItems()->delete(); 
    
            $barangKeluar->delete();
    
            DB::commit();
    
            Alert::success('Berhasil', 'Barang Keluar berhasil dihapus!');
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}
