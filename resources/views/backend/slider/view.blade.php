<form action="{{Route('slider.edit')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Görsel</label>
        <input type="file" name="image" class="form-control">
        <p class="text-sm">Görseli değiştirmek istemiyorsanız boş bırakınız</p>
    </div>
    <div class="col-12">
        <label class="form-label">Slider Başlık</label>
        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
    </div>
    <div class="col-12">
        <label class="form-label">Slider Alt Metin</label>
        <input type="text" name="content" class="form-control" value="{{ $slider->content }}">
    </div>
    <div class="col-12">
        <label class="form-label">Slider Sırası</label>
        <input type="text" name="order" class="form-control" value="{{ $slider->order }}">
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$slider->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$slider->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $slider->id }}">
    <input type="hidden" name="old_file" value="{{$slider->image}}">
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>
</form>
