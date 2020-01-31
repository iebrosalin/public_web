<?

namespace Model;



class User extends AbsModel
{
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    public static function checkAdmin()
    {
         if($userId = self::checkLogged()){
             if(self::getUserById($userId)['role']=='admin'){
                 return true;
             }
             else{
                 return false;
             }
         }
         else {
             return false;
         }
    }

    public static function checkAuth(){
        return isset($_SESSION['auth']);
    }

    public static function checkRoleUser($id,$role='admin'){
        return self::getUserById($id)['role']==$role;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function getAuthCode(){
        $code=random_int(1000, 9999);
        $_SESSION['code']=$code;
        return $code;
    }

    public static function checkAuthCode($code){
        if($_SESSION['code']==$code){
            \Model\Helper::p($_SESSION);
            $_SESSION['auth']=true;
            return true;
        }
        return false;
    }

    public static function checkUserData($login, $password){
        return $login!='' || $password !='';
    }

    public static function checkExistUser($login, $password)
    {
        $db = self::getConnection();

        $sql = 'SELECT password,id FROM users WHERE login = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, \PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user && password_verify($password,$user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public static function getUserById($id)
    {
        $db = self::getConnection();

        $sql = 'SELECT * FROM users WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->execute();
        $t=$result->fetch();
        return $t;
    }

    public static function getListUsers($data){
        $db=self::getConnection();
        $order=$data['order'];
        $limit=intval($data['limit']);
        $page=intval($data['page']);
        if($order=='asc'){
            $order="ORDER BY id ASC";
        }
        elseif($order=='desc'){
            $order="ORDER BY id DESC";
        }
        else {
            $order=null;
        }

        if($limit!=null){
            $limit=" LIMIT $limit";
        }

        $sql='SELECT * FROM users '.$order.$limit;
        $result = $db->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $result->execute();

        $usersList = [];
        while ($row = $result->fetch()) {
            $usersList[]=$row;
        }
        if($page!=\Model\User::getMaxPage()){
            $usersList=array_slice($usersList,-\Model\User::getItemPerPage());
        }
        else{
            $usersList=array_slice($usersList,-(\Model\User::countUsers()-\Model\User::getMaxPage()*\Model\User::getItemPerPage()));

        }
        return $usersList;
    }

    public static function countUsers(){
        $db=self::getConnection();
        $result=$db->query("SELECT COUNT(*) FROM `users`");
        return $result->fetch()[0];
    }

    public static function getMaxPage(){
        return round(\Model\User::countUsers()/\Model\User::getItemPerPage());
    }

    public static function getItemPerPage(){
            return 10;
    }
}