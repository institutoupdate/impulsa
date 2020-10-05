function fetch(){
    $('body').on('input', "#keyword", function() {
        if($(this).val().length) {
            $('#datafetch').slideDown();
            $.ajax({
                type: "POST",
                url: config.ajax_url,
                data: { action: 'data_fetch', s: $('#keyword').val() },
                success: function(data) {
                    $('#datafetch').html( data );
                }
            });
        } else {
            $('#datafetch').slideUp();
        }
    });
}

