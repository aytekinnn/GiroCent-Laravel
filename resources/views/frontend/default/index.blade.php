@extends('frontend.layout')
@section('content')

    <main>

        <!-- slider-area -->
        <section class="third-slider-area" data-background="img/slider/slider_bg.jpg">
            <div class="custom-container-two">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-active">
                            @foreach($slider as $index => $sliders)
                                @php
                                    $words = explode(' ', trim($sliders->title));
                                    $lastWord = array_pop($words);
                                    $titleWithoutLastWord = implode(' ', $words);
                                    $nextSlider = $slider[$index + 1] ?? $slider[0];
                                @endphp
                                <div class="single-slider slider-bg"
                                     data-background="/images/slider/{{$sliders->image}}">
                                    <div class="slider-content">
                                        <h2 data-animation="fadeInUp" data-delay=".6s">
                                            {{ $titleWithoutLastWord }} <span>{{ $lastWord }}</span>
                                        </h2>
                                        <p data-animation="fadeInUp" data-delay=".9s">{{$sliders->content}}</p>
                                        {{--                                    <a href="#" class="btn yellow-btn" data-animation="fadeInUp" data-delay="1s">Alışveriş YAP</a>--}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- exclusive-collection-area -->
        <section class="exclusive-collection pt-100 pb-55">
            <div class="custom-container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-60">
                            <span class="sub-title">özel koleksiyon</span>
                            <h2 class="title">çok satan ürünler</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($oneProduct as $oneProducts)
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="exclusive-item exclusive-item-three text-center mb-40">
                                <div class="exclusive-item-thumb">
                                    <a href="{{route('product.detail', $oneProducts->slug)}}">
                                        <img src="images/products/{{$oneProducts->image}}" alt="">
                                        <img class="overlay-product-thumb" src="images/products/{{$oneProducts->image}}"
                                             alt="">
                                    </a>
                                    <ul class="action">
                                        <li>
                                            <a class="add-to-cart"
                                                    data-id="{{ $oneProducts->id }}"
                                                    data-name="{{ $oneProducts->name }}"
                                                    data-price="{{ $oneProducts->campaigns->first() ? $oneProducts->campaigns->first()->new_price : $oneProducts->price }}"
                                                    data-image="images/products/{{$oneProducts->image}}">
                                                <i class="flaticon-supermarket"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="exclusive-item-content">
                                    <h5><a href="{{route('product.detail', $oneProducts->slug)}}">{{$oneProducts->name}}</a></h5>
                                    <div class="exclusive--item--price">
                                        @if($oneProducts->campaigns->first() && $oneProducts->campaigns->first()->id)
                                            <del class="old-price">
                                                ₺{{ number_format($oneProducts->price, 2, ',', '.') }}</del>
                                            <span
                                                class="new-price">₺{{ number_format($oneProducts->campaigns->first()->new_price, 2, ',', '.') }}</span>
                                        @else
                                            <span
                                                class="new-price">₺{{ number_format($oneProducts->price, 2, ',', '.') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- exclusive-collection-area-end -->

        <!-- deal-of-the-day -->
        <section class="deal-of-the-day theme-bg pt-100 pb-70">
            <div class="custom-container-two">
                <div class="row">
                    <div class="custom-col-4">
                        <div class="deal-of-day-banner mb-30">
                            <a href="{{route('product.filter', 'kampanya')}}"><img src="images/discount.jpg" width="100%" alt=""></a>
                        </div>
                    </div>
                    <div class="custom-col-8">
                        <div class="deal-day-top">
                            <div class="deal-day-title">
                                <h4 class="title">Kampanyalı Ürünler</h4>
                            </div>
                            <div class="view-all-deal">
                                <a href="{{route('product.filter', 'kampanya')}}"><i class="flaticon-scroll"></i> Tümünü Görüntüle</a>
                            </div>
                        </div>
                        <div class="row deal-day-active">
                            @foreach($validCampaigns as $campaigns)
                                <div class="col-xl-3">
                                    <div class="most-popular-viewed-item mb-30">
                                        <div class="viewed-item-top">
                                            <div class="most--popular--item--thumb mb-20">
                                                <a href="{{route('product.detail', $campaigns->product->slug)}}"><img width="100%"
                                                                                 src="images/products/{{$campaigns->product->image}}"
                                                                                 alt=""></a>
                                            </div>
                                            <div class="super-deal-content">
                                                <h6><a href="{{route('product.detail', $campaigns->product->slug)}}">{{$campaigns->product->name}}</a></h6>
                                                <p>₺ {{ number_format($campaigns->new_price, 2, ',', '.') }}<span>{ {{$campaigns->discount}}% indirim }</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="viewed-item-bottom">
                                            <ul>
                                                <li>Toplam Satış : 5</li>
                                                <li>Stok : {{$campaigns->product->stock}}</li>
                                            </ul>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                     aria-valuenow="25" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <div class="viewed-offer-time">
                                                <p><span>Acele Et</span> Kampanyaları Kaçırma</p>
                                                <div class="coming-time"
                                                     data-countdown="{{ \Carbon\Carbon::parse($campaigns->end_date)->format('Y/n/d') }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- deal-of-the-day-end -->

        <!-- top-cat-banner -->
        <div class="top--cat--banner--area pt-80">
            <div class="custom-container-two">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-6">
                        <div class="top-cat-banner-item yellow mt-20">
                            <a href="#"><img src="images/1.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="top-cat-banner-item dark-gray mt-20">
                                    <a href="#"><img src="images/2.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="top-cat-banner-item lite-red mt-20">
                                    <a href="#"><img src="images/3.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- top-cat-banner-end -->

        <!-- trending-this-week -->
        <section class="trending-this-week-area pt-100 pb-55">
            <div class="custom-container-two">
                <div class="row">
                    <div class="col-12">
                        <div class="deal-day-top">
                            <div class="deal-day-title">
                                <h4 class="title">Son Eklenen Ürünler</h4>
                            </div>
                            <div class="view-all-deal">
                                <a href="#"><i class="flaticon-scroll"></i> Hepsini Görüntüle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($product as $products)
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="exclusive-item exclusive-item-three text-center mb-40">
                                <div class="exclusive-item-thumb">
                                    <a href="{{route('product.detail', $products->slug)}}">
                                        <img src="images/products/{{$products->image}}" alt="">
                                        <img class="overlay-product-thumb" src="images/products/{{$products->image}}"
                                             alt="">
                                    </a>
                                    <ul class="action">
                                        <li>
                                            <a class="add-to-cart"
                                                data-id="{{ $products->id }}"
                                                data-name="{{ $products->name }}"
                                                data-price="{{ $products->campaigns->first() ? $products->campaigns->first()->new_price : $products->price }}"
                                                data-image="images/products/{{$products->image}}">
                                                <i class="flaticon-supermarket"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="exclusive-item-content">
                                    <h5><a href="{{route('product.detail', $products->slug)}}">{{$products->name}}</a></h5>
                                    <div class="exclusive--item--price">
                                        @if($products->campaigns->first() && $products->campaigns->first()->id)
                                            <del class="old-price">
                                                ₺{{ number_format($products->price, 2, ',', '.') }}</del>
                                            <span
                                                class="new-price">₺{{ number_format($products->campaigns->first()->new_price, 2, ',', '.') }}</span>
                                        @else
                                            <span
                                                class="new-price">₺{{ number_format($products->price, 2, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- trending-this-week-end -->

        <!-- bs-cat-area -->
        <section class="bs-cat-area theme-bg pt-100 pb-70">
            <div class="custom-container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-60">
                            <span class="sub-title">özel koleksiyon</span>
                            <h2 class="title">en çok satan kategoriler</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="deal-of-day-banner mb-30">
                            <a href="shop-left-sidebar.html"><img src="images/1.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="row">
                            @foreach($categories as $category)
                                @if($category->subCategories->count() > 0)
                                    <div class="col-sm-6">
                                        <div class="bs-cat-box mb-30">
                                            <div class="bs-cat-thumb">
                                                <a href="{{route('product.filter', $category->slug)}}">
                                                    <img width="60%" src="images/category/{{$category->icon}}" alt="">
                                                </a>
                                            </div>
                                            <div class="bs-cat-list">
                                                <ul>
                                                    <li class="title"><a style="font-size: 15px"
                                                                         href="{{route('product.filter', $category->slug)}}"> {{ $category->name }}</a></li>
                                                    @foreach($category->subCategories->take(4) as $subCategory)
                                                        <li><a href="{{route('product.filter', $subCategory->slug)}}">{{ $subCategory->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <a href="{{route('product.filter', $category->slug)}}" class="view-all">Hepsini Göster</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- bs-cat-area-end -->

        <!-- core-features -->
        <section class="core-features-area core-features-style-two">
            <div class="container">
                <div class="core-features-border">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="frontend/img/icon/core_features01.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Free Shipping On Over $ 50</h6>
                                    <span>Agricultural mean crops livestock</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="frontend/img/icon/core_features02.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Membership Discount</h6>
                                    <span>Only MemberAgricultural livestock</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="frontend/img/icon/core_features03.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Money Return</h6>
                                    <span>30 days money back guarantee</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="frontend/img/icon/core_features04.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Online Support</h6>
                                    <span>30 days money back guarantee</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- core-features-end -->

        <!-- limited-offer-area -->
        <section class="limited-offer-area" data-background="frontend/img/bg/limited_offer_bg.jpg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="limited-offer-left">
                            <div class="limited-offer-title">
                                <span class="sub-title">özel teklif</span>
                                <h2 class="title">{{\Illuminate\Support\Str::limit($kampanya->product->name, 70)}}</h2>
                            </div>
                            <div class="limited-offer-disc">
                                <img src="frontend/img/images/limited_offer_discount.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="limited-offer-action">
                            <a href="#" class="btn">sınırlı süreli teklif</a>
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

@endsection
@section('css')@endsection
@section('js')@endsection
