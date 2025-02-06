$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.edit-button', function () {
        var mId = $(this).data("mid");
        // AJAX isteği yapın
        $.ajax({
            type: "POST",
            url: manufacturerViewUrl,
            data: {
                'mid': mId,
            },
            success: function (response) {

                $("#add-contact-d .modal-body").html(response);

                $("#add-contact-d").modal("show");
            },
            error: function (xhr, status, error) {

                console.log(response);
            }
        });
    });

    $(document).on('click', '.trashh', function () {
        var destroy_id = $(this).attr('id');
        alertify.confirm('Silme İşlemini Onaylıyor musunuz?', 'Bu İşlem Geri Alınamaz',
            function () {
                var deleteUrl = manufacturerDeleteUrl.replace(':destroy_id', destroy_id);
                location.href = deleteUrl;
            },
            function () {
                alertify.error("Silme İşlemi İptal Edildi");
            }
        );
    });
});
