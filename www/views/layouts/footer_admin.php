</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
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
</script>
</body>
</html>