@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Package Edit</title>
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
@endsection

@section('content')
    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page Title and Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Event Packages</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Event Package</h4>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="header-title">Edit Event Package</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('event-package.update', $eventPackage->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Method field for update -->
                                
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $eventPackage->name) }}" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $eventPackage->description) }}</textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $eventPackage->price) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Categories</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach($categories as $category)
                                            <div class="form-check me-3">
                                                <input type="checkbox" class="form-check-input" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}" {{ $eventPackage->categories->contains($category->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="product-image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="product-image" name="image">
                                    <br>
                                    @if($eventPackage->image)
                                        <img id="image-preview" src="{{ asset('storage/' . $eventPackage->image) }}" alt="Current Image" class="img-fluid rounded" style="max-width: 100%; max-height: 300px;">
                                    @else
                                        <img id="image-preview" src="" alt="No Image" class="img-fluid rounded" style="max-width: 100%; max-height: 300px;">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                <a href="{{ route('event-package.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- wrapper -->


    
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
    <script>
        document.getElementById('product-image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imgPreview = document.getElementById('image-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = 'none';
            }
        });
    </script>
@endsection
