<?php
namespace FSR_AI;

class User extends BaseModel
{
    const TABLENAME = '`USER`';

    public $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT    ],
        'ROLE_ID'          => [ 'type' => BaseModel::TYPE_INT    ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'DATE_OF_BIRTH'    => [ 'type' => BaseModel::TYPE_STRING ],
        'FIRSTNAME'        => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,   'max' => 21   ],
        'LASTNAME'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,   'max' => 24   ],
        'DESCRIPTION'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 100, 'max' => 1000 ],
        'PICTURE'          => [ 'type' => BaseModel::TYPE_STRING, 'min' => 1,   'max' => 28   ],
        'EMAIL'            => [ 'type' => BaseModel::TYPE_STRING, 'min' => 3,   'max' => 62   ],
        'PASSWORD'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 8,   'max' => 60   ]
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

    public static function checkUserPermissionForPage($roleIdWithPermission){
        $user = User::findUserBySessionUserID();
        if($user  != null) {
            if (is_array($roleIdWithPermission)) {
                foreach ($roleIdWithPermission as $index) { // check the Array with the role ID´s that have access
                    if ($user['ROLE_ID'] == $index) {
                        return true;                     //give the permission to join the page
                    }
                }
            } else {
                if ($user['ROLE_ID'] == $roleIdWithPermission) {
                    return true;                     //give the permission to join the page
                }
            }
        }
        sendHeaderByControllerAndAction('pages', 'errorPage');
        return false;
    }

    public static function checkUniqueUserEntity($email){
        $where = " EMAIL = '" . $email . "';'";
        return self::findOne($where)['ID'];
    }

    public static function changeUserRoleAndFunction($userID, $newRole, $newfunctionFSR = null){
        // TODO: Ducumentation about this
        $user = self::findOne('ID = ' . $userID);
        $actualRole = $user['ROLE_ID'];

        if ($actualRole == Role::USER && $newRole == Role::USER) {return true;}

        if($actualRole == Role::USER && $newRole != Role::USER){
            Function_FSR::changeUserFunction($userID,$newfunctionFSR);
        }else if($actualRole != Role::USER && $newRole == Role::USER){
            Function_FSR::changeUserFunction($userID,6);
            Role::changeUserRole($userID,$newRole);
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
                return true;
            }
            return true;
        }
        return false;
    }

    public static function generateUserProfilInformations(){
        if(isset($_GET['userId'])){
            $accessUser = role::ADMIN;    // which user(role_id) has permission to join the page
            $where = 'ID = ' . $_GET['userId'];
            $user = User::findOne($where);
            $userRole = role::ADMIN;
            $userInformation = '&userId='.$_GET['userId'];
            $title = 'Nutzer Ändern';
            $colorModeChecked = '';
            $action = 'userManagement';
        }else{
            $accessUser = [role::ADMIN, role::MEMBER, role::USER];    // which user(role_id) has permission to join the page
            $where = 'ID = ' . $_SESSION['userId'];
            $user = User::findOne($where);
            $userRole = $user['ROLE_ID'];
            $userInformation = '';
            $title = 'Profil';
            if (isset($_COOKIE['colorMode']) && $_COOKIE['colorMode'] == true) {
                $colorModeChecked = 'checked';
            }else{
                $colorModeChecked = '';
            }
            $action = 'profil';
        }

        if($user == null){return null;}

        $errorMessage = '';
        $userFunction = MemberHistory::generateActualMemberHistory($user['ID']);
        $allRoles = Role::find();
        $allFunctions = Function_FSR::find();

        return $paramsInformations = [
            'userProfil'        => $user,
            'accessUser'        => $accessUser,
            'userRole'          => $userRole,
            'userInformation'   => $userInformation,
            'title'             => $title,
            'colorModeChecked'  => $colorModeChecked,
            'errorMessage'      => $errorMessage,
            'userFunction'      => $userFunction,
            'allRoles'          => $allRoles,
            'allFunctions'      => $allFunctions,
            'action'            => $action
        ];
    }

    public static function generateSortClauseForMember($sortMemberGET){
        switch ($sortMemberGET) {
            case 1:
                return $sortMember = 'ORDER BY FIRSTNAME';
            case 2:
                return $sortMember = 'ORDER BY FIRSTNAME DESC';
            case 3:
                return $sortMember = 'ORDER BY LASTNAME';
            case 4:
                return $sortMember = 'ORDER BY LASTNAME DESC';
            case 5:
               return  $sortMember = 'ORDER BY DATE_OF_BIRTH ';
            case 6:
                return $sortMember = 'ORDER BY DATE_OF_BIRTH DESC';
            case 7:
                return $sortMember = 'ORDER BY EMAIL ';
            case 8:
                return $sortMember = 'ORDER BY EMAIL DESC';
            case 9:
                return $sortMember = 'ORDER BY ROLE_ID ';
            case 10:
                return $sortMember = 'ORDER BY ROLE_ID DESC';
            case 11:
                return $sortMember = 'ORDER BY FUNCTION_FSR_ID';
            case 12:
                return $sortMember = 'ORDER BY FUNCTION_FSR_ID DESC';
            default:
                return $sortMember = '';
        }
    }

    public static function generateSortClauseForUser($sortUserGET){
        switch ($sortUserGET) {
            case 1:
                return $sortUser = 'ORDER BY FIRSTNAME';
            case 2:
                return $sortUser = 'ORDER BY FIRSTNAME DESC';
            case 3:
                return  $sortUser = 'ORDER BY LASTNAME';
            case 4:
                return  $sortUser = 'ORDER BY LASTNAME DESC';
            case 5:
                return  $sortUser = 'ORDER BY DATE_OF_BIRTH ';
            case 6:
                return  $sortUser = 'ORDER BY DATE_OF_BIRTH DESC';
            case 7:
                return  $sortUser = 'ORDER BY EMAIL ';
            case 8:
                return  $sortUser = 'ORDER BY EMAIL DESC';
            case 9:
                return  $sortUser = 'ORDER BY ROLE_ID ';
            case 10:
                return  $sortUser = 'ORDER BY ROLE_ID DESC';
            case 11:
                return  $sortUser = 'ORDER BY FUNCTION_FSR_ID';
            case 12:
                return  $sortUser = 'ORDER BY FUNCTION_FSR_ID DESC';
            default:
                return  $sortUser = '';
        }
    }

    public static function generateSortClauseForUserPage($sortUserPOST){
        switch ($sortUserPOST){
            case 1:
                return $filterSort = 'ORDER BY FUNCTION_FSR_ID';
            case 2:
                return $filterSort = 'ORDER BY FIRSTNAME';
            case 3:
                return $filterSort = 'ORDER BY FIRSTNAME DESC';
            case 4:
                return $filterSort = 'ORDER BY LASTNAME';
            case 5:
                return $filterSort = 'ORDER BY LASTNAME DESC';
            default:
                return  $filterSort = '';
        }
    }

    public static function checkPassword($password, &$error){

        if(!preg_match('/[!@#$%&?.]/',$password)) {
            $error =  "Das Passwort muss mindestens eines der folgenden Zeichen beinhalten: ! @ # . $ % & ? ";
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $error =  "Das Passwort muss mindestens einen Großbuchstaben beinhalten";
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $error =  "Das Passwort muss mindestens eine Kleinbuchstaben beinhalten";
            return false;
        }
        return true;
    }
}