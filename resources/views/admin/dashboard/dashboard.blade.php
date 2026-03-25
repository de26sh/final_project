@extends('admin.layout.app')
@section('main')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-primary shadow-sm">
                                <i class="bi bi-gear-fill"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Product</span>
                                <span class="info-box-number">
                                    {{ $productCount }}

                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-danger shadow-sm">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Products Sold</span>
                                <span class="info-box-number">{{ $productsSold }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <!-- <div class="clearfix hidden-md-up"></div> -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">

                            <span class="info-box-icon text-bg-success shadow-sm">
                                <i class="bi bi-cash-stack"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Revenue</span>
                                <span class="info-box-number">₹ {{ $totalRevenue }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-warning shadow-sm">
                                <i class="bi bi-people-fill"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Orders</span>
                                <span class="info-box-number">{{ $totalOrders }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Last 7 Days Revenue</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item"> Something else here </a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                                        </p>

                                        <div id="sales-charts"></div>
                                    </div>
                                    <!-- /.col -->

                                    <!-- /.col -->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!-- ./card-body -->

                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-8">
                        <!--begin::Row-->

                        <!--end::Row-->

                        <!--begin::Latest Order Widget-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Item</th>
                                                <th>Status</th>
                                                <th>Popularity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latestOrders as $order)
                                                <tr>
                                                    <td>#{{ $order->order_number }}</td>
                                                    <td>Product #{{ $order->product_id }}</td>
                                                    <td>
                                                        <span
                                                            class="badge
            @if ($order->status == 'pending') text-bg-warning
            @elseif($order->status == 'confirmed') text-bg-primary
            @elseif($order->status == 'shipped') text-bg-info
            @elseif($order->status == 'delivered') text-bg-success
            @else text-bg-secondary @endif">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>₹ {{ number_format($order->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">
                                    Place New Order
                                </a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">
                                    View All Orders
                                </a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Products by Category</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-12">
                                        <div id="category-chart"></div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!-- /.card-body -->

                            <!-- /.footer -->
                        </div>
                        <!-- /.card -->

                        <!-- PRODUCT LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="px-2">
                                    @foreach ($recentProducts as $product)
                                        <div class="d-flex border-top py-2 px-1">
                                            <div class="col-2">
                                                <img src="{{ $product->image ?? asset('assets/img/default-150x150.png') }}"
                                                    class="img-size-50" />
                                            </div>
                                            <div class="col-10">
                                                <span class="fw-bold">
                                                    {{ $product->name }}
                                                    <span class="badge text-bg-warning float-end">₹
                                                        {{ $product->price }}</span>
                                                </span>
                                                <div class="text-truncate">{{ $product->description }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="javascript:void(0)" class="uppercase"> View All Products </a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 300
                },
                series: [{
                    name: 'Revenue',
                    data: @json($revenues)
                }],
                xaxis: {
                    categories: @json($dates)
                },
                colors: ['#ff6a00'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                }
            };

            new ApexCharts(document.querySelector("#sales-charts"), options).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'donut',
                    height: 300
                },
                series: @json($categoryCounts),
                labels: @json($categoryLabels),
                legend: {
                    position: 'bottom'
                },
                colors: ['#ff6a00', '#28a745', '#17a2b8', '#ffc107', '#dc3545']
            };

            new ApexCharts(document.querySelector("#category-chart"), options).render();
        });
    </script>
@endsection
