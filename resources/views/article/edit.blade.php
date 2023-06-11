@extends('layouts.admin')
@section('title', 'Edit Data Table Article')

@section('content')


<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
        width="60">
</div>

<div class="card">
    @include('layouts._flash')
    <div class="card-header mb-3 border-bottom">
        <th>
            <tr>
                <th>
                    @yield('title')
                </th>
            </tr>
        </th>
    </div>
    <div class="card-body">
        <center>
            <h5>Masukan Data Form Article</h5>
        </center>
        <form action="{{ route('article.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12 form-group p-2">
                <label for="">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $data->judul) }}"
                    class="form-control @error('judul') is-invalid @enderror" required>
                @error('judul')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-md-12 form-group p-2">
                <label for="">Isi</label>
                <input type="text" name="isi" value="{{ old('isi', $data->isi) }}"
                    class="form-control @error('isi') is-invalid @enderror" required>
                @error('isi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-md-12 form-group p-2">
                <label for="">Pembuat</label>
                <input type="text" name="pembuat" value="{{ old('pembuat', $data->pembuat) }}"
                    class="form-control @error('pembuat') is-invalid @enderror" required>
                @error('pembuat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-md-12 form-group p-2">
                <label for="">Tanggal Dibuat</label>
                <input type="date" name="tanggal_dibuat" value="{{ old('tanggal_dibuat', $data->tanggal_dibuat) }}"
                    class="form-control @error('tanggal_dibuat') is-invalid @enderror" required>
                @error('tanggal_dibuat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-md-12 form-group p-2">
                <label class="form-label">Foto wisata</label>
                @if (isset($data) && $data->foto)
                <p>
                    <img src="{{ asset('images/article/' . $data->foto) }}" class="img-rounded img-responsive"
                        style="width: 200px; height:150px;" alt="">
                </p>
                @endif
                <input type="file" class="form-control  @error('foto') is-invalid @enderror" name="foto"
                    value="{{ $data->foto }}">
                @error('foto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <center>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('article.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </center>
        </form>
    </div>
</div>
@endsection