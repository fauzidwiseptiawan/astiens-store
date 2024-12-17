@extends('backend.layouts.master')
@section('title', 'Header')
@push('styles')
    <style>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $headers->id }}">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Set Image <small>(300x300)</small>
                                    <strong class="text-danger">*</strong></label>
                                <input type="file" id="image" name="image" class="form-control">
                                <div id="errorimage" class="invalid-feedback"></div>
                                <div class="col-xxl-3 col-lg-3" id="previewImage"
                                    style="display:{{ $headers->image ? 'block' : 'none' }};">
                                    <div class="card mt-1 shadow-none border">
                                        <div class="p-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img id="imagePreview"
                                                        src="{{ $headers->image ? asset('storage/upload/image/header/thumbnail/' . $headers->image) : 'https://via.placeholder.com/150?text=No+Image' }}"
                                                        alt="image" class="avatar-sm rounded bg-light" />
                                                </div>
                                                <div class="col ps-0">
                                                    <a
                                                        class="text-muted fw-bold file-name">{{ strlen($headers->image) > 10 ? substr($headers->image, 0, 10) : $headers->image ?? '' }}</a>
                                                    <a class="text-muted fw-bold file-format">{{ $headers->ext ?? '' }}</a>
                                                    <p class="mb-0 file-size">
                                                        {{ number_format($headers->size / 1024, 2) }}
                                                        KB</p>
                                                </div>
                                                {{-- <div class="col-auto">
                                                <!-- Button -->
                                                <button type="button" id="edtRemoveImage"
                                                    class="btn btn-link fs-16 text-muted">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">Title Promo </label>
                            <div id="titleContainer">
                                @if ($headers && $headers->title_promo)
                                    @foreach (json_decode($headers->title_promo, true) as $promo)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <input type="text" name="title[]" class="form-control me-2"
                                                    placeholder="Enter title promo" value="{{ $promo['title'] }}">
                                                <button type="button" id="deleteRowTitle"
                                                    class="btn btn-circle btn-soft-danger btn-sm">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="d-grid gap-2 mb-2 mt-2">
                                <button type="button" class="btn btn-outline-success" id="addRowTitle">
                                    <i class="ri-add-fill me-1"></i> <span>Add New</span>
                                </button>
                            </div>
                            <label class="form-label">Header Nav Menu </label>
                            <div id="navContainer">
                                @if ($headers && $headers->nav_menu)
                                    @foreach (json_decode($headers->nav_menu, true) as $menu)
                                        <div class="d-flex align-items-center">
                                            <div class="row flex-grow-1">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <input type="text" name="name[]" value="{{ $menu['name'] }}"
                                                            class="form-control" placeholder="Enter label">
                                                        <div id="errorName" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <input type="text" name="url[]" value="{{ $menu['url'] }}"
                                                            class="form-control"
                                                            placeholder="https://localhost/ecommerce_demo/">
                                                        <div id="errorLink" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" id="deleteRowNav"
                                                    class="btn btn-circle btn-soft-danger btn-sm mb-3">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="d-grid gap-2 mb-2 mt-2">
                                <button type="button" class="btn btn-outline-success" id="addRowNav">
                                    <i class="ri-add-fill me-1"></i> <span>Add New</span>
                                </button>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div></div> <!-- Spacer untuk memastikan Save berada di kanan -->
                                <button type="button" class="btn btn-primary custom-width" id="save">
                                    Save
                                </button>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script>
        // nav active
        $('.sidebarUI').addClass('menuitem-active')

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
                    $("#previewImage").hide(50);
                }

                $('#removeImage').click(function(e) {
                    e.preventDefault()
                    $("#previewImage").hide(50);
                    $('#image').val('');
                })
            });
        });


        $(document).ready(function() {
            // Fungsi untuk mengatur tampilan tombol delete
            function toggleDeleteButtons() {
                // Menyembunyikan/memperlihatkan tombol deleteRowNav
                $('#navContainer .d-flex').length > 1 ?
                    $('#navContainer #deleteRowNav').show() :
                    $('#navContainer #deleteRowNav').hide();

                // Menyembunyikan/memperlihatkan tombol deleteRowTitle
                $('#titleContainer .d-flex').length > 1 ?
                    $('#titleContainer #deleteRowTitle').show() :
                    $('#titleContainer #deleteRowTitle').hide();
            }

            // Event listener untuk tombol Add New pada Title
            $('#addRowTitle').on('click', function() {
                const newRow = $(`
                    <div class="d-flex align-items-center mb-3">
                        <input type="text" name="title[]" class="form-control me-2" placeholder="Enter title promo">
                        <div id="errorTitle" class="invalid-feedback"></div>
                        <button type="button" id="deleteRowTitle" class="btn btn-circle btn-soft-danger btn-sm">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                `);

                $('#titleContainer').append(newRow);
                toggleDeleteButtons(); // Update tombol setelah penambahan row
            });

            // Event listener untuk tombol Remove pada Title
            $(document).on('click', '#deleteRowTitle', function() {
                $(this).closest('.d-flex').remove();
                toggleDeleteButtons(); // Update tombol setelah penghapusan row
            });

            // Event listener untuk tombol Add New pada Nav
            $('#addRowNav').on('click', function() {
                const newRow = $(`
                    <div class="d-flex align-items-center">
                        <div class="row flex-grow-1">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" name="name[]" class="form-control" placeholder="Enter label">
                                    <div id="errorName" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" name="url[]" class="form-control"
                                        placeholder="https://localhost/ecommerce_demo/">
                                    <div id="errorLink" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-2">
                            <button type="button" id="deleteRowNav" class="btn btn-circle btn-soft-danger btn-sm mb-3">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>
                `);

                $('#navContainer').append(newRow);
                toggleDeleteButtons(); // Update tombol setelah penambahan row
            });

            // Event listener untuk tombol Remove pada Nav
            $(document).on('click', '#deleteRowNav', function() {
                $(this).closest('.d-flex').remove();
                toggleDeleteButtons(); // Update tombol setelah penghapusan row
            });

            // Inisialisasi toggleDeleteButtons saat halaman dimuat
            toggleDeleteButtons();
        });

        // Menangani form submit untuk menyimpan data
        $('#save').on('click', function() {
            const formData = new FormData();

            // Mengambil data dari input title
            let titles = [];
            $('input[name="title[]"]').each(function() {
                let title = $(this).val();
                if (title) {
                    titles.push({
                        title: title
                    }); // Simpan dalam format JSON
                }
            });
            formData.append('title', JSON.stringify(titles)); // Kirim sebagai JSON string

            // Mengambil data dari input nav_menu
            let navMenu = [];
            $('#navContainer .d-flex.align-items-center').each(function() {
                let name = $(this).find('input[name="name[]"]').val();
                let url = $(this).find('input[name="url[]"]').val();

                if (name && url) {
                    navMenu.push({
                        name: name,
                        url: url
                    }); // Simpan dalam format JSON
                }
            });

            formData.append('nav_menu', JSON.stringify(navMenu)); // Kirim sebagai JSON string

            // Menyertakan file image jika ada
            const imageInput = $('#image')[0].files[0];
            if (imageInput) {
                formData.append('image', imageInput);
            }

            // Tambahkan ID jika sedang update
            const headerId = $('input[name="id"]').val(); // ID diambil dari hidden input jika ada
            if (headerId) {
                formData.append('id', headerId);
            }

            // Setup CSRF token untuk AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "{{ route('header.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#save').attr('disabled', 'disabled');
                    $('#save').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#save').removeAttr('disabled');
                    $('#save').html('Save');
                },
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
                            console.log(inputName);
                            var errorMessage = value.join(
                                ', '); // Gabungkan error jika ada beberapa pesan

                            // Temukan elemen input terkait berdasarkan ID yang sesuai
                            var inputElement = $('#' + inputName);
                            var errorElement = $('#' + 'error' + inputName);

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
                error: function(xhr) {
                    // Tangani validasi gagal
                    if (xhr.status === 400) {
                        let errors = xhr.responseJSON.message;
                        for (let key in errors) {
                            alert(errors[key]); // Tampilkan semua pesan error
                        }
                    } else {
                        alert('Terjadi kesalahan saat menyimpan.');
                    }
                },
            });
        });
    </script>
@endpush
