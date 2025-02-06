$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.edit-button', function () {
        var tId = $(this).data("tid");
        // AJAX isteği yapın
        $.ajax({
            type: "POST",
            url: installmentViewUrl,
            data: {
                'tid': tId,
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
});
