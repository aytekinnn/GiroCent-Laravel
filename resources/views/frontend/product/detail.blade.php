@extends('frontend.layout')
@section('content')
    <style>
        .data-price.selected {
            box-shadow: 0px 0px 10px #FE6001;
            background-color: #FE6001;
            color: white;
            border-radius: 5px;
        }

    </style>
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>{{$product->name}}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- shop-details-area -->
        <section class="shop-details-area pt-100 pb-100">
            <div class="container">
                <div class="row mb-95">
                    <div class="col-xl-7 col-lg-6">
                        <div class="shop-details-nav-wrap">
                            <div class="shop-details-nav">
                                @foreach($galeri as $gallery)
                                    <div class="shop-nav-item">
                                        <img src="/images/gallery/{{$gallery->galeri_yol}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="shop-details-img-wrap">
                            <div class="shop-details-active">
                                @foreach($galeri as $gallery)
                                    <div class="shop-nav-item">
                                        <img width="100%" src="/images/gallery/{{$gallery->galeri_yol}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="shop-details-content">
                           <span class="stock-info">
                                @if($product->stock == 0)
                                   @switch($product->stok_dis_durum)
                                       @case(0)
                                           0-2 Gün İçinde Stok Aktif
                                           @break
                                       @case(1)
                                           Ön Sipariş
                                           @break
                                       @case(3)
                                           Stokta Bulunmuyor
                                           @break
                                       @default
                                           Stokta Var
                                   @endswitch
                               @else
                                   Stokta Var
                               @endif
                            </span>

                            <h2>{{$product->name}}</h2>
{{--                            <div class="shop-details-review">--}}
{{--                                <div class="rating">--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                </div>--}}
{{--                                <span>- 3 Customer Reviews</span>--}}
{{--                            </div>--}}

                            <div class="shop-details-price">
                                <h2 id="product_price">
                                    ₺{{ number_format($product->campaigns->first() ? $product->campaigns->first()->new_price : $product->price, 2, ',', '.') }}
                                    @if($product->campaigns->first() && $product->campaigns->first()->id)
                                        <del>₺{{ number_format($product->price, 2, ',', '.') }}</del>
                                    @endif
                                </h2>
                            </div>

                            <p>{{$product->description}}</p>

                            @if($product->groupedExtraFeatures && count($product->groupedExtraFeatures) > 0)
                                <div class="product-details-size mb-40">
                                    <ul>
                                        @foreach($product->groupedExtraFeatures as $featureId => $extraFeatureGroup)
                                            @if($extraFeatureGroup->isNotEmpty())
                                                <li class="feature-group">
                                                    <strong>{{ optional($extraFeatureGroup->first()['feature'])->name }}</strong>
                                                    <ul>
                                                        @foreach($extraFeatureGroup as $extraFeature)
                                                            <li>
                                                                <a class="data-price" data-id="{{$extraFeature['id']}}" data-price="{{ $extraFeature['price'] ?? 0 }}" href="#">
                                                                    {{ $extraFeature['content'] ?? 'Bilinmeyen İçerik' }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif




                            <div class="perched-info">
                                <a href="#" class="btn add-card-btn add-to-cart"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-price="{{ $product->campaigns->first() ? $product->campaigns->first()->new_price : $product->price }}"
                                   data-extra_feature_id=""
                                   data-image="/images/products/{{$product->image}}">SEPETE EKLE</a>
                            </div>
                            <div class="shop-details-bottom">
                                <h5><a href="#"><i class="far fa-heart"></i> Favorilere Ekle</a></h5>
                                <ul>
                                    <li>
                                        <span>KATEGORİLER :</span>
                                        @foreach($product->categories as $category)
                                            <a href="{{route('product.filter', $category->slug)}}">{{ $category->name }},</a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-desc-wrap mb-100">
                            <ul class="nav nav-tabs mb-25" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details"
                                       role="tab" aria-controls="details"
                                       aria-selected="true">Ürün Detay</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="details" role="tabpanel"
                                     aria-labelledby="details-tab">
                                    <div class="product-desc-content">
                                        <h4 class="title">Ürün Detay</h4>
                                        <div class="row">
                                            <div class="col-xl-3 col-md-4">
                                                <div class="product-desc-img">
                                                    <img src="/images/products/{{$product->image}}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-md-8">
                                                <h5 class="small-title">{{$product->name}}</h5>
                                                <p>{{$product->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-details-add mb-95">
                            <a href="#"><img src="/frontend/img/product/shop_details_add.jpg" alt=""></a>
                        </div>
                        <div class="related-product-wrap pb-95">
                            <div class="deal-day-top">
                                <div class="deal-day-title">
                                    <h4 class="title">Benzer Ürünler</h4>
                                </div>
                                <div class="related-slider-nav">
                                    <div class="slider-nav"></div>
                                </div>
                            </div>
                            <div class="row related-product-active">
                                @foreach($similarProducts as $similarProduct)
                                    <div class="col-xl-3">
                                        <div class="exclusive-item exclusive-item-three text-center">
                                            <div class="exclusive-item-thumb">
                                                <a href="{{ route('product.detail', $similarProduct->slug) }}">
                                                    <img src="/images/products/{{$similarProduct->image}}" alt="">
                                                    <img class="overlay-product-thumb" src="/images/products/{{$similarProduct->image}}" alt="">
                                                </a>
                                                <ul class="action">
                                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="exclusive-item-content">
                                                <h5><a href="{{ route('product.detail', $similarProduct->slug) }}">{{ $similarProduct->name }}</a></h5>
                                                <div class="exclusive--item--price">
                                                    @if($similarProduct->campaigns->first() && $similarProduct->campaigns->first()->id)
                                                        <del class="old-price">
                                                            ₺{{ number_format($similarProduct->price, 2, ',', '.') }}</del>
                                                        <span class="new-price">₺{{ number_format($similarProduct->campaigns->first()->new_price, 2, ',', '.') }}</span>
                                                    @else
                                                        <span class="new-price">₺{{ number_format($similarProduct->price, 2, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
{{--                        <div class="product-reviews-wrap">--}}
{{--                            <div class="deal-day-top">--}}
{{--                                <div class="deal-day-title">--}}
{{--                                    <h4 class="title">Product Reviews</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="reviews-count-title">--}}
{{--                                <h5 class="title">3 review for Pouch Pocket Jacket</h5>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="product-review-list blog-comment">--}}
{{--                                        <ul>--}}
{{--                                            <li>--}}
{{--                                                <div class="single-comment">--}}
{{--                                                    <div class="comment-avatar-img">--}}
{{--                                                        <img src="img/product/review_author_thumb01.jpg" alt="img">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div class="comment-avatar-info">--}}
{{--                                                            <h5>Emaliy Watson <span class="comment-date"> - November 13, 2020</span>--}}
{{--                                                            </h5>--}}
{{--                                                            <div class="rating">--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but--}}
{{--                                                            also the leap into electronic typesetting, remaining.</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <div class="single-comment">--}}
{{--                                                    <div class="comment-avatar-img">--}}
{{--                                                        <img src="img/product/review_author_thumb02.jpg" alt="img">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div class="comment-avatar-info">--}}
{{--                                                            <h5>Tomas Alexzender <span class="comment-date"> - November 13, 2020</span>--}}
{{--                                                            </h5>--}}
{{--                                                            <div class="rating">--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but--}}
{{--                                                            also the leap into electronic typesetting, remaining.</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <div class="single-comment">--}}
{{--                                                    <div class="comment-avatar-img">--}}
{{--                                                        <img src="img/product/review_author_thumb03.jpg" alt="img">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div class="comment-avatar-info">--}}
{{--                                                            <h5>Rana Watson <span class="comment-date"> - November 13, 2020</span>--}}
{{--                                                            </h5>--}}
{{--                                                            <div class="rating">--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but--}}
{{--                                                            also the leap into electronic typesetting, remaining.</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <div class="single-comment">--}}
{{--                                                    <div class="comment-avatar-img">--}}
{{--                                                        <img src="img/product/review_author_thumb04.jpg" alt="img">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div class="comment-avatar-info">--}}
{{--                                                            <h5>Emaliy Watson <span class="comment-date"> - November 13, 2020</span>--}}
{{--                                                            </h5>--}}
{{--                                                            <div class="rating">--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                                <i class="fas fa-star"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but--}}
{{--                                                            also the leap into electronic typesetting, remaining.</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="product-review-form">--}}
{{--                                        <p>Your email address will not be published. Required fields are marked *</p>--}}
{{--                                        <div class="rising-star mb-40">--}}
{{--                                            <h5>Your Rating</h5>--}}
{{--                                            <div class="rising-rating"></div>--}}
{{--                                        </div>--}}
{{--                                        <form action="#">--}}
{{--                                            <div class="form-grp">--}}
{{--                                                <label for="message">YOUR REVIEW *</label>--}}
{{--                                                <textarea name="message" id="message"></textarea>--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <div class="form-grp">--}}
{{--                                                        <label for="uea">YOUR NAME *</label>--}}
{{--                                                        <input type="text" id="uea">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <div class="form-grp">--}}
{{--                                                        <label for="email">YOUR Email *</label>--}}
{{--                                                        <input type="email" id="email">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <button class="btn">SUBMIT</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-details-area-end -->

        <!-- limited-offer-area -->
        <section class="limited-offer-area" data-background="/frontend/img/bg/limited_offer_bg.jpg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="limited-offer-left">
                            <div class="limited-offer-title">
                                <span class="sub-title">özel teklif</span>
                                <h2 class="title">{{\Illuminate\Support\Str::limit($kampanya->product->name, 70)}}</h2>
                            </div>
                            <div class="limited-offer-disc">
                                <img src="/frontend/img/images/limited_offer_discount.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="limited-offer-action">
                            <a href="{{route('product.detail', $kampanya->product->slug)}}" class="btn">sınırlı süreli teklif</a>
                            <div class="amount-info">
                                <span class="amount">₺{{ number_format($kampanya->new_price, 2, ',', '.') }}</span>
                                <span class="off">İNDİRİM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="limited-overlay-title">{{$kampanya->name . ' ' . $kampanya->discount}}<span>%</span></h2>
        </section>
        <!-- limited-offer-area-end -->


    </main>

    <script>
        $(document).ready(function () {
            let basePrice = parseFloat("{{ $product->campaigns->first() ? $product->campaigns->first()->new_price : $product->price }}".replace(',', '.'));
            let updatedPrice = basePrice; // Güncellenmiş fiyatı saklayacak değişken
            let extraFeatures = []; // Extra özellikler dizisi

            console.log("Başlangıç fiyatı:", basePrice);

            $(".data-price").click(function (e) {
                e.preventDefault(); // Sayfa yenilenmesini önle

                let selectedPrice = parseFloat($(this).attr("data-price"));
                let selectedId = $(this).attr("data-id");
                let selectedContent = $(this).text().trim();
                let featureGroup = $(this).closest('.feature-group'); // Grup elemanını bul

                console.log("Seçilen fiyat:", selectedPrice);

                // Grup içerisinde bir seçim yapılmış mı kontrol et
                if (featureGroup.find('.selected').length > 0 && !$(this).hasClass("selected")) {
                    toastr.error("Bu gruptan yalnızca bir seçim yapabilirsiniz!");
                    return; // Eğer grup içinde başka bir seçim varsa, yeni seçim yapılmasın
                }

                if ($(this).hasClass("selected")) {
                    updatedPrice -= selectedPrice;
                    $(this).removeClass("selected");
                    // Seçilen özellik kaldırılacak, diziden çıkar
                    extraFeatures = extraFeatures.filter(feature => feature.id !== selectedId);
                    console.log("Özellik kaldırıldı, yeni fiyat:", updatedPrice);
                } else {
                    updatedPrice += selectedPrice;
                    $(this).addClass("selected");
                    // Yeni özellik dizisine ekle
                    extraFeatures.push({
                        id: selectedId,
                        content: selectedContent,
                        price: selectedPrice
                    });
                    console.log("Özellik eklendi, yeni fiyat:", updatedPrice);
                }

                // Güncellenmiş fiyatı formatlayıp yazdır
                $("#product_price").html("₺" + updatedPrice.toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                // Sepete ekle butonunun data-price ve data-extra-feature_id özelliğini güncelle
                $(".add-to-cart").attr("data-price", updatedPrice);

                // Extra özellikleri formatla ve butona ekle
                let formattedExtraFeatures = extraFeatures.map(feature => `${feature.id},${feature.content},${feature.price}`).join("||");
                $(".add-to-cart").attr("data-extra_feature_id", formattedExtraFeatures);
            });
        });


    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
