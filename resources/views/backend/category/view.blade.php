<form action="{{Route('category.edit')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="col-sm-12">
        <label class="form-label">Yeni Kategori Icon Ekle*</label>
        <div class="position-relative">
            <input type="file" name="icon" class="form-control">
            <label>Yeni ikon eklemek istemiyorsanız boş bırakın</label>
            <div class="wizard-form-error"></div>
        </div>
    </div>
    <input type="hidden" name="old_icon" value="{{$category->icon}}">
    <div class="col-12">
        <label class="form-label">Kategori Adı</label>
        <input type="text" name="name" id="ureticiAdi" class="form-control" value="{{ $category->name }}" oninput="geneSlug()">
    </div>
    <div class="col-12">
        <label class="form-label">Kategori Seo Url</label>
        <input type="text" name="slug" id="seoLinks" class="form-control" value="{{ $category->slug }}">
    </div>
    <div class="col-12">
        <label class="form-label">Kategori Sırası</label>
        <input type="text" name="order" class="form-control" value="{{ $category->order }}">
    </div>
    <div class="col-12">
        <label class="form-label">Üst Kategori</label>
        <select name="ust_id" class="form-select">
            <option value="{{ $category->ust_id ?? '' }}">{{ $category->ust_id ?? 'Seçili Üst Kategori Yok' }}</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $ust_id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$category->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$category->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Kategori Öne Çıkarılsın Mı?</label>
        <select name="popular_category" class="form-select">
            <option value="1" {{ old('popular_category', $category->popular_category) == "1" ? 'selected' : '' }}>Evet</option>
            <option value="0" {{ old('popular_category', $category->popular_category) == "0" ? 'selected' : '' }}>Hayır</option>
        </select>
    </div>


    <input type="hidden" name="id" value="{{ $category->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>
</form>
