@extends('backend.layouts.master')
@section('title', 'Flash Sale')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Marketing</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="m-0 d-print-none">All @yield('title')</h4>
                    <div class="mt-2">
                        <a href="{{ route('flash-sale.create') }}" class="btn btn-primary rounded-pill"><i
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
                <table id="tableFlashSale" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="selectAll"
                                    name="select_all">
                            </th>
                            <th></th>
                            <th>Title</th>
                            <th>Banner</th>
                            <th>Start Date</th>
                            <th>End Date</th>
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
        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableFlashSale tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableFlashSale tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        // fetch data category
        let table;
        let check = 0
        $(function() {
            table = $("#tableFlashSale").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('flash-sale.fetch') }}",
                    type: "GET",
                },
                order: [
                    [1, 'desc']
                ],
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false,
                        width: "5%",
                        render: function(data, type, row) {
                            // Menambahkan span untuk menunjukkan status expand/collapse
                            return `<span class="toggle-row" style="cursor: pointer;"> <span class="badge badge-outline-primary"><i class="expand-icon ri-add-line"></i></span> ${data}</span>`;
                        },
                    },
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false,
                        width: "5%"
                    },
                    {
                        data: 'name',
                        width: "15%"
                    },
                    {
                        data: 'image',
                        searchable: false,
                        sortable: false,
                        width: "15%"
                    },
                    {
                        data: 'start_date',
                        searchable: false,
                        sortable: false,
                        width: "17%"
                    },
                    {
                        data: 'end_date',
                        searchable: false,
                        sortable: false,
                        width: "17%"
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false,
                        width: "17%"
                    },
                ],
                pagingType: "full_numbers",
                searching: true,
                language: {
                    paginate: {
                        previous: "<i class='ri-arrow-left-s-line'>",
                        next: "<i class='ri-arrow-right-s-line'>"
                    },
                    processing: "<div class='spinner-border text-primary m-2' role='status'></div>",
                },
                drawCallback: function(settings) {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
            });
            // Menambahkan event listener untuk klik pada expand-icon
            $('#tableFlashSale tbody').on('click', '.expand-icon', function(e) {
                e.stopPropagation(); // Mencegah event bubble ke tr
                var tr = $(this).closest('tr'); // Ambil baris terdekat
                var row = table.row(tr); // Ambil data row

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

            // Jika Anda ingin memastikan baris tidak dapat di-expand dengan klik pada baris itu sendiri,
            // Anda dapat menghapus atau menonaktifkan event listener untuk baris:
            $('#tableFlashSale tbody').on('click', 'tr', function(e) {
                e.stopPropagation(); // Mencegah event bubble ke parent
            });

            // Fungsi untuk membuat konten child row
            function createChildRowContent(data) {
                return `
                    <table class="table table-striped dt-responsive w-100">
                        <tr>
                            <th width="20%">Publish</th>
                            <td>${data.publish}</td>
                        </tr>
                        <tr>
                            <th width="20%">Feature</th>
                            <td>${data.feature}</td>
                        </tr>
                        <tr>
                            <th width="20%">Page Link</th>
                            <td></td>
                        </tr>
                    </table>
                `;
            }

            table.buttons().container()
                .appendTo('#table-flash-sale_wrapper .col-md-5:eq(0)');
        })

        // switch select published
        $(document).on("change", ".is_active", function(e) {
            var id = $(this).attr('data-active');
            var active = $(this).prop('checked');

            var fd = new FormData();
            fd.append("id", id);
            if (active == true) {
                fd.append("is_active", '1');
            } else {
                fd.append("is_active", '0');
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(
                            'meta[name="csrf-token"]')
                        .attr('content')
                }
            });

            $.ajax({
                url: "{{ route('flash-sale.changeActive') }}",
                type: "POST",
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    if (response.status == 200) {
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                            },
                        });
                    }
                }
            })
        })

        // switch select published
        $(document).on("change", ".is_feature", function(e) {
            var id = $(this).attr('data-active');
            var active = $(this).prop('checked');

            var fd = new FormData();
            fd.append("id", id);
            if (active == true) {
                fd.append("is_feature", '1');
            } else {
                fd.append("is_feature", '0');
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(
                            'meta[name="csrf-token"]')
                        .attr('content')
                }
            });

            $.ajax({
                url: "{{ route('flash-sale.changeFeature') }}",
                type: "POST",
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    if (response.status == 200) {
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                            },
                        });
                    }
                }
            })
        })
    </script>
@endpush
