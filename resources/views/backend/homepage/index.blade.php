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
                                            data-group-id="{{ $group->id }}" aria-controls="v-pills-{{ $group->id }}"
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
                                                <div class="card slider-items" data-id="{{ $item->id }}">
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
                                                                        <input type="text" name="title_h4[]"
                                                                            class="form-control"
                                                                            id="slider_items_{{ $loop->index }}_title_h4"
                                                                            value="{{ $item->title_h4 }}">
                                                                        <div class="invalid-feedback"
                                                                            id="slider_items_{{ $loop->index }}_title_h4_error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Subtitle <strong
                                                                                class="text-danger">*</strong></label>
                                                                        <input type="text" name="subtitle_h2[]"
                                                                            class="form-control"
                                                                            id="slider_items_{{ $loop->index }}_subtitle_h2"
                                                                            value="{{ $item->subtitle_h2 }}">
                                                                        <div class="invalid-feedback"
                                                                            id="slider_items_{{ $loop->index }}_subtitle_h2_error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Main Heading <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <input type="text" name="main_heading_h1[]"
                                                                        class="form-control"
                                                                        id="slider_items_{{ $loop->index }}_main_heading_h1"
                                                                        value="{{ $item->main_heading_h1 }}">
                                                                    <div class="invalid-feedback"
                                                                        id="slider_items_{{ $loop->index }}_main_heading_h1_error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <textarea class="form-control" name="description_p[]">{{ $item->description_p }}</textarea>
                                                                    <div class="invalid-feedback"
                                                                        id="slider_items_{{ $loop->index }}_description_p_error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Link <strong
                                                                            class="text-danger">*</strong></label>
                                                                    <input type="text" class="form-control"
                                                                        name="link_url[]"
                                                                        id="slider_items_{{ $loop->index }}_link_url"
                                                                        value="{{ $item->link_url }}">
                                                                    <div class="invalid-feedback"
                                                                        id="slider_items_{{ $loop->index }}_link_url_error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="name" class="form-label">Image <strong
                                                                        class="text-danger">*</strong></label>
                                                                <input type="file"
                                                                    id="slider_items_{{ $loop->index }}_image"
                                                                    name="image[]" class="form-control">
                                                                <div class="invalid-feedback"
                                                                    id="slider_items_{{ $loop->index }}_image_error">
                                                                </div>
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

                    // Dapatkan jumlah card saat ini untuk menentukan index baru
                    let currentIndex = activeTab.find('.card.slider-items').length;

                    // Reset nilai input untuk card baru
                    newCard.find('input').val('');
                    newCard.find('textarea').val('');

                    // Set nilai input name berdasarkan format slider_items[index][field]
                    newCard.find('input, textarea').each(function() {
                        let oldName = $(this).attr('name');
                        if (oldName) {
                            let newName = oldName.replace(/\[\d+\]/, `[${currentIndex}]`);
                            $(this).attr('name', newName);
                        }
                    });

                    // Kosongkan data-id pada card baru agar id tidak terbawa
                    newCard.removeAttr('data-id'); // Menghapus data 'data-id' dari card baru

                    // Tambahkan tombol hapus hanya jika bukan card pertama
                    newCard.find('.d-flex').remove(); // Menghapus tombol hapus pada card pertama yang disalin
                    if (activeTab.find('.card.slider-items').length > 0) {
                        // Tambahkan tombol hapus pada card baru
                        let deleteButton = $(
                            '<div class="d-flex justify-content-between align-items-center mb-2">' +
                            '<h4 class="header-title"></h4>' +
                            '<button type="button" id="deletedSliderItems" class="btn btn-circle btn-soft-danger btn-sm">' +
                            '<i class="ri-close-line"></i></button>' +
                            '</div>'
                        );
                        newCard.find('.card-body').prepend(
                            deleteButton); // Menambahkan di bagian atas card-body
                    }

                    // Tambahkan card baru di bawah card yang ada
                    activeTab.find('.card.slider-items:last').after(newCard);
                });

                // Event delegation untuk tombol "Delete" pada card
                $(document).on('click', '#deletedSliderItems', function() {
                    var card = $(this).closest('.card.slider-items');
                    var inputs = card.find('input').val(); // Menyaring elemen input dalam card
                    var sliderItemId = card.data('id'); // Mengambil ID slider dari atribut data-id (jika ada)

                    var url = "{{ route('homepage.destroy', ':id') }}";
                    url = url.replace(':id', sliderItemId);

                    // Jika input kosong, hapus card langsung
                    if (!inputs) {
                        card.remove();
                    } else if (sliderItemId) {
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
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                });
                                $.ajax({
                                    url: url,
                                    type: 'DELETE', // Menggunakan metode DELETE
                                    success: function(responce) {
                                        $.toast({
                                            text: responce.message,
                                            icon: 'success',
                                            hideAfter: 1500,
                                            showHideTransition: 'plain',
                                            position: 'top-right',
                                            afterShown: function() {
                                                card.remove();
                                            },
                                        });
                                    }
                                })
                            }
                        });
                    }
                });

                // Optional: Event untuk tombol hapus gambar
                $(document).on('click', '#removeImg', function() {
                    let card = $(this).closest('.card');
                    card.find('#edtImage').val('');
                    card.find('#edtImagePreview').attr('src', 'https://via.placeholder.com/150?text=No+Image');
                });
            });


            // Pastikan menggunakan event delegation
            $(document).on('click', '.nav-link', function() {
                // Tambahkan logika jika ada pengaturan tambahan
                // console.log('Active tab changed to:', $(this).data('group-id'));
            });

            $(document).on('click', '#saveHomeslider', function() {
                // Cari slider group yang aktif
                let activeGroup = $('.nav-link.active').data('group-id');

                if (!activeGroup) {
                    alert('No active slider group found!');
                    return;
                }

                // Ambil slider items hanya untuk group yang aktif
                let sliderItems = [];

                $(`#v-pills-${activeGroup} .slider-items`).each(function() {
                    let item = {
                        id: $(this).data('id') || '', // Jika tidak ada data-id, set id sebagai null
                        title_h4: $(this).find('input[name="title_h4[]"]').val() || '',
                        subtitle_h2: $(this).find('input[name="subtitle_h2[]"]').val() || '',
                        main_heading_h1: $(this).find('input[name="main_heading_h1[]"]').val() || '',
                        description_p: $(this).find('textarea[name="description_p[]"]').val() || '',
                        link_url: $(this).find('input[name="link_url[]"]').val() || '',
                    };
                    // Cek duplikasi berdasarkan id dan nilai data lainnya
                    if (!sliderItems.some(existingItem => existingItem.id === item.id)) {
                        sliderItems.push(item);
                    }
                });

                let formData = new FormData();
                formData.append('group_id', activeGroup); // Sertakan group ID
                sliderItems.forEach((item, index) => {
                    formData.append(`slider_items[${index}][id]`, item.id);
                    formData.append(`slider_items[${index}][title_h4]`, item.title_h4);
                    formData.append(`slider_items[${index}][subtitle_h2]`, item.subtitle_h2);
                    formData.append(`slider_items[${index}][main_heading_h1]`, item.main_heading_h1);
                    formData.append(`slider_items[${index}][description_p]`, item.description_p);
                    formData.append(`slider_items[${index}][link_url]`, item.link_url);
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('homepage.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $.toast({
                                text: response.message,
                                icon: 'success',
                                showHideTransition: 'plain',
                                hideAfter: 1500,
                                position: 'top-right',
                            });
                        } else {
                            $.each(response.message, function(key, value) {
                                // Ganti titik (.) dengan underscore (_) untuk mendapatkan ID yang dinamis
                                var inputName = key.replace(/\./g,
                                    '_'
                                ); // Misalnya slider_items.3.link_url -> slider_items_3_link_url

                                var errorMessage = value.join(
                                    ', '); // Gabungkan error jika ada beberapa pesan

                                // Temukan elemen input terkait berdasarkan ID yang sesuai
                                var inputElement = $('#' + inputName);
                                var errorElement = $('#' + inputName + '_error');

                                inputElement.addClass(
                                    'is-invalid'); // Tambahkan kelas is-invalid pada input

                                // Menampilkan pesan error di div invalid-feedback
                                if (errorElement.length) {
                                    errorElement.text(errorMessage); // Tampilkan pesan error
                                    errorElement.show(); // Tampilkan elemen error
                                }
                            });
                        }
                    },
                });
            });
        </script>
    @endpush
