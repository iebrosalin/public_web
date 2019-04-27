<?php

namespace View;


class User
{
    public static function getPreloader()
    {
        return <<<VIEW
            <div class="wrapper-preloader">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
            </div>
VIEW;

    }

    public static function getLogin()
    {
        return <<<VIEW
                <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <form name="login" method="post" action="/api/ajax.php" enctype="multipart/form-data">
              <fieldset>
                <legend>Please log in to admin panel</legend>
                <div class="form-group">
                  <label for="exampleInputEmail1">Login</label>
                  <input type="text" class="form-control" name="login"  placeholder="Enter login">
                  <small class="form-text text-muted">We'll never share your login with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </fieldset>
        </form>
            </div>
        </div>
VIEW;
    }

    public static function getListUsers($arUsers)
    {
        $tableHead = '';

        $arFileds = self::getHeadTable();
        foreach ($arFileds as $field) {
            $field=$field=='id'?$field.'<i id="sortId" class="fa fa-arrow-up" aria-hidden="true" data-sort="asc"></i>':$field;
            $tableHead .= <<<TH
            <th scope="col">$field</th>
TH;
        }
        $tableBody=self::getRowsUsers($arUsers,$arFileds);
        $pagination=self::getPagination(1);
        return <<<VIEW
        <section data-table-users>
            <div class="row ">
        <div class="col-12 text-center">
            <h2>List users</h2>
        </div>
    </div>
                <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">        
        <table class="table table-hover text-center">
            <thead>
                    <tr>
                        $tableHead
                    </tr>
            </thead>
            <tbody>
                $tableBody 
            </tbody>
        </table>
            $pagination
           </div>
        </div>
</section>
VIEW;
    }

    public static function getRowsUsers($arUsers){
        $tableBody = '';
        //$tableRow = '';
        $arFileds = self::getHeadTable();
        foreach ($arUsers as $user) {
            $tableRow = '';
            $idUser=$user['id'];
            foreach ($user as $k => $v) {
                if ($k == 'id') {
                    $tableRow .= <<<TH
                     <th  scope="row">$v</th>
TH;
                } else {
                    if (in_array($k, $arFileds)) {
                        $tableRow .= <<<TD
                     <td>$v</td>
TD;
                    }
                }
            }
            $tableRow.=<<<TD
            <td class="action-icon">
                <span data-id-user="$idUser" data-view><i class="fa fa-eye" aria-hidden="true"></i></span>
                <span data-id-user="$idUser" data-edit><i class="fa fa-pencil" aria-hidden="true"></i></span>
                <span data-id-user="$idUser" data-delete><i class="fa fa-trash" aria-hidden="true"></i></span>
            </td>
TD;
            $tableBody .= "<tr data-id-user=\"$idUser\">" . $tableRow . "</tr>";
        }
        return $tableBody;
    }

    public static function getHeadTable(){
        return ['id', 'name', 'soname','action'];
    }
    public static function getAuth()
    {
        return <<<VIEW
                <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <form name="auth" method="post" action="/api/ajax.php" enctype="multipart/form-data">
              <fieldset>
                <legend>Please enter the code you received.</legend>
                <div class="form-group">
                  <label for="exampleInputEmail1">Login</label>
                  <input type="text" class="form-control" name="authCode"  placeholder="Enter code">
                  <small class="form-text text-muted">Do not tell this code to other people.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </fieldset>
        </form>
            </div>
        </div>
VIEW;
    }

    public static function getPagination($page){

        $maxPage=floor(\Model\User::countUsers()/\Model\User::getItemPerPage());
        $disablePrev='';
        $disableNext='';
        if($page==$maxPage){
            $disableNext='disabled';
        }
        else if($page==1){
            $disablePrev='disabled';
        }
        return <<<VIEW
        <div class="block-center">
              <ul class="pagination">
                <li class="page-item $disablePrev" data-arrow data-prev>
                  <a class="page-link">&laquo;</a>
                </li>
                <li class="page-item">
                  <a class="page-link" data-page="$page">$page</a>
                </li>
               
                <li class="page-item $disableNext" data-arrow data-next>
                  <a class="page-link" >&raquo;</a>
                </li>
              </ul>
        </div>
VIEW;
    }

    public static function getUserDetail($data){
        $name=$data['name'];
        $soname=$data['soname'];


        return <<<VIEW
        <section data-user-detail>
                    <div class="row ">
        <div class="col-12 text-center">
            <h2>Detail page $name $soname</h2>
        </div>
    </div>
                        <div class="row ">
        <div class="col-12 text-center">
//            <h2>Detail page $name $soname</h2>
        </div>
    </div>
             <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6" data-user-container>    
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control-plaintext" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control-plaintext" value="email@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                    
                        <label for="staticEmail" class="col-sm-2 col-form-label">Burthday</label>
                        <div class="col-sm-10">
                                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control-plaintext" value="email@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                       
                            <input type="text" readonly="" class="form-control-plaintext" value="email@example.com">
                        </div>
                    </div>
                </div>
             </div>
        </section>
VIEW;
    }

    public static function getUserEdit($data){

    }

}


?>

