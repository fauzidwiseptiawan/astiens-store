        $('#choiseAttributes').on('change', function() {
            let selectAttributes = $(this).select2('data');
            $('.value-attributes').empty();

            if (selectAttributes) {
                selectAttributes.forEach(function(attributes) {
                    let attributesId = attributes.id;
                    let attributesText = attributes.text;
                    let url = "{{ route('product.getValue', ':id') }}".replace(':id', attributesId);
                    let existingValues = $(`#choiseAttributes${attributesId}`).val() || [];

                    // Menambahkan elemen HTML untuk setiap atribut yang dipilih
                    $('.value-attributes').append(`
                        <div class="row mt-2" id="attribute-row-${attributesId}">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="${attributesText}" disabled>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control attributes${attributesId} attributes_choise" name="choise_attributes[]" id="choiseAttributes${attributesId}" multiple="multiple">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    `);

                    // Menangani AJAX untuk mendapatkan nilai atribut
                    $.ajax({
                        type: 'GET',
                        url: url,
                        dataType: 'JSON',
                        success: function(response) {
                            let options = '<option></option>' + response['data'].map(item =>
                                `<option value="${item.id}" data-variant="${item.name}">${item.name}</option>`
                            ).join('');
                            $(`#choiseAttributes${attributesId}`).html(options).val(
                                existingValues).trigger('change');

                            // Inisialisasi Select2
                            $(`.attributes${attributesId}`).select2({
                                placeholder: 'Select Attributes',
                                allowClear: false
                            });
                        }
                    });
                });
            }
        });

        // Fungsi untuk memperbarui varian produk berdasarkan atribut yang dipilih
        function updateProductVariants() {
            let allSelectedAttributes = [];

            // Mendapatkan semua nilai yang dipilih dari setiap atribut
            $('.attributes_choise').each(function() {
                let attributeId = $(this).attr('id');
                let selectedValues = $(this).val();

                if (selectedValues) {
                    allSelectedAttributes.push({
                        id: attributeId,
                        values: selectedValues.map(value => ({
                            id: value,
                            name: $(this).find(`option[value="${value}"]`).data('variant')
                        }))
                    });
                }
            });

            // Membuat kombinasi varian produk berdasarkan atribut yang dipilih
            let productVariants = createCombinations(allSelectedAttributes);

            let attributeRowCount = $('.value-attributes .row').length; // Menghitung jumlah row di dalam .value-attributes
            console.log(attributeRowCount)

            if (attributeRowCount > 1) {
                // Jika ada lebih dari satu row, update tabel dengan varian
                updateVariantTable(productVariants);
            } else if (attributeRowCount === 1 && productVariants.length > 0) {
                // Jika hanya ada satu row, tambahkan ke dalam tabel
                addVariantsToTable(productVariants);
            }
        }

        // Fungsi untuk menambahkan varian ke tabel
        function addVariantsToTable(variants) {
            let tableBody = $('#detailVariant tbody');

            // Menghindari duplikasi dengan menggunakan set
            let existingVariantTexts = new Set();

            // Menambahkan setiap varian ke dalam tabel
            variants.forEach(variant => {
                let variantText = variant.map(attr => attr.name).join(' - ');

                // Cek jika varian sudah ada
                if (!existingVariantTexts.has(variantText)) {
                    existingVariantTexts.add(variantText);
                    tableBody.append(`
                <tr>
                    <td>${variantText}</td>
                    <td><input type="number" class="form-control" name="variant_price[]" placeholder="Price"></td>
                    <td><input type="number" class="form-control" name="variant_stock[]" placeholder="Stock"></td>
                </tr>
            `);
                }
            });
        }

        // Fungsi untuk membuat kombinasi dari atribut yang dipilih
        function createCombinations(attributes) {
            if (attributes.length === 0) return [];
            if (attributes.length === 1) return attributes[0].values.map(val => [val]);

            let combinations = [];
            let restCombinations = createCombinations(attributes.slice(1));

            attributes[0].values.forEach(val => {
                restCombinations.forEach(combination => {
                    combinations.push([val, ...combination]);
                });
            });

            return combinations;
        }

        // Fungsi untuk mengupdate tabel varian produk
        function updateVariantTable(variants) {
            let tableBody = $('#detailVariant tbody');
            tableBody.empty();

            // Set untuk menyimpan kombinasi unik
            let uniqueCombinations = new Set();

            variants.forEach(variant => {
                let variantText = variant.map(attr => attr.name).join(' - ');

                // Cek duplikasi dengan menambahkan ke Set
                if (!uniqueCombinations.has(variantText)) {
                    uniqueCombinations.add(variantText);

                    tableBody.append(`
                <tr>
                    <td>${variantText}</td>
                    <td><input type="number" class="form-control" name="variant_price[]" placeholder="Price"></td>
                    <td><input type="number" class="form-control" name="variant_stock[]" placeholder="Stock"></td>
                </tr>
            `);
                }
            });
        }

        // Modifikasi: Menggunakan event listener untuk setiap atribut yang dipilih
        $(document).on('change', '.attributes_choise', function() {
            updateProductVariants();
        });
