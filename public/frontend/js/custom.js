$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".add-to-cart").on("click", function (e) {
        e.preventDefault(); // Sayfa yenilenmesini engelle

        let productId = $(this).data("id");
        let productName = $(this).data("name");
        let productPrice = $(this).data("price");
        let productImage = $(this).data("image");
        let productCampaigns = $(this).data("campaigns");
        let productExtraFeatureId = $(this).data("extra_feature_id");
        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                campaigns: productCampaigns,
                extra_features_id: productExtraFeatureId,
            },
            success: function (response) {
                console.log("Başarılı:", response);

                // Sepet sayacı ve toplam fiyat güncellemesi
                $(".cart-count").text(response.cartCount);
                $(".cart-total-price").text("₺" + response.cartTotal.toFixed(2));

                // Minicart içeriğini güncelle
                let minicartHtml = "";
                if (response.cartItems.length > 0) {
                    response.cartItems.forEach(function (item) {
                        minicartHtml += `
                        <li class="d-flex align-items-start">
                            <div class="cart-img">
                                <a href="#"><img src="${item.image}" alt=""></a>
                            </div>
                            <div class="cart-content">
                                <h4><a href="#">${item.name}</a></h4>
                                <div class="cart-price">
                                    <span class="new">₺${parseFloat(item.price).toFixed(2).replace(".", ",")}</span>
                                    <span class="quantity"> x${item.quantity}</span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a href="#" class="remove-from-cart" data-id="${item.id}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </li>
                    `;
                    });

                    minicartHtml += `
                    <li>
                        <div class="total-price">
                            <span class="f-left">Toplam:</span>
                            <span class="f-right">₺${response.cartTotal.toFixed(2).replace(".", ",")}</span>
                        </div>
                    </li>
                    <li>
                        <div class="checkout-link">
                            <a href="/cart">Sepeti Görüntüle</a>
                            <a class="/checkout" href="#">Onaya Gönder</a>
                        </div>
                    </li>
                `;
                } else {
                    minicartHtml = '<li><p class="text-center">Sepetiniz boş.</p></li>';
                }

                $(".minicart").html(minicartHtml); // Minicart'ı güncelle

                toastr.success("Ürün sepete eklendi!");
            },
            error: function (xhr, status, error) {
                console.error("Hata:", xhr.responseText);
                toastr.error("Ürün sepete eklenirken hata oluştu.");
            }
        });
    });


    // Sepetten ürün silme
    $(document).on("click", ".remove-from-cart", function (e) {
        e.preventDefault();

        let productId = $(this).data("id");
        let self = $(this); // Bu satırı ekleyerek doğru referansı alıyoruz

        $.ajax({
            url: "/cart/remove",
            type: "POST",
            data: {
                id: productId
            },
            success: function (response) {
                // Sepet bilgilerini güncelle
                $(".cart-count").text(response.cartCount);
                $(".cart-total-price").text("₺" + response.cartTotal.toFixed(2));

                // Ürünü listeden kaldır
                self.closest("li").remove();

                // Eğer sepet boşsa, "Sepetiniz boş" mesajını göster
                if (response.cartCount === 0) {
                    $(".minicart").html('<li><p class="text-center">Sepetiniz boş.</p></li>');
                }
                toastr.info("Ürün sepetten çıkarıldı!");
            },
            error: function () {
                toastr.error("Ürün silinirken hata oluştu.");
            }
        });
    });
});
