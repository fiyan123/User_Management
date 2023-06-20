<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
       $data = Role::all(); 
    
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                $button = "<div class='d-flex'>";
                $button .= "<a href='" . route('role.edit', ['id' => $data->id]) . "' class='btn btn-outline-success btn-sm me-1'><i class='fas fa-edit nav-icon'></i></a>";
                $button .= "<button id='".$data->id."' name='hapus' class='hapus btn btn-outline-danger btn-sm me-1'><i class='fas fa-trash'></i></button>";
                $button .= "</div>";
            
                return $button;
            })
                
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.roles.index');
    }

    public function create()
    {
        //
    }
   
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|unique:roles'
        ], [
            'name.required' => 'Nama role tidak boleh kosong'
        ]);
        
        Role::create($validated);
        
        return redirect()->route('role.index')->with('success', 'Role berhasil dibuat!');        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);

        return view('admin.roles.edit', compact('roles'));
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
