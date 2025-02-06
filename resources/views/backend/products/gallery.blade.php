@extends('backend.layout')
@section('content')
    <style>
        .image-container{
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .checkboxx {
            position: absolute !important;
            top: 10px !important;
            left: 20px !important;
            z-index: 10;
        }
    </style>
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

        <div class="container">
            <div class="row">
                @foreach($gallery as $galleries)
                    <div class="col-md-3 image-container">
                        <input type="checkbox" id="radio1" class="form-check-input checkboxx" name="image" value="{{ $galleries->id }}">
                        <img width="100%" src="/images/gallery/{{ $galleries->galeri_yol }}" alt="">
                    </div>
                @endforeach
                <div align="center" class="col-md-12">
                    <button id="deleteBtn" class="btn btn-danger"><i class="ti ti-trash"></i> Toplu Sil</button>
                    <a id="{{ $id}} " class="btn btn-success camera"><i class="bx bx-plus"></i> Görsel Yükle</a>
                </div>
            </div>
        </div>

    </div>



    <script>
        $('#deleteBtn').on('click', function() {
            var selectedImages = [];
            $('input[name="image"]:checked').each(function() {
                selectedImages.push($(this).val());
            });

            if (selectedImages.length > 0) {
                $.ajax({
                    url: '{{ route("gallery.delete") }}', // Route adı
                    type: 'POST',
                    data: {
                        images: selectedImages,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Seçili resimler silindi.');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Silme işlemi başarısız:', error);
                    }
                });
            } else {
                alert('Lütfen silmek istediğiniz resimleri seçin.');
            }
        });

        $(".camera").click(function () {
            var camera_id = $(this).attr('id');
            location.href = "{{route('gallery.add',['id'=> ':camera_id'])}}".replace(':camera_id', camera_id);
        });
    </script>


@endsection
@section('css')@endsection
@section('js')@endsection
