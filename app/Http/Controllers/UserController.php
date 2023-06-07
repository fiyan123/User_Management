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
        $roles = Role::all();
        return view('users.index', compact('users', 'user' , 'permissions','roles'));
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


    // Create Permissions
    public function storePermission(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Permission Berhasil dibuat!');
    }

    // Update Permissions
    public function update(Request $request, User $user)
    {
        $permissions = $request->input('permissions', []);

        $user->syncPermissions($permissions);

        return redirect()->route('users.index')->with('success', 'Permissions Berhasil Diubah!');
    }


    // Create Role
    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Role Berhasil dibuat!');
    }

    // Update Roles
    public function updateRole(Request $request, User $user)
    {
        $roles = $request->input('roles', []);

        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Role Berhasil Diubah!');
    }
}

