$('a[methods]').on('click',function (e) {
    $('a[methods]').removeClass('active');
    $(this).addClass('active');
    var value=$('#valueRequest').val();
    $.ajax(
        {
            method: $(this).attr('methods'),
            url: "/admin/echo-request/"+$(this).attr('methods'),
            data:{
                value: value,
            },
            success: function ( data ) {
                $( '#resRequest' ).html(data );
            }
        }
    )
});