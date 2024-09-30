@extends('user.layout.main')

@section('main')

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row">
    
                    <div class="col-12 col-md-6">
                        <div class="checkout_details_area mt-50 clearfix">
    
                            <div class="cart-page-heading mb-30">
                                <h5>Informasi Tambahan</h5>
                            </div>
    
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="event_date">Tanggal Acara</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date" value="{{ $event_date }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address">Lokasi Acara <span>*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat Acara" required>
                                </div>
                                <input type="hidden" name="total_price" value="{{ $total }}">
    
                            </div>
                            
                        </div>
                    </div>
    
                    <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                        <div class="order-details-confirmation">
    
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                                <p>The Details</p>
                            </div>
    
                            <ul class="order-details-form mb-4">
                                <li><span>Product</span> <span>Total</span></li>
                                <li><span>{{ $eventPackage->name }}</span> <span>IDR {{number_format($eventPackage->price, 0, ',', '.') }}</span></li>
                                <li><span>Diskon</span> <span>{{ $user->badges->discount }}%</span></li>
                                <li><span>Shipping</span> <span>Free</span></li>
                                <li><span>Total</span> <span>IDR {{number_format($total, 0, ',', '.') }}</span></li>
                                <small>anda menghemat {{ number_format($diskon, 0, ',', '.') }}</small>
                            </ul>
                            </div>
                            <button type="submit" name="eventPackage_id" value="{{ $eventPackage->id }}" class="btn essence-btn">Checkout</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

@endsection