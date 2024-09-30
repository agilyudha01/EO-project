@extends('user.layout.main')

@section('main')
    
        <!-- ##### Shop Grid Area Start ##### -->
        <section class="shop_grid_area">
            <div class="container" style="background-color: #F7F7F7">
                <div class="row">
                    <div class="col-12">
                        <div class="shop_grid_product_area mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="product-topbar d-flex align-items-center justify-content-between">
                                        <!-- Total Products -->
                                        <div class="total-products">
                                            <p><span>{{ $eventPackages->count() }}</span> products found</p>
                                        </div>

                                        <!-- Sorting -->
                                        <div class="product-sorting d-flex">
                                            {{-- {{ dd(request('filter')) }} --}}
                                            <p>Sort by:</p>
                                            <form action="/search" method="get">
                                                <input type="hidden" name="search" value="{{ $search }}">
                                                <select name="filter" id="sortBySelect" onchange="this.form.submit()">
                                                    <option value="asc" {{ request('filter') == 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                                                    <option value="desc" {{ request('filter') == 'desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                @foreach ($eventPackages as $eventPackage)
                                    <!-- Single Product -->
                                    <div class="col-6 col-sm-4 col-lg-3">
                                        <div class="single-product-wrapper p-2">
                                            <!-- Product Image -->
                                            <div class="product-img">
                                                <a href="/package/{{ $eventPackage->name }}">
                                                    <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="">
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
                        <!-- Pagination -->
                        {{-- <nav aria-label="navigation">
                            <ul class="pagination mt-50 mb-70">
                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">21</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Shop Grid Area End ##### -->

@endsection