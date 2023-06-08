<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIM Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item">
                    <a href="{{ route('article.index') }}"
                        class="nav-link {{ request()->is('article*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Article Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}"
                        class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                @role('moderator')
                <li class="nav-header">MANAGEMENT USERS</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.index') }}"
                        class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permission.index') }}"
                        class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                @endrole
                <li class="nav-header">AKTIFITAS</li>
                <li class="nav-item">
                    <form id="logOut" action="/logout" method="POST">
                        @csrf
                        <a class="nav-link" id="logOut">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Keluar</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

{{-- Script Logout --}}
<script>
    const logOut = document.getElementById('logOut');
    logOut.addEventListener('click', function() {

    Swal.fire({
        title: 'Apa Anda Yakin?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Keluar'
    }).then((result) => {
    if (result.isConfirmed) {
        $('#logOut').submit()
        }
    });

});
</script>