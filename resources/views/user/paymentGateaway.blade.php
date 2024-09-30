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
          <div class="row">

              <div class="col-12">
                  <div class="order-details-confirmation">
                      <div class="cart-page-heading">
                          <h5>Detail Pesanan</h5>
                      </div>

                      <ul class="order-details-form mb-4">
                          <li><span>*</span> <span>Total</span></li>
                          <li><span>Nama Paket</span> <span>{{ $order->eventPackage->name }}</span></li>
                          <li><span>Harga</span> <span>IDR {{number_format($order->eventPackage->price, 0, ',', '.') }}</span></li>
                          <li><span>Alamat Acara</span> <span>{{ $order->address }}</span></li>
                          <li><span>Diskon</span> <span>{{ $order->user->badges->discount }}%</span></li>
                          <li><span>Total</span> <span>IDR {{ $order->price - ($order->price * $order->user->badges->discount) }}</span></li>
                      </ul>

                      <button type="button" id="pay-button" class="btn essence-btn">Pembayaran</button>
                      {{-- <button class="btn btn-primary mt-3" id="pay-button">Bayar Sekarang</button> --}}
                  </div>
              </div>
          </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

    <!-- Snap.js Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$order->snapToken}}', {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    window.location.href = '/order'
                    console.log(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    // alert("wating your payment!");
                    window.location.href = '/'
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    // alert("payment failed!");
                    window.location.href = '/'
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

    </script>
@endsection


