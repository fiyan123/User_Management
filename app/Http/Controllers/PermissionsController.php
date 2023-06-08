<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create($validatedData);

        return redirect()->route('permission.index')->with('success', 'Permission Berhasil dibuat!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permissions = Permission::find($id);

        return view('admin.permissions.edit', compact('permissions'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $permissions = Permission::findOrFail($id);

        $permissions->name  = $request->name;
        $permissions->save();

        return redirect()->route('permission.index')->with('success', 'Permission Berhasil Diubah');
    }

    public function destroy(Request $request)
    {
        $permissions = Permission::findOrFail($request->id);
        $permissions->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
