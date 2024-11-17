@extends('backend.layouts.master')
@section('title', 'Add Product')
@push('styles')
    <style>
        .child-row {
            max-height: 300px;
            /* Atur batas tinggi sesuai kebutuhan */
            overflow-y: auto;
            /* Tambahkan scrollbar jika konten lebih dari batas tinggi */
        }

        @media (max-width: 992px) {

            /* atau sesuai dengan breakpoint mobile */
            .order-12 {
                order: 12;
            }
        }

        /* Mengatur gaya untuk Select2 saat is-invalid */
        .select2-container--default.is-invalid .select2-selection--single {
            border: 1px solid red;
            /* Warna border merah untuk menandakan kesalahan */
            border-radius: 0.25rem;
            /* Menyesuaikan radius border */
            background-color: #fff;
            /* Warna latar belakang putih */
        }


        /* Mengatur gaya dropdown saat is-invalid */
        .select2-container--default.is-invalid .select2-selection--single .select2-selection__arrow b {
            border-color: red transparent transparent transparent;
            /* Mengatur warna panah dropdown */
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
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">All Product</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <!-- row 1 -->
            <div class="col-xxl-8 col-xl-8 col-lg-8">
                <!-- product information -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Information</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {{-- <label for="barcode" class="form-label">Item Code</label> --}}
                                <input type="hidden" id="itemCode" name="item_code" class="form-control" disabled>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter name">
                                <div id="errorName" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {{-- <label for="slugs" class="form-label">Slugs</label> --}}
                                <input type="hidden" id="slugs" name="slugs" class="form-control" disabled>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" id="barcode" name="barcode" class="form-control"
                                    placeholder="Enter barcode">
                                <div id="errorBarcode" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Unit <strong class="text-danger">*</strong></label>
                                <input type="text" id="unit" name="unit" class="form-control"
                                    placeholder="Unit (e.g. PCS, KG etc)">
                                <div id="errorUnit" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Weight <strong
                                        class="text-danger">*</strong></label>
                                <div class="input-group flex-nowrap">
                                    <input type="number" class="form-control" id="weight" placeholder="Enter weight"
                                        aria-describedby="basic-addon1" value="0">
                                    <span class="input-group-text" id="basic-addon1">Grams</span>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Minimum Order Quantity</label>
                                <input type="number" id="minQty" name="min_qty" class="form-control"
                                    placeholder="Enter minimum order quantity">
                                <div id="errorMinQty" class="invalid-feedback"></div>
                                <small>Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Maximum Order Quantity</label>
                                <input type="number" id="maxQty" name="max_qty" class="form-control"
                                    placeholder="Enter maximum order quantity">
                                <div id="errorMaxQty" class="invalid-feedback"></div>
                                <small>Maximum quantity to place an order, if the value is 0, there is no limit.</small>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product files & media -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Files & Media</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Thumbnail Image</small>
                                    <strong class="text-danger">*</strong></label>
                                <input type="file" id="image1" name="image" class="form-control">
                                <div id="errorImage1" class="invalid-feedback"></div>
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border mt-1" id="img1loading" role="status"
                                        style="display:none;">
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-lg-12" id="thumbnail1">
                                    <div class="card mt-1 shadow-none border">
                                        <div class="p-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img id="imagePreview1"
                                                        src="https://via.placeholder.com/150?text=No+Image" alt="image"
                                                        class="avatar-sm rounded bg-light" />
                                                </div>
                                                <div class="col ps-0">
                                                    <a class="text-muted fw-bold file-name1"></a>
                                                    <a class="text-muted fw-bold file-format1"></a>
                                                    <p class="mb-0 file-size1"></p>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" id="removeImage1"
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
                        <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Gallery Images</label>
                                <input type="file" id="image2" name="image2[]" class="form-control" multiple>
                                <div id="errorImage" class="invalid-feedback"></div>
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border mt-1" id="img2loading" role="status"
                                        style="display:none;">
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-lg-12" id="thumbnail2">
                                    <div class="card mt-1 shadow-none border">
                                        <div class="p-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img id="imagePreview1"
                                                        src="https://via.placeholder.com/150?text=No+Image" alt="image"
                                                        class="avatar-sm rounded bg-light" />
                                                </div>
                                                <div class="col ps-0">
                                                    <a class="text-muted fw-bold file-name1"></a>
                                                    <a class="text-muted fw-bold file-format1"></a>
                                                    <p class="mb-0 file-size1"></p>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" id="removeImage2"
                                                        class="btn btn-link fs-16 text-muted">
                                                        <i class="ri-close-line text-danger"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small>These images are visible in product details page gallery. Minimum dimensions
                                    required: 900px width X 900px height.</small>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Video Link</label>
                                    <input type="text" id="link" name="link" class="form-control"
                                        placeholder="Enter video link">
                                    <small>Use proper link without extra parameter. Don't use short share link/embeded
                                        iframe
                                        code.</small>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">PDF Specification</label>
                                    <input type="file" id="file" name="file" class="form-control">
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end card body-->
                    </div>
                </div>
                <!-- product price -->
                <div class="card">
                    <div class="card-header bg-light-subtle">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-8 mb-2 mb-md-0">
                                <h5 class="text-center text-md-start">Product price, stock</h5>
                            </div>
                            <div class="col-12 col-md-4 text-center text-md-end">
                                <label for="name" class="form-label ms-3 me-2 d-block d-md-inline">Variant Product
                                </label>
                                <label class="slideon">
                                    <input type="checkbox" name="is_variant" value="1" id="isVariant">
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="notVariant">
                        <form class="reset-not-variant-form">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Regular price <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="Enter regular price" onkeyup="money_format(this)">
                                    <div id="errorPrice" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">SKU <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="sku" name="sku" class="form-control"
                                        placeholder="Enter SKU">
                                    <div id="errorSku" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Stock <strong
                                            class="text-danger">*</strong></label>
                                    <input type="number" id="stock" name="stock" class="form-control"
                                        placeholder="Enter stock">
                                    <div id="errorStock" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                        </form>
                    </div>
                    <div class="card-body" id="variant">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="Attributes" disabled>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control choice_attributes" data-toggle="choice_attributes"
                                    name="choice_attributes[]" id="choiseAttributes" multiple="multiple">
                                    <option></option>
                                    @foreach ($attributes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-2 mb-2">Choose the attributes of this product and then input attribute of each
                                attribute
                            </p>
                            <div class="value-attributes">
                            </div>
                        </div>
                        <!-- detail variant -->
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" id="vloading" role="status" style="display:none;"></div>
                        </div>
                        <div class="table-responsive mt-3" id="formDetailVariant">
                            <form class="reset-variant-form">
                                <table class="table table-bordered display responsive nowrap detail-variant"
                                    id="detailVariant" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="30%">Variant</th>
                                            <th>Variant Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody"></tbody>
                                </table>
                            </form>
                        </div>
                        <!-- end table-responsive-->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product description -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Description</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Short Description</label>
                                <textarea name="short_desc" class="form-control" id="shortDesc" placeholder="Short Description"></textarea>
                                <div id="errorShortDesc" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Description <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="long_desc" class="form-control" id="longDesc" placeholder="Short Description"></textarea>
                                <div id="errorLongDesc" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end card -->

            </div>
            <!-- row 2 -->
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <!-- product status -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Status <strong class="text-danger">*</strong></h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-control status" data-toggle="status" name="is_active"
                                    id="isActive">
                                    <option></option>
                                    <option value="2">Draft</option>
                                    <option value="3">Pending</option>
                                    <option value="1">Published</option>
                                </select>
                                <div id="errorIsActive" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product brand -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Brand <strong class="text-danger">*</strong></h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-control brand" data-toggle="brand" name="brand_id" id="brandId">
                                    <option></option>
                                </select>
                                <div id="errorBrandId" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product category -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Category <strong class="text-danger">*</strong>
                    </h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-control category" data-toggle="category" name="category_id"
                                    id="categoryId">
                                    <option></option>
                                </select>
                                <div id="errorCategoryId" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-control SubCategory" data-toggle="SubCategory" name="sub_category_id"
                                    id="subCategoryId">
                                    <option></option>
                                </select>
                                <div id="errorSubCategoryId" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- is Feature -->
                <div class="card">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6">
                            <h5 class="card-header bg-light-subtle">Is Feature?</h5>
                            <div class="card-body">
                                <label class="slideon">
                                    <input type="checkbox" name="is_feature" value="1" id="isFeature">
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6">
                            <h5 class="card-header bg-light-subtle">Refundable</h5>
                            <div class="card-body">
                                <label class="slideon">
                                    <input type="checkbox" name="refundable" value="0" id="refundable">
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- end card body-->
                </div>

                <!-- product Tags -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Tags <strong class="text-danger">*</strong></h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <input type="text" id="tags" name="tags" class="form-control tags"
                                    placeholder="Enter tags">
                                <div id="errorTags" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- Search Engine Optimize -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Search Engine Optimize</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="seo" class="form-label">SEO Title</label>
                                <input type="text" id="seo" name="seo" class="form-control"
                                    placeholder="Enter SEO">
                                <div id="errorSeo" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="seo" class="form-label">SEO Description</label>
                                <textarea class="form-control" id="seoDesc" name="seo_desc" rows="3" placeholder="Enter SEO Description"></textarea>
                                <div id="errorSeoDesc" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product discount -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Discount</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Discount Date Range </label>
                                <input type="text" id="date" name="date" class="form-control"
                                    placeholder="2018-10-03 to 2018-10-10">
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Discount </label>
                                <input type="text" id="discount" name="discount" class="form-control"
                                    placeholder="Enter discount">
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product collection -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Collections</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="newArrival" name="new_arrival"
                                    value="1">
                                <label class="form-check-label" for="customCheck1">New Arrival</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="bestSeller" name="best_seller"
                                    value="1">
                                <label class="form-check-label" for="customCheck2">Best Seller</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="specialOffer" name="special_offer"
                                    value="1">
                                <label class="form-check-label" for="customCheck3">Special Offer</label>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- labels -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Labels</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="hot" value="1">
                                <label class="form-check-label" for="customCheck1">Hot</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="new" value="1">
                                <label class="form-check-label" for="customCheck2">New</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="sale" value="1">
                                <label class="form-check-label" for="customCheck3">Sale</label>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product publish -->
                <div class="card order-12 order-lg-0">
                    <h5 class="card-header bg-light-subtle">Publish</h5>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="addProduct">
                                <i class="ri-save-line"></i> Save
                            </button>
                            <button type="button" class="btn btn-light">
                                <i class="ri-logout-box-r-line"></i> Save & Exit
                            </button>
                        </div>
                    </div>
                    <!-- end card body-->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div> <!-- end col-->
@endsection

@push('page-scripts')
    <script>
        // nav active
        $('#sidebarProduct, .activeProduct, #activeProduct').addClass('show menuitem-active');

        function capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // get brand and category by request
        $(document).ready(function() {
            // Inisialisasi Select2 untuk Brand
            $('#brandId').select2({
                placeholder: 'Select Brand',
                allowClear: false,
                ajax: {
                    url: `{{ route('product.getBrand') }}`, // URL endpoint untuk data Brand
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // Kata kunci pencarian
                            page: params.page || 1 // Halaman yang diminta
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        // Memproses hasil pencarian Brand
                        const results = data.data.map(item => ({
                            id: item.id,
                            text: item.name
                        })) || [];

                        // Menyisipkan opsi "All Brand" hanya pada halaman pertama
                        if (params.page === 1) {
                            results.unshift({
                                id: 0,
                                text: 'All Brand'
                            });
                        }

                        return {
                            results: results,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                templateResult: function(item) {
                    return item.text ? $('<span>' + item.text + '</span>') : item.text;
                },
                templateSelection: function(item) {
                    return item.text;
                }
            });

            // Inisialisasi Select2 untuk Category
            $('#categoryId').select2({
                placeholder: 'Select Category',
                allowClear: false,
                ajax: {
                    url: `{{ route('product.getCategory') }}`, // URL endpoint untuk data Category
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        // Memproses hasil pencarian Category
                        const results = data.data.map(item => ({
                            id: item.id,
                            text: item.name
                        })) || [];

                        // Menyisipkan opsi "All Category" hanya pada halaman pertama
                        if (params.page === 1) {
                            results.unshift({
                                id: 0,
                                text: 'All Category'
                            });
                        }

                        return {
                            results: results,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                templateResult: function(item) {
                    return item.text ? $('<span>' + item.text + '</span>') : item.text;
                },
                templateSelection: function(item) {
                    return item.text;
                }
            });

            // Memuat data brand dan category saat inisialisasi
            loadInitialBrands();
            loadInitialCategories();

            function loadInitialBrands() {
                $.ajax({
                    url: `{{ route('product.getBrand') }}`,
                    dataType: 'json',
                    data: {
                        page: 1
                    },
                    success: function(data) {
                        if (data.data) {
                            data.data.forEach(function(item) {
                                const newOption = new Option(item.name, item.id,
                                    false, false);
                                $('#brandId').append(newOption);
                            });
                        }
                        $('#brandId').trigger('change');
                    },
                    error: function() {
                        console.error('Error loading initial brands');
                    }
                });
            }

            function loadInitialCategories() {
                $.ajax({
                    url: `{{ route('product.getCategory') }}`,
                    dataType: 'json',
                    data: {
                        page: 1
                    },
                    success: function(data) {
                        if (data.data) {
                            data.data.forEach(function(item) {
                                const newOption = new Option(item.name, item.id,
                                    false, false);
                                $('#categoryId').append(newOption);
                            });
                        }
                        $('#categoryId').trigger('change');
                    },
                    error: function() {
                        console.error('Error loading initial categories');
                    }
                });
            }
        })

        flatpickr("#date", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                // Jika Anda ingin mendapatkan nilai dan melakukan sesuatu dengan itu
                console.log(selectedDates); // ini akan memberikan array tanggal yang dipilih
            }
        });

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

        // Fungsi upload gambar untuk TinyMCE
        const imageUploadHandler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/panel/admin/upload-tinymce-image');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            xhr.upload.onprogress = (e) => progress(e.loaded / e.total * 100);

            xhr.onload = () => {
                if (xhr.status !== 200) {
                    return reject('HTTP Error: ' + xhr.status);
                }

                const json = JSON.parse(xhr.responseText);
                json.location ? resolve(json.location) : reject('Invalid JSON: ' + xhr.responseText);
            };

            xhr.onerror = () => reject('Upload failed: ' + xhr.status);

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });

        // Fungsi untuk menginisialisasi TinyMCE dengan konfigurasi umum
        const initializeTinyMCE = (selector, height) => {
            tinymce.init({
                selector,
                height,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | removeformat | help',
                statusbar: false,
                promotion: false,
                images_upload_handler: imageUploadHandler,
                fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                automatic_uploads: true,
                license_key: 'gpl',
                setup: (editor) => {
                    editor.on('keydown', (e) => {
                        if ([8, 46].includes(e.keyCode)) { // Backspace or Delete
                            const selectedNode = editor.selection.getNode();
                            if (selectedNode && selectedNode.nodeName === 'IMG' && confirm(
                                    'Hapus gambar ini?')) {
                                fetch('/panel/admin/delete-tinymce-image', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').content
                                        },
                                        body: JSON.stringify({
                                            image_path: selectedNode.src
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => data.success ? editor.dom.remove(selectedNode) :
                                        alert('Gagal menghapus gambar'))
                                    .catch(() => alert('Terjadi kesalahan saat menghapus gambar.'));
                                e.preventDefault();
                            }
                        }
                    });
                },
            });
        };

        // Inisialisasi TinyMCE dengan selector dan tinggi
        initializeTinyMCE('#shortDesc', 300);
        initializeTinyMCE('#longDesc', 500);

        // Inisialisasi upload single image and multiple image
        $(document).ready(function() {
            // Inisialisasi thumbnail dan loading indicator
            $("#thumbnail1, #thumbnail2").hide(50);
            $("#loading1, #loading2").hide();

            // Validasi file
            function validateFile(file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // Maksimum 2 MB

                if (!allowedTypes.includes(file.type)) {
                    errorToast("Hanya file JPEG, PNG, atau GIF yang diizinkan.");
                    return false;
                }
                if (file.size > maxSize) {
                    errorToast("Ukuran file maksimal adalah 2 MB.");
                    return false;
                }
                return true;
            }

            // Fungsi untuk preview gambar
            function handleImagePreview(input, thumbnailId, isSingle, loadingId) {
                const thumbnailContainer = $(thumbnailId).empty().show(50);
                const loadingIndicator = $(loadingId).show();
                const files = Array.from(input.files).filter(validateFile);

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const imgElement = `
                        <div class="card mt-1 shadow-none border">
                            <div class="p-1">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="${event.target.result}" alt="image" class="avatar-sm rounded bg-light" />
                                    </div>
                                    <div class="col ps-0">
                                        <a class="text-muted fw-bold">${file.name}</a>
                                        <p class="mb-0">${(file.size / 1024).toFixed(2)} KB</p>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-link fs-16 text-muted removeImage">
                                            <i class="ri-close-line text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        thumbnailContainer.append(imgElement);

                        if (isSingle) {
                            $('#imagePreview1').attr('src', event.target.result);
                            $('.file-name1').text(file.name.length > 10 ? file.name.substr(0, 10) +
                                '..' : file.name);
                            $('.file-format1').text(file.type.split('/').pop());
                            $('.file-size1').text((file.size / 1024).toFixed(2) + ' KB');
                        }

                        loadingIndicator.hide(); // Sembunyikan loading indicator setelah selesai
                    };
                    reader.readAsDataURL(file);
                });

                if (files.length === 0) {
                    thumbnailContainer.hide(50);
                    loadingIndicator.hide();
                }
            }

            // Event listener untuk perubahan pada input file
            $('#image1, #image2').change(function(e) {
                e.preventDefault();
                const isSingle = this.id === 'image1';
                handleImagePreview(this, isSingle ? "#thumbnail1" : "#thumbnail2", isSingle, isSingle ?
                    "#loading1" : "#loading2");
            });

            // Hapus gambar dari thumbnail
            $(document).on('click', '.removeImage', function() {
                const card = $(this).closest('.card').remove();
                const thumbnailContainer = card.parent();
                if (thumbnailContainer.children().length === 0) {
                    thumbnailContainer.hide(50);
                    if (thumbnailContainer.is('#thumbnail2')) $('#image2').val(
                        ''); // Reset value untuk multiple image
                }
            });

            // Hapus gambar dan kosongkan form terkait pada upload tunggal
            $('#removeImage1').click(function(e) {
                e.preventDefault();
                $("#thumbnail1").hide(50);
                $('#image1').val(''); // Reset value untuk single image
                $('#imagePreview1').attr('src', ''); // Hapus preview gambar
                $('.file-name1').text(''); // Kosongkan nama file
                $('.file-format1').text(''); // Kosongkan format file
                $('.file-size1').text(''); // Kosongkan ukuran file
            });
        });

        // select option categories
        $(document).ready(function() {
            // Definisikan fungsi untuk mengambil subkategori
            function loadSubCategories(id) {
                var url = "{{ route('product.subCategory', ':id') }}".replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'JSON',
                    success: function(response) {
                        const subCategorySelect = $('#subCategoryId');
                        subCategorySelect.empty(); // Kosongkan pilihan sebelumnya

                        // Tambahkan opsi "Select Sub Category" di paling atas
                        subCategorySelect.prepend(`<option value=""></option>`);

                        // Buat array dari opsi subkategori
                        const options = response['data'].map(item =>
                            `<option value="${item['id']}">${item['name']}</option>`
                        ).join('');

                        // Tambahkan opsi baru ke dropdown
                        subCategorySelect.append(options);

                        // Panggil kembali Select2 untuk memperbarui dropdown
                        // subCategorySelect.select2(); // Pastikan ini dipanggil untuk memperbarui Select2
                    }
                });
            }

            // Event handler untuk perubahan pada dropdown kategori
            $('#categoryId').on('change', function() {
                var id = $(this).val(); // Mengambil nilai terpilih
                if (id) { // Pastikan id tidak kosong
                    loadSubCategories(id);
                }
            });
        });

        // Select option
        $(document).ready(function() {
            const selectElements = ['.status', '.choice_attributes', '.SubCategory'];

            selectElements.forEach(function(selector) {
                $(selector).select2({
                    placeholder: `Select ${selector.replace('.', '').replace(/([A-Z])/g, ' $1').trim()}`,
                    allowClear: false,
                });
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

        // Cache selectors
        var $nameInput = $('#name');
        var $slugInput = $('#slugs');
        var $itemCodeInput = $('#itemCode');

        // Generate slug on input
        $nameInput.on("input", function() {
            $slugInput.val(generateSlug($nameInput.val()));
        });

        // Generate item code on blur
        $nameInput.blur(function() {
            $.ajax({
                type: 'GET',
                url: `{{ route('product.generateItemCode') }}`,
                dataType: 'JSON',
                success: function(response) {
                    $itemCodeInput.val(response.data);
                }
            });
        });


        // Menyembunyikan elemen saat dimuat
        $('#variant, #formDetailVariant').hide();

        // Mengatur event listener untuk perubahan status varian
        $('[name="is_variant"]').change(function() {
            const isChecked = $(this).is(':checked');

            if (isChecked) {
                $('#variant').slideDown(300);
                $('#notVariant').slideUp(300);
            } else {
                $('#variant').slideUp(300);
                $('#notVariant').slideDown(300);

                // Reset form ketika tidak dicentang
                $('.reset-not-variant-form')[0].reset();
            }
        });

        // Inisialisasi Tagify
        let input = document.querySelector('input[name=tags]');
        new Tagify(input);

        // Initialisasi select attributes
        $('#choiseAttributes').on('change', function() {
            const selectAttributes = $(this).select2('data');
            $('.value-attributes').empty();

            if (selectAttributes) {
                selectAttributes.forEach(function(attribute) {
                    const {
                        id,
                        text
                    } = attribute;
                    const url = "{{ route('product.getValue', ':id') }}".replace(':id', id);
                    const existingValues = $(`#choiseAttributes${id}`).val() || [];

                    // Menampilkan loading
                    $("#vloading").show();

                    // Menambahkan elemen HTML untuk setiap atribut yang dipilih dengan animasi
                    const $attributeRow = $(`
                        <div class="row mt-2" id="attribute-row-${id}" style="display: none;">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="${text}" disabled>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control attributes${id} attributes_choise" id="choiseAttributes${id}" data-value="${text}" multiple="multiple">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    `);

                    // Append elemen dan tampilkan dengan animasi show
                    $('.value-attributes').append($attributeRow);
                    $attributeRow.show(300, function() {
                        // Inisialisasi AJAX untuk mendapatkan nilai setelah elemen ditampilkan
                        $.get(url, function(response) {
                            const options = '<option></option>' + response.data.map(item =>
                                `<option value="${item.id}" data-variant="${item.name}">${item.name}</option>`
                            ).join('');

                            const $select = $(`#choiseAttributes${id}`);
                            $select.html(options).val(existingValues).trigger('change');

                            // Inisialisasi Select2 langsung setelah elemen diupdate
                            initializeSelect2($select);

                            // Sembunyikan loading setelah semua selesai
                            $("#vloading").hide();
                        }).fail(function() {
                            // Menyembunyikan loading jika terjadi error
                            $("#vloading").hide();
                            alert("Terjadi kesalahan saat mengambil data.");
                        });
                    });
                });
            }
        });

        // Inisialisasi Select2
        function initializeSelect2($select) {
            $select.select2({
                placeholder: 'Select Attributes',
                allowClear: false
            });
        }

        $(document).on('change', '.attributes_choise', function() {
            const allSelectedAttributes = [];
            const showVariantForm = $('#formDetailVariant');

            $('.attributes_choise').each(function() {
                const key = $(this).attr('id');
                const attributeId = $(this).attr('data-value');
                const selectedValues = $(this).val() || [];

                if (selectedValues.length > 0) {
                    showVariantForm.show(300);
                    allSelectedAttributes.push({
                        key: key,
                        values: selectedValues.map(value => ({
                            id: value,
                            name: $(this).find(`option[value="${value}"]`).data(
                                'variant'),
                        }))
                    });
                } else {
                    showVariantForm.hide(300);
                }
            });

            // Tampilkan spinner saat permintaan dimulai
            $("#vloading").show();

            // Kirim permintaan untuk membuat varian
            $.post("{{ route('product.createVariants') }}", {
                    attributes: allSelectedAttributes,
                    _token: '{{ csrf_token() }}'
                })
                .done(function(variants) {
                    if (Array.isArray(variants)) {
                        $("#vloading").hide();
                        updateVariantTable(variants);
                    }
                })
                .fail(function(xhr) {
                    alert(xhr.responseJSON);
                })
                .always(function() {
                    // Sembunyikan spinner setelah permintaan selesai (baik sukses atau gagal)
                    $("#vloading").hide();
                });
        });

        // Objek untuk menyimpan nilai input
        let variantData = {};

        // Fungsi untuk mengupdate tabel varian produk
        function updateVariantTable(variants) {
            const table = $.fn.DataTable.isDataTable('#detailVariant') ?
                $('#detailVariant').DataTable() :
                $('#detailVariant').DataTable({
                    responsive: true,
                    searching: false,
                    paging: false,
                    ordering: false,
                    info: false
                });

            table.clear();

            if (variants.length === 0) {
                table.row.add(['<div colspan="2" class="text-center">No variants available</div>', '', '', '']).draw();
                return;
            }

            const uniqueCombinations = new Set();

            variants.forEach((variant, index) => {
                const variantAttributes = variant.map(attr => attr.name); // Adjusted to extract attribute names
                if (!uniqueCombinations.has(variantAttributes
                        .toString())) { // Convert to string to check uniqueness
                    uniqueCombinations.add(variantAttributes.toString());
                    table.row.add([
                        `<span class="badge badge-outline-primary expand-row" data-index="${index}" style="cursor: pointer;"><i class="ri-add-line"></i></span> ${variantAttributes.join(' - ')}`,
                        `<input type="hidden" class="form-control" value="${variantAttributes.join(', ')}" name="variant_attributes[${index}][]"><input type="text" class="form-control price-input" name="variant_price[]" placeholder="Price">`,
                        '',
                        ''
                    ]);
                }
                console.log(variant)
            });


            table.draw();
            formatPriceInput();
            handleExpandRow(table);
        }

        // Format input sebagai uang Rupiah
        function formatPriceInput() {
            $('.price-input').on('input', function() {
                const value = $(this).val().replace(/[^0-9]/g, '');
                const formattedValue = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(value);
                $(this).val(formattedValue);
            });
        }

        // Menangani peristiwa ketika baris diperluas
        function handleExpandRow(table) {
            $('#detailVariant tbody').off('click', 'span.expand-row').on('click', 'span.expand-row', function() {
                const tr = $(this).closest('tr');
                const row = table.row(tr);
                const index = $(this).data('index');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).html('<i class="ri-add-line"></i>').removeClass('badge-outline-primary').addClass(
                        'badge-outline-primary');
                } else {
                    const childContent = createChildRowContent(index);
                    row.child(childContent).show();
                    tr.addClass('shown');
                    $(this).html('<i class="ri-subtract-line"></i>').removeClass('badge-outline-primary').addClass(
                        'badge-outline-primary');

                    // Event listener untuk preview gambar
                    handleImagePreview(index);
                }
            });
        }

        // Membuat konten untuk baris anak
        function createChildRowContent(index) {
            const fileName = variantData[index] && variantData[index].fileName ? variantData[index].fileName : '';
            const fileFormat = variantData[index] && variantData[index].fileFormat ? variantData[index].fileFormat : '';
            const fileSize = variantData[index] && variantData[index].fileSize ? variantData[index].fileSize : '';

            return `
            <div class="child-row" style="height: auto; overflow-y: auto;">
                <div class="row mb-3">
                    <label for="stock" class="col-2 col-form-label">Stock</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="variant_stock[]" placeholder="Stock" value="${variantData[index] ? variantData[index].stock : ''}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sku" class="col-2 col-form-label">Sku</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="variant_sku[]" placeholder="SKU Product" value="${variantData[index] ? variantData[index].sku : ''}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-2 col-form-label">Image</label>
                    <div class="col-10">
                        <input type="file" id="image_${index}" name="variant_image[]" class="form-control">
                        <div id="errorImage_${index}" class="invalid-feedback"></div>
                        <div class="col-xxl-12 col-lg-12" id="thumbnail_${index}" style="display: ${variantData[index] && variantData[index].image ? 'block' : 'none'};">
                            <div class="card mt-1 shadow-none border">
                                <div class="p-1">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img id="imagePreview_${index}" src="${variantData[index] && variantData[index].image ? variantData[index].image : 'https://via.placeholder.com/150?text=No+Image'}" alt="image" class="avatar-sm rounded bg-light" />
                                        </div>
                                        <div class="col ps-0">
                                            <a class="text-muted fw-bold file-name_${index}">${fileName}</a>
                                            <input type="hidden" name="file_name[]" value="${fileName}" class="form-control mt-1 file-name-input_${index}" />

                                            <a class="text-muted fw-bold file-format_${index}">${fileFormat}</a>
                                            <input type="hidden" name="file_format[]" value="${fileFormat}" class="form-control mt-1 file-format-input_${index}" />

                                            <p class="mb-0 file-size_${index}">${fileSize}</p>
                                            <input type="hidden" name="file_size[]" value="${fileSize}" class="form-control mt-1 file-size-input_${index}" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-link fs-16 text-muted removeImage" data-index="${index}">
                                                <i class="ri-close-line text-danger"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }


        // Membuat validasi upload image dan input image
        function handleImagePreview(index) {
            $(`#image_${index}`).on('change', function(event) {
                const file = event.target.files[0];
                const allowedFormats = ['image/jpeg', 'image/png', 'image/jpg']; // Format yang diperbolehkan
                const maxSize = 2 * 1024 * 1024; // Maksimal ukuran 2MB

                if (file) {
                    // Validasi format file
                    if (!allowedFormats.includes(file.type)) {
                        $(`#errorImage_${index}`).text('Only JPG, JPEG, and PNG formats are allowed.').show();
                        resetImageInput(index);
                        return;
                    }

                    // Validasi ukuran file
                    if (file.size > maxSize) {
                        $(`#errorImage_${index}`).text('File size must be less than 2MB.').show();
                        resetImageInput(index);
                        return;
                    }

                    // Jika validasi berhasil, lanjutkan dengan preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewImage = e.target.result;
                        $(`#imagePreview_${index}`).attr('src', previewImage);
                        $(`#thumbnail_${index}`).show();
                        $(`.file-name_${index}`).text(file.name.length > 5 ? file.name.substr(0, 5) + '.. ' :
                            file.name);
                        $(`.file-name-input_${index}`).val(file.name);
                        $(`.file-format_${index}`).text(file.type.split('/').pop());
                        $(`.file-format-input_${index}`).val(file.type.split('/').pop());
                        $(`.file-size_${index}`).text((file.size / 1024).toFixed(2) + ' KB');
                        $(`.file-size-input_${index}`).val(file.size);

                        // Simpan data file
                        variantData[index] = {
                            stock: $(`input[name="variant_stock[]"]`).val(),
                            sku: $(`input[name="variant_sku[]"]`).val(),
                            image: previewImage,
                            fileName: file.name,
                            fileFormat: file.type.split('/').pop(),
                            fileSize: (file.size / 1024).toFixed(2) + ' KB'
                        };
                    };
                    reader.readAsDataURL(file);
                    $(`#errorImage_${index}`).hide(); // Sembunyikan pesan error jika validasi berhasil
                }
            });
        }

        // Fungsi untuk mereset input gambar jika terjadi kesalahan
        function resetImageInput(index) {
            $(`#image_${index}`).val('');
            $(`#imagePreview_${index}`).attr('src', 'https://via.placeholder.com/150?text=No+Image');
            $(`#thumbnail_${index}`).hide();
            $(`.file-name_${index}, .file-format_${index}, .file-size_${index}`).text('');
            $(`.file-name-input_${index}, .file-format-input_${index}, .file-size-input_${index}`).val('');

            if (variantData[index]) {
                variantData[index].image = null;
                variantData[index].fileName = '';
                variantData[index].fileFormat = '';
                variantData[index].fileSize = '';
            }
        }

        // Event listener untuk menghapus gambar
        $('#detailVariant tbody').on('click', '.removeImage', function() {
            const index = $(this).data('index');
            $(`#image_${index}`).val('');
            $(`#imagePreview_${index}`).attr('src', 'https://via.placeholder.com/150?text=No+Image');
            $(`#thumbnail_${index}`).hide();
            $(`.file-name_${index}, .file-format_${index}, .file-size_${index}`).text('');
            $(`.file-name-input_${index}, .file-format-input_${index}, .file-size-input_${index}`).val('');

            // Reset data
            if (variantData[index]) {
                variantData[index].image = null;
                variantData[index].fileName = '';
                variantData[index].fileFormat = '';
                variantData[index].fileSize = '';
            }
        });

        // store product at database
        $(document).on("click", "#addProduct", function(e) {
            let slugs = $('#slugs').val();
            let itemCode = $('#itemCode').val();
            let barcode = $('#barcode').val();
            let name = $('#name').val();
            let unit = $('#unit').val();
            let minQty = $('#minQty').val();
            let maxQty = $('#maxQty').val();
            let image = $('#image1')[0].files[0];
            let isVarinat = $('#is_variant').val();
            let price = $('#price').val();
            let sku = $('#sku').val();
            let weight = $('#weight').val();
            let stock = $('#stock').val();
            let attributesId = $('#attributesId').val();
            let valuesId = $('#valuesId').val();
            let shortDesc = tinymce.get("shortDesc").getContent();
            let longDesc = tinymce.get("longDesc").getContent();
            let isActive = $('#isActive').val();
            let brandId = $('#brandId').val();
            let categoryId = $('#categoryId').val();
            let subCategoryId = $('#subCategoryId').val();
            let isFeature = $('#isFeature').is(':checked') ? '1' : '0';
            let isVariant = $('#isVariant').is(':checked') ? '1' : '0';
            let tags = $('#tags').val();
            let seo = $('#seo').val();
            let seoDesc = $('#seoDesc').val();
            let date = $('#date').val();
            let discount = $('#discount').val();
            let newArrival = $('#newArrival').is(':checked') ? 'Yes' : 'No';
            let bestSeller = $('#bestSeller').is(':checked') ? 'Yes' : 'No';
            let specialOffer = $('#specialOffer').is(':checked') ? 'Yes' : 'No';
            let refundable = $('#refundable').is(':checked') ? '1' : '0';
            let hot = $('#hot').is(':checked') ? 'Yes' : 'No';
            let newLabel = $('#new').is(':checked') ? 'Yes' : 'No';
            let sale = $('#newArrival').is(':checked') ? 'Yes' : 'No';

            // Mengambil gambar-gambar dari input multiple
            let multipleImage = $('#image2')[0].files;

            // Mengambil choice_attributes dari input select2 multiple
            let choiceAttributes = $('select[name="choice_attributes[]"]').map(function(index, element) {
                // Mengambil teks dari pilihan yang dipilih menggunakan Select2
                var selectedData = $(element).select2('data'); // Mengambil data yang dipilih
                return selectedData.map(function(item) {
                    return item.text; // Ambil teks dari setiap item yang dipilih
                });
            }).get();

            // Hanya lakukan validasi jika isVariant dicentang
            if (isVariant === '1') {
                // let variantAttributes = $('input[name="variant_attributes[]"]');
                // if (variantAttributes.length === 0 || variantAttributes.filter((_, el) => $(el).val() === '')
                //     .length > 0) {
                //     errorToast("Silakan isi semua varian atribut.");
                //     return;
                // }

                let variantPrices = $('input[name="variant_price[]"]');
                if (variantPrices.length === 0 || variantPrices.filter((_, el) => $(el).val() === '').length > 0) {
                    errorToast("Silakan isi semua harga varian.");
                    return;
                }

                let variantStocks = $('input[name="variant_stock[]"]');
                if (variantStocks.length === 0 || variantStocks.filter((_, el) => $(el).val() === '').length > 0) {
                    errorToast("Silakan isi semua stok varian.");
                    return;
                }
            }

            const fd = new FormData();

            for (let i = 0; i < multipleImage.length; i++) {
                fd.append('image2[]', multipleImage[
                    i]); // Menggunakan 'images[]' agar dapat diolah sebagai array di server
            }

            choiceAttributes.forEach(function(value, index) {
                fd.append(`choice_attributes[${index}]`, value);
            });

            $('input[name^="variant_attributes"]').each(function() {
                // Get the index from the input's name attribute
                const index = $(this).attr('name').match(/\[(\d+)\]/)[1];

                // Append the value of the input field to FormData with the appropriate index
                fd.append(`variant_attributes[${index}][]`, $(this).val());
            });

            $('input[name="variant_price[]"]').each(function() {
                fd.append("variant_price[]", $(this).val());
            });
            $('input[name="variant_stock[]"]').each(function() {
                fd.append("variant_stock[]", $(this).val());
            });
            $('input[name="variant_sku[]"]').each(function() {
                fd.append("variant_sku[]", $(this).val());
            });
            $('input[name="variant_image[]"]').each(function() {
                fd.append("variant_image[]", $(this)[0].files[0]);
            });
            $('input[name="file_name[]"]').each(function() {
                fd.append("file_name[]", $(this).val());
            });
            $('input[name="file_format[]"]').each(function() {
                fd.append("file_format[]", $(this).val());
            });
            $('input[name="file_size[]"]').each(function() {
                fd.append("file_size[]", $(this).val());
            });
            fd.append("item_code", itemCode);
            fd.append("slugs", slugs);
            fd.append("barcode", barcode);
            fd.append("name", name);
            fd.append("weight", weight);
            fd.append("category_id", categoryId);
            fd.append("sub_category_id", subCategoryId);
            fd.append("brand_id", brandId);
            fd.append("unit", unit);
            fd.append("min_qty", minQty);
            fd.append("max_qty", maxQty);
            fd.append("price", price);
            fd.append("refundable", refundable);
            fd.append("image1", image);
            fd.append("sku", sku);
            fd.append("stock", stock);
            fd.append("discount_range", date);
            fd.append("discount", discount);
            fd.append("short_desc", shortDesc);
            fd.append("long_desc", longDesc);
            if (tags == '') {
                fd.append("tags", tags);
            } else {
                let convert = JSON.parse(tags)
                fd.append('tags', convert.map(item => item.value).toString())
            }
            fd.append("seo_title", seo);
            fd.append("seo_desc", seoDesc);
            fd.append("image", image);
            fd.append("new_arrival", newArrival);
            fd.append("best_seller", bestSeller);
            fd.append("special_offer", specialOffer);
            fd.append("hot", hot);
            fd.append("new", newLabel);
            fd.append("sale", sale);
            fd.append("is_active", isActive);
            fd.append("is_variant", isVariant);
            fd.append("is_feature", isFeature);
            // fd.append("validation_image", validationImage);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Kirim FormData menggunakan AJAX
            $.ajax({
                url: "{{ route('product.store') }}",
                type: "POST",
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: fd,
                beforeSend: function() {
                    $('#addProduct').attr('disabled', 'disabled');
                    $('#addProduct').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#addProduct').removeAttr('disabled');
                    $('#addProduct').html('<i class="ri-save-line"></i> Save');
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
                                        "{{ route('product.index') }}";
                                }, 1500);
                            },
                        });
                    } else if (response.status == 400) {
                        const fields = [{
                                id: 'unit',
                                key: 'unit'
                            },
                            {
                                id: 'brandId',
                                key: 'brand_id'
                            },
                            {
                                id: 'categoryId',
                                key: 'category_id'
                            },
                            {
                                id: 'subCategoryId',
                                key: 'sub_category_id'
                            },
                            {
                                id: 'name',
                                key: 'name'
                            },
                            {
                                id: 'shortDesc',
                                key: 'short_desc'
                            },
                            {
                                id: 'barcode',
                                key: 'barcode'
                            },
                            {
                                id: 'seo',
                                key: 'seo'
                            },
                            {
                                id: 'seoDesc',
                                key: 'seo_desc'
                            },
                            {
                                id: 'longDesc',
                                key: 'long_desc'
                            },
                            {
                                id: 'isActive',
                                key: 'is_active'
                            },
                            {
                                id: 'tags',
                                key: 'tags'
                            },
                            {
                                id: 'image1',
                                key: 'image1'
                            },
                            {
                                id: 'price',
                                key: 'price'
                            },
                            {
                                id: 'stock',
                                key: 'stock'
                            },
                            {
                                id: 'sku',
                                key: 'sku'
                            },
                        ];

                        fields.forEach(field => {
                            const errorElement = $(`#error${capitalize(field.id)}`);
                            const $field = $(`#${field.id}`);
                            const isSelect2 = $field.hasClass(
                                'select2-hidden-accessible'); // Check if it's a Select2
                            const isTagify = $field.hasClass(
                                'tagify--input'); // Check if it's a Tagify input

                            if (response.message[field.key]) {
                                if (isTagify) {
                                    // If it's a Tagify input, add the is-invalid class to the Tagify input's parent
                                    $field.closest('.tagify').addClass('is-invalid');
                                } else if (isSelect2) {
                                    // If it's Select2, add the is-invalid class to the container
                                    $field.siblings('.select2-container').addClass(
                                        'is-invalid');
                                } else {
                                    // If it's a normal input, add the is-invalid class to the input
                                    $field.addClass('is-invalid');
                                }
                                errorElement.html(response.message[field.key]);
                            } else {
                                if (isTagify) {
                                    // If it's a Tagify input, remove the is-invalid class from the Tagify input's parent
                                    $field.closest('.tagify').removeClass('is-invalid');
                                } else if (isSelect2) {
                                    // If it's Select2, remove the is-invalid class from the container
                                    $field.siblings('.select2-container').removeClass(
                                        'is-invalid');
                                } else {
                                    // If it's a normal input, remove the is-invalid class
                                    $field.removeClass('is-invalid');
                                }
                                errorElement.html('');
                            }
                        });


                    } else if (response.status == 500) {
                        Swal.fire({
                            icon: "error",
                            title: response.message,
                            text: response.error,
                        });
                    }

                },
                error: function(xhr, status, error) {
                    // Tangani error
                    let errorMessage;

                    try {
                        // Coba parse response JSON
                        const jsonResponse = JSON.parse(xhr.responseText);
                        errorMessage = jsonResponse.message || "Terjadi kesalahan.";
                    } catch (e) {
                        errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
                    }

                    Swal.fire({
                        icon: "error",
                        title: status,
                        text: errorMessage,
                    });
                }
            });
        })
    </script>
@endpush
