@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control shadow border-0" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-todo-fill fs-13"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="ri-refresh-line"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers</h5>
                                <h3 class="my-3">54,214</h3>
                                <p class="mb-0 text-muted text-truncate">
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 2,541</span>
                                    <span>Since last month</span>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div id="widget-customers" class="apex-charts" data-colors="#47ad77,#e3e9ee"></div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="my-3">7,543</h3>
                                <p class="mb-0 text-muted text-truncate">
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i> 1.08%</span>
                                    <span>Since last month</span>
                                </p>
                            </div>
                            <div id="widget-orders" class="apex-charts" data-colors="#3e60d5,#e3e9ee"></div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                                <h3 class="my-3">$9,254</h3>
                                <p class="mb-0 text-muted text-truncate">
                                    <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i> 7.00%</span>
                                    <span>Since last month</span>
                                </p>
                            </div>
                            <div id="widget-revenue" class="apex-charts" data-colors="#16a7e9,#e3e9ee"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Growth</h5>
                                <h3 class="my-3">+ 20.6%</h3>
                                <p class="mb-0 text-muted text-truncate">
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 4.87%</span>
                                    <span>Since last month</span>
                                </p>
                            </div>
                            <div id="widget-growth" class="apex-charts" data-colors="#ffc35a,#e3e9ee"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
            <div class="col col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-muted fw-normal mt-0" title="Conversation Ration">Conversation</h5>
                                <h3 class="my-3">9.62%</h3>
                                <p class="mb-0 text-muted text-truncate">
                                    <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i> 3.07%</span>
                                    <span>Since last month</span>
                                </p>
                            </div>
                            <div id="widget-conversation" class="apex-charts" data-colors="#f15776,#e3e9ee"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row -->
        <!-- end row -->

    </div>
@endsection

@push('page-scripts')
    <script>
        // nav active
        $('.activeDashboard').addClass('menuitem-active')
    </script>
@endpush
