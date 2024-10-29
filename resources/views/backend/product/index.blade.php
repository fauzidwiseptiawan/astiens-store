@extends('backend.layouts.master')
@section('title', 'Product')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@yield('title')</a></li>
                            <li class="breadcrumb-item active">All @yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start mt-1">
                        <h4 class="m-0 d-print-none">All @yield('title')</h4>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('product.create') }}" class="btn btn-primary rounded-pill"><i
                                class="ri-add-fill me-1"></i>
                            <span>Add New @yield('title')</span> </a>
                        <button type="button" class="btn btn-danger rounded-pill" id="bulkDelete"><i
                                class="ri-delete-bin-5-line me-1"></i> <span>Bulk Delete</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="clearfix mb-1">
                    <div class="float-start mt-1">
                        <h4 class="header-title">Filter</h4>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-lg-2 mb-1">
                        <input type="text" id="search" name="search" class="form-control search"
                            placeholder="Type search keywords..">
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control brand" data-toggle="brand" name="brand_id" id="brandId">
                            <option></option>
                            <option value="0">All</option>
                        </select>
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control categories" data-toggle="categories" name="categories_id"
                            id="categoriesId">
                            <option></option>
                            <option value="0">All</option>

                        </select>
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control status" data-toggle="status" name="is_active" id="isActive">
                            <option></option>
                            <option value="0">All</option>
                            <option value="2">Draft</option>
                            <option value="3">Pending</option>
                            <option value="1">Published</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-1">
                        <select class="form-control shortBy" data-toggle="shortBy" name="shortBy" id="shortBy">
                            <option></option>
                            <option value="id">ID</option>
                            <option value="name">Name</option>
                            <option value="brand_id">Brand</option>
                            <option value="1">Stock</option>
                            <option value="categories_id">Categories</option>
                            <option value="is_active">Status</option>
                        </select>
                    </div> <!-- end col -->
                    <div class="col-sm-2 mb-1 d-grid">
                        <button type="button" class="btn btn-info rounded-pill submit"><i class="ri-search-line me-1"></i>
                            <span>Search</span></button>
                    </div> <!-- end col -->
                </div>
                <table id="product" class="table table-striped dt-responsive w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="select" name="select">
                            </th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Categories</th>
                            <th>Info</th>
                            <th>Stock</th>
                            <th>Feature</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
@endsection

@push('page-scripts')
    <script>
        // nav active
        $('#sidebarProduct').addClass('show')
        $('.activeProduct').addClass('menuitem-active')
        $('#activeProduct').addClass('menuitem-active');
    </script>
@endpush
