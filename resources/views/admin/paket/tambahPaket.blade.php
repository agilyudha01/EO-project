@extends('admin.main.layout_admin')

{{-- @section('title') Create Paket @endsection --}}

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Create Package</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.ico') }}">

    <!-- plugin css -->
    <link href=" {{ asset('assets2/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets2/js/head.js') }}"></script>

    <!-- Bootstrap css -->
    <link href="{{ asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{ asset('assets2/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('assets2/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Create Paket</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Paket Baru</h4>

                        <form action="{{ route('event-package.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="product-name" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                <input type="text" id="product-name" class="form-control" placeholder="Masukkan nama paket" name="name" required />
                            </div>

                            <div class="mb-3">
                                <label for="product-summary" class="form-label">Deskripsi Paket</label>
                                <textarea class="form-control" id="product-summary" rows="4" placeholder="Masukkan deskripsi paket" name="description"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="product-category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="product-category" name="categories[]" multiple="multiple" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product-price">Harga <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product-price" placeholder="Masukkan harga" name="price" required />
                            </div>

                            <div class="mb-3">
                                <label for="product-image">Gambar Paket</label>
                                <input type="file" class="form-control" id="product-image" name="image" />
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
    <!-- Image preview -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#product-image').change(function(event) {
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
