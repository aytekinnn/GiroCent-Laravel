@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Siparişler</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Siparişler</li>
            </ul>
        </div>

        <div class="card basic-data-table">
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
                        <th scope="col">Sipariş Tarihi</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $orders)
                        <tr>
                            <td>
                                {{$orders->user->name}}
                            </td>
                            <td>
                                {{$orders->created_at}}
                            </td>
                            @if($orders->status == 1)
                                <td>
                                    <span
                                        class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Onay Bekliyor</span>
                                </td>
                            @elseif($orders->status == 2)
                                <td>
                                    <span
                                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Onaylandı</span>
                                </td>
                            @elseif($orders->status == 3)
                                <td>
                                    <span
                                        class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Reddedildi</span>
                                </td>
                            @elseif($orders->status == 4)
                                <td>
                                    <span
                                        class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Kısmen Onaylandı</span>
                                </td>
                            @elseif($orders->status == 5)
                                <td>
                                    <span
                                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Limit Açıldı</span>
                                </td>
                            @elseif($orders->status == 6)
                                <td>
                                    <span
                                        class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Sözleşme Hazırlanıyor</span>
                                </td>
                            @elseif($orders->status == 7)
                                <td>
                                    <span
                                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Sözleşme Kargoda</span>
                                </td>
                            @elseif($orders->status == 8)
                                <td>
                                    <span
                                        class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Ürün Hazırlanıyor</span>
                                </td>
                            @elseif($orders->status == 9)
                                <td>
                                    <span
                                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Ürün Kargoda</span>
                                </td>
                            @elseif($orders->status == 10)
                                <td>
                                    <span
                                        class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Sözleşme İnceleniyor</span>
                                </td>
                            @endif
                            {{--                                <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">--}}
                            {{--                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>--}}
                            {{--                                </a>--}}
                            <td>
                                <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <a href="{{route('order.edit-view', $orders->id)}}">
                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                    </a>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('css')@endsection
@section('js')@endsection
