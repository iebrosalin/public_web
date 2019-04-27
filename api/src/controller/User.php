<?php


namespace Controller;


class User
{
    public static function app()
    {
        if (\Model\User::checkAdmin()) {
            if (\Model\User::checkAuth()) {
                self::paginationListUsers();
            } else {
                echo \View\User::getAuth();
            }
        } else {
            echo \View\User::getLogin();
        }
    }

    public static function paginationListUsers()
    {
        $arUsers = \Model\User::getListUsers(
            [
                'order' => 'asc',
                'limit' => \Model\User::getItemPerPage()
            ]
        );
        echo \View\User::getListUsers($arUsers);

    }

    public static function login($data)
    {
        $data['login'] = \Model\Helper::sanitize($data['login']);
        $data['password'] = \Model\Helper::sanitize($data['password']);

        $resCheckUserData = \Model\User::checkUserData($data['login'], $data['password']);
        $resCheckExistUser = \Model\User::checkExistUser($data['login'], $data['password']);
        $resCheckRoleUser = \Model\User::checkRoleUser($resCheckExistUser);

        if ($resCheckUserData && $resCheckExistUser && $resCheckRoleUser) {
            \Model\User::auth($resCheckExistUser);
            \Model\Helper::sendMail(\Model\User::getAuthCode());
            echo json_encode('ok');
        }

    }

    public static function auth($data)
    {
        if (\Model\User::checkAuthCode($data['authCode'])) {
            echo json_encode('ok');
        }
    }

    public static function pagination($data)
    {
        echo json_encode(
            [
                'data'=>\View\User::getRowsUsers(
                    \Model\User::getListUsers(
                        [
                            'order' => $data['order'],
                            'limit' => $data['page'] * \Model\User::getItemPerPage(),
                            'page'  => $data ['page'],
                        ]
                    )
                ),
                'maxPage' => \Model\User::getMaxPage(),
            ]
        );
    }

    public static function userDetail($data)
    {
        switch ($data['mode']){
            case 'read':
                echo json_encode(\View\User::getUserDetail(\Model\User::getUserById($data['id'])));
                break;
            case 'edit':
                echo json_encode(\View\User::getUserEdit(\Model\User::getUserById($data['id'])));
                break;
        }


    }

    public static function userEdit($data)
    {
        echo json_encode( 'ok');
    }

    public static function userDelete($data)
    {
        echo json_encode( 'ok' );
    }

}