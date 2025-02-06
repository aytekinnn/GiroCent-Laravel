@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Sipariş Onaya Gönderildi</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sipariş Onaya Gönderildi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="order-complete-area pattern-bg pt-100 pb-100" data-background="/frontend/img/bg/pattern_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="order-complete-bg" data-background="/frontend/img/bg/order_comp_bg.png">
                            <div class="order-complete-content">
                                <h3><span>Siparişiniz</span> Başarıyla Oluşturuldu!</h3>
                                <div class="check mb-25">
                                    <img src="/frontend/img/icon/check.png" alt="">
                                </div>
                                <p>Alışveriş yaptığınız için teşekkür ederiz. Siparişiniz onay için gönderilmiştir. İncelendikten sonra mail ile sizlerle iletişime geçilecektir.</p>
                                <a href="{{route('product.filter', 'kampanya')}}" class="btn">Alışverişe Devam Et</a>
                                <p class="get-ans">Tüm sorularınız için <a href="#">İletişim</a> geçebilirsiniz.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





@endsection
@section('css')@endsection
@section('js')@endsection
