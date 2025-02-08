<form action="{{Route('users.edit')}}" method="POST">
    @csrf
    <div class="col-12">
        <label class="form-label">Kullanıcı Adı</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" oninput="geneSlug()">
    </div>
    <div class="col-12">
        <label class="form-label">Mail</label>
        <input type="text" name="email"  class="form-control" value="{{ $user->email }}">
    </div>
    <div class="col-12">
        <label class="form-label">Telefon</label>
        <input type="tel" name="phone"  class="form-control" value="{{ $user->phone }}">
    </div>
    <div class="col-12">
        <label class="form-label">Durum</label>
        <select name="status" class="form-select">
            <option {{$user->status=="1" ? "selected=''" : ""}} value="1">Aktif</option>
            <option {{$user->status=="0" ? "selected=''" : ""}} value="0">Pasif</option>
            <option {{$user->status=="2" ? "selected=''" : ""}} value="2">Engelle</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary-600 radius-8 px-20 py-11">
            Düzenle
        </button>
        <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11" data-bs-dismiss="modal">
            Kapat
        </button>
    </div>
</form>


