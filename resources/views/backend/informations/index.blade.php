@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Bilgi Sayfaları</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Bilgi Sayfaları</li>
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
                        Bilgi Sayfası Ekle
                    </button>
                </div>
            </div>
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="card-title mb-0">Yeni Bilgi Sayfası Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('informations.create')}}" enctype="multipart/form-data" method="POST"
                                  class="form-horizontal form-material">
                                @csrf
                                <div class="form-group">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label">Bilgi Sayfası Adı</label>
                                            <input type="text" id="kategoriAdi" name="title" class="form-control"
                                                   placeholder="Lütfen Sayfa Adını Giriniz" oninput="generateSlug()">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Bilgi Sayfası İçerik</label>
                                            <textarea name="description" id="ckEditor"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Seo Link Url</label>
                                            <input type="text" id="seoLink" name="slug" class="form-control">
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
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($information as $informations)
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
                                {{$informations->title}}
                            </td>
                            @if($informations->status == 1)
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
                                <button data-iid="{{$informations->id}}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h5 class="card-title mb-0">Üretici Düzenle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="{{$informations->id}}" href="javascript:void(0)"
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
        var informationsDeleteUrl = '{{route('informations.delete', ['id' => ':destroy_id'])}}';
        var informationsViewUrl = '{{route('informations.view')}}';
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="/backend/assets/js/customize/informations.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#ckEditor'))
            .then(editor => {
                console.log('CKEditor başarıyla başlatıldı!');
            })
            .catch(error => {
                console.error('CKEditor başlatılırken bir hata oluştu:', error);
            });
        function generateSlug() {
            const kategoriAdi = document.getElementById('kategoriAdi').value;
            let slug = kategoriAdi.toLowerCase()
                .replace(/ç/g, 'c')
                .replace(/ğ/g, 'g')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ş/g, 's')
                .replace(/ü/g, 'u')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('seoLink').value = slug;
        }

        function geneSlug() {
            const ureticiAdi = document.getElementById('ureticiAdi').value;
            let slug = ureticiAdi.toLowerCase()
                .replace(/ç/g, 'c')
                .replace(/ğ/g, 'g')
                .replace(/ı/g, 'i')
                .replace(/ö/g, 'o')
                .replace(/ş/g, 's')
                .replace(/ü/g, 'u')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('seoLinks').value = slug;
        }
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
