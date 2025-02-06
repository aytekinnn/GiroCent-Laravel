@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Hakkımızda</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Hakkımızda</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-area pt-100 pb-100">
            <div class="container">
                <div class="row align-items-xl-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="/frontend/img/images/about_img.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h4 class="title">Our Story</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting indust orem Ipsum has been the industry's standard
                                dummy texever since the when anunknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <p>Dorem Ipsum is simply dummy consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                aliqua. Ut enim ad minim veniam</p>
                            <div class="our-mission-wrap">
                                <h4 class="title">Mission of Our Creative House</h4>
                                <div class="our-mission-list">
                                    <div class="mission-box">
                                        <div class="mission-icon">
                                            <i class="flaticon-project"></i>
                                        </div>
                                        <div class="mission-count">
                                            <h2><span class="odometer" data-count="324">00</span>+</h2>
                                            <span>Projects</span>
                                        </div>
                                    </div>
                                    <div class="mission-box">
                                        <div class="mission-icon">
                                            <i class="flaticon-revenue"></i>
                                        </div>
                                        <div class="mission-count">
                                            <h2>$<span class="odometer" data-count="3">00</span>M</h2>
                                            <span>Revenue</span>
                                        </div>
                                    </div>
                                    <div class="mission-box">
                                        <div class="mission-icon">
                                            <i class="flaticon-quality"></i>
                                        </div>
                                        <div class="mission-count">
                                            <h2><span class="odometer" data-count="379">00</span>+</h2>
                                            <span>Awards</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>



@endsection
@section('css')@endsection
@section('js')@endsection
