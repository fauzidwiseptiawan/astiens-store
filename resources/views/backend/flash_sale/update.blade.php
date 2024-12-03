@extends('backend.layouts.master')
@section('title', 'Flash Sale')
@push('styles')
    <style>
        .table-responsive-sm {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 768px) {

            .table-centered th,
            .table-centered td {
                display: block;
                text-align: left;
                width: 100%;
            }

            .table-centered tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .table-centered th {
                background-color: #f7f7f7;
                font-weight: bold;
            }

            .table-centered td {
                padding: 0.5rem 1rem;
            }

            .table-centered img {
                max-width: 80px;
            }
        }

        th,
        td {
            word-wrap: break-word;
            white-space: normal;
            /* Memastikan teks tidak tetap dalam satu baris */
        }

        .table-centered th {
            word-break: break-word;
            /* Memecah kata panjang agar tidak melampaui lebar */
        }

        .table-centered td p {
            word-break: break-word;
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Marketing</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <!-- product information -->
            <form class="flash-sale" action="{{ route('flash-sale.update', $flash_sale->id) }}" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Flash Sale Information</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <input type="hidden" id="slugs" name="slugs" value="{{ $flash_sale->slug }}"
                                class="form-control" placeholder="Enter slugs">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter name" value="{{ $flash_sale->name }}">
                                <div id="errorName" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="date" class="form-label">Date <strong class="text-danger">*</strong></label>
                                <input type="text" id="date" name="date" class="form-control"
                                    placeholder="Select date" value="{{ $date_range }}">
                                <div id="errorDate" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Banner</small>
                                    <strong class="text-danger">*</strong></label>
                                <input type="file" id="image" name="image" class="form-control">
                                <div id="errorImage" class="invalid-feedback"></div>
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border mt-1" id="img1loading" role="status" style="display:none;">
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-lg-12" id="previewImage"
                                    style="{{ $flash_sale->image ? '' : 'display: none;' }}">
                                    <div class="card mt-1 shadow-none border">
                                        <div class="p-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img id="imagePreview"
                                                        src="{{ asset('storage/upload/image/flash_sale/thumbnail/' . $flash_sale->image) }}"
                                                        alt="image" class="avatar-sm rounded bg-light" />
                                                </div>
                                                <div class="col ps-0">
                                                    <a
                                                        class="text-muted fw-bold file-name">{{ strlen($flash_sale->image) > 10 ? substr($flash_sale->image, 0, 10) : $flash_sale->image }}</a>
                                                    <a class="text-muted fw-bold file-format">.{{ $flash_sale->ext }}</a>
                                                    <p class="mb-0 file-size">
                                                        {{ number_format($flash_sale->size / 1024, 2) }}
                                                        KB</p>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" id="removeImage"
                                                        class="btn btn-link fs-16 text-muted">
                                                        <i class="ri-close-line text-danger"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small>This image is visible in all product box. Minimum dimensions required: 195px
                                    width X
                                    195px height. Keep some blank space around main object of your image as we had to
                                    crop
                                    some edge in different devices to make it responsive.</small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="product" class="form-label">Product <strong
                                        class="text-danger">*</strong></label>
                                <select class="form-control product" data-toggle="product" name="product[]" id="product"
                                    multiple>
                                    <option></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            @foreach ($flash_sale->flashSaleProduct as $item)
                                                        @if ($item->product_id == $product->id) selected @endif @endforeach>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errorProduct" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="alert alert-danger" role="alert">
                            If any product has discount or exists in another flash deal, the discount will be replaced by
                            this
                            discount
                            & time limit.
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary m-2" id="vloading" role="status"
                                style="display:none;">
                            </div>
                        </div>
                        <div class="table-responsive-sm product-flash-sale p-1">
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 500px">Product</th>
                                        <th>Base Price</th>
                                        <th>Discount</th>
                                        <th>Discount Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flash_sale->flashSaleProduct as $item)
                                        @php
                                            $product = $item->product; // Mendapatkan detail produk
                                        @endphp
                                        <tr data-product-id="{{ $product->id }}">
                                            <td>
                                                <div class="d-flex p-1">
                                                    <img src="{{ $product->image ?? 'https://placehold.co/100' }}"
                                                        class="me-2 img-fluid avatar-md rounded" alt="Product Image" />
                                                    <div class="w-100">
                                                        <p class="mt-0 ms-2">
                                                            {{ $product->name }} <!-- Menampilkan nama produk -->
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            <td>
                                                <input type="number" id="discount" name="discount[]"
                                                    class="form-control" placeholder="Enter discount"
                                                    value="{{ $item->discount_price }}">
                                            </td>
                                            <td>
                                                <select class="form-control type" data-toggle="type" name="type[]"
                                                    id="type">
                                                    <option value="Flat"
                                                        {{ $item->discount_type == 'Flat' ? 'selected' : '' }}>Flat
                                                    </option>
                                                    <option value="Percentage"
                                                        {{ $item->discount_type == 'Percentage' ? 'selected' : '' }}>
                                                        Percentage
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="updateFlashSale">
                                <i class="ri-save-line"></i> Save
                            </button>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </form>
            <!-- end card body-->
        </div>
    @endsection

    @push('page-scripts')
        <script>
            // nav active
            $('#sidebarMarketing, .sidebarMarketing, #activeMarketing').addClass('show menuitem-active');

            function capitalize(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Tampilkan notifikasi error
            function errorToast(message) {
                $.toast({
                    text: message,
                    icon: 'error',
                    showHideTransition: 'plain',
                    hideAfter: 2000,
                    position: 'top-right',
                });
            }

            // Tampilkan notifikasi
            function successToast(message) {
                $.toast({
                    text: message,
                    icon: 'success',
                    showHideTransition: 'plain',
                    hideAfter: 2000,
                    position: 'top-right',
                });
            }

            // Tampilkan notifikasi
            function infoToast(message) {
                $.toast({
                    text: message,
                    icon: 'info',
                    showHideTransition: 'plain',
                    hideAfter: 2000,
                    position: 'top-right',
                });
            }


            flatpickr("#date", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // Jika Anda ingin mendapatkan nilai dan melakukan sesuatu dengan itu
                }
            });


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
                        // Show an alert when the file is not an image
                        errorToast("Please upload an image file (PNG, JPEG, JPG)!");
                        $("#previewImage").hide(50);
                        $('#image').val('');
                    }

                    $('#removeImage').click(function(e) {
                        e.preventDefault()
                        $("#previewImage").hide(50);
                        $('#image').val('');
                    })
                });
            });

            // Generate slug
            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/^-+/, '')
                    .replace(/-+$/, '')
                    .replace(/\s+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/[^\w\-]+/g, '');
            }

            var $nameInput = $('#name');
            var $slugInput = $('#slugs');

            // Generate slug on input
            $nameInput.on("input", function() {
                $slugInput.val(generateSlug($nameInput.val()));
            });

            $(document).ready(function() {
                // Select option initialization
                const selectElements = ['.product', '.type'];

                selectElements.forEach(function(selector) {
                    $(selector).select2({
                        placeholder: `Select ${selector.replace('.', '').replace(/([A-Z])/g, ' $1').trim()}`,
                        allowClear: false,
                    });
                });

                // Event listener for changes in the product dropdown
                $(".product").on('change', function() {
                    const selectedProducts = $(this).val(); // Get the array of selected product IDs

                    // Show loading indicator while removing products
                    $("#vloading").show(50);

                    // Remove products that are no longer selected
                    $(".product-flash-sale tbody tr").each(function() {
                        const productId = $(this).data('product-id');
                        if (!selectedProducts.includes(productId.toString())) {
                            $(this).remove(); // Remove product row from table
                        }
                    });

                    // Hide loading indicator after removal is complete
                    $("#vloading").hide(50);

                    // Add new products that are selected
                    if (selectedProducts && selectedProducts.length > 0) {
                        $(".product-flash-sale").show(50); // Show the table if there are selected products
                        selectedProducts.forEach(function(productId) {
                            // Check if the product is already in the table, if not, add it
                            if ($(`.product-flash-sale tbody tr[data-product-id="${productId}"]`)
                                .length === 0) {
                                appendProductToFlashSale(productId); // Add the new product to the table
                            }
                        });
                    } else {
                        $(".product-flash-sale").hide(50); // Hide table if no products are selected
                    }
                });

                // Function to add a product to the flash sale table
                function appendProductToFlashSale(productId) {
                    // Check if the product already exists in the table
                    if ($(".product-flash-sale tbody tr").filter(function() {
                            return $(this).data('product-id') == productId; // Check for matching product ID
                        }).length > 0) {
                        return; // Exit if the product is already in the table
                    }

                    // Show loading indicator while fetching product details
                    $("#vloading").show(50);

                    // Prepare the URL for the AJAX request
                    var url = "{{ route('flash-sale.getProduct', ':id') }}";
                    url = url.replace(':id', productId);

                    // Perform the AJAX request to fetch product details
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            // Hide loading indicator after processing the request
                            $("#vloading").hide(50);
                            if (response) {
                                const selectedProduct = response
                                    .product; // Adjust according to your response format
                                const price = selectedProduct.price ||
                                    0; // Ensure price is not null or undefined
                                const formattedPrice = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }).format(price);

                                // Create a new row for the product
                                const newRow = `
                                    <tr data-product-id="${productId}">
                                        <td>
                                            <div class="d-flex p-1">
                                                <img src="https://placehold.co/100" class="me-2 img-fluid avatar-md rounded" alt="Product Image" />
                                                <div class="w-100">
                                                    <p class="mt-0 ms-2">${selectedProduct.name}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${formattedPrice}</td>
                                        <td>
                                            <input type="number" id="discount" name="discount[]" class="form-control" placeholder="Enter discount">
                                        </td>
                                        <td>
                                            <select class="form-control type" data-toggle="type" name="type[]" id="type">
                                                <option value="Flat">Flat</option>
                                                <option value="Percentage">Percentage</option>
                                            </select>
                                        </td>
                                    </tr>
                                `;

                                // Append the new row to the table
                                $(".product-flash-sale tbody").append(newRow);
                            }
                        }
                    });
                }
            });

            // store flash sale at database
            $(document).on("click", "#updateFlashSale", function(e) {
                var method = $("input[name='_method']").attr('value');
                let slugs = $('#slugs').val();
                let name = $('#name').val();
                let date = $('#date').val();
                var image = $('#image')[0].files[0];

                var fd = new FormData();
                fd.append("_method", method)
                fd.append("name", name);
                fd.append("slugs", slugs);
                fd.append("date", date);
                // Cek jika gambar di-upload dan kondisi 'name' terpenuhi (misalnya name tidak kosong)
                if (image && name.trim() !== "") {
                    fd.append("image", image);
                }

                $('select[name="product[]"]').each(function() {
                    var selectedValues = $(this).val(); // Mendapatkan array nilai yang dipilih
                    if (selectedValues && selectedValues.length > 0) {
                        selectedValues.forEach(function(value) {
                            fd.append("product[]", value); // Add each value to FormData
                        });
                    } else {
                        errorToast("Please select at least one product.");
                        return false; // Stop further processing
                    }
                });
                $('input[name="discount[]"]').each(function() {
                    var discountValue = $(this).val();
                    if (discountValue) {
                        fd.append("discount[]", discountValue);
                    } else {
                        errorToast("Discount cannot be empty.");
                        return false; // Stop further processing
                    }
                });

                $('select[name="type[]"]').each(function() {
                    var typeValue = $(this).val();
                    if (typeValue) {
                        fd.append("type[]", typeValue);
                    } else {
                        errorToast("Please select a type.");
                        return false; // Stop further processing
                    }
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: $('.flash-sale').attr('action'),
                    type: $('.flash-sale').attr('method'),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function() {
                        $('#updateFlashSale').attr('disabled', 'disabled');
                        $('#updateFlashSale').html('<i class="ri-loader-4-line"></i>');
                    },
                    complete: function() {
                        $('#updateFlashSale').removeAttr('disabled');
                        $('#updateFlashSale').html('<i class="ri-save-line"></i> Save');
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $.toast({
                                text: response.message,
                                icon: 'success',
                                showHideTransition: 'plain',
                                hideAfter: 1500,
                                position: 'top-right',
                                afterShown: function() {
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('flash-sale.index') }}";
                                    }, 1500);
                                },
                            });
                        } else {
                            const fields = [{
                                    id: 'name',
                                    key: 'name'
                                },
                                {
                                    id: 'date',
                                    key: 'date'
                                },
                                {
                                    id: 'image',
                                    key: 'image'
                                },
                            ];
                            fields.forEach(field => {
                                const errorElement = $(`#error${capitalize(field.id)}`);
                                const $field = $(`#${field.id}`);
                                if (response.message[field.key]) {
                                    $field.addClass('is-invalid');
                                    errorElement.html(response.message[field.key]);
                                } else {
                                    $field.removeClass('is-invalid');
                                    errorElement.html('');
                                }
                            });
                        }
                    }
                })
            })
        </script>
    @endpush
