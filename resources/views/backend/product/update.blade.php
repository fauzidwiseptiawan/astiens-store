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
                        <input type="hidden" id="productId" name="product_id" class="form-control"
                            value="{{ $product->id }}" data-selected-brand-id="{{ $product->brand_id }}"
                            data-selected-category-id="{{ $product->category_id }}" disabled>
                        <input type="hidden" id="selectedSubCategoryId" value="{{ $product->sub_category_id }}">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {{-- <label for="barcode" class="form-label">Item Code</label> --}}
                                <input type="hidden" id="itemCode" name="item_code" class="form-control"
                                    value="{{ $product->item_code }}" disabled>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter name" value="{{ $product->name }}">
                                <div id="errorName" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                {{-- <label for="slugs" class="form-label">Slugs</label> --}}
                                <input type="hidden" id="slugs" name="slugs"
                                    class="form-control"value="{{ $product->slug }}" disabled>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" id="barcode" name="barcode" class="form-control"
                                    placeholder="Enter barcode" value="{{ $product->barcode }}">
                                <div id="errorBarcode" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Unit <strong class="text-danger">*</strong></label>
                                <input type="text" id="unit" name="unit" class="form-control"
                                    placeholder="Unit (e.g. PCS, KG etc)" value="{{ $product->unit }}">
                                <div id="errorUnit" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Weight <strong
                                        class="text-danger">*</strong></label>
                                <div class="input-group flex-nowrap">
                                    <input type="number" class="form-control" placeholder="Enter weight"
                                        aria-describedby="basic-addon1" value="{{ $product->weight }}">
                                    <span class="input-group-text" id="basic-addon1">Grams</span>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Minimum Order Quantity</label>
                                <input type="number" id="minQty" name="min_qty" class="form-control"
                                    placeholder="Enter minimum order quantity" value="{{ $product->min_qty }}">
                                <div id="errorMinQty" class="invalid-feedback"></div>
                                <small>Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Maximum Order Quantity</label>
                                <input type="number" id="maxQty" name="max_qty" class="form-control"
                                    placeholder="Enter maximum order quantity" value="{{ $product->max_qty }}">
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
                                <div class="col-xxl-12 col-lg-12" id="thumbnail1"
                                    style="{{ $product->image ? '' : 'display: none;' }}">
                                    <div class="card mt-1 shadow-none border">
                                        <div class="p-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img id="imagePreview1"
                                                        src="{{ asset('storage/upload/image/product/thumbnail/' . $product->image) }}"
                                                        alt="image" class="avatar-sm rounded bg-light" />
                                                </div>
                                                <div class="col ps-0">
                                                    <a
                                                        class="text-muted fw-bold file-name1">{{ strlen($product->image) > 10 ? substr($product->image, 0, 10) : $product->image }}</a>
                                                    <a class="text-muted fw-bold file-format1">.{{ $product->ext }}</a>
                                                    <p class="mb-0 file-size1">
                                                        {{ number_format($product->size / 1024, 2) }} KB</p>
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
                                @foreach ($product['images'] as $item)
                                    <div class="col-xxl-12 col-lg-12" id="thumbnail2"
                                        style="{{ $item->image ? '' : 'display: none;' }}">
                                        <div class="card mt-1 shadow-none border">
                                            <div class="p-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img id="imagePreview1"
                                                            src="{{ asset('storage/upload/image/product/gallery/thumbnail/' . $item->image) }}"
                                                            alt="image" class="avatar-sm rounded bg-light" />
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a
                                                            class="text-muted fw-bold file-name1">{{ strlen($item->image) > 10 ? substr($item->image, 0, 10) : $item->image }}</a>
                                                        <a
                                                            class="text-muted fw-bold file-format1">.{{ $item->ext }}</a>
                                                        <p class="mb-0 file-size1">
                                                            {{ number_format($item->size / 1024, 2) }} KB</p>
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
                                @endforeach
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
                                    <input type="checkbox" name="is_variant" value="{{ $product->is_variant }}"
                                        id="isVariant" {{ $product->is_variant ? 'checked' : '' }}>
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body not-variant" id="notVariant">
                        <form class="reset-not-variant-form">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Regular price <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="Enter regular price" onkeyup="money_format(this)"
                                        value="{{ format_number($product->price) }}">
                                    <div id="errorPrice" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">SKU <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" id="sku" name="sku" class="form-control"
                                        placeholder="Enter SKU" value="{{ $product->sku }}">
                                    <div id="errorSku" class="invalid-feedback"></div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Stock <strong
                                            class="text-danger">*</strong></label>
                                    <input type="number" id="stock" name="stock" class="form-control"
                                        placeholder="Enter stock" value="{{ $product->stock }}">
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
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}"
                                            @if (in_array($attribute->id, $selectedAttributeIds)) selected @endif>
                                            {{ $attribute->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-2 mb-2">Choose the attributes of this product and then input attribute of each
                                attribute
                            </p>
                            <div class="value-attributes">
                                <!-- Di sini akan tampilkan attribute-row secara dinamis -->
                                @foreach ($attributes as $attribute)
                                    @if (in_array($attribute->id, $selectedAttributeIds))
                                        <div class="row mt-2" id="attribute-row">
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control"
                                                    value="{{ $attribute->name }}" disabled>
                                            </div>
                                            <div class="col-lg-9">
                                                @if (!empty($attributeValues[$attribute->id]))
                                                    <select class="form-control attributes attributes_choise"
                                                        id="attributesChoise" multiple="multiple"
                                                        data-value="{{ $attribute->name }}">
                                                        @foreach ($attributeValues[$attribute->id] as $attributeValue)
                                                            <option value="{{ $attributeValue->id }}"
                                                                data-variant="{{ $attributeValue->name }}"
                                                                @if (in_array($attributeValue->id, $product->variants->pluck('attributeValues')->flatten()->pluck('id')->toArray())) selected @endif>
                                                                {{ $attributeValue->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
                                    <tbody id="tbody">
                                    </tbody>
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
                                <textarea name="short_desc" class="form-control" id="shortDesc" placeholder="Short Description">{{ $product->short_desc }}</textarea>
                                <div id="errorShortDesc" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Description <strong
                                        class="text-danger">*</strong></label>
                                <textarea name="long_desc" class="form-control" id="longDesc" placeholder="Short Description">{{ $product->long_desc }}</textarea>
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
                                    <option value="2" {{ $product->is_active == 2 ? 'selected' : '' }}>Draft</option>
                                    <option value="3" {{ $product->is_active == 3 ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="1" {{ $product->is_active == 1 ? 'selected' : '' }}>Published
                                    </option>
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
                                    <input type="checkbox" name="is_feature" value="1" id="isFeature"
                                        {{ $product->is_feature ? 'checked' : '' }}>
                                    <span class="slideon-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6">
                            <h5 class="card-header bg-light-subtle">Refundable</h5>
                            <div class="card-body">
                                <label class="slideon">
                                    <input type="checkbox" name="refundable" value="0" id="refundable"
                                        {{ $product->refundable ? 'checked' : '' }}>
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
                                    placeholder="Enter tags" value="{{ $product->tags }}">
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
                                    placeholder="Enter SEO" value="{{ $product->seo_title }}">
                                <div id="errorSeo" class="invalid-feedback"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="seo" class="form-label">SEO Description</label>
                                <textarea class="form-control" id="seoDesc" name="seo_desc" rows="3" placeholder="Enter SEO Description">{{ $product->seo_desc }}</textarea>
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
                                    placeholder="2018-10-03 to 2018-10-10" value="{{ $dateRange }}">
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Discount </label>
                                <input type="text" id="discount" name="discount" class="form-control"
                                    placeholder="Enter discount" value="{{ $product->discount }}">
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
                                    value="Yes" {{ $product->new_arrival === 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="customCheck1">New Arrival</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="bestSeller" name="best_seller"
                                    value="Yes" {{ $product->best_seller === 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="customCheck2">Best Seller</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="specialOffer" name="special_offer"
                                    value="Yes" {{ $product->special_offer === 'Yes' ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="hot" value="Yes"
                                    {{ $product->hot === 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="customCheck1">Hot</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="new" value="Yes"
                                    {{ $product->new === 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="customCheck2">New</label>
                            </div>
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="sale" value="Yes"
                                    {{ $product->sale === 'Yes' ? 'checked' : '' }}>
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
                            <button type="submit" class="btn btn-primary" id="updateProduct">
                                <i class="ri-save-line"></i> Update
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
        $('#sidebarProduct, .sidebarProduct, #activeProduct').addClass('show menuitem-active');

        function capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // get brand and brand by request
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
                            page: params.page || 1, // Halaman yang diminta
                            product_id: $('#productId').val() // Ambil product_id dari elemen terkait
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        // Memproses hasil pencarian Brand
                        const results = data.data.map(item => ({
                            id: item.id,
                            text: item.name
                        })) || [];

                        // Tandai brand yang dipilih (jika ada)
                        if (data.selected_brand_id && params.page === 1) {
                            results.unshift({
                                id: data.selected_brand_id,
                                text: results.find(item => item.id === data.selected_brand_id)
                                    ?.text || 'Selected Brand',
                                selected: true
                            });
                        }

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

            // Memuat nilai awal jika ada brand yang dipilih
            const selectedBrandId = $('#productId').data('selected-brand-id'); // Ambil brand_id terkait
            if (selectedBrandId) {
                $.ajax({
                    url: `{{ route('product.getBrand') }}`,
                    data: {
                        product_id: $('#productId').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        const selectedBrand = data.data.find(item => item.id === selectedBrandId);
                        if (selectedBrand) {
                            const newOption = new Option(selectedBrand.name, selectedBrand.id, true,
                                true);
                            $('#brandId').append(newOption).trigger('change');
                            // Setel opsi sebagai terpilih berdasarkan brand_id
                            $('#brandId').val(selectedBrand.id).trigger('change');
                        }
                    }
                });
            }

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
                            page: params.page || 1,
                            product_id: $('#productId').val() // Ambil product_id dari elemen terkait
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        // Memproses hasil pencarian Category
                        const results = data.data.map(item => ({
                            id: item.id,
                            text: item.name
                        })) || [];

                        // Tandai brand yang dipilih (jika ada)
                        if (data.selected_category_id && params.page === 1) {
                            results.unshift({
                                id: data.selected_category_id,
                                text: results.find(item => item.id === data
                                        .selected_category_id)
                                    ?.text || 'Selected Category',
                                selected: true
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

            // Memuat nilai awal jika ada brand yang dipilih
            const selectedCategoryId = $('#productId').data('selected-category-id'); // Ambil brand_id terkait
            if (selectedCategoryId) {
                $.ajax({
                    url: `{{ route('product.getCategory') }}`,
                    data: {
                        product_id: $('#productId').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        const selectedCategory = data.data.find(item => item.id === selectedCategoryId);
                        if (selectedCategory) {
                            const newOption = new Option(selectedCategory.name, selectedCategory.id,
                                true,
                                true);
                            $('#categoryId').append(newOption).trigger('change');
                        }
                    }
                });
            }


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
                        console.error('Error loading initial categori');
                    }
                });
            }
        })

        flatpickr("#date", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                // Jika Anda ingin mendapatkan nilai dan melakukan sesuatu dengan itu
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

        function initializeTinyMCE(selector, height) {
            tinymce.init({
                selector: selector,
                height: height, // Mengatur tinggi editor sesuai parameter
                promotion: false,
                license_key: 'gpl',
                deprecation_warnings: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                visual_table_class: 'tiny-table',
                statusbar: false,
                fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                automatic_uploads: true,
                file_browser_callback_types: 'file image media',
                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        const reader = new FileReader();
                        reader.addEventListener('load', () => {
                            const id = 'blobid' + new Date().getTime();
                            const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            // Panggil callback dan isi Title dengan nama file
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        });
                        reader.readAsDataURL(file);
                    });

                    input.click();
                }
            });
        }

        // Inisialisasi TinyMCE dengan tinggi berbeda
        initializeTinyMCE('#shortDesc', 300);
        initializeTinyMCE('#longDesc', 500);

        // Inisialisasi upload single image and multiple image
        $(document).ready(function() {
            // Inisialisasi thumbnail dan loading indicator
            // $("#thumbnail1, #thumbnail2").hide();
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

        // select option categori
        $(document).ready(function() {
            // Definisikan fungsi untuk mengambil subkategori
            function loadSubCategories(id, selectedSubCategory) {
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
                            `<option value="${item['id']}" ${item['id'] == selectedSubCategory ? 'selected' : ''}>${item['name']}</option>`
                        ).join('');

                        // Tambahkan opsi baru ke dropdown
                        subCategorySelect.append(options);

                        // Panggil kembali Select2 untuk memperbarui dropdown
                        subCategorySelect.select2(); // Pastikan ini dipanggil untuk memperbarui Select2
                    }
                });
            }

            // Event handler untuk perubahan pada dropdown kategori
            $('#categoryId').on('change', function() {
                var id = $(this).val(); // Mengambil nilai terpilih
                var selectedSubCategory = $('#selectedSubCategoryId')
                    .val(); // Ambil ID subkategori yang sudah dipilih sebelumnya
                if (id) { // Pastikan id tidak kosong
                    loadSubCategories(id, selectedSubCategory);
                }
            });

            // Memanggil loadSubCategories untuk kategori yang sudah terpilih jika ada
            var initialCategoryId = $('#categoryId').val(); // Ambil nilai kategori awal
            var selectedSubCategory = $('#selectedSubCategoryId')
                .val(); // Ambil ID subkategori yang sudah dipilih sebelumnya
            if (initialCategoryId) {
                loadSubCategories(initialCategoryId, selectedSubCategory);
            }
        });

        // Select option
        $(document).ready(function() {
            const selectElements = ['.status', '.choice_attributes', '.SubCategory', '.attributes_choise'];

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


        // Ketika halaman dimuat, cek status awal checkbox
        if ($('#isVariant').is(':checked')) {
            $('.formDetailVariant').show();
            $('.not-variant').hide();
        } else {
            $('#variant').hide();
            $('.formDetailVariant').hide();
            $('.not-variant').show();
        }

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

        // Objek untuk menyimpan nilai input
        var variantData = @json($product->variants);

        updateVariantTable(variantData);

        $(document).on('change', '.attributes_choise', function() {
            const allSelectedAttributes = [];
            const allSelectedAttributesVal = [];
            const showVariantForm = $('#formDetailVariant');

            const selectValue = $(this).find(":selected").map(function() {
                return $(this).val();
            }).get();

            const selectVariant = $(this).find(":selected").map(function() {
                return $(this).data("variant");
            }).get();

            if (selectValue.length > 0) {
                showVariantForm.show(300);
                for (let i = 0; i < selectValue.length; i++) {

                    allSelectedAttributesVal.push({
                        id: selectValue[i],
                        name: selectVariant[i]
                    });

                }

                allSelectedAttributes.push({
                    key: 1,
                    values: allSelectedAttributesVal
                })
            } else {
                showVariantForm.hide(300);
            }

            // Tampilkan spinner saat permintaan dimulai
            $("#vloading").show();

            // Kirim permintaan untuk membuat atau memperbarui varian produk
            $.post("{{ route('product.createVariants') }}", {
                    attributes: allSelectedAttributes,
                    _token: '{{ csrf_token() }}'
                })
                .done(function(variants) {
                    if (Array.isArray(variants)) {
                        // Update data di variantData
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

            const uniqueCombinations = new Set();
            let lastRowIndex = table.rows().count() - 1; // Indeks baris terakhir
            let lastVariantText = '';


            // Initialize dataNew as an empty array
            var dataNew = [];

            // Track matched items to avoid duplication
            var matchedItems = new Set();

            // Loop through each object in dataAwal
            variantData.forEach(dataAwalItem => {
                // Loop through each array in dataBaru
                variants.forEach(dataBaruArray => {
                    if (Array.isArray(dataBaruArray)) {
                        // Find the item in dataBaruArray where name matches variant_attribute in dataAwal
                        const matchingItem = dataBaruArray.find(dataBaruItem => dataBaruItem.name ===
                            dataAwalItem.variant_attribute);

                        if (matchingItem) {
                            // Add matched items to dataNew and store the matched name
                            dataNew.push({
                                id: matchingItem.id,
                                name: matchingItem.name,
                                price: dataAwalItem.price
                            });
                            matchedItems.add(matchingItem.name); // Track matched name
                        }
                    }
                });
            });

            // Add unmatched items from dataBaru to dataNew
            variants.forEach(dataBaruArray => {
                if (Array.isArray(dataBaruArray)) {
                    dataBaruArray.forEach(dataBaruItem => {
                        // If name is not in matchedItems, add it to dataNew
                        if (!matchedItems.has(dataBaruItem.name)) {
                            dataNew.push({
                                id: dataBaruItem.id,
                                name: dataBaruItem.name,
                                price: 0
                            });
                        }
                    });
                }
            });

            if (variants.length > variantData.length) {
                for (let i = 0; i < dataNew.length; i++) {
                    var variant = dataNew[i];

                    const variantPrice = variant['price'] || 0; // Pastikan harga tidak null atau undefined
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(variantPrice);

                    // Jika baris terakhir kosong atau variabel yang sesuai belum ada, tambahkan baris baru
                    table.row.add([
                        `<span class="badge badge-outline-primary expand-row" data-index="${i}" style="cursor: pointer;"><i class="ri-add-line"></i></span> ${variant['name']}`,
                        `<input type="hidden" class="form-control" value="${variant['name']}" name="variant_attributes[]" placeholder="Price">
                        <input type="text" class="form-control price-input" name="variant_price[]" placeholder="Price" value="${formattedPrice}">`,
                        '',
                        ''
                    ])


                    table.draw();
                    formatPriceInput();
                    handleExpandRow(table);
                }
            } else {
                for (let i = 0; i < variants.length; i++) {
                    var variant = variants[i];

                    const variantPrice = variant['price'] || 0; // Pastikan harga tidak null atau undefined
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(variantPrice);

                    // Jika baris terakhir kosong atau variabel yang sesuai belum ada, tambahkan baris baru
                    table.row.add([
                        `<span class="badge badge-outline-primary expand-row" data-index="${i}" style="cursor: pointer;"><i class="ri-add-line"></i></span> ${variant['variant_attribute']}`,
                        `<input type="hidden" class="form-control" value="${variant['variant_attribute']}" name="variant_attributes[]" placeholder="Price">
                        <input type="text" class="form-control price-input" name="variant_price[]" placeholder="Price" value="${formattedPrice}">`,
                        '',
                        ''
                    ]);

                    table.draw();
                    formatPriceInput();
                    handleExpandRow(table);

                }
            }
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
            const variant = variantData[index] || {};
            const fileName = variant.image || '';
            const fileFormat = variant.ext || '';
            const fileSize = variant.size || '';
            const imageUrl = variant.image ? `/storage/upload/image/product/variant/${variant.image}` :
                'https://via.placeholder.com/150?text=No+Image';

            return `
                        <div class="child-row" style="height: auto; overflow-y: auto;">
                            <div class="row mb-3">
                                <label for="stock" class="col-2 col-form-label">Stock</label>
                                <div class="col-10">
                                    <input type="number" class="form-control" name="variant_stock[]" placeholder="Stock" value="${variant.stock || ''}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sku" class="col-2 col-form-label">Sku</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="variant_sku[]" placeholder="SKU Product" value="${variant.sku || ''}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-2 col-form-label">Image</label>
                                <div class="col-10">
                                    <input type="file" id="image_${index}" name="variant_image[]" class="form-control">
                                    <div id="errorImage_${index}" class="invalid-feedback"></div>
                                    <div class="col-xxl-12 col-lg-12" id="thumbnail_${index}" style="display: ${variant.image ? 'block' : 'none'};">
                                        <div class="card mt-1 shadow-none border">
                                            <div class="p-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img id="imagePreview_${index}" src="${imageUrl}" alt="image" class="avatar-sm rounded bg-light" />
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a class="text-muted fw-bold file-name_${index}">${fileName.length > 5 ? fileName.substr(0, 5) + '.. ' :  fileName}</a>
                                                        <input type="hidden" name="file_name[]" value="${fileName}" class="form-control mt-1 file-name-input_${index}" />
                                                        <a class="text-muted fw-bold file-format_${index}">${fileFormat.split('/').pop()}</a>
                                                        <input type="hidden" name="file_format[]" value="${fileFormat}" class="form-control mt-1 file-format-input_${index}" />
                                                        <p class="mb-0 file-size_${index}">${(fileSize / 1024).toFixed(2) + ' KB'}</p>
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
        $(document).on("click", "#updateProduct", function(e) {
            let slugs = $('#slugs').val();
            let itemCode = $('#itemCode').val();
            let barcode = $('#barcode').val();
            let name = $('#name').val();
            let unit = $('#unit').val();
            let minQty = $('#minQty').val();
            let maxQty = $('#maxQty').val();
            let image = $('#image1')[0].files[0];
            // let validationImage = $('input[name="image"]').val().split('\\').pop();
            let isVarinat = $('#is_variant').val();
            let price = $('#price').val();
            let sku = $('#sku').val();
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
            let newArrival = $('#newArrival').is(':checked') ? '1' : '0';
            let bestSeller = $('#bestSeller').is(':checked') ? '1' : '0';
            let specialOffer = $('#specialOffer').is(':checked') ? '1' : '0';
            let refundable = $('#refundable').is(':checked') ? '1' : '0';
            let hot = $('#hot').is(':checked') ? '1' : '0';
            let newLabel = $('#new').is(':checked') ? '1' : '0';
            let sale = $('#newArrival').is(':checked') ? '1' : '0';

            // Mengambil gambar-gambar dari input multiple
            let multipleImage = $('#image2')[0].files;

            // Hanya lakukan validasi jika isVariant dicentang
            if (isVariant === '1') {
                let variantAttributes = $('input[name="variant_attributes[]"]');
                if (variantAttributes.length === 0 || variantAttributes.filter((_, el) => $(el).val() === '')
                    .length > 0) {
                    errorToast("Silakan isi semua varian atribut.");
                    return;
                }

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

            // array push kehadiran
            $('select[name^="choice_attributes"]').each(function(index) {
                $(this).find(':selected').each(function() {
                    // Menambahkan setiap pilihan yang dipilih ke dalam FormData
                    fd.append(`choice_attributes[${index}][]`, $(this).text());
                });
            });
            $('select[name="choice_attributes[]"]').each(function() {
                fd.append("choice_attributes[${index}][]", $(this).find(":selected").text());
            });
            $('input[name="variant_attributes[]"]').each(function() {
                fd.append("variant_attributes[]", $(this).val());
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
            fd.append("seo", seo);
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
                    $('#updateProduct').attr('disabled', 'disabled');
                    $('#updateProduct').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#updateProduct').removeAttr('disabled');
                    $('#updateProduct').html('<i class="ri-save-line"></i> Save');
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
