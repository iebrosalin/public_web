<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Edit admission</title>
</head>
<body class="container-fluid">
<h1>Admission</h1>
<a href="/">Home</a>
<form method="POST">

    <?php if(!isset($_POST['sub_show'])): ?>
    <select name="discipline" >
        <?php foreach ($disciplines as $discipline): ?>
        <option value="<?php echo $discipline ['title'] ?>"> <?php echo $discipline ['title'] ?> </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn" name="sub_show" value="show" >Show</button>
    <?php endif; ?>

    <?php if(isset($_POST['sub_show']) and isset($_POST['discipline'])): ;?>
        <?php foreach ($groups as $group): ?>
        <h2> <?php echo "Group ".$group['num_grp']; ?></h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Discipline</th>
                <th>FI student</th>
                <th>Admission (yes/no)</th>
            </tr>
            </thead>
            <tbody>
            <?php $students=Db::getGroupStud($group['num_grp']); foreach ($students as $stud): ?>
            <tr>
                <td>
                    <p><?php echo $_POST['discipline'];?></p>
                </td>
                <td>
                    <p><?php  echo $stud['name']." ".$stud['soname']; ?></p>
                </td>
                <td>
                        <select name="admission[]">
                           <?php if(Db::getAdmissionByIdStud($stud['id'],$_POST['discipline'])['admission']=="1"): ?>
                           <option value="<?php echo $stud['id']."/"."1"; ?>">Yes</option>
                           <option value="<?php echo $stud['id']."/"."0"; ?>">No</option>
                           <?php else: ?>
                            <option value="<?php echo $stud['id']."/"."0"; ?>">No</option>
                            <option value="<?php echo $stud['id']."/"."1"; ?>">Yes</option>
                            <?php endif; ?>
                        </select>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
    <button type="submit" class="btn" name="sub_edit" value="<?php echo $_POST['discipline'];?>" >Edit</button>
    <?php endif; ?>

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>