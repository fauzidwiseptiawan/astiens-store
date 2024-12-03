@extends('backend.layouts.master')
@section('title', 'Category')
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
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="m-0 d-print-none">All @yield('title')</h4>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#modal-add-category"><i class="ri-add-fill me-1"></i> <span>Add New
                                @yield('title')</span> </button>
                        <button type="button" class="btn btn-danger rounded-pill" id="bulkDelete"><i
                                class="ri-delete-bin-5-line me-1"></i> <span>Bulk Delete</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="tableCategory" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input select-form" id="selectAll"
                                    name="select_all">
                            </th>
                            <th>#</th>
                            <th>Image</th>
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

    {{-- modal add category --}}
    <div class="modal fade" id="modal-add-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="category" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
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
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Set Image <small>(300x300)</small>
                                        <strong class="text-danger">*</strong></label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <div id="errorImage" class="invalid-feedback"></div>
                                    <div class="col-xxl-12 col-lg-12" id="previewImage">
                                        <div class="card mt-1 shadow-none border">
                                            <div class="p-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img id="imagePreview"
                                                            src="https://via.placeholder.com/150?text=No+Image"
                                                            alt="image" class="avatar-sm rounded bg-light" />
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a class="text-muted fw-bold file-name"></a>
                                                        <a class="text-muted fw-bold file-format"></a>
                                                        <p class="mb-0 file-size"></p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <button type="button" id="removeImage"
                                                            class="btn btn-link fs-16 text-muted">
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position <strong
                                            class="text-danger">*</strong></label>
                                    <input type="number" id="position" name="position" class="form-control"
                                        placeholder="Enter position order">
                                    <div id="errorPosition" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Meta Keywords </label>
                                    <input type="text" id="keywords" name="keywords" class="form-control"
                                        placeholder="Enter meta keywords">
                                    <div id="errorKeywords" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Meta Description</label>
                                    <textarea class="form-control" id="desc" rows="5"></textarea>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addCategory">Save</button>
                    </div> <!-- end modal footer -->
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div>

    {{-- modal update category --}}
    <div class="modal fade" id="modal-update-category" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Update Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- end modal header -->
                <form class="category" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edtId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
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
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Set Image <small>(300x300)</small>
                                        <strong class="text-danger">*</strong></label>
                                    <input type="file" id="edtImage" name="image" class="form-control">
                                    <div id="errorEdtImage" class="invalid-feedback"></div>
                                    <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                        <div class="card mt-1 shadow-none border">
                                            <div class="p-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img id="edtImagePreview"
                                                            src="https://via.placeholder.com/150?text=No+Image"
                                                            alt="image" class="avatar-sm rounded bg-light" />
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a class="text-muted fw-bold edt-file-name"></a>
                                                        <a class="text-muted fw-bold edt-file-format"></a>
                                                        <p class="mb-0 edt-file-size"></p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <button type="button" id="edtRemoveImage"
                                                            class="btn btn-link fs-16 text-muted">
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position <strong
                                            class="text-danger">*</strong></label>
                                    <input type="number" id="edtPosition" name="position" class="form-control"
                                        placeholder="Enter position order">
                                    <div id="errorEdtPosition" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Meta Keywords </label>
                                    <input type="text" id="edtKeywords" name="keywords" class="form-control"
                                        placeholder="Enter meta keywords">
                                    <div id="errorEdtKeywords" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Meta Description</label>
                                    <textarea class="form-control" id="edtDesc" rows="5"></textarea>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" id="close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateCategory">Update</button>
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
            var slug = $('#slug').val(generateSlug(name));
        })
        // generate slug update
        $(document).on("keyup", "#edtName", function() {
            var name = $('#edtName').val();
            var slug = $('#edtSlug').val(generateSlug(name));
        })

        // click close modal reset form
        $(document).on("click", "#close", function() {
            $('.category')[0].reset();
            $('.category').find('.form-control').removeClass('is-invalid');
            $("#previewImage").hide();
        })

        // generate slug
        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/\-\-+/g, '-')
        }

        // format file size
        function formatFileSize(bytes, decimalPoint) {
            if (bytes == 0) return '0 Bytes';
            var k = 1000,
                dm = decimalPoint || 2,
                sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        // preview image add
        $(document).ready(function() {
            $("#previewImage").hide(50);
            $('#image').change(function(e) {
                e.preventDefault()
                var input = e.target
                var image = $('#image')[0].files[0];
                var url = $(e.target).val()

                const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase()
                if (input.files && input.files[0] && (ext === 'png' || ext === 'jpeg' || ext === 'jpg')) {
                    const reader = new FileReader()

                    reader.onload = function(e) {
                        $("#previewImage").show(50);
                        $('#imagePreview').attr('src', e.target.result)
                        $('.file-name').html(image.name.substr(0, 5) + '.. ')
                        $('.file-format').html('.' + image.type.substr(6, 4))
                        $('.file-size').html(formatFileSize(image.size))
                    }
                    reader.readAsDataURL(input.files[0])
                } else {
                    $("#previewImage").hide(50);
                }

                $('#removeImage').click(function(e) {
                    e.preventDefault()
                    $("#previewImage").hide(50);
                    $('#image').val('');
                })
            });
        });

        // preview image update
        $(document).ready(function() {
            $('#edtImage').change(function(e) {
                e.preventDefault()
                var input = e.target
                var image = $('#edtImage')[0].files[0];
                var url = $(e.target).val()

                const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase()
                if (input.files && input.files[0] && (ext === 'png' || ext === 'jpeg' || ext === 'jpg')) {
                    const reader = new FileReader()

                    reader.onload = function(e) {
                        $("#edtPreviewImage").show(50);
                        $('#edtImagePreview').attr('src', e.target.result);
                        $('.edt-file-name').html(image.name.substr(0, 5) + '.. ');
                        $('.edt-file-format').html('.' + image.type.substr(6, 4));
                        $('.edt-file-size').html(formatFileSize(image.size));
                    }
                    reader.readAsDataURL(input.files[0])
                } else {
                    $("#edtPreviewImage").hide(50);
                }

                $('#edtRemoveImage').click(function(e) {
                    e.preventDefault()
                    $("#edtPreviewImage").hide(50);
                    $('#edtImage').val('');
                })
            });
        });

        // check validation imgae update
        if ($("#edtImage").val() != '') {
            if (!image.type.match('image.*')) {
                $('#edtImage').addClass('is-invalid');
                $('#errorEdtImage').html('Format harus image!')
            } else {
                $('#edtImage').addClass('');
                $('#errorEdtImage').html('')
            }
        }

        // function select all
        $("#selectAll").on('click', function() {
            var isChecked = $("#selectAll").prop('checked')
            $(".select-form").prop('checked', isChecked)
        })

        // function select one
        $("#tableCategory tbody").on('click', '.select-form', function() {
            if ($(this).prop('checked') != true) {
                $("#selectAll").prop('checked', false)
            }
            var selectAll = $("#tableCategory tbody .select-form:checked")
            var devareSelected = (selectAll.length > 0)
        })

        // fetch data category
        let table;
        let check = 0
        $(function() {
            table = $("#tableCategory").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('category.fetch') }}",
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
                        data: 'image',
                        searchable: false,
                        sortable: false,
                        width: "15%"
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
                url: "{{ route('category.changeActive') }}",
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

        // add category
        $(document).on("click", "#addCategory", function(e) {

            var name = $('#name').val();
            var slug = $('#slug').val();
            var position = $('#position').val();
            var keywords = $('#keywords').val();
            var desc = $('#desc').val();
            var image = $('#image')[0].files[0];

            var fd = new FormData();
            fd.append("name", name);
            fd.append("slug", slug);
            fd.append("position", position);
            fd.append("keywords", keywords);
            fd.append("desc", desc);
            fd.append("image", image);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('.category').attr('action'),
                type: $('.category').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#addCategory').attr('disabled', 'disabled');
                    $('#addCategory').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#addCategory').removeAttr('disabled');
                    $('#addCategory').html('Save');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-add-category').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.category')[0].reset();
                                $('.category').find('.form-control').removeClass(
                                    'is-invalid');
                                $("#previewImage").hide();
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
                        if (response.message.position) {
                            $('#position').addClass('is-invalid');
                            $('#errorPosition').html(response.message.position);
                        } else {
                            $('#position').removeClass('is-invalid');
                            $('#position').addClass('');
                            $('#errorPosition').html('');
                        }
                        if (response.message.image) {
                            $('#image').addClass('is-invalid');
                            $('#errorImage').html(response.message.image);
                        } else {
                            $('#image').removeClass('is-invalid');
                            $('#image').addClass('');
                            $('#errorImage').html('');
                        }
                    }
                }
            })
        })

        // show modal category
        $(document).on("click", "#show", function(e) {
            e.preventDefault();
            var id = $(this).attr("value");
            var url = "{{ route('category.show', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#modal-update-category').modal('show');
                    $('#edtId').val(response.data.id);
                    $('#edtName').val(response.data.name);
                    $('#edtSlug').val(response.data.slug);
                    $('#edtPosition').val(response.data.position_order);
                    $('#edtKeywords').val(response.data.meta);
                    $('#edtDesc').val(response.data.meta_desc);
                    $('#edtImagePreview').attr('src',
                        `{{ URL::asset('storage/upload/image/category/thumbnail/') }}/${response.data.image}`
                    );
                    var nameImage = response.data.image;
                    var sizeImage = response.data.size;
                    $('.edt-file-name').html(nameImage.substr(0, 10) + ".. ");
                    $('.edt-file-format').html(response.data.ext);
                    $('.edt-file-size').html(formatFileSize(sizeImage));
                }
            })
        })

        // update category
        $(document).on("click", "#updateCategory", function(e) {
            e.preventDefault();

            var method = $("input[name='_method']").attr('value');
            var id = $('#edtId').val();
            var name = $('#edtName').val();
            var slug = $('#edtSlug').val();
            var position = $('#edtPosition').val();
            var keywords = $('#edtKeywords').val();
            var desc = $('#edtDesc').val();
            var image = $('#edtImage')[0].files[0];

            var url = "{{ route('category.update', ':id') }}";
            url = url.replace(':id', id);

            var fd = new FormData();
            fd.append("_method", method)
            fd.append("id", id);
            fd.append("name", name);
            fd.append("slug", slug);
            fd.append("position", position);
            fd.append("keywords", keywords);
            fd.append("desc", desc);
            fd.append("image", image);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: $('.category').attr('method'),
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#updateCategory').attr('disabled', 'disabled');
                    $('#updateCategory').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#updateCategory').removeAttr('disabled');
                    $('#updateCategory').html('Update');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modal-update-category').modal('hide')
                        $.toast({
                            text: response.message,
                            icon: 'success',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right',
                            afterShown: function() {
                                table.ajax.reload();
                                $('.category')[0].reset();
                                $('.category').find('.form-control').removeClass(
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
                        if (response.message.slug) {
                            $('#edtSlug').addClass('is-invalid');
                            $('#errorEdtSlug').html(response.message.slug);
                        } else {
                            $('#edtSlug').removeClass('is-invalid');
                            $('#edtSlug').addClass('');
                            $('#errorEdtSlug').html('');
                        }
                        if (response.message.position) {
                            $('#edtPosition').addClass('is-invalid');
                            $('#errorEdtPosition').html(response.message.position);
                        } else {
                            $('#edtPosition').removeClass('is-invalid');
                            $('#edtPosition').addClass('');
                            $('#errorEdtPosition').html('');
                        }
                    }
                }
            })
        })

        // bulk delete category
        $(document).on("click", "#bulkDelete", function(e) {
            e.preventDefault();

            var selected = $("#tableCategory tbody .select-form:checked");
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
                            url: "{{ route('category.destroySelected') }}",
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
            var url = "{{ route('category.destroySoft', ':id') }}";
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
