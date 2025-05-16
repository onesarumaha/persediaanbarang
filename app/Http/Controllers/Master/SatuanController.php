<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\SatuanModel;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Satuan';
        $data = SatuanModel::paginate(5);
        return view('master.satuan.index', compact('title', 'data'))->with('title', 'Data Satuan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Satuan';
        $satuans = ['pcs', 'kg', 'box', 'liter'];
        $data = SatuanModel::all();
        return view('master.satuan.create', compact('title', 'satuans', 'data'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required',
        ]);

        SatuanModel::create($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Satuan';
        $data = SatuanModel::findOrFail($id);
        return view('master.satuan.show', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Satuan';
        $data = SatuanModel::findOrFail($id);
        return view('master.satuan.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'satuan' => 'required',
        ]);

        $satuan = SatuanModel::findOrFail($id);
        $satuan->update([
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $satuan = SatuanModel::findOrFail($id);
        $satuan->delete();

        return redirect()->route('satuan.index')->with('danger', 'Data berhasil dihapus.');

    }
}
