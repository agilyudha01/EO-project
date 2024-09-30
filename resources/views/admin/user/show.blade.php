@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>Admin | Show User</title>
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

<div class="container profile-section">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center align-items-center position-relative" 
                            style="cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                            <!-- Foto Profil dengan Ikon Edit di pojok kanan bawah -->
                            <img src="{{ asset('storage/' . $user->image) }}" 
                                 class="profile-pic rounded-circle" 
                                 style="object-fit: cover; width: 75px; height: 75px;" 
                                 alt="User Photo" 
                                 >
                            
                            <!-- Ikon Edit di Pojok Kanan Bawah -->
                            <span class="edit-icon position-absolute" 
                                  style="bottom: 10%; right: 0; background-color: white; border-radius: 100%; padding: 5px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);">
                                <i class="bi bi-pencil rounded-circle"></i>
                            </span>
                        </div>
                        <div class="col-8">
                            <h2 class="mt-3">{{ $user->name }}</h2>
                            <p>{{ $user->badges->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal untuk mengubah foto profil -->
            <form action="{{ route('customer.show', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
        
                <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPhotoModalLabel">Edit Foto Profil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img id="previewImage" src="{{ asset('storage/' . $user->image) }}" alt="Preview Foto" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                </div>
                                <div class="mb-3">
                                    <label for="profileImage" class="form-label">Ganti Foto Profile</label>
                                    <input type="file" class="form-control" id="profileImage" name="profile_image" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Personal Information
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" value="+123 456 7890" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-3 col-form-label">Shipping Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" rows="3" readonly>123 Main Street, City, Country</textarea>
                            </div>
                        </div>
                    </form>
                </div>
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

    <!-- Third Party js-->
    <script src="{{ asset('assets2/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- Dashboard init js -->
    <script src="{{ asset('assets2/js/pages/ecommerce-dashboard.init.js') }}"></script>

    <script>
        document.getElementById('profileImage').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('previewImage').src = URL.createObjectURL(file);
            }
        });
    </script>
    
@endsection()
