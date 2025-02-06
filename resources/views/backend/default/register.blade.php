<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girocent Admin Panel</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/png" href="/backend/assets/images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="/backend/assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="/backend/assets/css/lib/bootstrap.min.css">
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

<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="/backend/assets/images/auth/auth-img.png" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="#" class="mb-40 max-w-290-px">
                    <img src="/images/logociro.png" alt="">
                </a>
                <h4 class="mb-12">Lütfen Hesap Oluşturun</h4>
                <p class="mb-32 text-secondary-light text-lg">Giriş yapabilmek için lütfen hesap oluşturunuz</p>
            </div>
            <form action="{{route('register.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="f7:person"></iconify-icon>
                    </span>
                    <input type="file" name="image" class="form-control h-56-px bg-neutral-50 radius-12">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="f7:person"></iconify-icon>
                    </span>
                    <input type="text" name="name" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="İsim Soyisim">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="f7:phone"></iconify-icon>
                    </span>
                    <input type="tel" name="phone" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Telefon Numarası">
                    @error('tel')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-20">
                    <div class="position-relative ">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Şifre">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <span class="mt-12 text-sm text-secondary-light">Şifreniz en az 8 karakter olmalıdır</span>
                </div>
                <div class="mb-20">
                    <div class="position-relative ">
                        <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                            <input type="password" name="password1" class="form-control h-56-px bg-neutral-50 radius-12" required id="your-password1" placeholder="Şifre">
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password1"></span>
                    </div>
                    <span class="mt-12 text-sm text-secondary-light">Lütfen şifrenizi tekrar giriniz.</span>
                    @error('password1')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-start">
                            <input class="form-check-input border border-neutral-300 mt-4" required type="checkbox" value="" id="condition">
                            <label class="form-check-label text-sm" for="condition">
                                <a href="javascript:void(0)" class="text-primary-600 fw-semibold">KVKK Metnini</a> ve
                                <a href="javascript:void(0)" class="text-primary-600 fw-semibold">Gizlilik Politikasını</a> okudum, kabul ediyorum.
                            </label>
                        </div>
                        @error('terms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Üye Ol</button>

                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Hesabınız var mı? <a href="{{route('login')}}" class="text-primary-600 fw-semibold">Giriş Yap</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- jQuery library js -->
<script src="/backend/assets/js/lib/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js -->
<script src="/backend/assets/js/lib/bootstrap.bundle.min.js"></script>
<!-- Apex Chart js -->
<script src="/backend/assets/js/lib/apexcharts.min.js"></script>
<!-- Data Table js -->
<script src="/backend/assets/js/lib/dataTables.min.js"></script>
<!-- Iconify Font js -->
<script src="/backend/assets/js/lib/iconify-icon.min.js"></script>
<!-- jQuery UI js -->
<script src="/backend/assets/js/lib/jquery-ui.min.js"></script>
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
<script src="assets/js/app.js"></script>

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
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
</script>

</body>
</html>

