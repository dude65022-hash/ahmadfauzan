<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Artikel</title>
    <link href="{{ asset('adminasset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('adminasset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminasset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

<div id="wrapper">

    {{-- Sidebar --}}
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
            <div class="sidebar-brand-text mx-3">dude Etmin<sup>2</sup></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.artikel.index') }}">
                <i class="fas fa-fw fa-table"></i><span>Artikel</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            {{-- Topbar --}}
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <form class="form-inline">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </form>
            </nav>

            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Data Artikel</h1>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('admin.artikel.tambah') }}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                            <span class="text">Tambah</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Tanggal Terbit</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($articles as $no => $art)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $art->judul }}</td>
                                        <td>{{ Str::limit($art->isi, 80) }}</td>
                                        <td>{{ $art->tanggalterbit }}</td>
                                        <td>
                                            {{-- Hapus --}}
                                            <form action="{{ route('admin.artikel.destroy', $art->id) }}"
                                                  method="POST" style="display:inline"
                                                  onsubmit="return confirm('Yakin hapus artikel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-circle btn-sm" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.artikel.edit', $art->id) }}"
                                               class="btn btn-warning btn-circle btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada artikel.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('adminasset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminasset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminasset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('adminasset/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('adminasset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminasset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminasset/js/demo/datatables-demo.js') }}"></script>
</body>
</html>
