<form action="{{Route('features.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Özellik Adı</label>
        <input type="text" name="name" class="form-control" value="{{ $features->name }}">
    </div>
    <div class="col-12">
        <label class="form-label">Üst Özellik Kategori</label>
        <select name="ust_id" class="form-select">
            @php
                $ustCategory = \App\Models\Faetures::find($features->ust_id);
            @endphp
            <option value="{{ $features->ust_id ?? '' }}">{{ $ustCategory->name ?? 'Seçili Üst Özellik Yok' }}</option>
            @foreach($featuries as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $ust_id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{ $features->status == "1" ? "selected" : "" }} value="1">Aktif</option>
            <option {{ $features->status == "0" ? "selected" : "" }} value="0">Pasif</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $features->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>

</form>
