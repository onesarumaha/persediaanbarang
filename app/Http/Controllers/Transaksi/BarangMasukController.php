<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\BarangMasukRequest;
use App\Models\Master\BarangModel;
use App\Models\Transaksi\BarangMasukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang Masuk';
        $data = BarangMasukModel::where('type','OUT')->latest()->paginate(10);
        return view('transaksi.in.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Barang Masuk';
        $data = BarangModel::all();
        return view('transaksi.in.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangMasukRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = BarangMasukModel::create($request->all());

            $model->barangMasukItems()->createMany($request->input('barang_items'));

            DB::commit();

            Alert::success('Berhasil','Barang masuk berhasil dibuat!');

            return redirect()->route('barang-masuk.view', ['id' => $model->id]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error create Barang Masuk : '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to create Barang masuk' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'View';
        $data = BarangMasukModel::findOrFail($id); 
        return view('transaksi.in.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update';
        $transaksi = BarangMasukModel::findOrFail($id); 
        $transaksiItems = $transaksi->barangMasukItems()->get(); 
        $data = BarangModel::all();
        return view('transaksi.in.update', compact('title', 'data', 'transaksi', 'transaksiItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $barangMasuk = BarangMasukModel::findOrFail($id);
            
            $barangMasuk->update($request->all());
        
            $barangMasukItems = $request->input('barang_items', []);
            
            $keyed = collect($barangMasukItems)
                ->mapWithKeys(function ($item) {
                    return [$item['id'] ?? null => $item['id'] ?? null];
                })
                ->filter()
                ->all();

        
            $barangMasuk->barangMasukItems()->whereNotIn("id", $keyed)->delete();
        
            foreach ($barangMasukItems as $item) {
                if (isset($item['id'])) {
                    $barangMasuk->barangMasukItems()->updateOrCreate(
                        ['id' => $item['id']],
                        $item
                    );
                } else {
                    $barangMasuk->barangMasukItems()->create($item);
                }
            }
        
            DB::commit();
        
            Alert::success('Berhasil', 'Barang Masuk berhasil diperbarui!');
            return redirect()->route('barang-masuk.view', ['id' => $barangMasuk->id]);

    
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
        //
    }
}
