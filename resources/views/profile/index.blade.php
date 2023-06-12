@extends('layouts.admin')
@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="col-lg-12">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Id</b> <a class="float-right">{{ Auth::user()->id }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Account Created</b> <a class="float-right">{{ Auth::user()->created_at }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        @include('layouts._flash')
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                    <button type="button" id="addButton" class="btn btn-sm btn-dark" data-toggle="modal"
                        data-target="#modal-default" style="float: right;">
                        Tambah Data
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @foreach ($data as $item)
                    @if ($item->user_id == Auth::user()->id) {{-- Menampilkan data yang dibuat oleh pengguna saat ini
                    --}}
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                    <p class="text-muted">
                        {{ $item->edukasi }}
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                    <p class="text-muted">{{ $item->alamat }}</p>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Phone</strong>
                    <p class="text-muted">
                        {{ $item->no_telepon }}
                    </p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                    <p class="text-muted">{{ $item->notes }}</p>
                    @endif
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@include('profile.create')
@endsection