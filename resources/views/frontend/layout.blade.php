<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Girocent</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/css/animate.min.css">
    <link rel="stylesheet" href="/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="/frontend/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/frontend/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/frontend/css/flaticon.css">
    <link rel="stylesheet" href="/frontend/css/odometer.css">
    <link rel="stylesheet" href="/frontend/css/aos.css">
    <link rel="stylesheet" href="/frontend/css/slick.css">
    <link rel="stylesheet" href="/frontend/css/default.css">
    <link rel="stylesheet" href="/frontend/css/style.css">
    <link rel="stylesheet" href="/frontend/css/responsive.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- jQuery (Toastr için gerekli) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
<body>

<style>
    .cart-contents {
        max-height: 300px; /* Bu değeri sepetin boyutuna göre ayarlayabilirsiniz */
        overflow-y: auto;
    }
    #searchResults {
        max-height: 400px; /* İstediğiniz yüksekliği ayarlayın */
        overflow-y: auto; /* Yalnızca dikey kaydırma */
        position: absolute; /* Arama sonuçlarının sabit bir alanda olmasını sağlar */
        z-index: 10; /* Diğer içeriklerin üstünde görünmesini sağlar */
        background-color: white; /* Sonuçların arka plan rengini belirleyin */
        width: 100%; /* Arama kutusunun genişliği ile aynı */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hafif gölge efekti */
        border-radius: 15px; /* Köşe yuvarlama */
    }
    .product-item {
        display: flex;
        align-items: center;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .product-item:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-item img {
        width: 150px; /* Resmin genişliği */
        height: 150px; /* Resmin yüksekliği */
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
    }

    .product-info {
        flex: 1;
    }

    .product-info h4 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .product-info .price {
        font-size: 16px;
        color: #e74c3c;
        font-weight: 600;
    }
</style>


<!-- preloader  -->
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                        <span data-text-preloader="G" class="letters-loading">
                            G
                        </span>
                <span data-text-preloader="İ" class="letters-loading">
                            İ
                        </span>
                <span data-text-preloader="R" class="letters-loading">
                            R
                        </span>
                <span data-text-preloader="O" class="letters-loading">
                            O
                        </span>
                <span data-text-preloader="C" class="letters-loading">
                            C
                        </span>
                <span data-text-preloader="E" class="letters-loading">
                            E
                        </span>
                <span data-text-preloader="N" class="letters-loading">
                            N
                        </span>
                <span data-text-preloader="T" class="letters-loading">
                            T
                        </span>
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- preloader end -->


<!-- Scroll-top -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
</button>
<!-- Scroll-top-end-->

<!-- header-area -->
<header class="header-style-two header-style-three">

    <!-- header-top -->
    <div class="header-top-area">
        <div class="custom-container-two">
            <div class="row">
                <div class="col-md-10 col-sm-10">
                    <div class="header-top-left">
                        <ul>
                            <li>
                                <div class="heder-top-guide">
                                    <span>Hızlı Rehber</span>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            Yardım
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            @foreach($information as $informations)
                                                <a class="dropdown-item"
                                                   href="{{ route('document.detail', $informations->id) }}">{{$informations->title}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="header-top-left">
                        <ul>
                            @if(Auth::user())
                                <li>
                                    <div class="heder-top-guide">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon-user"></i> {{Auth::user()->name}}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" href="terms-conditios.html">Hesap Ayarları</a>
                                                <a class="dropdown-item" href="{{route('orders.index')}}">Siparişlerim</a>
                                                <a class="dropdown-item" href="{{route('installment.indexs')}}">Taksit Ödeme</a>
                                                <a class="dropdown-item" href="{{route('logout.front')}}">Çıkış Yap</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li>
                                    <a style="color: #656565" href="{{route('register.front')}}"><i
                                            class="flaticon-user"></i>Üye Ol</a>
                                    <span>or</span>
                                    <a style="color: #656565" href="{{route('login.front')}}">Giriş Yap</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-end -->

    <!-- menu-area -->
    <div id="sticky-header" class="main-header menu-area">
        <div class="custom-container-two">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo">
                                <a href="{{route('home.frontend.index')}}"><img src="/images/logociro.png" alt="Logo"></a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="active"><a href="{{route('home.frontend.index')}}">Ana Sayfa</a>
                                    </li>
                                    <li><a href="{{route('hakkimizda.index')}}">Hakkımızda</a></li>
                                    <li><a href="{{route('iletisim.index')}}">İletişim</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    @php
                                        use Illuminate\Support\Facades\Auth;
                                        use App\Models\Carts;

                                        $cart = Auth::check() ? Carts::where('user_id', Auth::id())->get() : collect(session()->get('cart', []));
                                        $total = $cart->sum(fn($item) => $item['price'] * $item['quantity']);
                                    @endphp
                                    <li class="header-shop-cart">
                                        <a href="#">
                                            <i class="flaticon-shopping-bag"></i>
                                            <span class="cart-count">{{ $cart->count() }}</span>
                                        </a>
                                        <span class="cart-total-price">₺{{ number_format($total, 2, ',', '.') }}</span>

                                        <ul class="minicart">
                                            @if ($cart->count() > 0)
                                                <div class="cart-contents">
                                                    @foreach ($cart as $item)
                                                        <li class="d-flex align-items-start">

                                                            <div class="cart-img">
                                                                <a href="#"><img src="{{ $item['image'] }}" alt=""></a>
                                                            </div>
                                                            <div class="cart-content">
                                                                <h4><a href="#">{{ $item['name'] }}</a></h4>
                                                                <div class="cart-price">
                                                                    <span
                                                                        class="new">₺{{ number_format($item['price'], 2, ',', '.') }}</span>
                                                                    <span
                                                                        class="quantity"> x{{ $item['quantity'] }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="del-icon">
                                                                <a href="#" class="remove-from-cart"
                                                                   data-id="{{ Auth::check() ? $item['product_id'] : $loop->index }}">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </div>
                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">Toplam:</span>
                                                        <span
                                                            class="f-right">₺{{ number_format($total, 2, ',', '.') }}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <a href="{{ route('cart.index') }}">Sepeti Görüntüle</a>
                                                        <a class="red-color" href="{{route('checkout.index')}}">Onaya Gönder</a>
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <p class="text-center">Sepetiniz boş.</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>
                        <div class="close-btn"><i class="fas fa-times"></i></div>

                        <nav class="menu-box">
                            <div class="nav-logo"><a href="{{route('home.frontend.index')}}"><img
                                        src="/images/logociro.png" alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- menu-area-end -->

    <!-- header-search-area -->
    <div class="header-search-area d-none d-md-block">
        <div class="custom-container-two">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="header-category d-none d-lg-block">
                        <a href="#" class="cat-toggle"><i class="flaticon-menu"></i>Kategoriler</a>
                        <!-- category/index.blade.php -->
                        <ul class="category-menu">
                            @foreach ($categories as $category)
                                <li class="has-dropdown">
                                    <a href="{{route('product.filter', $category->slug)}}">
                                        <div class="cat-menu-img" style="width: 15%">
                                            <img src="/images/category/{{$category->icon}}" width="100%" alt="">
                                        </div>
                                        {{ $category->name }}
                                    </a>
                                    @if ($category->subCategories->isNotEmpty())
                                        <ul class="mega-menu">
                                            @foreach ($category->subCategories->chunk(5) as $subCategoryChunk)
                                                <li>
                                                    @foreach ($subCategoryChunk as $subCategory)
                                                        <ul>
                                                            <li><a href="{{route('product.filter', $subCategory->slug)}}">{{ $subCategory->name }}</a></li>
                                                        </ul>
                                                    @endforeach
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <div class="header-search-wrap">
                            <form action="#" id="searchForm">
                                <input type="text" id="searchQuery" placeholder="Aramak istediğiniz ürünün adını yazınız.....">
                                <button type="submit"><i class="flaticon-magnifying-glass-1"></i></button>
                            </form>

                            <div id="searchResults"></div>

                        </div>
                        <div class="header-free-shopping">
                            <p>Taksitli Satış Sitesi</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- header-search-area-end -->
 <!-- pupuler kategoriler -->
  <div class="populer">
    <div class="col-xl-12 col-lg-12">
                    <div class="navbar-wrap">
                        <span style="padding-top:30px;!important">Populer kategoriler: </span>
                        <ul class="navigation" style="margin-left: 0px;!important">
                            @foreach ($cat as $popular)
                                <li><a style="font-size:14px;!important" href="{{route('product.filter', $popular->slug)}}">{{$popular->name}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                </div>

</header>
<!-- header-area-end -->


@yield('content')





<!-- footer-area -->
<footer class="footer-area footer-style-two">
    <div class="footer-top pt-65 pb-25">
        <div class="custom-container-two">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="footer-logo mb-30">
                            <a href="{{route('home.frontend.index')}}"><img src="/images/logociro.png" alt=""></a>
                        </div>
                        <div class="footer-text mb-35">
                            <h5 class="call-us">Sorunuz mu Var? Hemen arayın 24/7</h5>
                            <h6 class="number">458-965-3224</h6>
                            <p>W898 RTower Stat, Suite 56 Brockland, CA 9622 United States</p>
                            <a href="#" class="btn"><i class="fas fa-map-marker-alt"></i>haritada görüntüle</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Özel Servisler</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                @foreach($information as $informations)
                                    <li>
                                        <a href="{{ route('document.detail', $informations->id) }}">{{$informations->title}}</a>
                                    </li>
                                @endforeach
                                <li><a href="#">İletişim</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Hesabım</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                <li><a href="#">Hesap Ayarları</a></li>
                                <li><a href="#">Siparişlerim</a></li>
                                <li><a href="#">Taksitlerim</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap copyright-style-two">
        <div class="custom-container-two">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text">
                        <p>Kopyalanamaz © 2025 <a href="#">UMD Reklam</a> Tüm Hakları Gizlidir.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="payment-method-img text-right">
                        <img src="/frontend/img/images/card_img.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->

<script>
    $(document).ready(function() {
        $('#searchQuery').on('keyup', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: '{{ route("product.search") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        let results = response.products;
                        let html = '';

                        results.forEach(function(product) {
                            if (product.old_price) {
                                html += `<div class="product-item">
                                <a href="{{ url('product/detay') }}/${product.slug}"><img src="/images/products/${product.image}" alt="${product.name}"></a>
                                <div class="product-info">
                                    <h4><a href="{{ url('product/detay') }}/${product.slug}">${product.name}</a></h4>
                                    <p class="price">
                                        <del class="old-price">${product.old_price} TL</del><br>
                                        <span class="new-price">${product.new_price} TL</span>
                                    </p>
                                </div>
                              </div>`;
                            } else {
                                html += `<div class="product-item">
                                <a href="{{ url('product/detay') }}/${product.slug}"><img src="/images/products/${product.image}" alt="${product.name}"></a>
                                <div class="product-info">
                                    <h4><a href="{{ url('product/detay') }}/${product.slug}">${product.name}</a></h4>
                                    <p class="price">${product.new_price} TL</p>
                                </div>
                              </div>`;
                            }
                        });
                        $('#searchResults').html(html);
                    }
                });
            } else {
                $('#searchResults').html('');
            }
        });


        $(document).click(function(e) {
            if (!$(e.target).closest('#searchQuery, #searchResults').length) {
                $('#searchResults').html('');
            }
        });
    });


</script>
<!-- JS here -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="/frontend/js/popper.min.js"></script>
<script src="/frontend/js/bootstrap.min.js"></script>
<script src="/frontend/js/isotope.pkgd.min.js"></script>
<script src="/frontend/js/imagesloaded.pkgd.min.js"></script>
<script src="/frontend/js/jquery.magnific-popup.min.js"></script>
<script src="/frontend/js/owl.carousel.min.js"></script>
<script src="/frontend/js/jquery.odometer.min.js"></script>
<script src="/frontend/js/jquery.countdown.min.js"></script>
<script src="/frontend/js/jquery.appear.js"></script>
<script src="/frontend/js/slick.min.js"></script>
<script src="/frontend/js/ajax-form.js"></script>
<script src="/frontend/js/wow.min.js"></script>
<script src="/frontend/js/aos.js"></script>
<script src="/frontend/js/plugins.js"></script>
<script src="/frontend/js/main.js"></script>
@if(session()->has('success'))
    <script>alertify.success('{{ session('success') }}');</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{ session('error') }}');</script>
@endif
@if(session()->has('info'))
    <script>alertify.info('{{ session('info') }}');</script>
@endif
@foreach($errors->all() as $error)
    <script>alertify.error('{{$error}}')</script>
@endforeach
</body>
</html>
