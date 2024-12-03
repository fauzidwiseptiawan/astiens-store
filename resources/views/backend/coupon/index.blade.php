@extends('backend.layouts.master')
@section('title', 'Coupon')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
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
                <div class="clearfix">
                    <div class="float-start mt-1">
                        <h4 class="m-0 d-print-none">All @yield('title')</h4>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-add-coupon"><i class="ri-add-fill me-1"></i> <span>Add New
                                @yield('title')</span> </button>
                        <button type="button" class="btn btn-danger rounded-pill" id="bulkDelete"><i
                                class="ri-delete-bin-5-line me-1"></i> <span>Bulk Delete</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="tableCoupon" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="selectAll"
                                    name="select_all">
                            </th>
                            <th>#</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
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

    {{-- modal add coupon --}}
    <div class="modal fade" id="modal-add-coupon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add @yield('title')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="coupon" action="{{ route('coupon.store') }}" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Coupon Type <strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-control type-coupon" data-toggle="type-coupon" name="type_coupon"
                                        id="type_coupon">
                                        <option></option>
                                        <option value="For Total Orders">For Total Orders</option>
                                        <option value="Welcome Coupon">Welcome Coupon</option>
                                    </select>
                                    <div id="errorTypeCoupon" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Coupon Code <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="code" name="code" class="form-control"
                                        placeholder="Enter name code">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Minimum Shopping <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="min_purchase" name="min_purchase" class="form-control"
                                        placeholder="Enter minimum shopping">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-7 col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Discount <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="discount" name="discount" class="form-control"
                                        placeholder="Enter name discount">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-5 col-12" style="margin-top: 5px">
                                <label for="name" class="form-label"> </label>
                                <select class="form-control type" data-toggle="type" name="type" id="type">
                                    <option value="Flat">Flat</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                                <div id="errorIsActive" class="invalid-feedback"></div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Maximum Discount Amount <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="max_discount" name="max_discount" class="form-control"
                                        placeholder="Enter maximum discount amount">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Date <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="date" name="date" class="form-control"
                                        placeholder="Select date">
                                    <div id="errorDate" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addCoupon">Save</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

    {{-- modal update  coupon --}}
    <div class="modal fade" id="modal-update-coupon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Update @yield('title')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="coupon" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edtId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Coupon Type <strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-control type-coupon" data-toggle="type-coupon" name="type_coupon"
                                        id="edtType_coupon">
                                        <option></option>
                                        <option value="For Total Orders">For Total Orders</option>
                                        <option value="Welcome Coupon">Welcome Coupon</option>
                                    </select>
                                    <div id="errorTypeCoupon" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Coupon Code <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtCode" name="code" class="form-control"
                                        placeholder="Enter name code">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Minimum Shopping <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtMin_purchase" name="min_purchase" class="form-control"
                                        placeholder="Enter minimum shopping">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-7 col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Discount <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtDiscount" name="discount" class="form-control"
                                        placeholder="Enter name discount">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-5 col-12" style="margin-top: 5px">
                                <label for="name" class="form-label"> </label>
                                <select class="form-control type" data-toggle="type" name="type" id="edtType">
                                    <option value="Flat">Flat</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                                <div id="errorIsActive" class="invalid-feedback"></div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Maximum Discount Amount <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtMax_discount" name="max_discount" class="form-control"
                                        placeholder="Enter maximum discount amount">
                                    <div id="errorCode" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Date <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtDate" name="date" class="form-control"
                                        placeholder="Select date">
                                    <div id="errorDate" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateCoupon">Update</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

@endsection

@push('page-scripts')
    <script>
        // generate slug
        $(document).on("keyup", "#code", function() {
            var code = $('#code').val();
        })

        // generate edit slug
        $(document).on("keyup", "#edtCode", function() {
            var code = $('#edtCode').val();
        })

        // click close modal reset form
        $(document).on("click", "#close", function() {
            $('.coupon')[0].reset();
            $('.coupon').find('.form-control').removeClass('is-invalid');
        })

        flatpickr("#date", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                // Jika Anda ingin mendapatkan nilai dan melakukan sesuatu dengan itu
            }
        });

        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableCoupon tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableCoupon tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        $(document).ready(function() {
            // Select option
            const selectElements = ['.type-coupon', '.type'];

            selectElements.forEach(function(selector) {
                $(selector).select2({
                    placeholder: `Select ${selector.replace('.', '').replace(/([A-Z])/g, ' $1').trim()}`,
                    allowClear: false,
                });
            });
        })

        // fetch data coupon
        let table;
        let check = 0
        $(function() {
            table = $("#tableCoupon").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('coupon.fetch') }}",
                    type: "GET",
                },
                order: [
                    [1, 'desc']
                ],
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false,
                        width: "5%"
                    },
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false,
                        width: "5%"
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'type_coupon'
                    },
                    {
                        data: 'start_date'
                    },
                    {
                        data: 'end_date'
                    },
                    {
                        data: 'publish',
                        searchable: false,
                        sortable: false,
                        width: "13%"
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false,
                        width: "13%"
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
            table.buttons().container()
                .appendTo('#table-category_wrapper .col-md-5:eq(0)');
        })

        // switch select published
        $(document).on("click", ".switch", function(e) {
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
                url: "{{ route('coupon.changeActive') }}",
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

        // add coupon
        $(document).on("click", "#addCoupon", function(e) {
            e.preventDefault();

            var type_coupon = $('#type_coupon').val();
            var code = $('#code').val();
            var min_purchase = $('#min_purchase').val();
            var discount = $('#discount').val();
            var type = $('#type').val();
            var max_discount = $('#max_discount').val();
            var date = $('#date').val();

            var fd = new FormData();
            fd.append("type_coupon", type_coupon);
            fd.append("code", code);
            fd.append("min_purchase", min_purchase);
            fd.append("discount", discount);
            fd.append("type", type);
            fd.append("max_discount", max_discount);
            fd.append("date", date);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('.coupon').attr('action'),
                type: $('.coupon').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#addCoupon').attr('disabled', 'disabled');
                    $('#addCoupon').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#addCoupon').removeAttr('disabled');
                    $('#addCoupon').html('Save');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-add-coupon').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.coupon')[0].reset();
                                $('.coupon').find('.form-control').removeClass(
                                    'is-invalid');
                            },
                        });
                    } else {
                        if (response.message.name) {
                            $('#name').addClass('is-invalid');
                            $('#errorName').html(response.message.name);
                        } else {
                            $('#name').removeClass('is-invalid');
                            $('#name').addClass('');
                            $('#errorName').html('');
                        }
                    }
                }
            })
        })

        // show coupon
        $(document).on("click", "#show", function(e) {
            e.preventDefault();

            var id = $(this).attr("value");
            var url = "{{ route('coupon.show', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#modal-update-coupon').modal('show');
                    $('#edtId').val(response.coupon.id);
                    $('#edtType_coupon').val(response.coupon.type_coupon).trigger('change');
                    $('#edtCode').val(response.coupon.code);
                    $('#edtMin_purchase').val(response.coupon.min_purchase);
                    $('#edtDiscount').val(response.coupon.discount_amount);
                    $('#edtType').val(response.coupon.type).trigger('change');
                    $('#edtMax_discount').val(response.coupon.max_discount);
                    $('#edtDate').val(response.date_range);
                }
            })
        })

        // update coupon
        $(document).on("click", "#updateCoupon", function(e) {
            e.preventDefault();

            var method = $("input[name='_method']").attr('value');
            var id = $('#edtId').val()
            var type_coupon = $('#edtType_coupon').val();
            var code = $('#edtCode').val();
            var min_purchase = $('#edtMin_purchase').val();
            var discount = $('#edtDiscount').val();
            var type = $('#edtType').val();
            var max_discount = $('#edtMax_discount').val();
            var date = $('#edtDate').val();


            var url = "{{ route('coupon.update', ':id') }}";
            url = url.replace(':id', id);

            var fd = new FormData();
            fd.append("_method", method)
            fd.append("id", id);
            fd.append("type_coupon", type_coupon);
            fd.append("code", code);
            fd.append("min_purchase", min_purchase);
            fd.append("discount", discount);
            fd.append("type", type);
            fd.append("max_discount", max_discount);
            fd.append("date", date);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: $('.coupon').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#updateCoupon').attr('disabled', 'disabled');
                    $('#updateCoupon').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#updateCoupon').removeAttr('disabled');
                    $('#updateCoupon').html('Update');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-update-coupon').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.coupon')[0].reset();
                                $('.coupon').find('.form-control').removeClass(
                                    'is-invalid');
                            },
                        });
                    } else {
                        if (response.message.code) {
                            $('#edtCode').addClass('is-invalid');
                            $('#errorEdtName').html(response.message.code);
                        } else {
                            $('#edtCode').removeClass('is-invalid');
                            $('#edtCode').addClass('');
                            $('#errorEdtName').html('');
                        }
                    }
                }
            })
        })

        // bulk delete category
        $(document).on("click", "#bulkDelete", function(e) {
            e.preventDefault();

            var selected = $("#tableCoupon tbody .select-form:checked");
            var id = [];
            // looping row selected
            $.each(selected, function(index, response) {
                id.push(response.value)
            })
            if ($('.select-form:checked').length > 0) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete this data?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#f46a6a',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No',
                    showClass: {
                        popup: 'animate__animated animate__bounceInLeft'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__bounceOut'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('coupon.destroySelected') }}",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function(responce) {
                                $.toast({
                                    text: responce.message,
                                    icon: 'success',
                                    hideAfter: 1500,
                                    showHideTransition: 'plain',
                                    position: 'top-right',
                                    afterShown: function() {
                                        table.ajax.reload();
                                    },
                                });

                            }
                        })
                    }
                });
            } else {
                $.toast({
                    text: "No data will be deleted!",
                    icon: 'warning',
                    showHideTransition: 'plain',
                    hideAfter: 1500,
                    position: 'top-right'
                });
            }
        })

        // delete category
        $(document).on("click", "#destroySoft", function(e) {
            e.preventDefault();

            var id = $(this).attr("value");
            var url = "{{ route('coupon.destroySoft', ':id') }}";
            url = url.replace(':id', id);


            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to delete this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#f46a6a',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No',
                showClass: {
                    popup: 'animate__animated animate__bounceInLeft'
                },
                hideClass: {
                    popup: 'animate__animated animate__bounceOut'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(responce) {
                            $.toast({
                                text: responce.message,
                                icon: 'success',
                                hideAfter: 1500,
                                showHideTransition: 'plain',
                                position: 'top-right',
                                afterShown: function() {
                                    table.ajax.reload();
                                },
                            });
                        }
                    })
                }
            });
        })
    </script>
@endpush
