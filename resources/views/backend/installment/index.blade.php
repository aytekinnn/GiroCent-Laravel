@extends('backend.layout')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Taksitler</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Taksitler</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-body">
                <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                    <thead>
                    <tr>
                        <th scope="col">Kullanıcı Adı</th>
                        <th scope="col">Ödenen Taksit</th>
                        <th scope="col">Gelecek Ödeme Tarihi</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($installmentData as $data)
                        <tr>
                            <td>{{ $data['user_name'] }}</td>
                            <td>{{ $data['paidInstallments'] }}/{{ $data['totalInstallments'] }}</td>
                            <td>{{ $data['nextPaymentDate'] ? \Carbon\Carbon::parse($data['nextPaymentDate'])->format('d-m-Y') : 'N/A' }}</td>

                            <td>
                                @if($data['status'] == 'Ödenmedi')
                                    <span class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Ödenmedi</span>
                                @elseif($data['status'] == 'Ödendi')
                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Ödendi</span>
                                @elseif($data['status'] == 'Günü Geçmiş')
                                    <span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Ödeme Günü Geçmiş</span>
                                @elseif($data['status'] == 'Yaklasiyor')
                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Ödeme Günü Yaklaşıyor</span>
                                @endif
                            </td>



                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#add-contact-d"
                                        class="edit-button w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <a href="{{route('installment.views', $data['firstInstallmentId'])}}"> <iconify-icon icon="lucide:edit"></iconify-icon></a>
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
        document.getElementById('productSelect').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const productPrice = parseFloat(selectedOption.getAttribute('data-price')); // Ürün fiyatını al

            const discountInput = document.getElementById('discountInput');
            const newPriceInput = document.getElementById('newPriceInput');

            discountInput.addEventListener('input', function () {
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
