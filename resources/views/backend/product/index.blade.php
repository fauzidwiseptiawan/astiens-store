@extends('backend.layouts.master')
@section('title', 'Product')
@push('styles')
    <style>
        .dataTables_wrapper .dataTable thead th.sorting_asc_disabled::after,
        .dataTables_wrapper .dataTable thead th.sorting_desc_disabled::after {
            display: none;
        }
    </style>
@endpush
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
                            placeholder="Search keywords..">
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control brand" data-toggle="brand" name="brand_id" id="brandId">
                            <option></option>
                            <option value="0">All Brand</option>
                            @foreach ($brand as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control category" data-toggle="category" name="category_id" id="categoryId">
                            <option></option>
                            <option value="0">All</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> <!-- end col -->
                    <div class="col-lg-2 mb-1">
                        <select class="form-control status" data-toggle="status" name="is_active" id="isActive">
                            <option></option>
                            <option value="0">All Status</option>
                            <option value="2">Draft</option>
                            <option value="3">Pending</option>
                            <option value="1">Published</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-1">
                        <select class="form-control shortBy" data-toggle="shortBy" name="shortBy" id="shortBy">
                            <option></option>
                            <option value="1">Sort By</option>
                            <option value="high_rating">Rating (High > Low)</option>
                            <option value="low_rating">Rating (Low > High)</option>
                            <option value="high_sale">Num of Sale (High > Low)</option>
                            <option value="high_sale">Num of Sale (Low > High)</option>
                            <option value="high_price">Price (High > Low)</option>
                            <option value="low_price">Price (Low > High)</option>
                        </select>
                    </div> <!-- end col -->
                    <div class="col-sm-2 mb-1 d-grid">
                        <button type="button" class="btn btn-info rounded-pill submit"><i class="ri-search-line me-1"></i>
                            <span>Search</span></button>
                    </div> <!-- end col -->
                </div>

                <table id="tableProduct" class="table table-striped dt-responsive w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="select" name="select">
                            </th>
                            <th>Name</th>
                            <th>Info</th>
                            <th>Stock</th>
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

        // select status
        $(document).ready(function() {
            $('.brand').select2({
                placeholder: 'All Brand',
                allowClear: false
            });
            $('.category').select2({
                placeholder: 'All Category',
                allowClear: false
            });
            $('.status').select2({
                placeholder: 'All Status',
                allowClear: false
            });
            $('.shortBy').select2({
                placeholder: 'Order By',
                allowClear: false
            });
        });


        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableProduct tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableProduct tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        let table;
        let check = 0;
        let search = $('#search').val().toLowerCase(),
            brand = $('#brandId').val(),
            category = $('#categoryId').val(),
            status = $('#isActive').val(),
            shortBy = $('#shortBy').val()

        // function submit seacrh
        $('.submit').on('click', function(e) {
            e.preventDefault(); // Mencegah submit form jika ada
            search = $('.search').val().toLowerCase();
            brand = $('.brand').val();
            category = $('.category').val();
            status = $('.status').val();
            table.ajax.reload(null, false)
        })


        // fetch data category
        $(function() {
            // Inisialisasi DataTable
            table = $("#tableProduct").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false, // Pastikan fitur pencarian dinonaktifkan
                ajax: {
                    url: "{{ route('product.fetch') }}",
                    type: "GET",
                    data: function(d) {
                        d.search.value = search;
                        d.brand = brand;
                        d.category = category;
                        d.status = status;
                        return d
                    }
                },
                order: [],
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false,
                        width: "7%",
                        render: function(data, type, row) {
                            // Menambahkan span untuk menunjukkan status expand/collapse
                            return `<span class="toggle-row" style="cursor: pointer;"> <span class="badge badge-outline-primary"><i class="expand-icon ri-add-line"></i></span> ${data}</span>`;
                        },
                    },
                    {
                        data: 'name',
                        width: "40%",
                        sortable: false,
                    },
                    {
                        data: 'info',
                        searchable: false,
                        sortable: false,
                        width: "22%",
                    },
                    {
                        data: 'stock',
                        searchable: false,
                        sortable: false,
                        width: "15%",
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'price',
                        visible: false
                    }, // Kolom tersembunyi untuk harga
                    {
                        data: 'rating',
                        visible: false
                    }, // Kolom tersembunyi untuk rating
                    {
                        data: 'sale',
                        visible: false
                    }, // Kolom tersembunyi untuk penjualan

                ],
                pagingType: "full_numbers",
                language: {
                    paginate: {
                        previous: "<i class='ri-arrow-left-s-line'>",
                        next: "<i class='ri-arrow-right-s-line'>"
                    },
                    processing: "<div class='spinner-border text-primary m-2' role='status'></div>",
                },
                createdRow: function(row, data, dataIndex) {
                    // Menambahkan HTML ke dalam kolom info
                    var info = JSON.parse(data.info); // Parsing JSON untuk mendapatkan data
                    $('td:eq(2)', row).html(info.html); // Mengubah HTML untuk kolom info
                },
                initComplete: function() {
                    // Menyembunyikan ikon sorting yang tidak diinginkan
                    $(this).find('th.sorting_asc_disabled, th.sorting_desc_disabled').removeClass(
                        'sorting_asc_disabled sorting_desc_disabled');
                },
                drawCallback: function(settings) {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    // Inisialisasi RateIt untuk semua elemen baru
                    $('.rateit').rateit();
                },
            });

            // Menambahkan fitur pengurutan di sisi klien
            $('.shortBy').change(function() {
                var shortBy = $(this).val();
                table.order([]); // Reset order sebelum menentukan order baru

                switch (shortBy) {
                    case 'low_price':
                        table.order([
                            [5, 'asc']
                        ]).draw(); // Urutkan berdasarkan harga ascending
                        break;
                    case 'high_price':
                        table.order([
                            [5, 'desc']
                        ]).draw(); // Urutkan berdasarkan harga descending
                        break;
                    case 'high_rating':
                        // Sorting berdasarkan rating (perlu menyesuaikan cara ambil datanya)
                        table.order([
                            [6, 'desc']
                        ]).draw(); // Perlu logika tambahan untuk ambil rating
                        break;
                    case 'low_rating':
                        // Sorting berdasarkan rating
                        table.order([
                            [6, 'asc']
                        ]).draw(); // Perlu logika tambahan untuk ambil rating
                        break;
                    case 'high_sale':
                        // Sorting berdasarkan sale (perlu menyesuaikan cara ambil datanya)
                        table.order([
                            [7, 'desc']
                        ]).draw(); // Perlu logika tambahan untuk ambil sale
                        break;
                    case 'low_sale':
                        // Sorting berdasarkan sale
                        table.order([
                            [7, 'asc']
                        ]).draw(); // Perlu logika tambahan untuk ambil sale
                        break;
                    default:
                        table.order([
                            [0, 'asc']
                        ]).draw(); // Urutkan berdasarkan ID default
                        break;
                }
            });

            // Menambahkan event listener untuk klik baris
            $('#tableProduct tbody').on('click', 'tr', function() {
                var tr = $(this);
                var row = table.row(tr);

                // Panggil fungsi untuk menangani ekspansi baris
                handleExpandRow(row, tr);
            });

            // Fungsi untuk menangani ekspansi dan penutupan baris
            function handleExpandRow(row, tr) {
                if (row.child.isShown()) {
                    // Jika child row sudah terbuka, tutup
                    row.child.hide();
                    tr.removeClass('shown');
                    tr.find('.expand-icon').removeClass('ri-subtract-line').addClass('ri-add-line'); // Ganti ikon
                } else {
                    // Jika child row belum terbuka, buka dan tampilkan konten
                    row.child(createChildRowContent(row.data())).show();
                    tr.addClass('shown');
                    tr.find('.expand-icon').removeClass('ri-add-line').addClass('ri-subtract-line'); // Ganti ikon
                }
            }

            // Fungsi untuk membuat konten child row
            function createChildRowContent(data) {
                return `
                    <table class="table table-striped dt-responsive w-100">
                        <tr>
                            <th width="20%">Brand</th>
                            <td>${data.brand}</td>
                        </tr>
                        <tr>
                            <th width="20%">Category</th>
                            <td>${data.category}</td>
                        </tr>
                        <tr>
                            <th width="20%">Publish</th>
                            <td>${data.publish}</td>
                        </tr>
                        <tr>
                            <th width="20%">Feature</th>
                            <td>${data.feature}</td>
                        </tr>
                        <tr>
                            <th width="20%">Special Offer</th>
                            <td>${data.special_offer}</td>
                        </tr>
                    </table>
                `;
            }

            table.buttons().container()
                .appendTo('#table-product_wrapper .col-md-5:eq(0)');
        });
    </script>
@endpush
