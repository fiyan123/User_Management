<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $data = Article::orderBy('id','DESC')->get();
    
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    
                $button = "<div class='d-flex'>";
                $button .= "<a href='".route('article.show', ['id' => $data->id])."'> <span class='btn btn-outline-warning btn-sm me-1'><i class='fa fa-eye'></i></span></a>";
                $button .= "<a href='" . route('article.edit', ['id' => $data->id]) . "' class='btn btn-outline-success btn-sm me-1'><i class='fas fa-pencil-alt'></i></a>";
                $button .= "<button id='".$data->id."' name='hapus' class='hapus btn btn-outline-danger btn-sm me-1'><i class='fas fa-trash'></i></button>";
                $button .= "</div>";
            
                return $button;
            })
                
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('article.index');
    }

    public function create()
    {
        if (!auth()->user()->hasPermissionTo('create articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');
        }
        else {
            return redirect()->view('article.create');
        }
    }

    public function store(Request $request)
    {
        // Pengecekan role dan izin
        if (!auth()->user()->hasPermissionTo('create articles')) {
            return redirect()->back()->with('error', 'Permissions Denied!');
        }
        else {

            $validated = [
                'judul'          => 'required|unique:articles',
                'isi'            => 'required',
                'tanggal_dibuat' => 'required',
                'foto'           => 'required|image|max:2048',
            ];

            $text = [
                'judul.required'          => 'judul tidak boleh kosong,',
                'isi.required'            => 'isi article tidak boleh kosong,',
                'tanggal_dibuat.required' => 'tanggal tidak boleh kosong,',
                'foto.required'           => 'foto tidak boleh kosong,',
            ];

            $validasi = Validator::make($request->all(), $validated, $text);

            if ($validasi->fails()) {
                return redirect()->back()->withErrors($validasi)->withInput();
            }


            $data = new Article();

            $data->judul            = $request->judul;
            $data->isi              = $request->isi;
            $data->pembuat          = Auth::user()->name;
            $data->tanggal_dibuat   = $request->tanggal_dibuat;

            // image
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $name = rand(1000, 9999) . $image->getClientOriginalName();
                $image->move('images/article/', $name);

                $data->foto = $name;
            }
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
            return redirect()->back()->with('error', 'Permissions Denied!');
        }
        else {
           $validated = $request->validate([
                'judul'          => 'required',
                'isi'            => 'required',
                // 'pembuat'        => 'required',
                'tanggal_dibuat' => 'required',
                'foto'           => 'image|max:2048',
            ]);

            $data = Article::findOrFail($id);

            $data->judul            = $request->judul;
            $data->isi              = $request->isi;
            // $data->pembuat          = $request->pembuat;
            $data->tanggal_dibuat   = $request->tanggal_dibuat;

            if ($request->hasFile('foto')) {
                $data->deleteImage(); //menghapus foto sebelum di update melalui method deleteImage di model
                $image = $request->file('foto');
                $name = rand(1000, 9999) . $image->getClientOriginalName();
                $image->move('images/article/', $name);
                $data->foto = $name;
            }
            $data->save();

            return redirect()->route('article.index')->with('success', 'Data Berhasil Diedit');
        }
    }

    public function destroy(Request $request)
    {
        // Pengecekan role dan izin
        $data = Article::findOrFail($request->id);

        $user = Auth::user();

        if ($user->hasPermissionTo('delete articles')) {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Permission denied.'
            ], 403);
        }
    }
}

