<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        //
    }
   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create($validatedData);

        return redirect()->route('role.index')->with('success', 'Role Berhasil dibuat!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);

        return view('roles.edit', compact('roles'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Temukan role berdasarkan ID
        $roles = Role::findOrFail($id);

        // Update data role
        $roles->name = $request->input('name');
        // Lakukan perubahan lainnya sesuai kebutuhan

        // Simpan perubahan
        $roles->save();

        // Redirect atau melakukan tindakan lain setelah update berhasil
        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $roles = Role::findOrFail($request->id);
        $roles->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
