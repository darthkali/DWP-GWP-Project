<?php
namespace FSR_AI;

class User extends BaseModel
{
    const TABLENAME = '`USER`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'FIRSTNAME'        => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 5 ],
        'LASTNAME'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 5 ],
        'DATE_OF_BIRTH'    => [ 'type' => BaseModel::TYPE_STRING],
        'DESCRIPTION'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'PICTURE'          => [ 'type' => BaseModel::TYPE_STRING ],
        'EMAIL'            => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 60 ],
        'PASSWORD'         => [ 'type' => BaseModel::TYPE_STRING,'min' => 2, 'max' => 60 ],
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

    public static function findUserByLoginDataFromPost(){
        $email    = $_POST['email'] ?? null;

        $where = " EMAIL = '" . $email . "';" ;
        $users = self::find($where);
        foreach($users as $user){
            if(User::checkPasswordHash($_POST['password'], $user)){
                return $user;
            }
        }
        return false;
    }

    public static function createLongLifeCookie($data){
        $duration = time() + 3600 * 24 * 30;
        if(is_array($data)){
            foreach ($data as $cookieName => $cookieValue){
                setcookie($cookieName, $cookieValue, $duration, '/');
            }
        }else{
            error_to_logFile("the transfer parameter must be an array");
        }
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

    public static function checkUniqueUserEntity($email){
        $where = " EMAIL = '" . $email . "';'";
        return self::findOne($where)['ID'];

    }

    public static function changeUserRoleAndFunction($userID, $newRole, $newfunctionFSR = null){
    // TODO: transaction Control? Maybe we need a rollback if some of this inserts / updates will fail

        $user = self::findOne('ID = ' . $userID);
        $actualRole = $user['ROLE_ID'];

        if ($actualRole == Role::USER && $newRole == Role::USER) {
            return true;
        }

        if($actualRole == Role::USER && $newRole != Role::USER){
            Function_FSR::changeUserFunction($userID,$newfunctionFSR);
            Role::changeUserRole($userID,$newRole);
            return true;
        }else if($actualRole != Role::USER && $newRole == Role::USER){
            Function_FSR::changeUserFunction($userID,6);
            Role::changeUserRole($userID,$newRole);
            return true;
        }else if ($actualRole == Role::MEMBER && $newRole == Role::ADMIN || $actualRole == Role::ADMIN && $newRole == Role::MEMBER) {
            Function_FSR::changeUserFunction($userID,$newfunctionFSR);
            Role::changeUserRole($userID,$newRole);
        }else{
            Function_FSR::changeUserFunction($user['ID'], $newfunctionFSR);
        }
        return true;
    }

    public static function generatePasswordHash($password){
        return password_hash($password . PEPPER, PASSWORD_BCRYPT, HASHOPTIONS);
    }

    public static function checkPasswordHash($password, $user){
        if (password_verify($password . PEPPER, $user['PASSWORD'])) {
            if (password_needs_rehash($user['PASSWORD'], PASSWORD_BCRYPT, HASHOPTIONS)) {
                $params = [
                    'ID' => $user['ID'],
                    'PASSWORD' => self::generatePasswordHash($password),
                ];
                $newUser = new user($params);
                $newUser->save();
                debug_to_logFile('password Refresh');
                return true;
            }
            debug_to_logFile('password ok');
            return true;
        }
        debug_to_logFile('password nok');
        return false;
    }

}