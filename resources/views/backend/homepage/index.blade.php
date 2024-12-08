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
                                    @foreach ($sliderGroups as $group)
                                        <a class="nav-link {{ $loop->first ? 'active show' : '' }}"
                                            id="v-pills-{{ $group->id }}-tab" data-bs-toggle="pill"
                                            href="#v-pills-{{ $group->id }}" role="tab"
                                            aria-controls="v-pills-{{ $group->id }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $group->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-10">
                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- target home slider --}}
                                    @foreach ($sliderGroups as $group)
                                        <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                            id="v-pills-{{ $group->id }}" role="tabpanel"
                                            aria-labelledby="v-pills-{{ $group->id }}-tab">

                                            {{-- Informasi umum --}}
                                            <div class="timeline-alt pb-0">
                                                <div class="timeline-item">
                                                    <i class="ri-information-line timeline-icon"></i>
                                                    <div class="timeline-item-info">
                                                        <p class="mt-0 mb-1">Minimum dimensions required: 1100px width X
                                                            460px height</p>
                                                        <p class="text-muted mt-2 mb-0 pb-3">
                                                            We have limited banner height to maintain UI...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- attribut image slider --}}
                                            {{-- Slider Items --}}
                                            @foreach ($group->sliderItems as $item)
                                                <div class="card slider-items">
                                                    <div class="card-body">
                                                        @if ($loop->index > 0)
                                                            <!-- Cek jika ini adalah data kedua atau lebih -->
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <h4 class="header-title"></h4>
                                                                <!-- Anda bisa mengganti "Slider Item" dengan nama dinamis jika diperlukan -->
                                                                <button type="button" id="deletedSliderItems"
                                                                    class="btn btn-circle btn-soft-danger btn-sm">
                                                                    <i class="ri-close-line"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="row">
                                                            @if (!in_array($group->name, ['banner_level_1', 'banner_level_2', 'todaysdeal']))
                                                                <!-- Cek jika slider_group bukan banner_level_1, banner_level_2, atau todaysdeal -->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Small Heading <strong
                                                                                class="text-danger">*</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $item->title_h4 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Subtitle <strong
                                                                                class="text-danger">*</strong></label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $item->subtitle_h2 }}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Main Heading <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->main_heading_h1 }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <textarea class="form-control">{{ $item->description_p }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Link <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->link_url }}">
                                                                </div>
                                                            </div>
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
                                                                                    <button type="button" id="removeImg"
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
                                            @endforeach
                                            {{-- add button --}}
                                            <div class="d-grid gap-2 mb-2">
                                                <button type="button" class="btn btn-outline-success" id="addRow">
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
                                    @endforeach
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

            $(document).ready(function() {
                // Event delegation untuk tombol "Add New" di dalam tab
                $(document).on('click', '#addRow', function() {
                    // Dapatkan elemen tab aktif
                    let activeTab = $('.tab-pane.active');

                    // Dapatkan template untuk card baru
                    let newCard = activeTab.find('.card.slider-items').first().clone(); // Menyalin card pertama

                    // Reset nilai input untuk card baru (bisa disesuaikan)
                    newCard.find('input').val('');
                    newCard.find('textarea').val('');

                    // Menambahkan tombol hapus hanya jika bukan card pertama
                    newCard.find('.d-flex').remove(); // Menghapus tombol hapus pada card pertama yang disalin
                    if (activeTab.find('.card.slider-items').length > 1) {
                        // Jika ada lebih dari satu card, tambahkan tombol hapus pada card baru
                        let deleteButton = $(
                            '<div class="d-flex justify-content-between align-items-center mb-2">' +
                            '<h4 class="header-title"></h4>' +
                            '<button type="button" id="deletedSliderItems" class="btn btn-circle btn-soft-danger btn-sm">' +
                            '<i class="ri-close-line"></i></button>' +
                            '</div>');
                        // Menambahkan tombol delete pada posisi yang tepat
                        newCard.find('.card-body').prepend(
                            deleteButton); // Menambahkan di bagian atas card-body
                    }

                    // Tambahkan card baru di bawah card yang ada
                    activeTab.find('.card.slider-items:last').after(newCard);
                });

                // Event delegation untuk tombol "Delete" pada card
                $(document).on('click', '#deletedSliderItems', function() {
                    // Menghapus card yang terkait dengan tombol yang diklik
                    $(this).closest('.card.slider-items').remove();
                });

                // Optional: Event untuk tombol hapus gambar
                $(document).on('click', '#removeImg', function() {
                    let card = $(this).closest('.card');
                    card.find('#edtImage').val('');
                    card.find('#edtImagePreview').attr('src', 'https://via.placeholder.com/150?text=No+Image');
                });
            });
        </script>
    @endpush
