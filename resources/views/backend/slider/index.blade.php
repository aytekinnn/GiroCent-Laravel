@extends('backend.layout')
@section('content')
    <style>
        /* Tablonun genel düzeni */
        #dataTable {
            table-layout: fixed;
            width: 100%;
        }

        #dataTable th, #dataTable td {
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }

        /* Resim sütununun genişliğini %30 olarak ayarla */
        #dataTable th:nth-child(1),
        #dataTable td:nth-child(1) {
            width: 30%;
        }

        /* Diğer sütunların genişliğini eşit olarak dağıt */
        #dataTable th:nth-child(2),
        #dataTable th:nth-child(3),
        #dataTable th:nth-child(4),
        #dataTable td:nth-child(2),
        #dataTable td:nth-child(3),
        #dataTable td:nth-child(4) {
            width: 23.33%; /* Kalan %70'i eşit dağıtmak için */
        }

        /* Resimlere uygun boyut ayarı */
        #dataTable img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Slider</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Slider</li>
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
                        Slider Ekle
                    </button>
                </div>
            </div>
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="card-title mb-0">Yeni Slider Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('slider.create')}}" enctype="multipart/form-data" method="POST"
                                  class="form-horizontal form-material">
                                @csrf
                                <div class="form-group">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label" for="stadium-photo">Slider Başlık</label>
                                            <input type="text" id="stadium-photo" name="title" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="stadium-photo">Slider Açıklama</label>
                                            <input type="text" id="stadium-photo" name="content" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="stadium-photo">Slider Görsel</label>
                                            <input type="file" id="stadium-photo" name="image" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Slider Sırası</label>
                                            <input type="number" id="seoLink" name="order" class="form-control">
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
                        <th scope="col" width="20%">Resim</th>
                        <th scope="col">Sıra</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slider as $sliders)
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
                                <div class="d-flex align-items-center">
                                    <img src="/images/slider/{{$sliders->image}}" alt=""
                                         width="300px" class="flex-shrink-0 me-12 radius-8">
                                </div>
                            </td>
                            <td>
                                {{$sliders->order}}
                            </td>
                            @if($sliders->status == 1)
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
                                <button data-sid="{{$sliders->id}}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex">
                                                <h5 class="card-title mb-0">Slider Düzenle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="{{$sliders->id}}" href="javascript:void(0)"
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
        var sliderDeleteUrl = '{{route('slider.delete', ['id' => ':destroy_id'])}}';
        var sliderViewUrl = '{{route('slider.view')}}';
    </script>
    <script src="/backend/assets/js/customize/slider.js"></script>

@endsection
@section('css')@endsection
@section('js')@endsection
