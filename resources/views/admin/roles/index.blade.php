@extends('layouts.admin')
@section('title', 'Table Roles Users')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
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
                <span class="info-box-text">Account Members</span>
                <span class="info-box-number">100</span>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        @include('sweetalert::alert')
        <div class="card-header mb-3 border-bottom">
            <th>
                <tr>
                    <th>
                        @yield('title')
                    </th>
                    <th>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#modal-roles" style="float: right;">
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
                        <th>Nama Roles</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('role.edit', $item->id) }}" class="btn btn-success btn-sm me-1"
                                title="Ubah Data">
                                <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                            </a>
                            <button class="hapus btn btn-danger btn-sm me-1" name="hapus" id="{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.roles.create')
</section>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.hapus', function () {
        let id = $(this).attr('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('role.destroy', '') }}" + "/" + id,
                    type: 'post',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res, status){
                        if (status === 'success') {
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((res) => {
                                    location.reload(); // Memuat ulang halaman
                                });
                            }, 500);
                        }
                    },
                    error: function(xhr){
                        Swal.fire({
                            icon: 'error',
                            title: 'Izin Tidak Diberikan!',
                        });
                    }
                });
            }
        });
    });
</script>
@endsection