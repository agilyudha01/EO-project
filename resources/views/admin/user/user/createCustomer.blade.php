@extends('admin.main.layout_admin')

{{-- @section('title') Create Paket @endsection --}}

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Create Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.ico') }}">

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

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Customer Baru</h4>

                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="user-name" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" id="User-Name" class="form-control" placeholder="Masukkan Username" name="name" required />
                            </div>

                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email <span class="text-danger">*</span></label>
                                {{-- <label for="emailaddress" class="form-label">Email address</label> --}}
                                <input type="email" id="emailaddress" class="form-control" placeholder="Masukkan Username" name="email" required />
                                {{-- <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email"> --}}
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" placeholder="Masukkan Password" name="password" required />
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>

                                </div>
                            </div>

                            

                            <div class="mb-3">
                                <label for="foto-profile">Foto Profile</label>
                                <input type="file" class="form-control" id="foto-profile" name="image" />
                                <img id="preview-img" class="mt-3" style="max-width: 100%; max-height: 300px; display: none;" alt="Preview Image" />
                            </div>




                            

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
@endsection

@section('script')
    <!-- Vendor js -->
    <script src="{{ asset('assets2/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets2/js/app.min.js') }}"></script>

    <!-- Third Party js-->
    <script src="{{ asset('assets2/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- Dashboard init js -->
    <script src="{{ asset('assets2/js/pages/ecommerce-dashboard.init.js') }}"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Authentication js -->
    <script src="{{ asset('assets2/js/pages/authentication.init.js') }}"></script>

    <!-- Image preview -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#foto-profile').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
