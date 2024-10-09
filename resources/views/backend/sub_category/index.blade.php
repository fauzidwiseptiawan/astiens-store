@extends('backend.layouts.master')
@section('title', 'Sub Category')
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
                            data-bs-target="#modal-add-sub-category"><i class="ri-add-fill me-1"></i> <span>Add New
                                @yield('title')</span> </button>
                        <button type="button" class="btn btn-danger rounded-pill" id="bulkDelete"><i
                                class="ri-delete-bin-5-line me-1"></i> <span>Bulk Delete</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="tableSubCategory" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="selectAll"
                                    name="select_all">
                            </th>
                            <th>#</th>
                            <th>Category</th>
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

    {{-- modal add sub category --}}
    <div class="modal fade" id="modal-add-sub-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add @yield('title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="sub-category" action="{{ route('sub-category.store') }}" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-control category" data-toggle="category" name="category_id"
                                        id="categoryId">
                                        <option></option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="errorCategory" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter name">
                                    <div id="errorName" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="slug" name="slug" disabled class="form-control">
                                    <div id="errorSlug" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addSubCategory">Save</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

    {{-- modal update  sub category --}}
    <div class="modal fade" id="modal-update-sub-category" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update @yield('title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="sub-category" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edtId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-control category" data-toggle="category" name="category_id"
                                        id="edtCategoryId">
                                        <option></option>
                                    </select>
                                    <div id="errorCategory" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtName" name="name" class="form-control"
                                        placeholder="Enter name">
                                    <div id="errorEdtName" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="edtSlug" name="slug" disabled class="form-control">
                                    <div id="errorEdtSlug" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateSubCategory">Update</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

@endsection

@push('page-scripts')
    <script>
        // generate slug
        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/\-\-+/g, '-')
        }

        // select 2 category
        $(document).ready(function() {
            $('.category').select2({
                placeholder: 'Select Category',
                allowClear: false
            });
        });

        // generate slug
        $(document).on("keyup", "#name", function() {
            var name = $('#name').val();
            var slug = $('#slug').val(generateSlug(name));
        })

        // generate edit slug
        $(document).on("keyup", "#edtName", function() {
            var name = $('#edtName').val();
            var slug = $('#edtSlug').val(generateSlug(name));
        })


        // click close modal reset form
        $(document).on("click", "#close", function() {
            $('.sub-category')[0].reset();
            $('.sub-category').find('.form-control').removeClass('is-invalid');
        })

        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableSubCategory tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableSubCategory tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        // fetch data sub category
        let table;
        let check = 0
        $(function() {
            table = $("#tableSubCategory").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sub-category.fetch') }}",
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
                        data: 'category'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'publish',
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
                url: "{{ route('sub-category.changeActive') }}",
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

        // add sub category
        $(document).on("click", "#addSubCategory", function(e) {
            e.preventDefault();

            var category = $('#categoryId').val();
            var name = $('#name').val();
            var slug = $('#slug').val();

            var fd = new FormData();
            fd.append("category_id", category);
            fd.append("name", name);
            fd.append("slug", slug);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('.sub-category').attr('action'),
                type: $('.sub-category').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#addSubCategory').attr('disabled', 'disabled');
                    $('#addSubCategory').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#addSubCategory').removeAttr('disabled');
                    $('#addSubCategory').html('Save');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-add-sub-category').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.sub-category')[0].reset();
                                $('.sub-category').find('.form-control').removeClass(
                                    'is-invalid');
                                $('.category').select2({
                                    placeholder: 'Select Category',
                                    allowClear: false
                                });
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
                        if (response.message.slug) {
                            $('#slug').addClass('is-invalid');
                            $('#errorSlug').html(response.message.slug);
                        } else {
                            $('#slug').removeClass('is-invalid');
                            $('#slug').addClass('');
                            $('#errorSlug').html('');
                        }
                        if (response.message.category_id) {
                            $('#category').addClass('is-invalid');
                            $('#errorCategory').html(response.message.category_id);
                        } else {
                            $('#category').removeClass('is-invalid');
                            $('#category').addClass('');
                            $('#errorCategory').html('');
                        }
                    }
                }
            })
        })

        // show sub category
        $(document).on("click", "#show", function(e) {
            e.preventDefault();

            var id = $(this).attr("value");
            var url = "{{ route('sub-category.show', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    var sub_category = response.sub_category;
                    var category = response.category;

                    var isi = '';
                    for (let i = 0; i < category.length; i++) {
                        if (sub_category.category_id == category[i]['id']) {
                            isi += `<option value="` + category[i]['id'] + `" selected>` + category[i][
                                'name'
                            ] + `</option>`
                        } else {
                            isi += `<option value="` + category[i]['id'] + `">` + category[i][
                                'name'
                            ] + `</option>`
                        }
                    }

                    $('#modal-update-sub-category').modal('show');
                    $('#edtId').val(response.sub_category.id);
                    $('#edtName').val(response.sub_category.name);
                    $('#edtSlug').val(response.sub_category.slug);
                    $('#edtCategoryId').html(isi);
                }
            })
        })

        // update sub category
        $(document).on("click", "#updateSubCategory", function(e) {
            e.preventDefault();

            var method = $("input[name='_method']").attr('value');
            var id = $('#edtId').val();
            var category = $('#edtCategoryId').val();
            var name = $('#edtName').val();
            var slug = $('#edtSlug').val();

            var url = "{{ route('sub-category.update', ':id') }}";
            url = url.replace(':id', id);

            var fd = new FormData();
            fd.append("_method", method)
            fd.append("id", id);
            fd.append("category_id", category);
            fd.append("name", name);
            fd.append("slug", slug);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: $('.sub-category').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#updateSubCategory').attr('disabled', 'disabled');
                    $('#updateSubCategory').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#updateSubCategory').removeAttr('disabled');
                    $('#updateSubCategory').html('Update');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-update-sub-category').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.sub-category')[0].reset();
                                $('.sub-category').find('.form-control').removeClass(
                                    'is-invalid');
                                $('.category').select2({
                                    placeholder: 'Select Category',
                                    allowClear: false
                                });
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
                        if (response.message.slug) {
                            $('#edtSlug').addClass('is-invalid');
                            $('#errorEdtSlug').html(response.message.slug);
                        } else {
                            $('#edtSlug').removeClass('is-invalid');
                            $('#edtSlug').addClass('');
                            $('#errorEdtSlug').html('');
                        }
                        if (response.message.category_id) {
                            $('#edtCategory').addClass('is-invalid');
                            $('#errorEdtCategory').html(response.message.category_id);
                        } else {
                            $('#edtCategory').removeClass('is-invalid');
                            $('#edtCategory').addClass('');
                            $('#errorEdtCategory').html('');
                        }
                    }
                }
            })
        })

        // bulk delete category
        $(document).on("click", "#bulkDelete", function(e) {
            e.preventDefault();

            var selected = $("#tableSubCategory tbody .select-form:checked");
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
                            url: "{{ route('sub-category.destroySelected') }}",
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
            var url = "{{ route('sub-category.destroySoft', ':id') }}";
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
