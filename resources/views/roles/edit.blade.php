@extends('layouts.admin')
@section('title', 'Edit Data Table Role')

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
            <h5>Masukan Data Form Roles</h5>
        </center>
        <form action="{{ route('role.update', $roles->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12 form-group p-2">
                <label for="">Nama Roles</label>
                <input type="text" name="name" value="{{ old('name', $roles->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <center>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>&nbsp;
                    <a href="{{ route('role.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </center>
        </form>
    </div>
</div>
@endsection