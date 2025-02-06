@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Kampanyalar</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Kampanyalar</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0"></h5>
            </div>
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary-600 radius-8 px-20 py-11"
                            data-bs-toggle="modal"
                            data-bs-target="#add-contact">
                        Kampanya Ekle
                    </button>
                </div>
            </div>
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="card-title mb-0">Yeni Kampanya Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('campaigns.create')}}" enctype="multipart/form-data" method="POST"
                                  class="form-horizontal form-material">
                                @csrf
                                <div class="form-group">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label">Kampanya Adı</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Lütfen Kampanya Adını Yazınız">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Kampanya Açıklama</label>
                                            <input type="text" name="contents" class="form-control"
                                                   placeholder="Lütfen Kampanya Açıklaması Yazınız">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Ürün Seçiniz</label>
                                            <select name="product_id" class="form-select" id="productSelect">
                                                <option value="">Seçim Yapınız</option>
                                                @foreach($product as $products)
                                                    <option value="{{$products->id}}" data-price="{{$products->price}}">{{$products->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Kamapanya Başlangıç Tarihi</label>
                                            <input type="datetime-local" class="form-control" name="start_date">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Kamapanya Bitiş Tarihi</label>
                                            <input type="datetime-local" class="form-control" name="end_date">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">İndirim Yüzdesi</label>
                                            <input type="text" class="form-control" placeholder="% işareti kullanmayın" name="discount" id="discountInput">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Yeni Fiyat</label>
                                            <input type="text" class="form-control" name="new_price" id="newPriceInput" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Durum</label>
                                            <select name="status" class="form-select">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11"
                                            data-bs-dismiss="modal">
                                        Ekle
                                    </button>
                                    <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11"
                                            data-bs-dismiss="modal">
                                        Kapat
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="card-body">
                <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                    <thead>
                    <tr>
                        {{--                        <th scope="col">--}}
                        {{--                            <div class="form-check style-check d-flex align-items-center">--}}
                        {{--                                <input class="form-check-input" type="checkbox">--}}
                        {{--                                <label class="form-check-label">--}}
                        {{--                                    S.N--}}
                        {{--                                </label>--}}
                        {{--                            </div>--}}
                        {{--                        </th>--}}
                        <th scope="col">Adı</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Kampanya Başlangıç - Bitiş Tarihi</th>
                        <th scope="col">Ürün Fiyatı - Kampanyalı Fiyat</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($campaign as $campaigns)
                        <tr>
                            {{--                            <td>--}}
                            {{--                                <div class="form-check style-check d-flex align-items-center">--}}
                            {{--                                    <input class="form-check-input" type="checkbox">--}}
                            {{--                                    <label class="form-check-label">--}}
                            {{--                                        {{ $loop->iteration }}--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}
                            <td>
                                {{ \Illuminate\Support\Str::limit($campaigns->name, 50) }}
                            </td>

                            <td>
                                {{\Illuminate\Support\Str::limit($campaigns->product->name, 40)}}
                            </td>
                            <td>
                                {{$campaigns->start_date .' || '. $campaigns->end_date}}
                            </td>
                            <td>
                                {{$campaigns->product->price .' || '. $campaigns->new_price}}
                            </td>
                            @if($campaigns->status == 1)
                                <td>
                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Aktif</span>
                                </td>
                            @else
                                <td>
                                    <span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pasif</span>
                                </td>
                            @endif
                            <td>
                                {{--                                <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">--}}
                                {{--                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>--}}
                                {{--                                </a>--}}
                                <button data-caid="{{$campaigns->id}}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h5 class="card-title mb-0">Kampanya Düzenle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="{{$campaigns->id}}" href="javascript:void(0)"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center trashh">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        console.log(typeof $);
        var campaignsDeleteUrl = '{{route('campaigns.delete', ['id' => ':destroy_id'])}}';
        var campaignsViewUrl = '{{route('campaigns.view')}}';
    </script>
    <script src="/backend/assets/js/customize/campaigns.js"></script>

    <script>
        document.getElementById('productSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const productPrice = parseFloat(selectedOption.getAttribute('data-price')); // Ürün fiyatını al

            const discountInput = document.getElementById('discountInput');
            const newPriceInput = document.getElementById('newPriceInput');

            discountInput.addEventListener('input', function() {
                const discount = parseFloat(discountInput.value);
                if (!isNaN(discount) && discount >= 0) {
                    // İndirim yüzdesi hesapla
                    const newPrice = productPrice - (productPrice * (discount / 100));
                    newPriceInput.value = newPrice.toFixed(2); // Yeni fiyatı göster
                } else {
                    newPriceInput.value = ''; // Geçersiz indirim durumunda boş bırak
                }
            });
        });

    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
