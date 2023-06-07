<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::orderBy('id','DESC')->get();

        return view('article.index',compact('data'));
    }

    public function create()
    {
        if (!auth()->user()->hasPermissionTo('create articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');;
        }
        else {
            return redirect()->view('article.create');
        }
    }

    public function store(Request $request)
    {
        // Pengecekan role dan izin
        if (!auth()->user()->hasPermissionTo('create articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');;
        }
        else {
           $validated = $request->validate([
                'judul'          => 'required|unique:articles',
                'isi'            => 'required',
                'pembuat'        => 'required',
                'tanggal_dibuat' => 'required',
            ]);

            $data = new Article();

            $data->judul            = $request->judul;
            $data->isi              = $request->isi;
            $data->pembuat          = $request->pembuat;
            $data->tanggal_dibuat   = $request->tanggal_dibuat;
            $data->save();

            return redirect()->route('article.index')->with('success', 'Data Berhasil Ditambah');
        }
    }

    public function show($id)
    {
        $data = Article::find($id);

        return view('article.show', compact('data'));
    }

    public function edit($id)
    {
        // Pengecekan role dan izin
        if (!auth()->user()->hasPermissionTo('edit articles')) {

            return redirect()->back()->with('error', 'Permissions Denied!');
        }
        else {

            $data = Article::findOrFail($id);

            return view('article.edit', compact('data'));
        }
    }

    public function update(Request $request, $id)
    {
        // Pengecekan role dan izin
       if (!auth()->user()->hasPermissionTo('edit articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');;
        }
        else {
           $validated = $request->validate([
                'judul'          => 'required',
                'isi'            => 'required',
                'pembuat'        => 'required',
                'tanggal_dibuat' => 'required',
            ]);

            $data = Article::findOrFail($id);

            $data->judul            = $request->judul;
            $data->isi              = $request->isi;
            $data->pembuat          = $request->pembuat;
            $data->tanggal_dibuat   = $request->tanggal_dibuat;
            $data->save();

            return redirect()->route('article.index')->with('success', 'Data Berhasil Diedit');
        }
    }

    public function destroy($id)
    {
        // Pengecekan role dan izin
        if (!auth()->user()->hasPermissionTo('delete articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');;
        }
        else {
            $data = Article::findOrFail($id);

            $data->delete();

            return redirect()->route('article.index')->with('success', 'Data Berhasil Dihapus');;
        }
    }
}

