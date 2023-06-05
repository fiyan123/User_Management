@extends('layouts.admin')
@section('title', 'Table Article')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard v2</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Article</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        @include('layouts._flash')
        <div class="card-header mb-3 border-bottom">
            <th>
                <tr>
                    <th>
                        @yield('title')
                    </th>
                    <th>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#modal-default" style="float: right;">
                            Tambah Data
                        </button>
                    </th>
                </tr>
            </th>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Nama Pembuat</th>
                        <th>Tanggal Dibuat</th>
                        <th>Isi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->pembuat }}</td>
                        <td>{{ $item->tanggal_dibuat }}</td>
                        <td>{{ $item->isi }}</td>
                        <td>
                            <form action="{{ route('article.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('article.edit', $item->id) }}" class="btn btn-success btn-sm me-1"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Data">
                                    <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                </a>
                                <a href="{{ route('article.show', $item->id) }}" class="btn btn-info btn-sm me-1"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data">
                                    <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm me-1"
                                    onclick="return confirm('Hapus Data Ini?')" data-bs-placement="top"
                                    title="Hapus Data">
                                    <i class='fas fa-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('article.create')

</section>
@endsection