@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Sepetim</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sepetim</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- shop-cart-area -->
        <section class="shop-cart-area wishlist-area pt-100 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="table-responsive-xl">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Ürün Adı</th>
                                    <th class="product-price">Fiyat</th>
                                    <th class="product-quantity">ADET</th>
                                    <th class="product-subtotal">İNDİRİMLİ FİYAT</th>
                                    <th class="product-extra">Ekstra Özellikler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $carts)
                                    <tr>
                                        <td class="product-thumbnail" style="width: 200px">
                                            <a href="#" class="wishlist-remove remove-from-cart" data-id="{{$carts['product_id']}}">
                                                <i class="flaticon-cancel-1"></i>
                                            </a>
                                            <a href="{{ route('product.detail', $carts->product->slug) }}"><img width="100%" src="/images/products/{{$carts->product->image}}" alt=""></a>
                                        </td>
                                        <td class="product-name">
                                            <h4><a href="{{ route('product.detail', $carts->product->slug) }}">{{$carts->product->name}}</a></h4>
                                        </td>
                                        <td class="product-price">₺{{ number_format($carts->product->price, 2, ',', '.') }}</td>
                                        <td class="product-quantity">
                                            <div class="cart-plus">
                                                <form>
                                                    <p class="align-items-center">{{$carts->quantity}} </p>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                        <span>
                                            ₺{{ number_format($carts->product->campaigns->first()->new_price ?? $carts->product->price, 2, ',', '.') }}
                                        </span>
                                        </td>


                                        <td class="product-extra">
                                            @php
                                                $extraFeatureTotal = 0;
                                                $extraFeatureContent = [];
                                                $extraFeatureNames = [];

                                                if (!empty($carts->extra_features_id)) {
                                                    $features = explode('||', $carts->extra_features_id);

                                                    foreach ($features as $feature) {
                                                        $featureDetails = explode(',', $feature);

                                                        // Fiyat kontrolü yap ve sayıya çevir
                                                        if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                                                            $extraFeatureTotal += floatval($featureDetails[2]);
                                                        }

                                                        // İçerik ekle
                                                        $extraFeatureContent[] = $featureDetails[1] ?? 'Bilinmeyen İçerik';

                                                        // Extra Feature ID'den ismi çek
                                                        if (!empty($featureDetails[0]) && is_numeric($featureDetails[0])) {
                                                            $extraFeatureId = $featureDetails[0];
                                                            $extraFeature = \App\Models\ExtraFeatures::find($extraFeatureId);
                                                            if ($extraFeature) {
                                                                $extraFeatureNames[] = $extraFeature->name;
                                                            } else {
                                                                $extraFeatureNames[] = 'Bilinmeyen Özellik';
                                                            }
                                                        } else {
                                                            $extraFeatureNames[] = 'Bilinmeyen Özellik';
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <strong>₺{{ number_format($extraFeatureTotal, 2, ',', '.') }}</strong><br>

                                            <small>
                                                @foreach($extraFeatureContent as $index => $content)
                                                    {{ $content }}
                                                    @if(isset($extraFeatureNames[$index]))
                                                        ({{ $extraFeatureNames[$index] }})
                                                    @endif
                                                    @if($index < count($extraFeatureContent) - 1)
                                                        , <br>
                                                    @endif
                                                @endforeach
                                            </small>
                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="shop-cart-bottom mt-20">
                            <div class="row">
                                <div class="col-md-7">
{{--                                    <div class="cart-coupon">--}}
{{--                                        <form action="#">--}}
{{--                                            <input type="text" placeholder="Enter Coupon Code...">--}}
{{--                                            <button class="btn">Apply Coupon</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-md-5">
                                    <div class="continue-shopping">
                                        <a href="{{route('product.filter', 'kampanya')}}" class="btn">Alışverişe Devam Et</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <aside class="shop-cart-sidebar">
                            <div class="shop-cart-widget">
                                <h6 class="title">Sepet Toplam</h6>
                                <form action="#">
                                    <ul>
                                        <li><span>ARA TOPLAM</span> ₺ {{number_format($totalPrice, 2, ',', '.')}}</li>
                                        <li><span>İNDİRİMLİ TUTARI</span> ₺ {{number_format($totalDiscount, 2, ',', '.')}}</li>
                                        <li><span>EKSTRALAR</span> ₺ {{number_format($extraFeaturePrice, 2, ',', '.')}}</li>

                                        <li class="cart-total-amount"><span>TOPLAM FİYAT</span> <span class="amount"> ₺ {{number_format($toplamFiyat, 2, ',', '.')}}</span></li>
                                    </ul>
                                    <button class="btn"><a href="/checkout" style="color: white">Onaya Gönder</a></button>
                                </form>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-cart-area-end -->

        <!-- core-features -->
        <section class="core-features-area core-features-style-two">
            <div class="container">
                <div class="core-features-border">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="img/icon/core_features01.png" alt="">
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
                                    <img src="img/icon/core_features02.png" alt="">
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
                                    <img src="img/icon/core_features03.png" alt="">
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
                                    <img src="img/icon/core_features04.png" alt="">
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
