<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaksi\BarangKeluarRequest;
use App\Models\Master\BarangModel;
use App\Models\Transaksi\BarangKeluarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang Keluar';
        $data = BarangKeluarModel::all();
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

            $model->barangMasukItem()->createMany($request->input('barang_items'));

            DB::commit();

            session()->flash('success', 'Barang Keluar has been successfully created!');

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
        return view('transaksi.out.view', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update';
        $transaksi = BarangKeluarModel::findOrFail($id); 
        $data = BarangModel::all();
        return view('transaksi.out.update', compact('title', 'data', 'transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
