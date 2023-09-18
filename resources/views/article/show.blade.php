@extends('layouts.admin')
@section('title', 'Detail Data Table Article')

@section('content')

<!-- Preloader -->
{{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
        width="60">
</div> --}}

<div class="col-lg-12">
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
                <h5>Detail Data Article</h5>
            </center>
    
            <div class="col-md-12 form-group p-2">
                <label for="">Judul</label>
                <input type="text" name="judul" value="{{ $data->judul }}"
                    class="form-control @error('judul') is-invalid @enderror" readonly>
            </div>

            <div class="col-md-12 form-group p-2">
                <label class="form-label">Isi Article</label>
                <textarea name="isi" class="form-control  @error('isi') is-invalid @enderror" id="" cols=""
                    rows="" readonly >{{ old('isi', $data->isi) }}</textarea>
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
    
            <div class="row">
                <div class="col-md-12 form-group p-2 text-center">
                    <label for="">Foto Article</label>
                    @if (isset($data) && $data->foto)
                        <div>
                            <img src="{{ asset('images/article/' . $data->foto) }}" class="img-rounded img-responsive"
                                style="max-width: 500px; max-height: 350px;" alt="image">
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('article.download', $data->foto) }}" type="button" class="btn btn-primary">Unduh Foto</a>
                        </div>
                    @endif
                </div>
            </div>            
    
            <center>
                <div class="btn-group mt-3" role="group" aria-label="Basic mixed styles example">
                    <a href="{{ route('article.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </center>
        </div>
    </div>
</div>
@endsection