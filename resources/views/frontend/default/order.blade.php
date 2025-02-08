@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Siparişlerim</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Siparişlerim</li>
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
                    <div class="col-lg-12">
                        <div class="table-responsive-xl">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Ürün Adı</th>
                                    <th class="product-date">Sipariş Tarihi</th>
                                    <th class="product-status">Ürün Durumu</th>
                                    <th class="product-change">Durum Değiştirme Tarihi</th>
                                    <th class="product-subtotal">FİYAT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @foreach($order->products as $index => $product)
                                        <tr>
                                            <td class="product-thumbnail" style="width: 200px">
                                                <a href="{{ route('product.detail', $product->slug) }}">
                                                    <img width="100%" src="/images/products/{{$product->image}}" alt="">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <h4>
                                                    <a href="{{ route('product.detail', $product->slug) }}">
                                                        {{$product->name}}
                                                    </a>
                                                </h4>
                                            </td>
                                            <td class="product-date">
                                                {{ $order->created_at ? $order->created_at->format('d.m.Y') : 'Henüz İncelemede' }}
                                            </td>
                                            <td class="product-status">
                                                @if($order->status == 1)
                                                    <button class="btn btn-info" style="background-color: #FFC107">Onay
                                                        Bekliyor
                                                    </button>
                                                @elseif($order->status == 2)
                                                    <button class="btn btn-success">Siparişiniz Onaylandı</button>
                                                @elseif($order->status == 3)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #DC3545">Siparişiniz Reddedildi
                                                    </button>
                                                @elseif($order->status == 4)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #FFC107">Kısmen Onaylandı
                                                    </button>
                                                @elseif($order->status == 5)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #FFC107">Limit Açıldı
                                                    </button>
                                                @elseif($order->status == 6)
                                                    <button class="btn btn-success">Sözleşme Hazırlanıyor</button>
                                                @elseif($order->status == 7)
                                                    <button class="btn btn-success">Sözleşme Kargoda</button>
                                                @elseif($order->status == 8)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #FFC107">Ürün Hazırlanıyor
                                                    </button>
                                                @elseif($order->status == 9)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #FFC107">Ürün Kargoda
                                                    </button>
                                                @elseif($order->status == 10)
                                                    <button class="btn btn-warning-300"
                                                            style="background-color: #FFC107">Sözleşme İnceleniyor
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="product-change">
                                                {{ $order->updated_at ? $order->updated_at->format('d.m.Y') : 'Henüz İncelemede' }}
                                            </td>
                                            <td class="product-subtotal">
                                                @php
                                                    $unitPrice = isset($order->campaigns[$product->id]->new_price) ? floatval($order->campaigns[$product->id]->new_price) : floatval($product->price);
                                                    $quantity = isset($order->adet[$index]) ? intval($order->adet[$index]) : 1;
                                                    $totalPrice = $unitPrice * $quantity;
                                                    $extraFeatureTotal = 0;
                                                    $extraFeatureContent = [];
                                                    $extraFeatureNames = [];

                                                    if (!empty($order->extraFId[$index])) {
                                                        $features = explode('||', $order->extraFId[$index]);
                                                        foreach ($features as $feature) {
                                                            if ($feature !== "0") {
                                                                $featureDetails = explode(',', $feature);
                                                                if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                                                                    $extraFeatureTotal += floatval($featureDetails[2]);
                                                                }
                                                                $extraFeatureContent[] = $featureDetails[1] ?? 'Bilinmeyen İçerik';
                                                                $extraFeatureNames[] = \App\Models\ExtraFeatures::find($featureDetails[0])->name ?? 'Bilinmeyen Özellik';
                                                            }
                                                        }
                                                    }

                                                    if ($extraFeatureTotal > 0) {
                                                        $totalPrice += $extraFeatureTotal;
                                                    }
                                                @endphp
                                                <span>
                                                    ₺{{ number_format($totalPrice, 2, ',', '.') }}
                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="shop-cart-bottom mt-20">
                            <div class="row">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-5">
                                    <div class="continue-shopping">
                                        <a href="{{route('product.filter', 'kampanya')}}" class="btn">Alışverişe Devam
                                            Et</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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


    </main>

@endsection
@section('css')@endsection
@section('js')@endsection
