<?php

namespace App\Http\Controllers;

use App\Models\Laporan\Laporan;
use App\Models\Transaksi\BarangMasukModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::orderBy('tanggal', 'desc')->paginate(10); // Fetch reports ordered by date, paginated
        $title = 'Laporan';
        return view('laporan.index', compact('laporans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view to create a new report
        $title = 'Buat Laporan';
        return view('laporan.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'status' => 'required|string|max:50',
            'id_user' => 'required|integer|exists:users,id', // Assuming there's a users table
        ]);

        // Create a new report using the validated data
        Laporan::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        // Return a view to show the details of a specific report

        $filter = request()->get('filter'); // misal: 'barang_masuk'
        $filterBy = request()->get('filterBy'); // misal: 'month'

        $data = [];

        if ($filter == 'barang_masuk') {
            $data = BarangMasukModel::all(); // atau query sesuai filterBy
        }

        $laporans = [
            'filter' => $filter,
            'data' => $data,
        ];

        return view('laporan.show', compact('laporans', 'filterBy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        // Return a view to edit the specified report
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        // Validate the incoming request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'status' => 'required|string|max:50',
            'id_user' => 'required|integer|exists:users,id', // Assuming there's a users table
        ]);

        // Update the report with the validated data
        $laporan->update($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        // Delete the specified report
        $laporan->delete();

        // Redirect to the index page with a success message
        return redirect()->route('laporan.index')->with('success', 'Laporan deleted successfully.');
    }
}
