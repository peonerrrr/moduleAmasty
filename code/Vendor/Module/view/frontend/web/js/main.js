require(['jquery','Magento_Customer/js/customer-data'], function ($, customerData) {
    'use strict';

    $(document).ready(function(){
        $("#product-addtocart-button").on('click', function(){
            $("#product_addtocart_form").off("submit");
            $("#product_addtocart_form").on("submit", function (e) {
                e.preventDefault();
            });
        });

        $('#addToCartByScuProduct').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $('#addToCartByScuProduct').attr('action'),
                data: $(this).serialize(),
                type: 'post',
                success: function(data){
                    var section = ['cart'];
                    customerData.invalidate(section);
                    customerData.reload(section, true);
                }
            })
        });
    });
});
