@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ürünler</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ürünler</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0"></h5>
            </div>
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <a href="{{route('product.store')}}"><button type="button" class="btn btn-outline-primary-600 radius-8 px-20 py-11">Ürün Ekle</button></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                    <thead>
                    <tr>
                        <th scope="col" style="width: 50px !important;">Ürün Resmi</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Üretici</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $products)
                        <tr>
                            <td style="width: 50px;">
                                <div style="width: 50px;">
                                    <img src="/images/products/{{$products->image}}" alt="">
                                </div>
                                </td>
                            <td>
                                {{\Illuminate\Support\Str::limit($products->name, 60)}}
                            </td>
                            <td>
                                @if($products->categories->isNotEmpty())
                                    @foreach($products->categories as $category)
                                        - {{ $category->name }} <br>
{{--                                        @if(!$loop->last), @endif--}}
                                    @endforeach
                                @else
                                    Kategori Yok
                                @endif
                            </td>
                            <td>{{$products->manufacturer->name}}</td>
                            <td>{{$products->stock}}</td>
                            @if($products->durum == 1)
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
                                <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <a href="{{ route('portfolyoGallery', $products->id) }}"><iconify-icon icon="lucide:image"></iconify-icon></a>
                                </button>
                                <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <a href="{{ route('product.edit-view', $products->id) }}"><iconify-icon icon="lucide:edit"></iconify-icon></a>
                                </button>
                                <button id="{{$products->id}}" href="javascript:void(0)"
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
        var productDeleteUrl = '{{route('product.delete', ['id' => ':destroy_id'])}}';
    </script>
    <script src="/backend/assets/js/customize/products.js"></script>

@endsection
@section('css')@endsection
@section('js')@endsection
