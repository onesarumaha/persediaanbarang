<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\StockOpnameRequest;
use App\Models\Master\BarangModel;
use App\Models\Transaksi\StockOpnameModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class StockOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Stock Opname';
        $data = StockOpnameModel::paginate(5);
        return view('transaksi.opname.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Stock Opname';
        $data = BarangModel::all();
        return view('transaksi.opname.create', compact('title', 'data'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StockOpnameRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = StockOpnameModel::create($request->all());

            $model->stockOpnameItems()->createMany($request->input('stock_opname'));

            DB::commit();

            Alert::success('Berhasil','Stock Opname berhasil dibuat!');

            return redirect()->route('stock-opname.show', ['stock_opname' => $model->id]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error create Stock Opname : '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to create Stock Opname' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'View';
        $data = StockOpnameModel::findOrFail($id); 
        return view('transaksi.opname.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Uptdate Stock Opname';
        $opname = StockOpnameModel::findOrFail($id); 
        $opnameItems = $opname->stockOpnameItems()->get(); 
        $data = BarangModel::all();

        return view('transaksi.opname.update', compact('title', 'opname', 'opnameItems', 'data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockOpnameRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $opname = StockOpnameModel::findOrFail($id);
            
            $opname->update($request->all());
        
            $stockOpnameItems = $request->input('stock_opname', []);
            
            $keyed = collect($stockOpnameItems)
                ->mapWithKeys(function ($item) {
                    return [$item['id'] ?? null => $item['id'] ?? null];
                })
                ->filter()
                ->all();

        
            $opname->stockOpnameItems()->whereNotIn("id", $keyed)->delete();
        
            foreach ($stockOpnameItems as $item) {
                if (isset($item['id'])) {
                    $opname->stockOpnameItems()->updateOrCreate(
                        ['id' => $item['id']],
                        $item
                    );
                } else {
                    $opname->stockOpnameItems()->create($item);
                }
            }
        
            DB::commit();
        
            Alert::success('Berhasil', 'Stock Opname berhasil diperbarui!');
            return redirect()->route('stock-opname.show', ['stock_opname' => $opname->id]);


    
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
            $opname = StockOpnameModel::findOrFail($id);
    
            foreach ($opname->stockOpnameItems as $item) {
                $item->delete(); 
            }
    
            $opname->delete();
    
            DB::commit();
    
            Alert::success('Berhasil', 'Stock Opname berhasil dihapus!');
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function approve(string $id) 
    {
        DB::beginTransaction();
    
        try {
            $opname = StockOpnameModel::findOrFail($id);
            $opname->status = 'OP-DONE';
            $opname->save(); 
    
            DB::commit();
    
            Alert::success('Berhasil', 'Stock Opname berhasil diapprove!');
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
