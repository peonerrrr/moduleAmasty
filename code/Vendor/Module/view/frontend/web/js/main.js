require(['jquery'], function ($) {
    'use strict';

    $(document).ready(function(){
        $('#addToCartByScuProduct').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $('#addToCartByScuProduct').attr('action'),
                data: $(this).serialize(),
                type: 'post',
            })
        });
    });
});




