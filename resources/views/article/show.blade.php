@extends('layouts.admin')
@section('title', 'Detail Data Table Article')

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
            <h5>Detail Data Article</h5>
        </center>

        <div class="col-md-12 form-group p-2">
            <label for="">Judul</label>
            <input type="text" name="judul" value="{{ $data->judul }}"
                class="form-control @error('judul') is-invalid @enderror" readonly>
        </div>

        <div class="col-md-12 form-group p-2">
            <label for="">Isi</label>
            <input type="text" name="isi" value="{{ $data->isi }}"
                class="form-control @error('isi') is-invalid @enderror" readonly>
        </div>

        <div class="col-md-12 form-group p-2">
            <label for="">Nama Pembuat</label>
            <input type="text" name="pembuat" value="{{ $data->pembuat }}"
                class="form-control @error('pembuat') is-invalid @enderror" readonly>
        </div>

        <div class="col-md-12 form-group p-2">
            <label for="">Tanggal Dibuat</label>
            <input type="date" name="tanggal_dibuat" value="{{ $data->tanggal_dibuat }}"
                class="form-control @error('tanggal_dibuat') is-invalid @enderror" readonly>
        </div>

        <center>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="{{ route('article.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </center>
    </div>
</div>
@endsection