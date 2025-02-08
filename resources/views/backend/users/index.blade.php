@extends('backend.layout')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Müşteriler</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Müşteriler</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0"></h5>
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
                        <th scope="col">Kayıt Tarihi</th>
                        <th scope="col">İsim Soyisim</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Telefon</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $users)
                        <tr>
                            <td>
                                {{$users->created_at}}
                            </td>
                            <td>
                                {{$users->name}}
                            </td>
                            <td>{{$users->email}}</td>
                            <td>{{$users->phone}}</td>
                            @if($users->status == 1)
                                <td>
                                    <span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Aktif</span>
                                </td>
                            @elseif($users->status == 2)
                                <td>
                                    <span class="bg-warning-200 text-warning-600 border border-warning-400 px-24 py-4 radius-4 fw-medium text-sm">Engellendi</span>
                                </td>
                            @else
                                <td>
                                    <span class="bg-neutral-200 text-neutral-600 border border-neutral-400 px-24 py-4 radius-4 fw-medium text-sm">Pasif</span>
                                </td>
                            @endif
                            <td>
                                {{--                                <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">--}}
                                {{--                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>--}}
                                {{--                                </a>--}}
                                <button data-uid="{{$users->id}}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-contact-d"
                                        class="edit-button bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex">
                                                <h5 class="card-title mb-0">Kullanıcı Düzenle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="{{$users->id}}" href="javascript:void(0)"
                                        class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle trashh">
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
        var usersDeleteUrl = '{{route('users.delete', ['id' => ':destroy_id'])}}';
        var usersViewUrl = '{{route('users.view')}}';
    </script>
    <script src="/backend/assets/js/customize/users.js"></script>

@endsection
@section('css')@endsection
@section('js')@endsection
