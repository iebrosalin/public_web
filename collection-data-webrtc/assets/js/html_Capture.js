(function() {
    //
    'use strict';

    $.ajaxSetup({
        url: '/ajax.php', // путь к php-обработчику
        type: 'POST', // метод передачи данных
        dataType: 'json', // тип ожидаемых данных в ответе
        beforeSend: function(){ // Функция вызывается перед отправкой запроса
            console.debug('Запрос отправлен. Ждите ответа.');
            // тут можно, к примеру, начинать показ прелоадера, в общем, на ваше усмотрение
        },
        error: function(req, text, error){ // отслеживание ошибок во время выполнения ajax-запроса
            console.error('Упс! Ошибочка: ' + text + ' | ' + error);
        },
        complete: function(){ // функция вызывается по окончании запроса
            console.debug('Запрос полностью завершен!');
            // тут завершаем показ прелоадера, если вы его показывали
        }
    });

    function ajaxSend(selector, type) {
        var $that = $(selector);
        var formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        formData.append('type', type);
        $.ajax({
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            success: function(json){
                if(json){
                    $('#screenshot-img').attr('src',decodeURI(json.src));
                    $('#result').html('Detected face(s): '+json.countFaces);
                }
            }
        });
    };

    $('#file-image').on('change',function (element) {
        var file = element.target.files; // FileList object
        var f = file[0];
        //console.log(f);
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                $('#preview').attr('src', e.target.result);
                $('#preview').attr('title', encodeURI(theFile.name));
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
        ajaxSend('form[name="capture-image"]','htmlCapture');      //  sendAjaxForm('','');
    });
})();