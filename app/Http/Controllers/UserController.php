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
        
        return view('users.index', compact('users', 'user' , 'permissions','roles','permission','role'));
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

    // Update Permissions Users
    public function updatePermissionUsers(Request $request, User $user)
    {
        $permissions = $request->input('permissions', []);

        $user->syncPermissions($permissions);

        return redirect()->route('users.index')->with('success', 'Permissions Users Berhasil Diubah!');
    }

    // Update Roles Users
    public function updateRoleUsers(Request $request, User $user)
    {
        $roles = $request->input('roles', []);

        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Role Users Berhasil Diubah!');
    }
}

