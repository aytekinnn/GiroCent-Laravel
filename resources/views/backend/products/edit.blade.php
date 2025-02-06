@extends('backend.layout')
@section('content')
    <style>
        .category-item {
            display: inline-flex;
            align-items: center;
            margin: 5px;
            padding: 5px 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            position: relative;
        }

        .category-text {
            margin-right: 10px;
            font-size: 14px;
        }

        .remove-btn {
            color: red;
            cursor: pointer;
            font-weight: bold;
            padding: 2px 5px;
            background: #fff;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        .cke_notification_warning {
            display: none !important;
        }
    </style>
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ürün Düzenle</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ürün Düzenle</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form Wizard Start -->
                        <div class="form-wizard">
                            <form action="{{route('product.edit')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-wizard-header overflow-x-auto scroll-sm pb-8 my-32">
                                    <ul class="list-unstyled form-wizard-list style-two">
                                        <li class="form-wizard-list__item active">
                                            <div class="form-wizard-list__line">
                                                <span class="count">1</span>
                                            </div>
                                            <span class="text text-xs fw-semibold">Genel Bilgiler </span>
                                        </li>
                                        <li class="form-wizard-list__item">
                                            <div class="form-wizard-list__line">
                                                <span class="count">2</span>
                                            </div>
                                            <span class="text text-xs fw-semibold">Veri</span>
                                        </li>
                                        <li class="form-wizard-list__item">
                                            <div class="form-wizard-list__line">
                                                <span class="count">3</span>
                                            </div>
                                            <span class="text text-xs fw-semibold">Bağlantılar</span>
                                        </li>
                                        <li class="form-wizard-list__item">
                                            <div class="form-wizard-list__line">
                                                <span class="count">4</span>
                                            </div>
                                            <span class="text text-xs fw-semibold">Tamamlandı</span>
                                        </li>
                                    </ul>
                                </div>

                                <fieldset class="wizard-fieldset show">
                                    <h6 class="text-md text-neutral-500">Genel Bilgiler</h6>
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <div class="row gy-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">Ürün Adı*</label>
                                            <div class="position-relative">
                                                <input type="text" name="name" class="form-control wizard-required"
                                                       id="kategoriAdi" oninput="generateSlug()" placeholder="Ürün Adı"
                                                       required value="{{$product->name}}">
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">Ürün Açıklaması*</label>
                                            <div class="position-relative">
                                                <textarea name="description"
                                                          class="form-control">{{$product->description}}</textarea>
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Seo Ürün Adı*</label>
                                            <div class="position-relative">
                                                <input type="text" name="slug" id="seoLink"
                                                       class="form-control wizard-required" placeholder="Ürün Adı"
                                                       required value="{{$product->slug}}">
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Yeni Görsel Ekle*</label>
                                            <div class="position-relative">
                                                <input type="file" name="image" class="form-control" required>
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="old_file" value="{{$product->image}}">
                                        <div class="form-group text-end">
                                            <button type="button"
                                                    class="form-wizard-next-btn btn btn-primary-600 px-32">İleri
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="wizard-fieldset">
                                    <h6 class="text-md text-neutral-500">Veri</h6>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label">Ürün Kodu*</label>
                                            <div class="position-relative">
                                                <input type="text" name="product_code"
                                                       class="form-control wizard-required"
                                                       placeholder="Ürün Kodu Giriniz"
                                                       value="{{$product->product_code}}" required>
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Konum'u</label>
                                            <div class="position-relative">
                                                <input type="text" name="location" value="{{$product->location}}"
                                                       class="form-control wizard-required"
                                                       placeholder="Konum'u ">
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Fiyat*</label>
                                            <div class="position-relative">
                                                <input type="text" id="priceInput" name="price"
                                                       value="{{ $product->price }}"
                                                       class="form-control wizard-required" placeholder="Fiyat" required>
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">Vergi Sınıfı</label>
                                            <div class="position-relative">
                                                <select name="tax_class" class="form-select">
                                                    <option disabled selected>Bir üretici seçin...</option>
                                                    <option {{$product->tax_class=="0" ? "selected=''" : ""}} value="0">
                                                        KDV(%10)
                                                    </option>
                                                    <option {{$product->tax_class=="1" ? "selected=''" : ""}} value="1">
                                                        KDV(%20)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Miktar*</label>
                                            <div class="position-relative">
                                                <input type="number" name="stock" class="form-control wizard-required"
                                                       required placeholder="Miktar" value="{{$product->stock}}">
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Geçerlilik Tarihi</label>
                                            <div class="position-relative">
                                                <input type="date" name="gecerlilik_tarih"
                                                       value="{{$product->gecerlilik_tarih}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">Stok Dışı Durumu</label>
                                            <div class="position-relative">
                                                <select name="stok_dis_durum" class="form-select">
                                                    <option disabled selected>Bir Stok Dışı Durum Seçin...</option>
                                                    <option
                                                        {{$product->stok_dis_durum=="0" ? "selected=''" : ""}} value="0">
                                                        2-3 Gün İçinde
                                                    </option>
                                                    <option
                                                        {{$product->stok_dis_durum=="1" ? "selected=''" : ""}} value="1">
                                                        Ön Sipariş
                                                    </option>
                                                    <option
                                                        {{$product->stok_dis_durum=="2" ? "selected=''" : ""}} value="2">
                                                        Stokta Var
                                                    </option>
                                                    <option
                                                        {{$product->stok_dis_durum=="3" ? "selected=''" : ""}} value="3">
                                                        Stokta Yok
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Kargo
                                                Durumu</label>
                                            <div class="d-flex align-items-center flex-wrap gap-28">
                                                <!-- Evet -->
                                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="kargo"
                                                           value="1"
                                                           id="Personal"
                                                        {{ $product->kargo == 1 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Personal">
                                                        <span
                                                            class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                        Evet
                                                    </label>
                                                </div>
                                                <!-- Hayır -->
                                                <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="kargo"
                                                           value="0"
                                                           id="Holiday"
                                                        {{ $product->kargo == 0 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Holiday">
                                                        <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                        Hayır
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Stoktan
                                                Düş </label>
                                            <div class="d-flex align-items-center flex-wrap gap-28">
                                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="stok_dus"
                                                           value="1"
                                                           id="Personal" {{ $product->stok_dus == 1 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Personal">
                                                        <span
                                                            class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                        Evet
                                                    </label>
                                                </div>
                                                <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="stok_dus"
                                                           value="0"
                                                           id="Holiday" {{ $product->stok_dus == 0 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Holiday">
                                                        <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                        Hayır
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <label
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Durum </label>
                                            <div class="d-flex align-items-center flex-wrap gap-28">
                                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="durum" value="1"
                                                           id="Personal" {{ $product->durum == 1 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Personal">
                                                        <span
                                                            class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="durum" value="0"
                                                           id="Holiday" {{ $product->durum == 0 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Holiday">
                                                        <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                        Pasif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Öne Çıkar </label>
                                            <div class="d-flex align-items-center flex-wrap gap-28">
                                                <div class="form-check checked-success d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="one_cikar" value="1"
                                                           id="Personal" {{ $product->one_cikar == 1 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Personal">
                                                        <span
                                                            class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                                        Evet
                                                    </label>
                                                </div>
                                                <div class="form-check checked-danger d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="radio" name="one_cikar" value="0"
                                                           id="Holiday" {{ $product->one_cikar == 0 ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1"
                                                        for="Holiday">
                                                        <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                                        Hayır
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button"
                                                    class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">
                                                Geri
                                            </button>
                                            <button type="button"
                                                    class="form-wizard-next-btn btn btn-primary-600 px-32">İleri
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="wizard-fieldset">
                                    <h6 class="text-md text-neutral-500">Bağlantılar</h6>
                                    <div class="row gy-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">Üretici*</label>
                                            <div class="position-relative">
                                                <select name="uretici_id" class="form-select">
                                                    <option
                                                        disabled {{ empty($product->manufacturer) ? 'selected' : '' }}>
                                                        Bir üretici seçin...
                                                    </option>
                                                    @foreach($manufacturer as $manufacturers)
                                                        <option
                                                            value="{{ $manufacturers->id }}"
                                                            {{ isset($product->manufacturer) && $manufacturers->id == $product->manufacturer->id ? 'selected' : '' }}>
                                                            {{ $manufacturers->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="categorySelect" class="form-label">Kategori Seç</label>
                                                <select id="categorySelect" class="form-select">
                                                    <option disabled selected>Bir kategori seçin...</option>
                                                    @foreach($category as $categories)
                                                        <option
                                                            value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="textarea" class="form-label">Seçili Kategoriler</label>
                                                <div id="textareaWrapper"
                                                     style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; min-height: 80px;">
                                                    <!-- Seçili kategoriler buraya otomatik olarak yüklenecek -->
                                                    @if(isset($product->categories))
                                                        @foreach($product->categories as $selectedCategory)
                                                            <div class="category-item"
                                                                 data-id="{{ $selectedCategory->id }}">
                                                                <div
                                                                    class="category-text">{{ $selectedCategory->name }}</div>
                                                                <span class="remove-btn">×</span>
                                                                <input type="hidden" name="category_id[]"
                                                                       value="{{ $selectedCategory->id }}">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="categorySelect" class="form-label">Özellikler</label>
                                                <div id="ozellik-container">
                                                    <!-- JS Dinamik Olarak Sütunları Buraya Ekleyecek -->
                                                </div>
                                                <button type="button" id="addRow"
                                                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                                                    <iconify-icon icon="simple-line-icons:plus"
                                                                  class="text-xl"></iconify-icon>
                                                    Ekle
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="categorySelect" class="form-label">Ekstra Özellikler</label>
                                                <div id="ozellik-containers">
                                                    <!-- JS Dinamik Olarak Sütunları Buraya Ekleyecek -->
                                                </div>
                                                <button type="button" id="addRows"
                                                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                                                    <iconify-icon icon="simple-line-icons:plus"
                                                                  class="text-xl"></iconify-icon>
                                                    Ekle
                                                </button>
                                            </div>
                                        </div>


                                        <div class="form-group d-flex align-items-center justify-content-end gap-8">
                                            <button type="button"
                                                    class="form-wizard-previous-btn btn btn-neutral-500 border-neutral-100 px-32">
                                                Geri
                                            </button>
                                            <button type="button" class="form-wizard-submit btn btn-primary-600 px-32">
                                                Güncelle
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="wizard-fieldset">
                                    <div class="text-center mb-40">
                                        <img src="/backend/assets/images/gif/success-img3.gif" alt=""
                                             class="gif-image mb-24">
                                        <h6 class="text-md text-neutral-600">Tebrikler </h6>
                                        <p class="text-neutral-400 text-sm mb-0">Ürününüz başarıyla güncellendi.</p>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- Form Wizard End -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script src="/backend/assets/js/customize/products.js"></script>
    <script>

        document.getElementById('categorySelect').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const selectedText = selectedOption.text;
            const selectedValue = selectedOption.value;

            if (!selectedValue) return;

            if (document.querySelector(`#textareaWrapper .category-item[data-id="${selectedValue}"]`)) {
                alert('Bu kategori zaten eklendi.');
                return;
            }

            const categoryItem = document.createElement('div');
            categoryItem.className = 'category-item';
            categoryItem.setAttribute('data-id', selectedValue);

            const categoryText = document.createElement('div');
            categoryText.className = 'category-text';
            categoryText.textContent = selectedText;

            const removeBtn = document.createElement('span');
            removeBtn.className = 'remove-btn';
            removeBtn.textContent = '×';

            removeBtn.addEventListener('click', function () {
                categoryItem.remove();

                const hiddenInput = document.querySelector(`#textareaWrapper input[value="${selectedValue}"]`);
                if (hiddenInput) hiddenInput.remove();
            });

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'category_id[]';
            hiddenInput.value = selectedValue;

            categoryItem.appendChild(categoryText);
            categoryItem.appendChild(removeBtn);

            document.getElementById('textareaWrapper').appendChild(categoryItem);
            document.getElementById('textareaWrapper').appendChild(hiddenInput);
        });

        // Daha önce eklenmiş kategoriler için kaldırma butonu olaylarını yeniden tanımla
        document.querySelectorAll('#textareaWrapper .remove-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const categoryItem = this.parentElement;
                const selectedValue = categoryItem.getAttribute('data-id');

                categoryItem.remove();

                const hiddenInput = document.querySelector(`#textareaWrapper input[value="${selectedValue}"]`);
                if (hiddenInput) hiddenInput.remove();
            });
        });

        // =============================== Wizard Step Js Start ================================
        CKEDITOR.replace('editor');

        function generateSlug() {
            const kategoriAdi = document.getElementById('kategoriAdi').value;
            let slug = kategoriAdi.toLowerCase()
                .replace(/ç/g, 'c')
                .replace(/ğ/g, 'g')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ş/g, 's')
                .replace(/ü/g, 'u')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('seoLink').value = slug;
        }

        $(document).ready(function () {
            // click on next button
            $('.form-wizard-next-btn').on("click", function () {
                var parentFieldset = $(this).parents('.wizard-fieldset');
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                var next = $(this);
                var nextWizardStep = true;
                parentFieldset.find('.wizard-required').each(function () {
                    var thisValue = $(this).val();

                    if (thisValue == "") {
                        $(this).siblings(".wizard-form-error").show();
                        nextWizardStep = false;
                    } else {
                        $(this).siblings(".wizard-form-error").hide();
                    }
                });
                if (nextWizardStep) {
                    next.parents('.wizard-fieldset').removeClass("show", "400");
                    currentActiveStep.removeClass('active').addClass('activated').next().addClass('active', "400");
                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
                    $(document).find('.wizard-fieldset').each(function () {
                        if ($(this).hasClass('show')) {
                            var formAtrr = $(this).attr('data-tab-content');
                            $(document).find('.form-wizard-list .form-wizard-step-item').each(function () {
                                if ($(this).attr('data-attr') == formAtrr) {
                                    $(this).addClass('active');
                                    var innerWidth = $(this).innerWidth();
                                    var position = $(this).position();
                                    $(document).find('.form-wizard-step-move').css({
                                        "left": position.left,
                                        "width": innerWidth
                                    });
                                } else {
                                    $(this).removeClass('active');
                                }
                            });
                        }
                    });
                }
            });

            //click on previous button
            $('.form-wizard-previous-btn').on("click", function () {
                var counter = parseInt($(".wizard-counter").text());
                ;
                var prev = $(this);
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                prev.parents('.wizard-fieldset').removeClass("show", "400");
                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
                currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active', "400");
                $(document).find('.wizard-fieldset').each(function () {
                    if ($(this).hasClass('show')) {
                        var formAtrr = $(this).attr('data-tab-content');
                        $(document).find('.form-wizard-list .form-wizard-step-item').each(function () {
                            if ($(this).attr('data-attr') == formAtrr) {
                                $(this).addClass('active');
                                var innerWidth = $(this).innerWidth();
                                var position = $(this).position();
                                $(document).find('.form-wizard-step-move').css({
                                    "left": position.left,
                                    "width": innerWidth
                                });
                            } else {
                                $(this).removeClass('active');
                            }
                        });
                    }
                });
            });
            //click on form submit button
            $(document).on("click", ".form-wizard .form-wizard-submit", function () {
                var parentFieldset = $(this).parents('.wizard-fieldset');
                var currentActiveStep = $(this).parents('.form-wizard').find('.form-wizard-list .active');
                var nextStep = currentActiveStep.next();
                var form = $(this).closest('form');
                var isValid = true;
                parentFieldset.find('.wizard-required').each(function () {
                    var thisValue = $(this).val();
                    if (thisValue == "") {
                        $(this).siblings(".wizard-form-error").show();
                        isValid = false;
                    } else {
                        $(this).siblings(".wizard-form-error").hide();
                    }
                });
                if (isValid) {
                    var formData = new FormData(form[0]);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // AJAX ile formu gönder
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function (response) {
                            if (response.success) {

                                currentActiveStep.removeClass('active');
                                nextStep.addClass('active');

                                parentFieldset.removeClass('show').next('.wizard-fieldset').addClass('show');
                            } else {
                                alert('Bir hata oluştu!');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Hata: " + error);
                            alert('Bir hata oluştu, lütfen tekrar deneyin.');
                        }
                    });
                } else {
                    alert('Lütfen zorunlu alanları doldurun.');
                }
            });
            $(".form-control").on('focus', function () {
                var tmpThis = $(this).val();
                if (tmpThis == '') {
                    $(this).parent().addClass("focus-input");
                } else if (tmpThis != '') {
                    $(this).parent().addClass("focus-input");
                }
            }).on('blur', function () {
                var tmpThis = $(this).val();
                if (tmpThis == '') {
                    $(this).parent().removeClass("focus-input");
                    $(this).siblings(".wizard-form-error").show();
                } else if (tmpThis != '') {
                    $(this).parent().addClass("focus-input");
                    $(this).siblings(".wizard-form-error").hide();
                }
            });
        });
        // =============================== Wizard Step Js End ================================


        (function ($) {
            $(document).ready(function () {
                // Backend'den gelen parsedFeatures verilerini JS'e aktar
                const parsedFeatures = @json($product->parsedFeatures);

                // Mevcut özellikleri döngüyle ekle
                parsedFeatures.forEach(function (featureData) {
                    const newRow = `
                <div class="row">
                    <div class="col-sm-4 mt-2">
                        <select name="feature_id[]" class="form-select">
                            <option disabled>Bir Özellik seçin...</option>
                            @foreach($feature as $features)
                    <option value="{{ $features->id }}"
                                    ${featureData.feature.id == {{ $features->id }} ? 'selected' : ''}>
                                    {{ $features->name }}
                    </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mt-2">
                    <textarea name="feature_description[]" class="form-control">${featureData.content}</textarea>
                    </div>
                    <div class="col-sm-2 mt-2">
                        <button type="button" class="remove-row">
                            <iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
                    $('#ozellik-container').append(newRow);
                });
            });
        })(jQuery);

        (function ($) {
            $(document).ready(function () {
                // Backend'den gelen parsedFeatures verilerini JS'e aktar
                const parsedExtraFeatures = @json($product->parsedExtraFeatures);

                // Mevcut özellikleri döngüyle ekle
                parsedExtraFeatures.forEach(function (extraFeatureData) {
                    const newRows = `
                <div class="row">
                    <div class="col-sm-4 mt-2">
                        <select name="extra_feature_id[]" class="form-select">
                            <option disabled>Bir Özellik seçin...</option>
                            @foreach($extraFeature as $extraFeatures)
                    <option value="{{ $extraFeatures->id }}"
                                    ${extraFeatureData.feature.id == {{ $extraFeatures->id }} ? 'selected' : ''}>
                                    {{ $extraFeatures->name }}
                    </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-sm-4 mt-2">
                    <textarea name="extra_feature_description[]" class="form-control">${extraFeatureData.content}</textarea>
                    </div>
                    <div class="col-sm-2 mt-2">
                    <textarea name="extra_feature_price[]" class="form-control">${extraFeatureData.price}</textarea>
                    </div>
                    <div class="col-sm-2 mt-2">
                        <button type="button" class="remove-row">
                            <iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
                    $('#ozellik-containers').append(newRows);
                });
            });
        })(jQuery);
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
