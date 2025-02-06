<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girocent Admin Panel</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/png" href="/images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="/backend/assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/bootstrap.min.css">
    <script src="/backend/assets/js/lib/jquery-3.7.1.min.js"></script>
    <script src="/backend/assets/js/lib/jquery-ui.min.js"></script>
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="/backend/assets/css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="/backend/assets/css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/prism.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/file-upload.css">

    <link rel="stylesheet" href="/backend/assets/css/lib/audioplayer.css">
    <!-- main css -->
    <link rel="stylesheet" href="/backend/assets/css/style.css">

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
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{route('home.index')}}" class="sidebar-logo">
            <img src="/images/logociro.png" alt="site logo" class="light-logo">
            <img src="/images/logociro.png" alt="site logo" class="dark-logo">
            <img src="/images/logociro.png" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{route('home.index')}}">
                    <iconify-icon icon="mage:home" class="menu-icon"></iconify-icon>
                    <span>Anasayfa</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Girocent</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="hugeicons:tags" class="menu-icon"></iconify-icon>
                    <span>Katalog</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('slider.index')}}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Slider</a>
                    </li>
                    <li>
                        <a href="{{route('category.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Kategoriler</a>
                    </li>
                    <li>
                        <a href="{{route('features.index')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Özellikler</a>
                    </li>
                    <li>
                        <a href="{{route('extra-features.index')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Ekstra Özellikler</a>
                    </li>
                    <li>
                        <a href="{{route('manufacturer.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Üreticiler</a>
                    </li>
                    <li>
                        <a href="{{route('product.index')}}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Ürünler</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Yorumlar</a>
                    </li>
                    <li>
                        <a href="{{route('informations.index')}}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Bilgi Sayfaları</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="hugeicons:user" class="menu-icon"></iconify-icon>
                    <span>Müşteriler</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Müşteriler</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Müşteri Onaylama</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="hugeicons:shopping-cart-check-in-01" class="menu-icon"></iconify-icon>
                    <span>Satışlar</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('campaigns.index')}}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Kampanyalar</a>
                    </li>
                    <li>
                        <a href="{{route('order.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Siparişler</a>
                    </li>
                    <li>
                        <a href="{{route('installment.index')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Taksitler</a>
                    </li>
                    <li>
                        <a href="#"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Hediye Çekleri</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

<main class="dashboard-main">
    <div class="navbar-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <div class="d-flex flex-wrap align-items-center gap-4">
                    <button type="button" class="sidebar-toggle">
                        <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                        <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                    </button>
                    <button type="button" class="sidebar-mobile-toggle">
                        <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                    </button>
                    <form class="navbar-search">
                        <input type="text" name="search" placeholder="Search">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>


                    <div class="dropdown">
                        <button
                            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown">
                            <iconify-icon icon="mage:email" class="text-primary-light text-xl"></iconify-icon>
                        </button>
                        <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                            <div
                                class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Message</h6>
                                </div>
                                <span
                                    class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">01</span>
                            </div>

                            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">

                                <a href="javascript:void(0)"
                                   class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                                    <div
                                        class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <span class="w-40-px h-40-px rounded-circle flex-shrink-0 position-relative">
                                          <img src="/backend/assets/images/notification/profile-3.png" alt="">
                                          <span class="w-8-px h-8-px bg-success-main rounded-circle position-absolute end-0 bottom-0"></span>
                                        </span>
                                        <div>
                                            <h6 class="text-md fw-semibold mb-4">Kathryn Murphy</h6>
                                            <p class="mb-0 text-sm text-secondary-light text-w-100-px">hey! there
                                                i’m...</p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="text-sm text-secondary-light flex-shrink-0">12:30 PM</span>
                                        <span
                                            class="mt-4 text-xs text-base w-16-px h-16-px d-flex justify-content-center align-items-center bg-warning-main rounded-circle">8</span>
                                    </div>
                                </a>

                            </div>
                            <div class="text-center py-12 px-16">
                                <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All
                                    Message</a>
                            </div>
                        </div>
                    </div><!-- Message dropdown end -->

                    <div class="dropdown">
                        <button
                            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown">
                            <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                        </button>
                        <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                            <div
                                class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <h6 class="text-lg text-primary-light fw-semibold mb-0">Bildirimler</h6>
                                </div>
                                <span
                                    class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">01</span>
                            </div>

                            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                                <a href="javascript:void(0)"
                                   class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                                    <div
                                        class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <span
                                            class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                          <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                                        </span>
                                        <div>
                                            <h6 class="text-md fw-semibold mb-4">Congratulations</h6>
                                            <p class="mb-0 text-sm text-secondary-light text-w-200-px">Your profile has
                                                been Verified. Your profile has been Verified</p>
                                        </div>
                                    </div>
                                    <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
                                </a>
                            </div>

                            <div class="text-center py-12 px-16">
                                <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All
                                    Notification</a>
                            </div>

                        </div>
                    </div><!-- Notification dropdown end -->

                    <div class="dropdown">
                        <button class="d-flex justify-content-center align-items-center rounded-circle" type="button"
                                data-bs-toggle="dropdown">
                            <img src="/images/user/{{Auth::user()->image}}" alt="image"
                                 class="w-40-px h-40-px object-fit-cover rounded-circle">
                        </button>
                        <div class="dropdown-menu to-top dropdown-menu-sm">
                            <div
                                class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <h6 class="text-lg text-primary-light fw-semibold mb-2">{{Auth::user()->name}}</h6>
                                    <span class="text-secondary-light fw-medium text-sm">@if(Auth::user()->role_id == 1) Admin @else Kullanıcı @endif</span>
                                </div>
                                <button type="button" class="hover-text-danger">
                                    <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                                </button>
                            </div>
                            <ul class="to-top-list">
                                <li>
                                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                       href="javascript:void(0)">
                                        <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>
                                        Profil Ayarları</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3"
                                       href="{{route('logout')}}">
                                        <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>
                                        Çıkış Yap</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- Profile dropdown end -->
                </div>
            </div>
        </div>
    </div>


@yield('content')


    <footer class="d-footer">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <p class="mb-0">© 2024 TECH. All Rights Reserved.</p>
            </div>
            <div class="col-auto">
                <p class="mb-0">Made by <span class="text-primary-600">wowtheme7</span></p>
            </div>
        </div>
    </footer>
</main>
<!-- Bootstrap js -->
<script src="/backend/assets/js/lib/bootstrap.bundle.min.js"></script>
<!-- Apex Chart js -->
<script src="/backend/assets/js/lib/apexcharts.min.js"></script>
<!-- Data Table js -->
<script src="/backend/assets/js/lib/dataTables.min.js"></script>
<!-- Iconify Font js -->
<script src="/backend/assets/js/lib/iconify-icon.min.js"></script>
<!-- jQuery UI js -->

<!-- Vector Map js -->
<script src="/backend/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
<script src="/backend/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
<!-- Popup js -->
<script src="/backend/assets/js/lib/magnifc-popup.min.js"></script>
<!-- Slick Slider js -->
<script src="/backend/assets/js/lib/slick.min.js"></script>
<!-- prism js -->
<script src="/backend/assets/js/lib/prism.js"></script>
<!-- file upload js -->
<script src="/backend/assets/js/lib/file-upload.js"></script>
<!-- audioplayer -->
<script src="/backend/assets/js/lib/audioplayer.js"></script>

<!-- main js -->
<script src="/backend/assets/js/app.js"></script>

<script src="/backend/assets/js/homeThreeChart.js"></script>

@if(session()->has('success'))
    <script>alertify.success('{{session('success')}}')</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{session('error')}}')</script>
@endif
@foreach($errors->all() as $error)
    <script>alertify.error('{{$error}}')</script>
@endforeach
<script>
    let table = new DataTable('#dataTable');
</script>
</body>
</html>
