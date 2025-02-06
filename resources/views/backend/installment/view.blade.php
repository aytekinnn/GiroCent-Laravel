@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $installments->first()->user->name }} Taksit Detayları</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Taksit Detayları</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-xxl-12 col-lg-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-body px-24 py-32">
                        <div class="border radius-12 mt-50 p-24">
                            <h6 class="text-md mb-16">Taksitler</h6>
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table rounded-table sm-table mb-0">
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
                                            <td style="width:190px">
                                                {{$installment->taksit_no}}
                                            </td>
                                            <td>
                                                {{$installment->due_date}}
                                            </td>
                                            <td>
                                                {{ $installment->created_at == $installment->updated_at ? 'Henüz Ödenmedi' : $installment->updated_at }}
                                            </td>
                                            <td>
                                                ₺{{number_format($installment->amount, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                @if($installment->status == 0)
                                                    <span class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Ödenmedi</span>
                                                @elseif($installment->status == 1)
                                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Ödendi</span>
                                                @elseif($installment->due_date < $date)
                                                    <span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Ödeme Günü Geçmiş</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button data-tid="{{$installment->id}}" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#add-contact-d"
                                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </button>
                                                <div id="add-contact-d" class="modal fade in" tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex align-items-center">
                                                                <h5 class="card-title mb-0">Taksit Düzenle</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- Table End -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        console.log(typeof $);
        var installmentViewUrl = '{{route('installment.view')}}';
    </script>
    <script src="/backend/assets/js/customize/installment.js"></script>

@endsection
@section('css')@endsection
@section('js')@endsection
