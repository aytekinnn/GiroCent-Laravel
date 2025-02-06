@extends('backend.layout')
@section('content')
    <link rel="stylesheet" href="/backend/assets/js/dropzone/dist/min/dropzone.min.css">
    <script src="/backend/assets/js/dropzone/dist/min/dropzone.min.js"></script>
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Resim Ekle</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{Route('home.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Anasayfa
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Resim Ekle</li>
            </ul>
        </div>
            <div class="row">
                <div class="col-12">



                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 mb-4">
                        <a id="{{$id}}" class="camera" > <button type="submit" class="btn btn-primary">Yüklenen Resimleri Görüntüle</button></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('gallery.upload') }}" method="POST" class="dropzone" id="imageDropzone">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <script>
        $(".camera").click(function () {
            var camera_id = $(this).attr('id');
                    location.href = "{{route('portfolyoGallery',['id'=> ':camera_id'])}}".replace(':camera_id', camera_id);
        });
        Dropzone.options.imageDropzone = {
            paramName: "file",
            maxFilesize: 4, // MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            init: function() {
                var myDropzone = this;

                // Tüm dosyalar yüklendikten sonra mesajı göstermek için bir işaretçi
                var allFilesUploaded = false;

                // Her dosya yüklendiğinde
                this.on("success", function(file, response) {
                    // Dosya başarıyla yüklendiğinde yapılacak işlemler
                });

                // Tüm dosyalar yüklendiğinde
                this.on("complete", function(file) {
                    if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                        if (!allFilesUploaded) {
                            allFilesUploaded = true;
                            alert('Tüm görseller başarıyla yüklendi.');
                        }
                    }
                });

                // Hata durumunda mesaj gösterimi
                this.on("error", function(file, response) {
                    console.error('Görsel yükleme hatası:', response);
                    alert('Görsel yükleme hatası.');
                });
            }
        };
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection

