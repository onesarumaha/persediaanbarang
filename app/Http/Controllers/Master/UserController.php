<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\UserRequest;
use App\Models\Master\UserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Users';
        $data = User::latest()->paginate(10);;
        return view('master.user.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User';
        return view('master.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        $user = UserModel::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('123456'),
        ]);
    
        Alert::success('Berhasil','User berhasil dibuat!');

        return redirect()->route('user.show', ['id' => $user->id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail User';
        $data = UserModel::findOrFail($id);
        return view('master.user.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User';
        $data = UserModel::findOrFail($id);
        return view('master.user.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = UserModel::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        Alert::success('Berhasil', 'User berhasil diperbarui!');

        return redirect()->route('user.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        DB::beginTransaction();
    
        try {
            $user = UserModel::findOrFail($id);
    
            $user->delete();
    
            DB::commit();
    
            Alert::success('Berhasil', 'User berhasil dihapus!');

            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
