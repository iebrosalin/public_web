<h4>Экзамен</h4>
<form method="POST">

    <?php if ( empty($_POST['exam_show']) || $_POST['exam_show'] ==''): ?>
        <div class="form-group">
            <select class="form-control" name="discipline">
                <?php foreach ($disciplines as $discipline): ?>
                    <option value="<?php echo $discipline ['title'] ?>"> <?php echo $discipline ['title'] ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="num_grp">
                <?php foreach ($groups as $group): ?>
                    <option value="<?php echo $group ['num_grp'] ?>"> <?php echo $group ['num_grp'] ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">

            <button type="submit" class="btn" name="exam_show" value="show">Показать</button>
        </div>
    <?php else: ?>
        <div class="form-group">

            <button type="submit" class="btn" name="exam_show" value>Назад</button>
        </div>
    <?php endif; ?>

    <?php if ($_POST['exam_show'] == 'show' and isset($_POST['discipline']) and isset($_POST['num_grp'])): ; ?>
        <div class="table-responsive">
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
                            <p><?php echo $stud['name'] . " " . $stud['soname']; ?></p>
                        </td>
                        <td>
                            <p><?php echo $stud['id_zachot'] ?></p>
                        </td>
                        <td>
                            <?php if (Db::getAdmissionByIdStud($stud['id'], $_POST['discipline'])['admission'] == "1"): ?>
                                <select class="form-control" name="mark[]">
                                    <?php $temp = Db::getMarkByIdStud($stud['id'], $_POST['discipline'])[0];
                                    if ($temp == -1): ?>

                                        <option value="<?php echo $stud['id'] . "/" . "3"; ?>">3</option>
                                        <option value="<?php echo $stud['id'] . "/" . "4"; ?>">4</option>
                                        <option value="<?php echo $stud['id'] . "/" . "5"; ?>">5</option>
                                    <?php elseif ($temp == 3): ?>
                                        <option value="<?php echo $stud['id'] . "/" . "3"; ?>">3</option>
                                        <option value="<?php echo $stud['id'] . "/" . "4"; ?>">4</option>
                                        <option value="<?php echo $stud['id'] . "/" . "5"; ?>">5</option>
                                    <?php elseif ($temp == 4): ?>
                                        <option value="<?php echo $stud['id'] . "/" . "4"; ?>">4</option>
                                        <option value="<?php echo $stud['id'] . "/" . "3"; ?>">3</option>
                                        <option value="<?php echo $stud['id'] . "/" . "5"; ?>">5</option><
                                    <?php elseif ($temp == 5): ?>
                                        <option value="<?php echo $stud['id'] . "/" . "5"; ?>">5</option>
                                        <option value="<?php echo $stud['id'] . "/" . "4"; ?>">4</option>
                                        <option value="<?php echo $stud['id'] . "/" . "3"; ?>">3</option>
                                    <?php endif; ?>
                                </select>
                            <?php else: ?>
                                <p>Не допущен</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn" name="exam_edit" value="<?php echo $_POST['discipline']; ?>">Сохранить</button>
    <?php endif; ?>

</form>
