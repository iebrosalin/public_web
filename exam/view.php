<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Экзамен</title>
</head>
<body class="container-fluid">
<h1>Экзамен</h1>
<a href="/">Домой</a>
<form method="POST">

    <?php if(!isset($_POST['sub_show'])): ?>
        <select name="discipline" >
            <?php foreach ($disciplines as $discipline): ?>
                <option value="<?php echo $discipline ['title'] ?>" > <?php echo $discipline ['title'] ?> </option>
            <?php endforeach; ?>
        </select>
        <select name="num_grp" >
            <?php foreach ($groups as $group): ?>
                <option value="<?php echo $group ['num_grp'] ?>" > <?php echo $group ['num_grp'] ?> </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn" name="sub_show" value="show" >Show</button>
    <?php endif; ?>

    <?php if(isset($_POST['sub_show']) and isset($_POST['discipline']) and isset($_POST['num_grp'])): ;?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Студент</th>
                <th>Номер зачетки</th>
                <th>Оценка</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $stud): ?>
                <tr>
                    <td>
                        <p><?php  echo $stud['name']." ".$stud['soname']; ?></p>
                    </td>
                    <td>
                        <p><?php  echo $stud['id_zachot'] ?></p>
                    </td>
                    <td>
                        <?php if(Db::getAdmissionByIdStud($stud['id'],$_POST['discipline'])['admission']=="1"): ?>
                            <select name="mark[]">
                            <?php $temp=Db::getMarkByIdStud($stud['id'],$_POST['discipline'])[0]; if($temp==-1):?>
                   
                                <option value="<?php echo $stud['id']."/"."3"; ?>">3</option>
                                <option value="<?php echo $stud['id']."/"."4"; ?>">4</option>
                                <option value="<?php echo $stud['id']."/"."5"; ?>">5</option>
                            <?php elseif($temp== 3): ?>
                                <option value="<?php echo $stud['id']."/"."3"; ?>">3</option>
                                <option value="<?php echo $stud['id']."/"."4"; ?>">4</option>
                                <option value="<?php echo $stud['id']."/"."5"; ?>">5</option>
                            <?php elseif($temp== 4): ?>
                                <option value="<?php echo $stud['id']."/"."4"; ?>">4</option>
                                <option value="<?php echo $stud['id']."/"."3"; ?>">3</option>
                                <option value="<?php echo $stud['id']."/"."5"; ?>">5</option><
                            <?php elseif($temp== 5): ?>
                                <option value="<?php echo $stud['id']."/"."5"; ?>">5</option>
                                <option value="<?php echo $stud['id']."/"."4"; ?>">4</option>
                                <option value="<?php echo $stud['id']."/"."3"; ?>">3</option>
                            <?php endif;?>
                        </select>
                        <?php else: ?>
                            <p>Не допущен</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn" name="sub_edit" value="<?php echo $_POST['discipline'];?>" >Сохранить</button>
    <?php endif; ?>

</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>