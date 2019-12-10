<?php
namespace FSR_AI;

class User extends BaseModel
{
    const TABLENAME = '`USER`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'FIRSTNAME'        => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'LASTNAME'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'DATE_OF_BIRTH'    => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45  ],
        'DESCRIPTION'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'PICTURE'          => [ 'type' => BaseModel::TYPE_STRING ],
        'EMAIL'            => [ 'type' => BaseModel::TYPE_STRING ],
        'PASSWORD'         => [ 'type' => BaseModel::TYPE_STRING ],
        'ROLE_ID'          => [ 'type' => BaseModel::TYPE_INT ]
    ];

    public static function findUserBySessionUserID(){
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            $where = 'ID = ' . $_SESSION['userId'];     // build the where statement
            return self::findOne($where);
        }else{
            return null;
        }
    }



    public static function createLongLifeCookie($userID, $password){
        $duration = time() + 3600 * 24 * 30;
        setcookie('userId', $userID, $duration, '/');
        setcookie('password', $password, $duration, '/');
    }

    public static function findUserByLoginDataFromPost(){
        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $where = " EMAIL = '" . $email . "' and PASSWORD = '". $password .  "';'";
        return self::findOne($where);
    }

    public static function writeLoginDataToActiveSession($succeedLoggedIn, $userId = null){
        if($succeedLoggedIn){
            $_SESSION['userId'] = $userId;
        }
        $_SESSION['loggedIn'] = $succeedLoggedIn;
    }

    public static function getAge($dateOfBirth){

        return date_diff(date_create($dateOfBirth), date_create(date('d.m.Y')))->format('%y');
    }

    public static function getFullName($firstName, $lastName){
        return $firstName.' '.$lastName;
    }

    public static function checkUserPermissionForPage($roleIdWithPermission, $errorPage){

        $user = User::findUserBySessionUserID();
        if($user  != null) {
            $access = false;                            // default no access to the page

            if(is_array($roleIdWithPermission)){
                foreach ($roleIdWithPermission as $index) { // check the Array with the role ID´s that have access
                    if ($user['ROLE_ID'] == $index) {
                        $access = true;                     //give the permission to join the page
                        break;
                    }
                }
            }else{
                if ($user['ROLE_ID'] == $roleIdWithPermission) {
                    $access = true;                     //give the permission to join the page
                }
            }

            if (!$access) {
                sendHeaderByControllerAndAction('pages', 'errorPage');
            }
        }else{
            sendHeaderByControllerAndAction('pages', 'errorPage');
        }
    }

    public static function checkUniqueUserEntity(){
        $email    = $_POST['email'] ?? null;

        $where = " EMAIL = '" . $email . "';'";
        return (self::findOne($where) == '') ? true : false;
    }

}