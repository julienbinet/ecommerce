$('document').ready(function () {

    $('.cp').on('keyup select',function () {
        if ($(this).val().length === 5) {
            $.ajax({
                type: 'get',
//                url: "http://dev.ecommerce.com/web/app_dev.php/villes/" + $(this).val(),
                url: Routing.generate('villes', {cp: $(this).val()}),
                beforeSend: function () {
                    if ($(".loading").length == 0) {
                        $("form .ville").parent().prepend('<div class="loading"></div>')
                    }
                    $('.ville option').remove();
                },
                success: function (data) {
                    $.each(data.villes, function (index,value) {
                        $('.ville').append($('<option>', { value : value, text: value }));
                    });
                    $('.loading').remove();
                }
            });
        } else {
            $('.ville').val("");
        }
    });

});