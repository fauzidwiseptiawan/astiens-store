@extends('backend.layouts.master')
@section('title', 'Product')
@push('styles')
    <style>
        .child-row {
            max-height: 300px;
            /* Atur batas tinggi sesuai kebutuhan */
            overflow-y: auto;
            /* Tambahkan scrollbar jika konten lebih dari batas tinggi */
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
        <div class="row">
            <!-- row 1 -->
            <div class="col-xxl-8 col-xl-8 col-lg-8">
                <!-- product information -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Information</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Item Code</label>
                                <input type="text" id="itemCode" name="item_code" class="form-control" disabled>
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
                                <label for="barcode" class="form-label">Slugs</label>
                                <input type="text" id="slugs" name="slugs" class="form-control" disabled>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" id="barcode" name="barcode" class="form-control"
                                    placeholder="Enter barcode">
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
                                    <input type="number" class="form-control" placeholder="Enter weight"
                                        aria-describedby="basic-addon1" value="0">
                                    <span class="input-group-text" id="basic-addon1">Grams</span>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Minimum Order Quantity</label>
                                <input type="number" id="minQty" name="min_qty" class="form-control"
                                    placeholder="Enter minimum order quantity" value="0">
                                <div id="errorMinQty" class="invalid-feedback"></div>
                                <small>Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Maximum Order Quantity</label>
                                <input type="number" id="maxQty" name="max_qty" class="form-control"
                                    placeholder="Enter maximum order quantity" value="0">
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
                                <label for="example-fileinput" class="form-label">Thumbnail Image <small>(300x300)</small>
                                    <strong class="text-danger">*</strong></label>
                                <input type="file" id="image1" name="image" class="form-control">
                                <div id="errorImage" class="invalid-feedback"></div>
                                <div class="col-xxl-3 col-lg-12" id="thumbnail1">
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
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small>This image is visible in all product box. Use 300x300 sizes image. Keep some blank
                                    space around the main object of your image as we had to crop some edge in different
                                    devices to make it responsive.</small>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Gallery Images
                                    <small>(600x600)</small></label>
                                <input type="file" id="image2" name="image" class="form-control" multiple>
                                <div id="errorImage" class="invalid-feedback"></div>
                                <div class="col-xxl-3 col-lg-12" id="thumbnail2">
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
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small>This image is visible in all product box. Use 600x600 sizes image. Keep some blank
                                    space around the main object of your image as we had to crop some edge in different
                                    devices to make it responsive.</small>
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
                    <!-- product price -->
                    <div class="card">
                        <div class="card-header bg-light-subtle">
                            <div class="row">
                                <div class="col-6 col-md-8">
                                    <h5>Product price, stock</h5>
                                </div>
                                <div class="col-6 col-md-4" style="text-align: end;">
                                    <label for="name" class="form-label ms-3 me-2">Variant Product </label>
                                    <label class="slideon">
                                        <input type="checkbox" name="is_variant" value="1" id="isVariant">
                                        <span class="slideon-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="notVariant">
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
                            <div class="table-responsive mt-3" id="formDetailVariant">
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
                                    <label for="name" class="form-label">Short Description <strong
                                            class="text-danger">*</strong></label>
                                    <textarea name="short_desc" class="form-control" id="shortDesc" placeholder="Short Description"></textarea>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Description <strong
                                            class="text-danger">*</strong></label>
                                    <textarea name="long_desc" class="form-control" id="longDesc" placeholder="Short Description"></textarea>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- product price -->
                <div class="card">
                    <div class="card-header bg-light-subtle">
                        <div class="row">
                            <div class="col-6 col-md-8">
                                <h5>Product price, stock</h5>
                            </div>
                            <div class="col-6 col-md-4" style="text-align: end;">
                                <label for="name" class="form-label ms-3 me-2">Variant Product </label>
                                <label class="slideon">
                                    <input type="checkbox" name="is_variant" value="1" id="isVariant">
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="notVariant">
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
                        <div class="table-responsive mt-3" id="formDetailVariant">
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
                                <label for="name" class="form-label">Short Description <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="short_desc" class="form-control" id="shortDesc" placeholder="Short Description"></textarea>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Description <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="long_desc" class="form-control" id="longDesc" placeholder="Short Description"></textarea>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end card -->
            </div>
            <!-- row 2 -->
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <!-- product publish -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Publish</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="addProduct"><i class="ri-save-line"></i>
                                Save</button>
                            <button type="button" class="btn btn-light"><i class="ri-logout-box-r-line"></i> Save &
                                Exit</button>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
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
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div id="errorBrandId" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product category -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Category <strong class="text-danger">*</strong></h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-control category" data-toggle="category" name="category_id"
                                    id="categoryId">
                                    <option></option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
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
                    <h5 class="card-header bg-light-subtle">Is Feature?</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <label class="slideon">
                                <input type="checkbox" name="is_feature" value="1" id="isFeature">
                                <span class="slideon-slider"></span>
                            </label>
                        </div> <!-- end col -->
                    </div>
                    <!-- end card body-->
                </div>
                <!-- product Tags -->
                <div class="card">
                    <h5 class="card-header bg-light-subtle">Product Tags</h5>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <input type="text" id="tags" name="tags" class="form-control tags"
                                    placeholder="Enter tags">
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
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="seo" class="form-label">SEO Description</label>
                                <textarea class="form-control" id="seoDesc" name="seo_desc" rows="3" placeholder="Enter SEO Description"></textarea>
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
                                    placeholder="Enter discount date range">
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
            </div>
            <!-- end card -->
        </div>
    </div> <!-- end col-->
@endsection

@push('page-scripts')
    <script>
        // nav active
        $('#sidebarProduct, .activeProduct, #activeProduct').addClass('show menuitem-active');

        // preview image single and multiple image
        $(document).ready(function() {
            // Inisialisasi thumbnail
            $("#thumbnail1, #thumbnail2").hide(50);

            // Validasi file
            function validateFile(file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // Maksimum 2 MB

                if (!allowedTypes.includes(file.type)) {
                    showToast("Hanya file JPEG, PNG, atau GIF yang diizinkan.");
                    return false;
                }
                if (file.size > maxSize) {
                    showToast("Ukuran file maksimal adalah 2 MB.");
                    return false;
                }
                return true;
            }

            // Tampilkan notifikasi
            function showToast(message) {
                $.toast({
                    text: message,
                    icon: 'error',
                    showHideTransition: 'plain',
                    hideAfter: 1500,
                    position: 'top-right',
                });
            }

            // Fungsi untuk preview gambar
            function handleImagePreview(input, thumbnailId, isSingle) {
                const thumbnailContainer = $(thumbnailId).empty().show(50);
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
                                    <i class="ri-close-line"></i>
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
                    };
                    reader.readAsDataURL(file);
                });

                if (files.length === 0) thumbnailContainer.hide(50);
            }

            // Event listener untuk perubahan pada input file
            $('#image1, #image2').change(function(e) {
                e.preventDefault();
                const isSingle = this.id === 'image1';
                handleImagePreview(this, isSingle ? "#thumbnail1" : "#thumbnail2", isSingle);
            });

            // Hapus gambar dari thumbnail
            $(document).on('click', '.removeImage', function() {
                const card = $(this).closest('.card').remove();
                const thumbnailContainer = card.parent();
                if (thumbnailContainer.children().length === 0) {
                    thumbnailContainer.hide(50);
                    if (thumbnailContainer.is('#thumbnail2')) $('#image2').val('');
                }
            });

            // Hapus gambar dari upload tunggal
            $('#removeImage1').click(function(e) {
                e.preventDefault();
                $("#thumbnail1").hide(50);
                $('#image1').val('');
            });
        });


        // Select option
        $(document).ready(function() {
            const selectElements = ['.category', '.brand', '.status', '.choice_attributes', '.SubCategory'];

            selectElements.forEach(function(selector) {
                $(selector).select2({
                    placeholder: `Select ${selector.replace('.', '').replace(/([A-Z])/g, ' $1').trim()}`,
                    allowClear: false
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
            $('#variant').toggle(isChecked, 300);
            $('#notVariant').toggle(!isChecked, 300);
        });

        // Inisialisasi Tagify
        let input = document.querySelector('input[name=tags]');
        new Tagify(input);

        // select option categories
        $('#categoryId').on('change', function() {
            var id = $(this).val(); // Mengambil nilai terpilih
            var url = "{{ route('product.subCategory', ':id') }}".replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'JSON',
                success: function(response) {
                    const subCategorySelect = $('#subCategoryId');
                    subCategorySelect.empty(); // Kosongkan pilihan sebelumnya

                    // Buat array dari opsi subkategori
                    const options = response['data'].map(item =>
                        `<option value="${item['id']}">${item['name']}</option>`
                    ).join('');

                    // Tambahkan opsi baru ke dropdown
                    subCategorySelect.html(options);
                }
            });
        });


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

                    // Menambahkan elemen HTML untuk setiap atribut yang dipilih
                    $('.value-attributes').append(`
                <div class="row mt-2" id="attribute-row-${id}">
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="${text}" disabled>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control attributes${id} attributes_choise" name="choise_attributes[]" id="choiseAttributes${id}" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                </div>
            `);

                    // Inisialisasi AJAX dan Select2
                    $.get(url, function(response) {
                        const options = '<option></option>' + response.data.map(item =>
                            `<option value="${item.id}" data-variant="${item.name}">${item.name}</option>`
                        ).join('');

                        const $select = $(`#choiseAttributes${id}`).html(options).val(
                            existingValues).trigger('change');
                        initializeSelect2($select);
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
                const attributeId = $(this).attr('id');
                const selectedValues = $(this).val() || [];

                if (selectedValues.length > 0) {
                    showVariantForm.show(300);
                    allSelectedAttributes.push({
                        id: attributeId,
                        values: selectedValues.map(value => ({
                            id: value,
                            name: $(this).find(`option[value="${value}"]`).data(
                                'variant')
                        }))
                    });
                } else {
                    showVariantForm.hide(300);
                }
            });

            // Kirim permintaan untuk membuat varian
            $.post("{{ route('product.createVariants') }}", {
                    attributes: allSelectedAttributes,
                    _token: '{{ csrf_token() }}'
                })
                .done(function(variants) {
                    if (Array.isArray(variants)) {
                        updateVariantTable(variants);
                    }
                })
                .fail(function(xhr) {
                    alert(xhr.responseJSON);
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
                const variantText = variant.map(attr => attr.name).join(' - ');
                if (!uniqueCombinations.has(variantText)) {
                    uniqueCombinations.add(variantText);
                    table.row.add([
                        `<span class="badge badge-outline-primary expand-row" data-index="${index}" style="cursor: pointer;"><i class="ri-add-line"></i></span> ${variantText}`,
                        '<input type="text" class="form-control price-input" name="variant_price[]" placeholder="Price">',
                        '',
                        ''
                    ]);
                }
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
                <input type="text" class="form-control" name="sku[]" placeholder="SKU Product" value="${variantData[index] ? variantData[index].sku : ''}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-2 col-form-label">Image</label>
            <div class="col-10">
                <input type="file" id="image_${index}" name="image[]" class="form-control">
                <div id="errorImage_${index}" class="invalid-feedback"></div>
                <div class="col-xxl-3 col-lg-12" id="thumbnail_${index}" style="display: ${variantData[index] && variantData[index].image ? 'block' : 'none'};">
                    <div class="card mt-1 shadow-none border">
                        <div class="p-1">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img id="imagePreview_${index}" src="${variantData[index] && variantData[index].image ? variantData[index].image : 'https://via.placeholder.com/150?text=No+Image'}" alt="image" class="avatar-sm rounded bg-light" />
                                </div>
                                <div class="col ps-0">
                                    <a class="text-muted fw-bold file-name_${index}">${variantData[index] && variantData[index].fileName ? variantData[index].fileName : ''}</a>
                                    <a class="text-muted fw-bold file-format_${index}">${variantData[index] && variantData[index].fileFormat ? variantData[index].fileFormat : ''}</a>
                                    <p class="mb-0 file-size_${index}">${variantData[index] && variantData[index].fileSize ? variantData[index].fileSize : ''}</p>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-link fs-16 text-muted removeImage" data-index="${index}">
                                        <i class="ri-close-line"></i>
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

        // Menangani preview gambar
        function handleImagePreview(index) {
            $(`#image_${index}`).on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewImage = e.target.result;
                        $(`#imagePreview_${index}`).attr('src', previewImage);
                        $(`#thumbnail_${index}`).show();
                        $(`.file-name_${index}`).text(file.name.length > 5 ? file.name.substr(0, 5) + '.. ' :
                            file.name);
                        $(`.file-format_${index}`).text(file.type.split('.').pop());
                        $(`.file-size_${index}`).text((file.size / 1024).toFixed(2) + ' KB');

                        // Simpan data file
                        variantData[index] = {
                            stock: $(`input[name="variant_stock[]"]`).val(),
                            sku: $(`input[name="sku[]"]`).val(),
                            image: previewImage,
                            fileName: file.name,
                            fileFormat: file.type.split('.').pop(),
                            fileSize: (file.size / 1024).toFixed(2) + ' KB'
                        };
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Event listener untuk menghapus gambar
        $('#detailVariant tbody').on('click', '.removeImage', function() {
            const index = $(this).data('index');
            $(`#image_${index}`).val('');
            $(`#imagePreview_${index}`).attr('src', 'https://via.placeholder.com/150?text=No+Image');
            $(`#thumbnail_${index}`).hide();
            $(`.file-name_${index}, .file-format_${index}, .file-size_${index}`).text('');

            // Reset data
            if (variantData[index]) {
                variantData[index].image = null;
                variantData[index].fileName = '';
                variantData[index].fileFormat = '';
                variantData[index].fileSize = '';
            }
        });
    </script>
@endpush
