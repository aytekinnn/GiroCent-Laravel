<form action="{{Route('installment.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{ $installment->status == "1" ? "selected" : "" }} value="1">Ödendi</option>
            <option {{ $installment->status == "0" ? "selected" : "" }} value="0">Ödenmedi</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $installment->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>

</form>
