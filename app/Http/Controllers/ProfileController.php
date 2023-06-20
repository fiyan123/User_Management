<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Profile::all();

        return view('profile.index', compact('data'));
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $validated = [
            'no_telepon' => 'required',
            'edukasi'    => 'required',
            'alamat'     => 'required',
            'notes'      => 'required'
        ];

        $text = [
            'no_telepon.required'     => 'no telepon tidak boleh kosong,',
            'edukasi.required'        => 'pendidikan tidak boleh kosong,',
            'alamat.required'         => 'alamat tidak boleh kosong,',
            'notes.required'          => 'note tidak boleh kosong,',
        ];

        $validasi = Validator::make($request->all(), $validated, $text);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        $data = new Profile();

        $data->user_id    = Auth::user()->id;
        $data->no_telepon = $request->no_telepon;
        $data->edukasi    = $request->edukasi;
        $data->alamat     = $request->alamat;
        $data->notes      = $request->notes;
        $data->save();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil dibuat!');
    }

    public function show(Profile $profile)
    {
        //
    }

    public function edit($id)
    {
        $data = Profile::find($id);

        return view('profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_telepon' => 'required',
            'edukasi'    => 'required',
            'alamat'     => 'required',
            'notes'      => 'required'
        ]);

        $data = Profile::findOrFail($id);

        $data->no_telepon = $request->no_telepon;
        $data->edukasi    = $request->edukasi;
        $data->alamat     = $request->alamat;
        $data->notes      = $request->notes;
        $data->save();

        return redirect()->route('profile.index')->with('success', 'Profile Berhasil Diedit');
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
