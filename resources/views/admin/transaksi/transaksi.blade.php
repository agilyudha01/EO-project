@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Order</title>
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
    <!-- Page Title and Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Transaksi</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Transaksi</h4>
            </div>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Filter User</h4>
                    <form action="/admin/orders" method="get">
                        <div class="input-group">
                            <select class="form-select" name="user" onchange="this.form.submit()" aria-label="Select User">
                                <option value="" {{ request('user') == '' ? 'selected' : '' }}>Semua User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Transaksi</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Paket</th>
                                    <th>Nama Customer</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Acara</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle">{{ $order->id }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $order->eventPackage->image) }}" class="img-fluid rounded me-2" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $order->eventPackage->name }}">
                                            <div class="text-truncate">
                                                {{ $order->eventPackage->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $order->user->name }}</td>
                                    <td class="align-middle">{{ $order->price }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ $order->status }}</span>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $order->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                        <!-- Modal for updating status -->
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" id="modal{{ $order->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $order->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel{{ $order->id }}">Update Status Order</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <select class="form-select" name="status">
                                                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                <option value="Failed" {{ $order->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="align-middle">{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td class="align-middle">{{ $order->event_date->format('d-m-Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-12 -->
    </div> <!-- end row -->

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
