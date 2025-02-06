@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>{{$category->name ?? 'Kampanyalar'}}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$category->name ?? 'Kampanyalar'}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- shop-area -->
        <div class="shop-area gray-bg pt-100 pb-100">
            <div class="custom-container-two">
                <div class="row justify-content-center">
{{--                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8 order-2 order-lg-0">--}}
{{--                        <aside class="shop-sidebar">--}}
{{--                            <div class="widget shop-widget mb-30">--}}
{{--                                <div class="shop-widget-title">--}}
{{--                                    <h6 class="title">Fiyat Filtreleme</h6>--}}
{{--                                </div>--}}
{{--                                <form action="{{ route('product.filter', $category->slug) }}" method="GET">--}}
{{--                                    <div class="price_filter">--}}
{{--                                        <div id="slider-range"></div>--}}
{{--                                        <div class="price_slider_amount">--}}
{{--                                            <span>Fiyat :</span>--}}
{{--                                            <input type="text" id="amount" readonly />--}}
{{--                                            <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 2500) }}" />--}}
{{--                                            <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 50000) }}" />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-primary">Onayla</button>--}}
{{--                                </form>--}}

{{--                            </div>--}}

{{--                        </aside>--}}
{{--                    </div>--}}

                    <div class="col-xl-12 col-lg-12">
                        <div class="shop-top-meta mb-40">
                            <p class="show-result"> {{ ($products->currentPage() - 1) * $products->perPage() + 1 }} -
                                {{ min($products->currentPage() * $products->perPage(), $products->total()) }} ürün arasında {{ $products->total() }} ürün gösteriliyor</p>
                            <div class="shop-meta-right">
{{--                                <ul>--}}
{{--                                    <li class="active"><a href="#"><i class="flaticon-grid"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="flaticon-list"></i></a></li>--}}
{{--                                </ul>--}}
{{--                                <form action="{{ route('product.filter', $category->slug) }}" method="GET" id="filterForm">--}}
{{--                                    <select class="custom-select" name="sort" id="sortOption">--}}
{{--                                        <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>Ucuzdan Pahalıya</option>--}}
{{--                                        <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>Pahalıdan Ucuza</option>--}}
{{--                                        <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected' : '' }}>Yeni Eklenenler</option>--}}
{{--                                    </select>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4">
                                    <div class="exclusive-item exclusive-item-three text-center mb-50">
                                        <div class="exclusive-item-thumb">
                                            <a href="{{route('product.detail', $product->slug)}}">
                                                <img src="/images/products/{{$product->image}}" alt="">
                                                <img class="overlay-product-thumb"
                                                     src="/images/products/{{$product->image}}" alt="">
                                            </a>
                                            <ul class="action">
                                                <li>
                                                    <a class="add-to-cart"
                                                        data-id="{{ $product->id }}"
                                                        data-name="{{ $product->name }}"
                                                        data-price="{{ $product->campaigns->first() ? $product->campaigns->first()->new_price : $product->price }}"
                                                        data-campaigns="{{ $product->campaigns->first() ? $product->campaigns->first()->id : 0 }}"
                                                        data-image="/images/products/{{$product->image}}">
                                                        <i class="flaticon-supermarket"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="exclusive-item-content">
                                            <h5><a href="{{route('product.detail', $product->slug)}}">{{$product->name}}</a></h5>
                                            <div class="exclusive--item--price">
                                                @if($product->campaigns->first() && $product->campaigns->first()->id)
                                                    <del class="old-price">
                                                        ₺{{ number_format($product->price, 2, ',', '.') }}</del>
                                                    <span
                                                        class="new-price">₺{{ number_format($product->campaigns->first()->new_price, 2, ',', '.') }}</span>
                                                @else
                                                    <span
                                                        class="new-price">₺{{ number_format($product->price, 2, ',', '.') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class="pagination-wrap">
                                    {!! $products->links('frontend.default.pagination') !!}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shop-area-end -->

    </main>

    <script>
        document.getElementById('sortOption').addEventListener('change', function () {
            requestAnimationFrame(function() {
                document.getElementById('filterForm').submit(); // Formu gönder
            });
        });

        $(document).ready(function () {
            // URL'den mevcut fiyat değerlerini al
            let urlParams = new URLSearchParams(window.location.search);
            let minPrice = urlParams.get("price_min") ? parseInt(urlParams.get("price_min")) : 2500;
            let maxPrice = urlParams.get("price_max") ? parseInt(urlParams.get("price_max")) : 50000;

            // jQuery UI Slider'ı başlat ve değerleri ayarla
            $("#slider-range").slider({
                range: true,
                min: 2000,
                max: 150000,
                values: [minPrice, maxPrice],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                    $("#price_min").val(ui.values[0]);
                    $("#price_max").val(ui.values[1]);
                }
            });

            // Seçili fiyat aralığını inputlara yaz
            $("#amount").val(minPrice + " - " + maxPrice);
            $("#price_min").val(minPrice);
            $("#price_max").val(maxPrice);
        });
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
