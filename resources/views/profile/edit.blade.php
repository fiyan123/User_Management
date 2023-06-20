@extends('layouts.admin')
@section('title', 'Edit Data Profile')

@section('content')


<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
        width="60">
</div>

<div class="card">
    @include('sweetalert::alert')
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
            <h5>Masukan Data Form Profile</h5>
        </center>
        <form action="{{ route('profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Edukasi / Pendidikan</label>
                    <input type="text" class="form-control  @error('edukasi') is-invalid @enderror" name="edukasi"
                        value="{{ old('edukasi', $data->edukasi) }}" placeholder="edukasi">

                    @error('edukasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Anda</label>
                    <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror" id=""
                        cols="" rows="" placeholder="alamat anda">{{ old('alamat', $data->alamat) }}</textarea>

                    @error('alamat')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="notes" class="form-control  @error('notes') is-invalid @enderror" id="" cols=""
                        rows="" placeholder="catatan anda">{{ old('notes', $data->notes) }}</textarea>

                    @error('notes')
                    <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="number" class="form-control  @error('no_telepon') is-invalid @enderror"
                        name="no_telepon" value="{{ old('no_telepon', $data->no_telepon) }}" placeholder="no telepon anda">

                    @error('no_telepon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            <center>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>&nbsp;
                    <a href="{{ route('profile.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </center>
        </form>
    </div>
</div>
@endsection