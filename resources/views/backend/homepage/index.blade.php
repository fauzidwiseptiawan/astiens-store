@extends('backend.layouts.master')
@section('title', 'Homepage Settings')
@push('styles')
    <style>
        .timeline-icon {
            transform: scale(1.7);
            /* Ganti angka untuk memperbesar/memperkecil */
        }

        .custom-width {
            width: 320px;
            /* Atur lebar sesuai kebutuhan */
        }

        @media (max-width: 768px) {
            .custom-width {
                width: 100%;
                /* Membuat tombol menjadi block pada perangkat mobile */
            }
        }
    </style>
@endpush
@section('content') <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Website Setup</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-2 mb-2 mb-sm-0">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active show" id="v-pills-homeslider-tab" data-bs-toggle="pill"
                                        href="#v-pills-homeslider" role="tab" aria-controls="v-pills-homeslider"
                                        aria-selected="true">
                                        Home Slider
                                    </a>
                                    <a class="nav-link" id="v-pills-todaysdeal-tab" data-bs-toggle="pill"
                                        href="#v-pills-todaysdeal" role="tab" aria-controls="v-pills-todaysdeal"
                                        aria-selected="false">
                                        Todays Deal
                                    </a>
                                    <a class="nav-link" id="v-pills-banner1-tab" data-bs-toggle="pill"
                                        href="#v-pills-banner1" role="tab" aria-controls="v-pills-banner1"
                                        aria-selected="false">
                                        Banner Level 1
                                    </a>
                                    <a class="nav-link" id="v-pills-banner2-tab" data-bs-toggle="pill"
                                        href="#v-pills-banner2" role="tab" aria-controls="v-pills-banner2"
                                        aria-selected="false">
                                        Banner Level 2
                                    </a>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-10">
                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- target home slider --}}
                                    <div class="tab-pane fade active show" id="v-pills-homeslider" role="tabpanel"
                                        aria-labelledby="v-pills-homeslider-tab">
                                        {{-- information --}}
                                        <div class="timeline-alt pb-0">
                                            <div class="timeline-item">
                                                <i class="ri-information-line timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <p class="mt-0 mb-1">Minimum dimensions required: 1100px width X 460px
                                                        height</p>
                                                    <p class="text-muted mt-2 mb-0 pb-3">We have limited banner height to
                                                        maintain UI. We had to crop from both left & right side in view for
                                                        different devices to make it responsive. Before designing banner
                                                        keep these points in mind.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- attribut image slider --}}
                                        <div class="card image-slider">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Subtitle (H2) <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H1)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Description (P)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                                            </div>
                                        </div>
                                        {{-- add button --}}
                                        <div class="d-grid gap-2 mb-2">
                                            <button type="button" class="btn btn-outline-success" id="addHomeslider">
                                                <i class="ri-add-fill me-1"></i> <span>Add New</span>
                                            </button>
                                        </div>
                                        {{-- save button --}}
                                        <div class="d-flex justify-content-between">
                                            <div></div> <!-- Spacer untuk memastikan Save berada di kanan -->
                                            <button type="button" class="btn btn-primary custom-width"
                                                id="saveHomeslider">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                    {{-- target todays deal --}}
                                    <div class="tab-pane fade" id="v-pills-todaysdeal" role="tabpanel"
                                        aria-labelledby="v-pills-todaysdeal-tab">
                                        {{-- information --}}
                                        <div class="timeline-alt pb-0">
                                            <div class="timeline-item">
                                                <i class="ri-information-line timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <p class="mt-0 mb-1">Minimum dimensions required: 1100px width X 460px
                                                        height</p>
                                                    <p class="text-muted mt-2 mb-0 pb-3">We have limited banner height to
                                                        maintain UI. We had to crop from both left & right side in view for
                                                        different devices to make it responsive. Before designing banner
                                                        keep these points in mind.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- attribut todays deal --}}
                                        <div class="card todays-deal">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (SPAN)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                                            </div>
                                        </div>
                                        {{-- add button --}}
                                        <div class="d-grid gap-2 mb-2">
                                            <button type="button" class="btn btn-outline-success" id="addTodaysDeal"><i
                                                    class="ri-add-fill me-1"></i> <span>Add
                                                    New</span></button>
                                        </div>
                                        {{-- save button --}}
                                        <div class="d-flex justify-content-between">
                                            <div></div> <!-- Spacer untuk memastikan Save berada di kanan -->
                                            <button type="button" class="btn btn-primary custom-width"
                                                id="saveHomeslider">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                    {{-- target banner level 1 --}}
                                    <div class="tab-pane fade" id="v-pills-banner1" role="tabpanel"
                                        aria-labelledby="v-pills-banner1-tab">
                                        {{-- information --}}
                                        <div class="timeline-alt pb-0">
                                            <div class="timeline-item">
                                                <i class="ri-information-line timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <p class="mt-0 mb-1">Minimum dimensions required: 1100px width X 460px
                                                        height</p>
                                                    <p class="text-muted mt-2 mb-0 pb-3">We have limited banner height to
                                                        maintain UI. We had to crop from both left & right side in view for
                                                        different devices to make it responsive. Before designing banner
                                                        keep these points in mind.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- attribut banner level 1 --}}
                                        <div class="card banner-1">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (H1)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                                            </div>
                                        </div>
                                        {{-- add button --}}
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-success" id="addBanner1"><i
                                                    class="ri-add-fill me-1"></i> <span>Add
                                                    New</span></button>
                                        </div>
                                    </div>
                                    {{-- target banner level 2 --}}
                                    <div class="tab-pane fade" id="v-pills-banner2" role="tabpanel"
                                        aria-labelledby="v-pills-banner1-tab">
                                        {{-- information --}}
                                        <div class="timeline-alt pb-0">
                                            <div class="timeline-item">
                                                <i class="ri-information-line timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <p class="mt-0 mb-1">Minimum dimensions required: 1100px width X 460px
                                                        height</p>
                                                    <p class="text-muted mt-2 mb-0 pb-3">We have limited banner height to
                                                        maintain UI. We had to crop from both left & right side in view for
                                                        different devices to make it responsive. Before designing banner
                                                        keep these points in mind.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- attribut banner level 1 --}}
                                        <div class="card banner-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (H1)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                                            </div>
                                        </div>
                                        {{-- add button --}}
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-success" id="addBanner2"><i
                                                    class="ri-add-fill me-1"></i> <span>Add
                                                    New</span></button>
                                        </div>
                                    </div>
                                </div> <!-- end tab-content-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    @endsection

    @push('page-scripts')
        <script>
            // nav active
            $('.activeDashboard').addClass('menuitem-active')

            // Event delegation untuk add card home slider
            $(document).on('click', '#addHomeslider', function() {
                const newCard = `
                        <div class="card image-slider">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="header-title"></h4>
                                        <button type="button" id="deletedHomesilder" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-close-line"></i></button>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                                <label for="name" class="form-label">Small Heading (H4)
                                                                    <strong class="text-danger">*</strong></label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" placeholder="Enter name">
                                                                <div id="errorName" class="invalid-feedback"></div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Subtitle (H2) <strong
                                                                        class="text-danger">*</strong></label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" placeholder="Enter name">
                                                                <div id="errorName" class="invalid-feedback"></div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Main Heading (H1)
                                                                    <strong class="text-danger">*</strong></label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" placeholder="Enter name">
                                                                <div id="errorName" class="invalid-feedback"></div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Description (P)
                                                                    <strong class="text-danger">*</strong></label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" placeholder="Enter name">
                                                                <div id="errorName" class="invalid-feedback"></div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Link <strong
                                                                        class="text-danger">*</strong></label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" placeholder="Enter name">
                                                                <div id="errorName" class="invalid-feedback"></div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <label for="name" class="form-label">Image <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="file" id="edtImage" name="image"
                                                                class="form-control">
                                                            <div id="errorEdtImage" class="invalid-feedback"></div>
                                                            <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                                <div class="card mt-1 shadow-none border">
                                                                    <div class="p-1">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-auto">
                                                                                <img id="edtImagePreview"
                                                                                    src="https://via.placeholder.com/150?text=No+Image"
                                                                                    alt="image"
                                                                                    class="avatar-sm rounded bg-light" />
                                                                            </div>
                                                                            <div class="col ps-0">
                                                                                <a
                                                                                    class="text-muted fw-bold edt-file-name"></a>
                                                                                <a
                                                                                    class="text-muted fw-bold edt-file-format"></a>
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
                                    </div>
                                </div>
                        </div>
                    `;
                $(this).parent().before(newCard);
            })
            // Event delegation untuk menghapus card home slider
            $(document).on('click', '#deletedHomesilder', function() {
                $(this).closest('.image-slider').remove(); // Menghapus card terdekat
            });

            // Event delegation untuk add card todays deal
            $(document).on('click', '#addTodaysDeal', function() {
                const newCard = `
                    <div class="card todays-deal">
                            <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="header-title"></h4>
                                        <button type="button" id="deletedTodaysDeal" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-close-line"></i></button>
                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (SPAN)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                            </div>
                      </div>
                    `;
                $(this).parent().before(newCard);
            })
            // Event delegation untuk menghapus card todays deal
            $(document).on('click', '#deletedTodaysDeal', function() {
                $(this).closest('.todays-deal').remove(); // Menghapus card terdekat
            });

            // Event delegation untuk add card banner level 1
            $(document).on('click', '#addBanner1', function() {
                const newCard = `
                    <div class="card banner-1">
                            <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="header-title"></h4>
                                        <button type="button" id="deletedBanner1" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-close-line"></i></button>
                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (SPAN)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                            </div>
                      </div>
                    `;
                $(this).parent().before(newCard);
            })
            // Event delegation untuk menghapus card banner level 1
            $(document).on('click', '#deletedBanner1', function() {
                $(this).closest('.banner-1').remove(); // Menghapus card terdekat
            });

            // Event delegation untuk add card banner level 1
            $(document).on('click', '#addBanner2', function() {
                const newCard = `
                    <div class="card banner-2">
                            <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="header-title"></h4>
                                        <button type="button" id="deletedBanner2" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-close-line"></i></button>
                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Small Heading (SPAN)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Main Heading (H4)
                                                                <strong class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Link <strong
                                                                    class="text-danger">*</strong></label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter name">
                                                            <div id="errorName" class="invalid-feedback"></div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-6">
                                                        <label for="name" class="form-label">Image <strong
                                                                class="text-danger">*</strong></label>
                                                        <input type="file" id="edtImage" name="image"
                                                            class="form-control">
                                                        <div id="errorEdtImage" class="invalid-feedback"></div>
                                                        <div class="col-xxl-12 col-lg-12" id="edtPreviewImage">
                                                            <div class="card mt-1 shadow-none border">
                                                                <div class="p-1">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-auto">
                                                                            <img id="edtImagePreview"
                                                                                src="https://via.placeholder.com/150?text=No+Image"
                                                                                alt="image"
                                                                                class="avatar-sm rounded bg-light" />
                                                                        </div>
                                                                        <div class="col ps-0">
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-name"></a>
                                                                            <a
                                                                                class="text-muted fw-bold edt-file-format"></a>
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
                                                </div>
                            </div>
                      </div>
                    `;
                $(this).parent().before(newCard);
            })
            // Event delegation untuk menghapus card banner level 1
            $(document).on('click', '#deletedBanner2', function() {
                $(this).closest('.banner-2').remove(); // Menghapus card terdekat
            });
        </script>
    @endpush
