@extends('layouts.admin')
@section('title', 'Table Role Dan Permissions User')
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
                    <li class="breadcrumb-item active">Users</li>
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
                <span class="info-box-text">Permissions</span>
                <span class="info-box-number">{{ $permission }}</span>
            </div>
        </div>
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Roles</span>
                <span class="info-box-number">{{ $role }}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Account Members</span>
                <span class="info-box-number">{{ $user }}</span>
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
                        <button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal"
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
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('usersRole.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @foreach ($roles as $role)
                                <div>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{
                                        $user->hasRole($role) ?
                                    'checked' : '' }}>
                                    <label>{{ $role->name }}</label>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-sm btn-success mx-auto d-block mt-3">Save
                                    changes</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('usersPermission.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{
                                        $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                    <label>{{ $permission->name }}</label>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-sm btn-success mx-auto d-block mt-3">Save
                                    changes</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('users.create')

@endsection