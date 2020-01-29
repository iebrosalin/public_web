<?php require_once __DIR__ . "/db/Db.php"; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">

    <title>Меню</title>
</head>
<body class="container">
<h1>Ведомость</h1>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="admission-tab" data-toggle="tab" href="#admission" role="tab">Допуск
            на экзамен</a>
        <a class="nav-item nav-link" id="exam-tab" data-toggle="tab" href="#exam" role="tab">Экзамен</a>
    </div>
</nav>
<div class="tab-content mb-5" id="nav-tabContent">
    <div class="tab-pane show active" id="admission" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php require_once __DIR__ . "/admission/index.php"; ?>
    </div>
    <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="nav-profile-tab">
        <?php require_once __DIR__ . "/exam/index.php"; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<script>

    $('#admission-tab').on('click', function (e) {
        e.preventDefault()
        window.location.hash = '#admission';
    });
    $('#exam-tab').on('click', function (e) {
        e.preventDefault()
        window.location.hash = '#exam';
    })
    if (window.location.hash == "#admission") {
        $('#admission-tab').tab('show');
    }

    if (window.location.hash == "#exam") {
        $('#exam-tab').tab('show');
    }
</script>
</body>
</html>
