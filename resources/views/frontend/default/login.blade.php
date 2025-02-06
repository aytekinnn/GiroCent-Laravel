@extends('frontend.layout')
@section('content')

    <main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2>Giriş Yap</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giriş Yap</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- my-account-area -->
    <section class="my-account-area pattern-bg pt-100 pb-100" data-background="/frontend/img/bg/pattern_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="login-page-title">
                        <h2 class="title"><span>Giriş</span> Yap</h2>
                    </div>
                    <div class="my-account-bg" data-background="/frontend/img/bg/my_account_bg.png">
                        <div class="my-account-content">
                            <form action="{{route('Login.Auth')}}" method="post" class="login-form">
                                @csrf
                                <div class="form-grp">
                                    <label for="uea">MAİL ADRESİNİZ <span>*</span></label>
                                    <input name="email" type="text" id="uea">
                                </div>
                                <div class="form-grp">
                                    <label for="password">ŞİFRE <span>*</span></label>
                                    <input name="password" type="password" id="password">
                                    <i class="far fa-eye"></i>
                                </div>
                                <div class="form-grp-bottom">
                                    <div class="remember">
                                        <input name="remember_me" type="checkbox" id="check">
                                        <label for="check">Beni Hatırla</label>
                                    </div>
                                    <div class="forget-pass">
                                        <a href="#">şifremi unuttum</a>
                                    </div>
                                </div>
                                <div class="form-grp-btn">
                                    <a href="#" class="btn"><button style="background-color: transparent;color: white; border: 0px;text-transform: uppercase;" type="submit">Giriş</button></a>
                                    <a href="{{route('register.front')}}" class="btn">Üye Ol</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my-account-area-end -->

    <!-- limited-offer-area -->
    <section class="limited-offer-area" data-background="/frontend/img/bg/limited_offer_bg.jpg">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-5 col-lg-6 col-md-7">
                    <div class="limited-offer-left">
                        <div class="limited-offer-title">
                            <span class="sub-title">exclusive offer</span>
                            <h2 class="title">Smart Watch Bracelet</h2>
                        </div>
                        <div class="limited-offer-disc">
                            <img src="img/images/limited_offer_discount.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="limited-offer-action">
                        <a href="#" class="btn">limited time offer</a>
                        <div class="amount-info">
                            <span class="upto">UPTO</span>
                            <span class="amount">$ 50.00</span>
                            <span class="off">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="limited-overlay-title">Vanam Top Sale 35<span>%</span></h2>
        <div class="limited-overlay-img"><img src="/frontend/img/images/limited_offer_img.png" alt=""></div>
    </section>
    <!-- limited-offer-area-end -->

</main>


@endsection
@section('css')@endsection
@section('js')@endsection
