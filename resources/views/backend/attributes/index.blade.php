@extends('backend.layouts.master')
@section('title', 'Attributes')
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
                            data-bs-target="#modal-add-attributes"><i class="ri-add-fill me-1"></i> <span>Add New
                                @yield('title')</span> </button>
                        <button type="button" class="btn btn-danger rounded-pill" id="bulkDelete"><i
                                class="ri-delete-bin-5-line me-1"></i> <span>Bulk Delete</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="tableAttributes" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="selectAll"
                                    name="select_all">
                            </th>
                            <th>#</th>
                            <th>Name</th>
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

    {{-- modal add attributes --}}
    <div class="modal fade" id="modal-add-attributes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add @yield('title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="attributes" action="{{ route('attributes.store') }}" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter name">
                                    <div id="errorName" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addAttributes">Save</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

    {{-- modal update  attributes --}}
    <div class="modal fade" id="modal-update-attributes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update @yield('title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="attributes" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edtId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtName" name="name" class="form-control"
                                        placeholder="Enter name">
                                    <div id="errorEdtName" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateAttributes">Update</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

@endsection

@push('page-scripts')
    <script>
        // generate slug
        $(document).on("keyup", "#name", function() {
            var name = $('#name').val();
        })

        // generate edit slug
        $(document).on("keyup", "#edtName", function() {
            var name = $('#edtName').val();
        })

        // click close modal reset form
        $(document).on("click", "#close", function() {
            $('.attributes')[0].reset();
            $('.attributes').find('.form-control').removeClass('is-invalid');
        })

        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableAttributes tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableAttributes tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        // fetch data attributes
        let table;
        let check = 0
        $(function() {
            table = $("#tableAttributes").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('attributes.fetch') }}",
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
                        width: "7%"
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'publish',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false,
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
                url: "{{ route('attributes.changeActive') }}",
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

        // add attributes
        $(document).on("click", "#addAttributes", function(e) {
            e.preventDefault();

            var name = $('#name').val();

            var fd = new FormData();
            fd.append("name", name);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('.attributes').attr('action'),
                type: $('.attributes').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#addAttributes').attr('disabled', 'disabled');
                    $('#addAttributes').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#addAttributes').removeAttr('disabled');
                    $('#addAttributes').html('Save');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-add-attributes').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.attributes')[0].reset();
                                $('.attributes').find('.form-control').removeClass(
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

        // show attributes
        $(document).on("click", "#show", function(e) {
            e.preventDefault();

            var id = $(this).attr("value");
            var url = "{{ route('attributes.show', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#modal-update-attributes').modal('show');
                    $('#edtId').val(response.sub_category.id);
                    $('#edtName').val(response.sub_category.name);
                }
            })
        })

        // update attributes
        $(document).on("click", "#updateAttributes", function(e) {
            e.preventDefault();

            var method = $("input[name='_method']").attr('value');
            var id = $('#edtId').val();
            var name = $('#edtName').val();

            var url = "{{ route('attributes.update', ':id') }}";
            url = url.replace(':id', id);

            var fd = new FormData();
            fd.append("_method", method)
            fd.append("id", id);
            fd.append("name", name);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: $('.attributes').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#updateAttributes').attr('disabled', 'disabled');
                    $('#updateAttributes').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#updateAttributes').removeAttr('disabled');
                    $('#updateAttributes').html('Update');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-update-attributes').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.attributes')[0].reset();
                                $('.attributes').find('.form-control').removeClass(
                                    'is-invalid');
                            },
                        });
                    } else {
                        if (response.message.name) {
                            $('#edtName').addClass('is-invalid');
                            $('#errorEdtName').html(response.message.name);
                        } else {
                            $('#edtName').removeClass('is-invalid');
                            $('#edtName').addClass('');
                            $('#errorEdtName').html('');
                        }
                    }
                }
            })
        })

        // bulk delete category
        $(document).on("click", "#bulkDelete", function(e) {
            e.preventDefault();

            var selected = $("#tableAttributes tbody .select-form:checked");
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
                            url: "{{ route('attributes.destroySelected') }}",
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
            var url = "{{ route('attributes.destroySoft', ':id') }}";
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
