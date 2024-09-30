@extends('user.layout.main')

@section('main')

    <div class="container" style="background-color: #F7F7F7">
        <div id="carouselExample" class="carousel slide d-flex justify-content-center align-items-center" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/seeder/aset2.jpg') }}" class="d-block custom-carousel-img" style="height: 30vh; width: 100%;  object-fit: cover;" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/seeder/aset2.jpg') }}" class="d-block custom-carousel-img" style="height: 30vh; width: 100%;  object-fit: cover;" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/seeder/aset3.jpg') }}" class="d-block custom-carousel-img" style="height: 30vh; width: 100%;  object-fit: cover;" alt="Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                        <!-- Single Product -->
                        @foreach ($eventPackages as $eventPackage)
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <a href="/package/{{ $eventPackage->name }}">
                                    <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="">
                                </a>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>topshop</span>
                                <a href="single-product-details.html">
                                    <h6 class="text-truncate">{{ $eventPackage->name }}</h6>
                                </a>
                                <p class="product-price">IDR {{number_format($eventPackage->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($eventPackages->take(5) as $eventPackage)
                    <!-- Single Product -->
                    <div class="col-6 col-sm-4 col-lg-3">
                        <div class="single-product-wrapper p-4">
                            <!-- Product Image -->
                            <div class="product-img">
                                <a href="/package/{{ $eventPackage->name }}">
                                    <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="" class="rounded bi-circle">
                                </a>
                            </div>

                            <!-- Product Description -->
                            <div class="product-description">
                                <span>topshop</span>
                                <a href="/package/{{ $eventPackage->name }}">
                                    <h6 class="text-truncate">{{ $eventPackage->name }}</h6>
                                </a>
                                <p class="product-price">IDR {{number_format($eventPackage->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                
                @endforeach

            </div>
            
        </div>


        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Category</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('assets/img/product-img/wedding.jpeg') }});">
                    <div class="catagory-content">
                        <a href="/package?category=2">Wedding</a>
                    </div>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('assets/img/product-img/carnaval.jpeg') }});">
                    <div class="catagory-content">
                        <a href="/package?category=3">Carnaval</a>
                    </div>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('assets/img/product-img/party.jpeg') }});">
                    <div class="catagory-content">
                        <a href="/package?category=4">Party</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('assets/img/product-img/party.jpeg') }});">
                    <div class="catagory-content">
                        <a href="/package?category=1">Photo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection