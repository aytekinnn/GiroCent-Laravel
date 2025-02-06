@extends('backend.layout')
@section('content')
    <style>
        .col-md-1{
            width: 11.0999999%;
        }
    </style>
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Sipariş Onayla</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Sipariş Onayla</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-xxl-12 col-lg-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-body px-24 py-32">
                        <div class="row mb-24">
                            <div class="col-sm-4">
                                <label class="form-label">Müşteri İsim Soyisim</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           id="kategoriAdi" oninput="generateSlug()" placeholder="Ürün Adı"
                                           required value="{{$order->user->name}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Müşteri Mail</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->user->email}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Müşteri Telefon</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->user->phone ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Sipariş Tarihi</label>
                                <div class="position-relative">
                                    <input type="date" name="name" class="form-control wizard-required"
                                           required value="{{$created}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Şirket Adı</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->company_name ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Adres</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->address?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-3 mt-20">
                                <label class="form-label">Ülke</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->ulke ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-3 mt-20">
                                <label class="form-label">Şehir</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->sehir ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-3 mt-20">
                                <label class="form-label">İlçe</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->ilce ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-3 mt-20">
                                <label class="form-label">Posta Kodu</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->posta_kodu ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">İcra Dosyası</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->icraDosya=="0" ? "selected=''" : ""}} value="0">Evet var.
                                            Kalan borç 10.000₺ üstünde
                                        </option>
                                        <option {{$order->icraDosya=="1" ? "selected=''" : ""}} value="1">Hayır yok hiç
                                            olmadı.
                                        </option>
                                        <option {{$order->icraDosya=="2" ? "selected=''" : ""}} value="2">Hayır yok
                                            ödendi kapandı
                                        </option>
                                        <option {{$order->icraDosya=="3" ? "selected=''" : ""}} value="3">Evet var.
                                            Kalan borç 10.000₺ altında
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Son İş Yerinde Çalışma Süresi ?</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->calismaSuresi=="0" ? "selected=''" : ""}} value="0">6 aydan
                                            az
                                        </option>
                                        <option {{$order->calismaSuresi=="1" ? "selected=''" : ""}} value="1">6-12 ay
                                        </option>
                                        <option {{$order->calismaSuresi=="2" ? "selected=''" : ""}} value="2">1-3 yıl
                                        </option>
                                        <option {{$order->calismaSuresi=="3" ? "selected=''" : ""}} value="3">3-6 yıl
                                        </option>
                                        <option {{$order->calismaSuresi=="4" ? "selected=''" : ""}} value="4">6 yıldan
                                            fazla
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Aylık Gelir ?</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->aylikGelir=="0" ? "selected=''" : ""}} value="0">22.000 ₺
                                            altı
                                        </option>
                                        <option {{$order->aylikGelir=="1" ? "selected=''" : ""}} value="1">22.000 ₺ -
                                            30.000 ₺
                                        </option>
                                        <option {{$order->aylikGelir=="2" ? "selected=''" : ""}} value="2">30.000 ₺ -
                                            50.000 ₺
                                        </option>
                                        <option {{$order->aylikGelir=="3" ? "selected=''" : ""}} value="3">50.000 ₺
                                            üzeri
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Mal Varligi ?</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->malVarligi=="0" ? "selected=''" : ""}} value="0">Ev</option>
                                        <option {{$order->malVarligi=="1" ? "selected=''" : ""}} value="1">Araba
                                        </option>
                                        <option {{$order->malVarligi=="2" ? "selected=''" : ""}} value="2">Arsa</option>
                                        <option {{$order->malVarligi=="3" ? "selected=''" : ""}} value="3">Tarla
                                        </option>
                                        <option {{$order->malVarligi=="4" ? "selected=''" : ""}} value="4">Yok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Doğum Tarihi</label>
                                <div class="position-relative">
                                    <input type="date" name="name" class="form-control wizard-required"
                                           required value="{{$dogum}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">TC.</label>
                                <div class="position-relative">
                                    <input type="date" name="name" class="form-control wizard-required"
                                           required value="{{$order->tc}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Medeni Durum</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->medeni_durum}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Oturduğunuz Ev ?</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->evDurum=="0" ? "selected=''" : ""}} value="0">Kira</option>
                                        <option {{$order->evDurum=="1" ? "selected=''" : ""}} value="1">Kendim</option>
                                        <option {{$order->evDurum=="2" ? "selected=''" : ""}} value="2">Lojman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Sgk Durumu ?</label>
                                <div class="position-relative">
                                    <select name="status" class="form-select">
                                        <option {{$order->sgkDurum=="0" ? "selected=''" : ""}} value="0">4A aktif işçi
                                        </option>
                                        <option {{$order->sgkDurum=="1" ? "selected=''" : ""}} value="1">4B bağkur
                                        </option>
                                        <option {{$order->sgkDurum=="2" ? "selected=''" : ""}} value="2">4C aktif
                                            memur
                                        </option>
                                        <option {{$order->sgkDurum=="3" ? "selected=''" : ""}} value="3">Emekle SSK
                                        </option>
                                        <option {{$order->sgkDurum=="4" ? "selected=''" : ""}} value="4">Emekli Memur
                                        </option>
                                        <option {{$order->sgkDurum=="5" ? "selected=''" : ""}} value="5">Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Bağlantı Kurulacak Kişinin Adı</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->baglanti}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Bağlantılı Kişinin Telefon Numarası</label>
                                <div class="position-relative">
                                    <input type="text" name="name" class="form-control wizard-required"
                                           required value="{{$order->baglantiTelefon}}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-20">
                                <label class="form-label">Taksit Seçeneği ?</label>
                                <div class="position-relative">
                                    <select name="taksit" id="taksit" class="form-select">
                                        <option {{$order->taksit=="0" ? "selected=''" : ""}} value="0">6</option>
                                        <option {{$order->taksit=="1" ? "selected=''" : ""}} value="1">9</option>
                                        <option {{$order->taksit=="2" ? "selected=''" : ""}} value="2">12</option>
                                        <option {{$order->taksit=="3" ? "selected=''" : ""}} value="3">18</option>
                                        <option {{$order->taksit=="4" ? "selected=''" : ""}} value="4">24</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Table Start -->
                        <div class="border radius-12 mt-50 p-24">
                            <h6 class="text-md mb-16">Ürünler</h6>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table rounded-table sm-table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">Ürün Resmi</th>
                                        <th scope="col">Ürün Adı</th>
                                        <th scope="col">Estra Özellikler</th>
                                        <th scope="col">Ürün Adet</th>
                                        <th scope="col">Birim Fiyatı</th>
                                        <th scope="col">Toplam</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $subtotal = 0; $extraFIdString = is_array($order->extraFId) ? implode('|||', $order->extraFId) : $order->extraFId;
                                    $yeniFiyat = [];
                                    @endphp


                                    @foreach($order->products as $index => $product)
                                        @php
                                            $unitPrice = $order->campaigns[$product->id]->new_price ?? $product->price;
                                            $totalPrice = $unitPrice * ($order->adet[$index] ?? 1);
                                            $extraFeatureTotal = 0;
                                            $extraFeatureContent = [];
                                            $extraFeatureNames = [];

                                            if (!empty($order->extraFId[$index])) {
                                                $features = explode('||', $order->extraFId[$index]);
                                                foreach ($features as $feature) {
                                                    if ($feature !== "0") {
                                                        $featureDetails = explode(',', $feature);
                                                        if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                                                            $extraFeatureTotal += floatval($featureDetails[2]);
                                                        }
                                                        $extraFeatureContent[] = $featureDetails[1] ?? 'Bilinmeyen İçerik';
                                                        $extraFeatureNames[] = \App\Models\ExtraFeatures::find($featureDetails[0])->name ?? 'Bilinmeyen Özellik';
                                                    }
                                                }
                                            }

                                            if ($extraFeatureTotal > 0) {
                                                $totalPrice += $extraFeatureTotal;
                                            }

                                            $subtotal += $totalPrice;
                                            $yeniFiyat[] = $totalPrice;
                                        @endphp

                                        <tr>
                                            <td style="width:190px">
                                                <img width="100%" src="/images/products/{{$product->image}}" alt="">
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($product->name, 60) }}</td>
                                            <td>
                                                <strong>₺{{ number_format($extraFeatureTotal, 2, ',', '.') }}</strong><br>
                                                <small>
                                                    @foreach($extraFeatureContent as $index => $content)
                                                        {{ $content }}
                                                        @if(isset($extraFeatureNames[$index]))
                                                            ({{ $extraFeatureNames[$index] }})
                                                        @endif
                                                        @if($index < count($extraFeatureContent) - 1)
                                                            , <br>
                                                        @endif
                                                    @endforeach
                                                </small>
                                            </td>
                                            <td>{{ $order->adet[$index] ?? 1 }}</td>
                                            <td>{{ number_format($unitPrice, 2, ',', '.') }}</td>
                                            <td>{{ number_format($totalPrice, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>Ekstralar:</strong></td>
                                        <td>₺{{ number_format($extraFeaturePrice, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>Toplam:</strong></td>
                                        <td>₺{{ number_format($subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                    </tfoot>


                                </table>
                            </div>
                        </div>
                        <div class="mt-50">
                            <label for="">Açıklama Metni</label>
                            <textarea class="form-control" name="aciklama" rows="10"></textarea>
                            <input type="hidden" value="{{$order->id}}" name="order_id" id="order_id">
                            <input type="hidden" value="{{ htmlspecialchars($extraFIdString) }}" name="extra_feature_id" id="extra_feature_id">
                            <input type="hidden" value="{{$productId}}" name="cartId" id="cartId">
                            <input type="hidden" value="{{implode('||', $yeniFiyat) }}" name="prices" id="prices">
                        </div>


                        <div class="button mt-50">
                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn btn-success action-btn" data-action="onayla" style="width: 100%">Onayla</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger action-btn" data-action="reddet" style="width: 100%">Reddet</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary action-btn" data-action="kismen-onayla" style="width: 100%">Kısmen Onayla</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-info action-btn" data-action="limit-acildi" style="width: 100%">Limit Açıldı</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-info action-btn" data-action="sozlesme-hazirla" style="width: 100%">Sözleşme Hazırla</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success action-btn" data-action="sozlesme-kargola" style="width: 100%">Sözleşme Kargola</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-info action-btn" data-action="urun-hazirla" style="width: 100%">Ürün Hazırlanıyor</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success action-btn" data-action="urun-kargo" style="width: 100%">Ürün Kargolandı</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-warning action-btn" data-action="sozlesme-incele" style="width: 100%">Sözleşme İnceleniyor</button>
                                </div>

                            </div>
                        </div>
                        <!-- Table End -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script src="/backend/assets/js/customize/orders.js"></script>

    <script>
        $(document).ready(function () {
            $(".action-btn").click(function (e) {
                e.preventDefault();

                let orderId = $("input[name='order_id']").val();
                let action = $(this).data("action");  // Butona tıklanan action'ı alıyoruz.
                let toplamTutar = $("#toplam_tutar").text();
                let extra_feature_id = $("#extra_feature_id").val();
                let cartId = $("#cartId").val();
                let prices = $("#prices").val();


                // AJAX verilerini dinamik hale getiriyoruz.
                let data = {
                    order_id: orderId,
                    action: action,
                    _token: "{{ csrf_token() }}"
                };

                // Eğer toplam tutar ve taksit varsa, bunları da ekliyoruz.
                if (toplamTutar) {
                    data.toplam_tutar = toplamTutar;
                }

                if (extra_feature_id){
                    data.extra_feature_id = extra_feature_id;
                }

                if (cartId){
                    data.cartId = cartId;
                }

                if (prices){
                    data.prices = prices;
                }

                $.ajax({
                    url: "{{ route('order.edit') }}",
                    type: "POST",
                    data: data,
                    success: function (response) {
                        alert(response.success);
                        // window.location.href = response.redirect_url;
                    },
                    error: function (xhr) {
                        alert("Hata oluştu, lütfen tekrar deneyin!");
                    }
                });
            });
        });

    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
