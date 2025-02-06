@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ekstra Özellikler</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ekstra Özellikler</li>
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
                        Özellik Ekle
                    </button>
                </div>
            </div>
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="card-title mb-0">Yeni Ekstra Özellik Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('extra-features.create')}}" enctype="multipart/form-data" method="POST"
                                  class="form-horizontal form-material">
                                @csrf
                                <div class="form-group">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label">Özellik Adı</label>
                                            <input type="text" id="kategoriAdi" name="name" class="form-control"
                                                   placeholder="Lütfen Özellik Adını Yazınız">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Üst Özellik Kategorisi</label>
                                            <select name="ust_id" class="form-select">
                                                <option value="">Seçim Yapınız</option>
                                                @foreach($features as $featur)
                                                    <option value="{{$featur->id}}">{{$featur->name}}</option>
                                                @endforeach
                                            </select>
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
                        <th scope="col">Üst Kategori</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($feature as $featuries)
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
                                @if($featuries->ust_id == null)
                                    {{$featuries->name}}
                                @else
                                    @php
                                    $nameCategory = \App\Models\Faetures::find($featuries->ust_id);
                                    @endphp
                                    {{$nameCategory->name}} > {{$featuries->name}}
                                @endif
                            </td>
                            <td>
                                @if($featuries->ust_id == null)
                                    Üst Özellik Kategorisi Yok
                                @else
                                    @php
                                        $parentCategory = \App\Models\Faetures::find($featuries->ust_id);
                                    @endphp
                                    {{ $parentCategory ? $parentCategory->name : 'Üst Özellik Kategori Bulunamadı' }}
                                @endif

                            </td>
                            @if($featuries->status == 1)
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
                                <button data-fid="{{$featuries->id}}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h5 class="card-title mb-0">Özellik Düzenle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="{{$featuries->id}}" href="javascript:void(0)"
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
        var ExtraFeaturesDeleteUrl = '{{route('extra-features.delete', ['id' => ':destroy_id'])}}';
        var extraFeaturesViewUrl = '{{route('extra-features.view')}}';
    </script>
    <script src="/backend/assets/js/customize/extra-features.js"></script>
@endsection
@section('css')@endsection
@section('js')@endsection
