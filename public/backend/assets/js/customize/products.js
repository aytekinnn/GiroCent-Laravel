(function ($) {
    $('#addRow').click(function () {
        // AJAX ile verileri çekiyoruz
        $.ajax({
            url: '/tech/product/get-feature', // API route ya da controller route
            type: 'GET',
            success: function (features) {
                let options = '';
                features.forEach(function (feature) {
                    options += `<option value="${feature.id}">${feature.name}</option>`;
                });

                const newRow = `
                    <div class="row">
                        <div class="col-sm-4 mt-5">
                            <select name="feature_id[]" class="form-select">
                                <option disabled selected>Bir Özellik seçin...</option>
                                ${options}
                            </select>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <textarea name="feature_description[]" class="form-control" placeholder="İçeriği Yazınız"></textarea>
                        </div>
                        <div class="col-sm-2 mt-5">
                            <button type="button" class="remove-row">
                                <iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon>
                            </button>
                        </div>
                        </div>
                `;
                $('#ozellik-container').append(newRow);
            },
            error: function (error) {
                console.log('Veri çekilirken hata oluştu:', error);
            }
        });
    });

    $(document).on('click', '.remove-row', function () {
        $(this).closest('.row').remove();
    });


})(jQuery);


(function ($) {
    $('#addRows').click(function () {
        // AJAX ile verileri çekiyoruz
        $.ajax({
            url: '/tech/product/get-extra-feature', // API route ya da controller route
            type: 'GET',
            success: function (features) {
                let options = '';
                features.forEach(function (feature) {
                    options += `<option value="${feature.id}">${feature.name}</option>`;
                });

                const newRow = `
                    <div class="row">
                        <div class="col-sm-4 mt-5">
                            <select name="extra_feature_id[]" class="form-select">
                                <option disabled selected>Bir Özellik seçin...</option>
                                ${options}
                            </select>
                        </div>
                        <div class="col-sm-4 mt-5">
                            <textarea name="extra_feature_description[]" class="form-control" placeholder="İçeriği Yazınız"></textarea>
                        </div>
                        <div class="col-sm-2 mt-5">
                            <input name="extra_feature_price[]" type="text" class="form-control" placeholder="Tutarı Yazınız">
                        </div>
                        <div class="col-sm-2 mt-5">
                            <button type="button" class="remove-row">
                                <iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon>
                            </button>
                        </div>
                        </div>
                `;
                $('#ozellik-containers').append(newRow);
            },
            error: function (error) {
                console.log('Veri çekilirken hata oluştu:', error);
            }
        });
    });

    $(document).on('click', '.remove-rows', function () {
        $(this).closest('.row').remove();
    });


})(jQuery);


$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.trashh', function () {
        var destroy_id = $(this).attr('id');
        alertify.confirm('Silme İşlemini Onaylıyor musunuz?', 'Bu İşlem Geri Alınamaz',
            function () {
                var deleteUrl = productDeleteUrl.replace(':destroy_id', destroy_id);
                location.href = deleteUrl;
            },
            function () {
                alertify.error("Silme İşlemi İptal Edildi");
            }
        );
    });
});




