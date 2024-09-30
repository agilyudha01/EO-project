@extends('user.layout.main')

@section('main')
<div class="profile-header mt-5 d-flex justify-content-center align-items-center">
    <h2>Profile</h2>
</div>

<div class="container profile-section mb-5">
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
            <div class="card mb-3">
                <div class="card-body">
                    {{-- Form Login --}}
                    @if(auth()->check() && auth()->user()->level_user == 'admin')
                        <form id="adminForm" action="/admin/event-package" target="_blank" method="GET" style="display: none;">
                            {{-- @csrf --}}
                        </form>
                        <div class="row border m-1 p-1 border-1" style="cursor: pointer;" onclick="document.getElementById('adminForm').submit();">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <i class="bi bi-person-lines-fill fa-lg"></i>
                            </div>
                            <div class="col-10">
                                <strong>
                                    Admin
                                </strong>
                            </div>
                        </div>
                    @elseif (auth()->check() && auth()->user()->level_user == 'super-admin')
                        <form id="adminForm" action="/admin/dashboard" target="_blank" method="GET" style="display: none;">
                            {{-- @csrf --}}
                        </form>
                        <div class="row border m-1 p-1 border-1" style="cursor: pointer;" onclick="document.getElementById('adminForm').submit();">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <i class="bi bi-person-lines-fill fa-lg"></i>
                            </div>
                            <div class="col-10">
                                <strong>
                                    Admin
                                </strong>
                            </div>
                        </div>
                                   
                    @endif
                    <!-- Form Logout -->
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="row border m-1 p-1 border-1" style="cursor: pointer;" onclick="document.getElementById('logoutForm').submit();">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <i class="bi bi-box-arrow-right fa-lg"></i>
                        </div>
                        <div class="col-10">
                            <strong>
                                Keluar
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Modal untuk mengubah foto profil -->
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    Personal Information
                    <button id="editBtn" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#editPersonalInformation">Edit</button>
                </div>
                <!-- Modal untuk mengubah Personal Information -->
                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <div class="modal fade" id="editPersonalInformation" tabindex="-1" aria-labelledby="editPersonalInformationLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPersonalInformationLabel">Edit Personal Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="personalInfoForm" action="{{ route('profile.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 row">
                                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="asgh@gmail.com" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="082230807502">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="address" class="col-sm-3 col-form-label">Shipping Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="123 Main Street, City, Country" required>{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



                <div class="card-body">
                    <form id="personalInfoForm" action="{{ route('profile.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly placeholder="-">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-3 col-form-label">Shipping Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" name="address" rows="3" readonly placeholder="-">{{ $user->address }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('profileImage').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('previewImage').src = URL.createObjectURL(file);
        }
    });
</script>

@endsection
