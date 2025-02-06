<form action="{{Route('informations.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Bilgi Sayfası Adı</label>
        <input type="text" name="title" id="ureticiAdi" class="form-control" value="{{ $informations->title }}" oninput="geneSlug()">
    </div>
    <div class="col-12">
        <label class="form-label">Bilgi Sayfası İçerik</label>
        <textarea name="description" id="ckEditorr">{{ $informations->description }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Seo Link Url</label>
        <input type="text" name="slug" id="seoLinks" class="form-control" value="{{ $informations->slug }}">
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$informations->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$informations->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $informations->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ckEditorr'))
        .then(editor => {
            console.log('CKEditor başarıyla başlatıldı!');
        })
        .catch(error => {
            console.error('CKEditor başlatılırken bir hata oluştu:', error);
        });
</script>
