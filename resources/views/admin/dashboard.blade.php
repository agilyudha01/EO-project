@extends('admin.main.layout_admin')

@section('head')
    <meta charset="utf-8" />
    <title>Ecommerce Dashboard | Ubold - Responsive Bootstrap 5 Admin Dashboard</title>
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

    <!-- third party css -->
    <link href="{{ asset('assets2/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endsection

@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 

    <div class="row">
        <div class="col-6 col-sm-6 col-md-3 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="avatar-lg rounded bg-soft-primary w-100 d-flex justify-content-center align-items-center">
                                <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="text-center text-xs-center text-md-end text-xl-end">
                                <h5 class="text-dark mt-1 text-truncate">
                                    Rp {{ $totalPrice }}
                                </h5>
                                <p class="text-muted mb-1 text-truncate">Total Revenue</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-6 col-sm-6 col-md-3 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="avatar-lg rounded bg-soft-success w-100 d-flex justify-content-center align-items-center">
                                <i class="dripicons-basket font-24 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="text-center text-xs-center text-md-end text-xl-end">
                                <h5 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalOrders }}</span></h5>
                                <p class="text-muted mb-1 text-truncate">Orders</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-6 col-sm-6 col-md-3 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="avatar-lg rounded bg-soft-info w-100 d-flex justify-content-center align-items-center">
                                <i class="dripicons-store font-24 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="text-center text-xs-center text-md-end text-xl-end">
                                <h5 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalEventPackage }}</span></h5>
                                <p class="text-muted mb-1 text-truncate">Package</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-6 col-sm-6 col-md-3 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="avatar-lg rounded bg-soft-warning w-100 d-flex justify-content-center align-items-center">
                                <i class="dripicons-user-group font-24 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-xl-6">
                            <div class="text-center text-xs-center text-md-end text-xl-end">
                                <h5 class="text-dark mt-1"><span data-plugin="counterup">{{ number_format($totalUsers, 0, ',', '.') }}</span></h5>
                                <p class="text-muted mb-1 text-truncate">User</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pb-2">
                    {{-- <div class="float-end d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-light">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                        </div>
                    </div> --}}

                    <h4 class="header-title mb-3">Sales Analytics</h4>

                    <div class="row text-center">
                        <div class="col-md-6">
                            <p class="text-muted mb-0 mt-3">Current Week</p>
                            <h2 class="fw-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                <span>{{ number_format($currentWeekOrders->sum('total_price'), 0, ',', '.') }}</span>
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-0 mt-3">Previous Week</p>
                            <h2 class="fw-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                <span>{{ number_format($previousWeekOrders->sum('total_price'), 0, ',', '.') }}</span>
                            </h2>
                        </div>
                        {{-- <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">Targets</p>
                            <h2 class="fw-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                <span>$95,025</span>
                            </h2>
                        </div> --}}
                    </div>
                    <div id="chart" class="apex-charts mt-3" data-colors="#6658dd,#1abc9c"></div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-xl-4">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-0">Status Transaction</h4>

                    <div id="cardCollpase18" class="collapse show" dir="ltr">
                        <div id="apex-pie-1" class="apex-charts pt-3" data-colors="#6658dd,#4fc6e1,#4a81d4,#00b19d,#f1556c"></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        {{-- <div class="row">
        </div> --}}

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Transaction History</h4>

                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Badge & ID</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $order->user->image) }}" alt="{{ $order->user->name }}" class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">{{ $order->user->name }}</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/visa.png" alt="{{ $order->user->badges->name }}" height="24" />
                                        <span class="ms-2">{{ $order->id }}</span>
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td><span class="badge rounded-pill bg-danger">{{ $order->status }}</span></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Recent Products</h4>

                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Package</th>
                                    <th class="border-top-0">Category</th>
                                    <th class="border-top-0">Added Date</th>
                                    <th class="border-top-0">Amount</th>
                                    {{-- <th class="border-top-0">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventPackages as $eventPackage)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $eventPackage->image) }}" alt="product-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">{{ $eventPackage->name }}</span>
                                    </td>
                                    <td>
                                        @foreach ( $eventPackage->categories as $categorie )
                                            {{ $categorie->name }}
                                            @if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $eventPackage->created_at }}</td>
                                    <td>{{ $eventPackage->price }}</td>
                                    {{-- <td><span class="badge bg-soft-success text-success">Active</span></td> --}}
                                </tr>
                                    
                                @endforeach

                            
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

@endsection()
@section('script')

    <!-- Vendor js -->
    <script src="{{ asset('assets2/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets2/js/app.min.js') }}"></script>

    <!-- Third Party js-->
    <script src="{{ asset('assets2/libs/apexcharts/apexcharts.min.js') }}"></script>

    
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- Dashboard init js -->
    {{-- <script>
        !function(r) {
            "use strict";

            // Constructor untuk dashboard
            function e() {
                this.$body = r("body");
                this.charts = [];
            }

            // Inisialisasi chart
            e.prototype.initCharts = function() {
                window.Apex = {
                    chart: { parentHeightOffset: 0, toolbar: { show: !1 } },
                    grid: { padding: { left: 0, right: 0 } },
                    colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
                };

                var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
                var t = r("#revenue-chart").data("colors");
                if (t) e = t.split(",");

                var o = {
                    chart: {
                        height: 363,
                        type: "line",
                        dropShadow: { enabled: !0, opacity: .2, blur: 7, left: -7, top: 7 }
                    },
                    dataLabels: { enabled: !1 },
                    stroke: { curve: "smooth", width: 4 },
                    series: [
                        { name: "Current Week", type: "area", data: [10, 20, 15, 25, 20, 30, 20] },
                        { name: "Previous Week", type: "line", data: [0, 15, 10, 30, 15, 35, 25] }
                    ],
                    fill: { type: "solid", opacity: [.35, 1] },
                    colors: e,
                    zoom: { enabled: !1 },
                    legend: { show: !1 },
                    xaxis: {
                        type: "string",
                        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                        tooltip: { enabled: !1 },
                        axisBorder: { show: !1 }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(e) { return e + "k"; },
                            offsetX: -15
                        }
                    }
                };

                // Render chart
                new ApexCharts(document.querySelector("#revenue-chart"), o).render();
            };

            // Inisialisasi dashboard
            e.prototype.init = function() {
                this.initCharts();
            };

            // Buat instance dashboard
            r.Dashboard = new e();
            r.Dashboard.Constructor = e;

        }(window.jQuery);

        // Ketika dokumen siap, inisialisasi dashboard
        !function(t) {
            "use strict";
            t(document).ready(function(e) {
                t.Dashboard.init();
            });
        }(window.jQuery);
    </script> --}}
    <script>
        // Ambil data warna dari elemen dengan ID 'apex-pie-1' jika ada
        var dataColors = $("#apex-pie-1").data("colors");
        var colors = dataColors ? dataColors.split(",") : undefined;

        var labels = @json($chart2->pluck('status')); // Array of statuses as labels
        var series = @json($chart2->pluck('total')); // Array of counts as series data


        // Opsi konfigurasi untuk Pie Chart
        var options = {
            chart: {
                height: 320,
                type: "pie" // Tipe chart adalah 'pie'
            },
            series: series, // Data series untuk chart
            labels: labels, // Label untuk setiap bagian pie
            colors: colors, // Warna untuk setiap bagian pie
            legend: {
                show: true,
                position: "bottom", // Posisi legend di bagian bawah chart
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            responsive: [{
                breakpoint: 600, // Responsif saat ukuran layar kurang dari 600px
                options: {
                    chart: { height: 240 }, // Ubah tinggi chart
                    legend: { show: false } // Sembunyikan legend di layar kecil
                }
            }]
        };

        // Inisialisasi chart dan render ke elemen dengan ID 'apex-pie-1'
        var chart = new ApexCharts(document.querySelector("#apex-pie-1"), options);
        chart.render();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentWeekOrdersPrice = @json($currentWeekOrdersPrice);
            var previousWeekOrdersPrice = @json($previousWeekOrdersPrice);
            var days = @json($days);

            var options = {
                series: [{
                    name: 'Current Week',
                    data: currentWeekOrdersPrice
                }, {
                    name: 'Previous Week',
                    data: previousWeekOrdersPrice
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#6658dd', '#1abc9c'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: days,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "RP " + val.toLocaleString(); // format currency
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>

    <!-- third party js -->
    <script src="{{ asset('assets2/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
    
@endsection()
