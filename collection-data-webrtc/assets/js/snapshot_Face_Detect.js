(function() {

    function hasGetUserMedia() {
        return (navigator.mediaDevices &&
            navigator.mediaDevices.getUserMedia);
    }

    if (hasGetUserMedia()) {
        const captureVideoButton = document.querySelector('#screenshot .capture-button');
        const screenshotButton = document.querySelector('#screenshot-button');
        const img = document.querySelector('#screenshot img');
        const video = document.querySelector('#screenshot video');

        const canvas = document.createElement('canvas');

        const constraints = {
            video: {
                height: 1280,
                width: 720,
                frameRate: { ideal: 10, max: 15 },
                facingMode: {exact:"user"},
            },

        };

        captureVideoButton.onclick = function() {
            navigator.mediaDevices.getUserMedia(  constraints).
            then(handleSuccess).catch(handleError);
        };

        screenshotButton.onclick = video.onclick = function() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            // Other browsers will fall back to image/png
            img.src = canvas.toDataURL('image/png');
            ajaxSend('snapshotFaceDetect');

        };

        function handleSuccess(stream) {
            screenshotButton.disabled = false;
            video.srcObject = stream;
        }
        function handleError (){
            alert('Произошла какая-то ошибка. Попробуйте разрешить доступ к вашей камере.');
        }

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

        function ajaxSend(type) {
            var formData = new FormData(); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
            formData.append('type', type);
            formData.append('data', img.src);
            $.ajax({
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false, // важно - убираем преобразование строк по умолчанию
                data: formData,
                success: function(json){
                    if(json){
                        $('#screenshot-img[data-show]').attr('src',decodeURI(json.src));
                        $('#result').html('Detected face(s): '+json.countFaces);
                    }
                }
            });
        };


    } else {
        alert('GetUserMedia API неподдерживается вашим браузером. Обновите браузер пожалуйста.');
    }
})();
