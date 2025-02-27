@extends('frontend.layout')
@section('content')

    <main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2>Üye Ol</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Üye Ol</li>
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
                        <h2 class="title"><span>Üye</span> Ol</h2>
                    </div>
                    <div class="my-account-bg" data-background="/frontend/img/bg/my_account_bg.png">
                        <div class="my-account-content">
                            <form action="{{route('register.post')}}" method="post" enctype="multipart/form-data" class="login-form">
                                @csrf
                                <div class="form-grp">
                                    <label for="">PROFİL RESMİNİZ</label>
                                    <input name="image" type="file" id="">
                                </div>
                                <div class="form-grp">
                                    <label for="uea">İSİM SOYİSİM <span>*</span></label>
                                    <input name="name" type="text" id="uea">
                                </div>
                                <div class="form-grp">
                                    <label for="uea">TELEFON NUMARANIZ <span>*</span></label>
                                    <input name="phone" type="tel" id="uea">
                                </div>
                                <div class="form-grp">
                                    <label for="uea">MAİL ADRESİNİZ <span>*</span></label>
                                    <input name="email" type="text" id="uea">
                                </div>
                                <div class="form-grp">
                                    <label for="password">ŞİFRE <span>*</span></label>
                                    <input name="password" type="password" id="password">
                                    <i class="far fa-eye"></i>
                                </div>
                                <div class="form-grp">
                                    <label for="password">ŞİFRE TEKRAR<span>*</span></label>
                                    <input name="password1" type="password" id="password">
                                    <i class="far fa-eye"></i>
                                </div>
                                <div class="form-grp-btn">
                                    <a href="#" class="btn"><button style="background-color: transparent;color: white; border: 0px;text-transform: uppercase;" type="submit">Üye Ol</button></a>
                                    <a href="{{route('login.front')}}" class="btn">Giriş Yap</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my-account-area-end -->


</main>


@endsection
@section('css')@endsection
@section('js')@endsection
