<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionsController extends Controller
{
    
    public function index(Request $request)
    {
        $data = Permission::all(); 
    
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                $button = "<div class='d-flex'>";
                $button .= "<a href='" . route('permission.edit', ['id' => $data->id]) . "' class='btn btn-outline-success btn-sm me-1'><i class='fas fa-edit nav-icon'></i></a>";
                $button .= "<button id='".$data->id."' name='hapus' class='hapus btn btn-outline-danger btn-sm me-1'><i class='fas fa-trash'></i></button>";
                $button .= "</div>";
            
                return $button;
            })
                
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.permissions.index');

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions',
        ], [
            'name.required' => 'Nama permissions tidak boleh kosong'
        ]);
        
        Permission::create($validated);

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
