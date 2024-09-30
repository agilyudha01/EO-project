@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>User | Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.ico') }}">

    <!-- third party css -->
    <link href="{{ asset('assets2/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- Theme Config Js -->
    <script src="{{ asset('assets2/js/head.js') }}"></script>

    <!-- Bootstrap css -->
    <link href="{{ asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{ asset('assets2/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('assets2/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid mt-3">
    <!-- Title Section -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="page-title">Daftar Customer</h4>
            <a class="btn btn-success" href="{{ route('customer.create') }}">+ Tambah Customer</a>
        </div>
    </div>

    <!-- Customer Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Total Transaksi</th>
                            <th>Atur</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }} - {{ $user->badges->name }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $user->image) }}" class="img-fluid rounded me-2" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $user->name }}">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>RP {{ number_format($user->total_success_transaction, 0, ',', '.') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Atur
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('customer.show', $user->id) }}">Lihat Detail</a></li>
                                        <li>
                                            <form action="{{ route('customer.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Vendor js -->
    <script src="{{ asset('assets2/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets2/js/app.min.js') }}"></script>

     <!-- third party js -->
     <script src="{{ asset('assets2/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/pdfmake/build/pdfmake.min.js') }}"></script>
     <script src="{{ asset('assets2/libs/pdfmake/build/vfs_fonts.js') }}"></script>
     <!-- third party js ends -->

     <!-- Datatables init -->
     <script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
@endsection
