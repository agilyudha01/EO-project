@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Package Detailed</title>
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
  <!-- Page Wrapper -->
  <div class="wrapper">
    <div class="container-fluid mt-4">
      
      <!-- Page Title and Breadcrumb -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Event Packages</a></li>
                <li class="breadcrumb-item active">Details</li>
              </ol>
            </div>
            <h4 class="page-title">Event Package Details</h4>
          </div>
        </div>
      </div>

      <!-- Event Package Details Card -->
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h4>{{ $eventPackage->name }}</h4>
            </div>
            <div class="card-body">
              
              <div class="row">
                <!-- Image -->
                <div class="col-md-6">
                  <img src="{{asset('storage/' . $eventPackage->image)}}" alt="" class="img-fluid rounded">
                </div>

                <!-- Details -->
                <div class="col-md-6">
                  <h5 class="mb-3"><strong>Description:</strong></h5>
                  <p>{!! nl2br(e($eventPackage->description)) !!}</p>

                  <h5 class="mb-3"><strong>Price:</strong></h5>
                  <p>{{ $eventPackage->price }}</p>

                  <h5 class="mb-3"><strong>Categories:</strong></h5>
                  <p>
                    @foreach($eventPackage->categories as $category)
                      <span class="badge bg-info">{{ $category->name }}</span>
                      @if (!$loop->last), @endif
                    @endforeach
                  </p>

                  <h5 class="mb-3"><strong>Created At:</strong></h5>
                  <p>{{ $eventPackage->created_at->format('d-m-Y') }}</p>

                  <h5 class="mb-3"><strong>Updated At:</strong></h5>
                  <p>{{ $eventPackage->updated_at->format('d-m-Y') }}</p>
                </div>
              </div>
              
              <!-- Back to List Button -->
              <a href="{{ route('event-package.index') }}" class="btn btn-secondary mt-4">Back to List</a>
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
@endsection

