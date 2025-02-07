@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Hesap Ayarları</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Hesap Ayarları</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-150 mb-50">
                    <div style="border-radius: 15px; overflow: hidden;">
                        <img width="100%" src="/images/account.jpg" alt="">
                    </div>
                    <div style="position: absolute; top: 250px; left: 90px">
                        <img style="border-radius: 150px; overflow: hidden;" width="190px" src="{{ $user->image ? '/images/user/' . $user->image : '/images/logociro.png' }}" alt="">
                        <h5>{{$user->name}}</h5>
                    </div>
                </div>
            </div>
            <div class="mb-50"
                 style="margin-top: 150px; border: 1px solid black; border-radius: 10px; padding: 60px 30px">
                <form action="{{route('account.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="old_image" value="{{$user->image}}">
                        <div class="col-md-3">
                            <label for="">Profil Resmi</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">İsim Soyisim</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="col-md-3">
                            <label for="">E-Mail</label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="col-md-3">
                            <label for="">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{$user->phone ?? ''}}">
                        </div>
                        <div class="col-md-6 mt-50">
                            <label for="">Şifre</label>
                            <input type="password" name="password1" class="form-control">
                        </div>
                        <div class="col-md-6 mt-50">
                            <label for="">Şifre Tekrar</label>
                            <input type="password" name="password2" class="form-control">
                        </div>
                        <div class="col-md-4 mt-50">
                            <button type="submit" class="btn">Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>


    </main>

@endsection
@section('css')@endsection
@section('js')@endsection
