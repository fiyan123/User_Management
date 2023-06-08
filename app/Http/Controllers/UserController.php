<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $user = User::count();

        $permissions = Permission::all();
        $permission = Permission::count();

        $roles = Role::all();
        $role = Role::count();
        
        return view('admin.users.index', compact('users', 'user' , 'permissions','roles','permission','role'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        // Validasi Akun
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $users = new User();

        $users->name     = $request->name;
        $users->email    = $request->email;
        $users->password = bcrypt($validated['password']);
        $users->save();

        return redirect()->route('users.index')->with('success', 'Users berhasil ditambah!');
    }

    public function updateRolesAndPermissions(Request $request, $user)
    {
        // Mengupdate peran pengguna
        $user = User::findOrFail($user);
        $user->roles()->sync($request->input('roles', []));

        // Mengupdate izin pengguna
        $user->permissions()->sync($request->input('permissions', []));

        // Redirect atau melakukan tindakan lain setelah berhasil mengupdate data
        return redirect()->route('users.index')->with('success', 'Roles Dan Permissions Berhasil Diubah.');
    }

}

