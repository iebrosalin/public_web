
<h4>Допуск на экзамен</h4>
<form method="POST">

    <?php if( empty($_POST['admission_show']) || $_POST['admission_show'] ==''): ?>

    <div class="form-group">
        <select  class="form-control" name="discipline" >
            <?php foreach ($disciplines as $discipline): ?>
                <option value="<?php echo $discipline ['title'] ?>"> <?php echo $discipline ['title'] ?> </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">

        <button type="submit" class="btn" name="admission_show" value="show" >Показать</button>
    </div>
    <?php else: ?>
    <div class="form-group">
        <button type="submit" class="btn" name="admission_show" value >Назад</button>
    </div>
    <?php endif; ?>

    <?php if($_POST['admission_show'] == 'show' and isset($_POST['discipline'])): ;?>
        <?php foreach ($groups as $group): ?>
        <h6> <?php echo "Группа ".$group['num_grp']; ?></h6>
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>Студент</th>
                    <th>Допуск (Да/Нет)</th>
                </tr>
                </thead>
                <tbody>
                <?php $students=Db::getGroupStud($group['num_grp']); foreach ($students as $stud): ?>
                <tr>

                    <td>
                        <p><?php  echo $stud['name']." ".$stud['soname']; ?></p>
                    </td>
                    <td>
                            <select class="form-control" name="admission[]">
                               <?php if(Db::getAdmissionByIdStud($stud['id'],$_POST['discipline'])['admission']=="1"): ?>
                               <option value="<?php echo $stud['id']."/"."1"; ?>">Да</option>
                               <option value="<?php echo $stud['id']."/"."0"; ?>">Нет</option>
                               <?php else: ?>
                                <option value="<?php echo $stud['id']."/"."0"; ?>">Нет</option>
                                <option value="<?php echo $stud['id']."/"."1"; ?>">Да</option>
                                <?php endif; ?>
                            </select>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
    <button type="submit" class="btn" name="admission_edit" value="<?php echo $_POST['discipline'];?>" >Сохранить</button>
    <?php endif; ?>
