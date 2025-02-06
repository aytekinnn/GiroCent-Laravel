<form action="{{Route('manufacturer.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Üretici Adı</label>
        <input type="text" name="name" id="ureticiAdi" class="form-control" value="{{ $manufacturer->name }}" oninput="geneSlug()">
    </div>
    <div class="col-12">
        <label class="form-label">Seo Link Url</label>
        <input type="text" name="slug" id="seoLinks" class="form-control" value="{{ $manufacturer->slug }}">
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$manufacturer->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$manufacturer->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $manufacturer->id }}">

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

</script>
