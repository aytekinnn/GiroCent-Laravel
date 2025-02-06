@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Taksitlerim</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Taksitlerim</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="shop-cart-area wishlist-area pt-100 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="table-responsive-xl">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col" class="product-kullanici">Kullanıcı Adı</th>
                                    <th scope="col" class="product-odenen">Ödenen Taksit</th>
                                    <th scope="col" class="product-gelecek">Gelecek Ödeme Tarihi</th>
                                    <th scope="col" class="product-durum">Durum</th>
                                    <th scope="col" class="product-aksiyon">Aksiyon</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($installmentData as $data)
                                        <tr>
                                            <td class="product-kullanici">
                                                {{Auth::user()->name}}
                                            </td>
                                            <td class="product-odenen">
                                                {{ $data['paidInstallments'] }}/{{ $data['totalInstallments'] }}
                                            </td>
                                            <td class="product-gelecek">
                                                {{ $data['nextPaymentDate'] ? \Carbon\Carbon::parse($data['nextPaymentDate'])->format('d-m-Y') : 'N/A' }}
                                            </td>
                                            <td class="product-durum">
                                                @if($data['status'] == 'Ödenmedi')
                                                    <button class="btn btn-warning" style="background-color: #DC3545">Ödenmedi</button>
                                                @elseif($data['status'] == 'Ödendi')
                                                    <button class="btn btn-success">Ödendi</button>
                                                @elseif($data['status'] == 'Günü Geçmiş')
                                                    <button class="btn btn-info" style="background-color: #FFC107">Ödeme Günü Geçmiş</button>
                                                @elseif($data['status'] == 'Yaklasiyor')
                                                    <button class="btn btn-info" style="background-color: #FFC107">Ödeme Günü Yaklaşıyor</button>
                                                @endif
                                            </td>
                                            <td class="product-aksiyon">
                                                <button type="button" class="btn btn-success" style="background-color: #007BFF">
                                                    <a style="color: white" href="{{route('installment.viewer', $data['firstInstallmentId'])}}"> Detaylar</a>
                                                </button>
                                            </td>
                                        </tr>
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
                                        <a href="{{route('product.filter', 'kampanya')}}" class="btn">Alışverişe Devam Et</a>
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
