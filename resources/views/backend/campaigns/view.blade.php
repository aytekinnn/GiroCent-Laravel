<form action="{{Route('campaigns.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Kampanya Adı</label>
        <input type="text" name="name" value="{{$campaign->name}}" class="form-control"
               placeholder="Lütfen Kampanya Adını Yazınız">
    </div>
    <div class="col-12">
        <label class="form-label">Ürün Seçiniz</label>
        <select name="product_id" class="form-select" id="productSelects">
            <option value="">Ürün Seçiniz</option>
            @foreach($product as $products)
                <option value="{{ $products->id }}" data-price="{{ $products->price ?? '' }}"
                        @if(isset($campaign->product) && $campaign->product->id == $products->id) selected @endif>
                    {{ $products->name ?? '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Başlangıç Tarihi</label>
        <input type="datetime-local" name="start_date" value="{{ $campaign->start_date }}" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">Bitiş Tarihi</label>
        <input type="datetime-local" name="end_date" value="{{ $campaign->end_date }}" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">İndirim</label>
        <input type="text" name="discount" id="discountInputs" value="{{ $campaign->discount }}" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">İndirimli Fiyat</label>
        <input type="text" name="new_price" id="newPriceInputs" value="{{ $campaign->new_price }}" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$campaign->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$campaign->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $campaign->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>

</form>

<script>
    $(document).ajaxComplete(function () {
        let productSelect = document.getElementById("productSelects");
        let discountInput = document.getElementById("discountInputs");
        let newPriceInput = document.getElementById("newPriceInputs");

        function calculateDiscount() {
            let selectedOption = productSelect.options[productSelect.selectedIndex];

            let originalPrice = parseFloat(selectedOption.getAttribute("data-price")) || 0;
            let discountPercent = parseInt(discountInput.value) || 0;

            if (originalPrice > 0 && discountPercent >= 0) {
                let discountedPrice = originalPrice - (originalPrice * (discountPercent / 100));
                newPriceInput.value = discountedPrice.toFixed(2); // Yeni fiyatı göster
            } else {
                newPriceInput.value = "";
            }
        }

        productSelect.addEventListener("change", calculateDiscount);
        discountInput.addEventListener("input", calculateDiscount);
    });


</script>
