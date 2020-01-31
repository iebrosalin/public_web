(function() {
alert();
    function hasGetUserMedia() {
        return (navigator.mediaDevices &&
            navigator.mediaDevices.getUserMedia);
    }

    if (hasGetUserMedia()) {
        const captureVideoButton = document.querySelector('#screenshot .capture-button');
        const screenshotButton = document.querySelector('#screenshot-button');
        //const uploadButton = document.querySelector('#upload-button');
        const resultMessage = document.querySelector('#result-message');
        const img = document.querySelector('#screenshot img');
        const video = document.querySelector('#screenshot video');

        const canvas = document.createElement('canvas');

        const constraints = {
            video: {
                width: { min: 1024, ideal: 1280, max: 1920 },
                height: { min: 776, ideal: 720, max: 1080 },
                frameRate: { ideal: 10, max: 15 }
                facingMode: {exact:"user"},

            }
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
            img.src = canvas.toDataURL('image/jpeg');


        };

        function handleSuccess(stream) {
            screenshotButton.disabled = false;
            video.srcObject = stream;
        }
        function handleError (){
            alert('Произошла какая-то ошибка. Попробуйте разрешить доступ к вашей камере.');
        }



    } else {
        alert('GetUserMedia API неподдерживается вашим браузером. Обновите браузер пожалуйста.');
    }
})();
