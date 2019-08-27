<?php
require './src/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">

    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-T5jhQKMh96HMkXwqVMSjF3CmLcL1nT9//tCqu9By5XSdj7CwR0r+F3LTzUdfkkQf" crossorigin="anonymous">

    <title>Check email</title>
    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 64px;
            height: 64px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 46px;
            height: 46px;
            margin: 1px;
            border-radius: 50%;
            border: 5px solid #cef;
            border-color: #cef transparent #cef transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 ">
            <h5 class="mt-3">Data for scripts</h5>
            <form action="ajax.php" name="form">
                <fieldset>
                <div class="form-group">
                    <label >Email</label>
                    <input type="text" class="form-control" name="email" value="<?= config()->mail?>">
                    <small class="form-text text-muted">Email проверяемого ящика</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="text" class="form-control" name="password" value="<?= config()->password?>">
                    <small  class="form-text text-muted">Пароль от ящика</small>
                </div>
                    <div class="form-group">
                        <label >Subject</label>
                        <input type="text" class="form-control" name="subject" value="<?= config()->subject?>">
                        <small  class="form-text text-muted">Тема отправляемого письма</small>
                    </div>
                    <div class="form-group">
                        <label >Searched email</label>
                        <input type="text" class="form-control" name="searchEmail" value="<?= config()->mail?>">
                        <small class="form-text text-muted">Искомый email</small>
                    </div>
                    <div class="form-group">
                        <label >Searched subject</label>
                        <input type="text" class="form-control" name="searchSubject" value="<?= config()->subject?>">
                        <small class="form-text text-muted">Искомая тема</small>
                    </div>
                <div class="form-group">
                    <label >Webhook URL</label>
                    <input type="url" class="form-control" name="webhook" value="<?= config()->webhook?>">
                    <small class="form-text text-muted">Url куда отправить полученные данные</small>
                </div>
                </fieldset>
            </form>
            <h6>Debug btn</h6>
            <button class="btn btn-primary" name="create">Create new letter</button>
            <button class="btn btn-primary" name="check">Check email</button>
            <button class="btn btn-primary" name="webhook">Send to webhook</button>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-10 ">
            <h6 class="mt-3">Работа скрипта</h6>
            <pre id="res">

            </pre>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<script>
    $('button[name]').on('click',function f(e) {
        // const name=$(this).attr('name');
        const name=$(this).attr('name');
        const data={
            email:input('email'),
            password:input('password'),
            subject:input('subject'),
            url:input('url'),
            searchEmail:input('searchEmail'),
            searchSubject:input('searchSubject'),
            webhook:input('webhook')
        };
        sendAjax(name,data);
        return false;
    });
    function input(name) {
        return $('input[name="'+name+'"]').val();
    }
    function sendAjax(name, data) {
        $( '#res' ).html('<div class="lds-dual-ring"></div>');
        $.ajax(
            {
                method: "post",
                url: "/ajax.php",
                data:{
                    type: name,
                    data: data,
                },
                success: function ( data ) {
                    $( '#res' ).html(data );
                }
            }
        );
    }
</script>
</html>