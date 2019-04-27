$(function() {
    var arNameForms=['login','auth'];
    for (var name in arNameForms){
        $( 'form[name="'+arNameForms[name]+'"]' ).submit(function( event ) {
            event.preventDefault();
            $('#alert').remove();
            var formData = new FormData(this);
            formData.append('type',this.name);
            $.ajax({
                type: 'POST',
                url: this.action,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    // console.log('s');
                    location.reload();
                },
                error:function (data) {
                    // console.log('e');
                    $('form[name="login"] fieldset button').before(getAlert());
                }
            });
        });
    }

    function getAlert() {
        return "<div id=\"alert\" class=\"alert alert-dismissible alert-danger\">" +
            "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" +
            " Oops! Someone was wrong... " +
            "</div>"
    }

    $('#sortId').on('click',function (e){
        var arrItemsID= [];
        if($(this).attr('data-sort')=='asc'){
            $(this).removeClass('fa-arrow-up');
            $(this).addClass('fa-arrow-down');
            $(this).attr('data-sort','desc');
        }
        else{
            $(this).removeClass('fa-arrow-down');
            $(this).addClass('fa-arrow-up');
            $(this).attr('data-sort','asc');
        }
        $('table tbody').find('tr').each(function () {
            arrItemsID.push(this);
        });

        if($(this).attr('data-sort')=='desc'){
            $(this).removeClass('fa-arrow-up');
            $(this).addClass('fa-arrow-down');
            arrItemsID.sort(function (a,b) {
                // console.log(a);
                return parseInt($(b).attr('data-id-user')) -  parseInt($(a).attr('data-id-user'));
            })
        }
        else{
            $(this).removeClass('fa-arrow-down');
            $(this).addClass('fa-arrow-up');
            arrItemsID.sort(function (a,b) {
                // console.log(a);
                return parseInt($(a).attr('data-id-user')) -  parseInt($(b).attr('data-id-user'));
            })
        }
        var count=0;
        $('table tbody tr').remove();
        for(var i=0; i!=arrItemsID.length; ++i){
            $('table tbody').append(arrItemsID[i]);
        }
    });
    if( !$('a[data-prev]').hasClass('disabled') ){
        $('a[data-prev]').on('click',function (e) {
            var formData=new FormData();
            formData.append('page',parseInt($('a[data-page]').attr('data-page'))-1);
            formData.append('type','pagination');
            formData.append('order', $('#sortId').attr('data-sort'))
            $.ajax({
                type: 'POST',
                url: '/api/ajax.php',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    console.log('s');
                    // location.reload();
                },
                error:function (data) {
                    // console.log('e');
                    $('table').after(getAlert());
                }
            });
        });
    }

        $('li[data-arrow]').on('click',function (e) {
            if( $(this).hasClass('disabled') ){
                return false;
            }
            var formData=new FormData();
            var curPage;
            if($(this).is('[data-prev]')) {
                curPage = parseInt($('a[data-page]').attr('data-page')) - 1;
            }
            else{
                curPage = parseInt($('a[data-page]').attr('data-page')) + 1;
            }
            formData.append('page',curPage);
            formData.append('type','pagination');
            formData.append('order', $('#sortId').attr('data-sort'))
            $.ajax({
                type: 'POST',
                url: '/api/ajax.php',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data){
                    //console.log('s');
                    paginationUser(data,curPage);
                },
                error:function (data) {
                    // console.log('e');
                    $('table').after(getAlert());
                }
            });
        });


    function paginationUser(data,curPage) {
        $('tbody tr').remove();
        $('tbody').append(data.data);

        if(curPage==1){
            $('li[data-prev]').addClass('disabled')
        }
        else if(curPage==data.maxPage){
            $('li[data-next]').addClass('disabled')
        }
        else{
            $('li.page-item').removeClass('disabled');
        }

        $('a[data-page]').attr('data-page', curPage);
        $('a[data-page]').text(curPage);
    }

    $('span[data-view]').on('click',function (e) {
        if($(this).hasClass('active')){
            return false;
        }
        $(this).addClass('active');
        var formData=new FormData();
        formData.append('type','userDetail');
        formData.append('mode','read');
        formData.append('id',$(this).attr('data-id-user'));

        $.ajax({
            type: 'POST',
            url: '/api/ajax.php',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data){
                //console.log('s');
                $('section[data-table-users]').hide();
                $('main').prepend(data);
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
                $(this).removeClass('active');
                var stateObj = { position: "index" };
                history.pushState(stateObj, "", "index.php");
            },
            error:function (data) {
                // console.log('e');
                $('table').after(getAlert());
            }
        });
    });
    $('span[data-edit]').on('click',function (e) {
        var formData=new FormData();
        formData.append('type','userDetail');
        formData.append('mode','edit');
        formData.append('id',$(this).attr('data-id-user'));

        $.ajax({
            type: 'POST',
            url: '/api/ajax.php',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data){
                //console.log('s');
            },
            error:function (data) {
                // console.log('e');
                $('table').after(getAlert());
            }
        });
    });
    $('span[data-delete]').on('click',function (e) {
        var formData=new FormData();
        formData.append('type','userDelete');
        formData.append('id',$(this).attr('data-id-user'));

        $.ajax({
            type: 'POST',
            url: '/api/ajax.php',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data){
                //console.log('s');
            },
            error:function (data) {
                // console.log('e');
                $('table').after(getAlert());
            }
        });
    });

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});