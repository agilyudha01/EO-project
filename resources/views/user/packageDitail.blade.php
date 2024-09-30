@extends('user.layout.main')

@section('main')

    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">
        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="">
                <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="">
                {{-- <img src="{{ asset('storage/' . $eventPackage->image) }}" alt=""> --}}
                {{-- <img src="{{ asset('assets/img/product-img/product-big-2.jpg') }}" alt="" style="width: 100%; height: 200px; object-fit: cover;"> --}}
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>mango</span>
            <a href="cart.html">
                <h2>{{ $eventPackage->name }}</h2>
            </a>
            <p class="product-price">IDR {{number_format($eventPackage->price, 0, ',', '.') }}</p>
            <p class="product-desc">{!! nl2br(e($eventPackage->description)) !!}</p>

            <!-- Form -->
            <form class="cart-form clearfix" action="{{ route('order.create') }}" method="GET">
                @csrf
                <!-- Select Box -->
                <label for="event_date" class="form-label mt-50">
                    <h6>
                        Tanggal Acara 
                    </h6>
                </label>
                <div class="select-box d-flex mb-30">
                    <input type="date" id="event_date" name="event_date" class="form-control" required>
                </div>
                
                <div class="cart-fav-box d-flex align-items-center">
                    <button type="submit" name="eventPackage_id" value="{{ $eventPackage->id }}" class="btn essence-btn">Checkout</button>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

@endsection