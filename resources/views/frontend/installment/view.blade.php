@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Taksit Durumu</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Taksit Durumu</li>
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
                                    <th scope="col">Taksit</th>
                                    <th scope="col">Ödeme Tarihi</th>
                                    <th scope="col">Ödenme Tarihi</th>
                                    <th scope="col">Taksit Tutarı</th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">Aksiyon</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($installments as $installment)
                                        <tr>
                                            <td class="product-kullanici">
                                                {{$installment->taksit_no}}
                                            </td>
                                            <td class="product-odenen">
                                                {{$installment->due_date}}
                                            </td>
                                            <td class="product-gelecek">
                                                {{ $installment->created_at == $installment->updated_at ? 'Henüz Ödenmedi' : $installment->updated_at }}
                                            </td>
                                            <td>
                                                ₺{{number_format($installment->amount, 2, ',', '.') }}
                                            </td>
                                            <td class="product-durum">
                                                @if($installment->status == 0)
                                                    <button class="btn btn-warning" style="background-color: #DC3545">Ödenmedi</button>
                                                @elseif($installment->status == 1)
                                                    <button class="btn btn-success">Ödendi</button>
                                                @elseif($installment->status == 2)
                                                    <button class="btn btn-info" style="background-color: #FFC107">Ödeme Günü Geçmiş</button>
                                                @endif
                                            </td>
                                            <!-- Ödeme Yap Butonu -->
                                            @if($installment->status == 1)
                                                <td></td>
                                            @else
                                                <td class="product-aksiyon">
                                                    <button type="button" class="btn btn-success" style="background-color: #007BFF; color: white;" data-toggle="modal" data-target="#paymentModal">
                                                        Ödeme Yap
                                                    </button>
                                                </td>
                                            @endif


                                            <!-- Ödeme Bilgileri Modal -->
                                            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 id="paymentModalLabel">Ödeme Bilgileri</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>IBAN:</strong> 1111111111111</p>
                                                            <p><strong>Alıcı Adı Soyadı:</strong> Aytekin Aytekin</p>
                                                            <p class="text-danger"><strong>Ödeme yapıldıktan sonra lütfen dekontu WhatsApp’tan gönderiniz.</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
