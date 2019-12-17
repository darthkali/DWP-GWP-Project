<?php

namespace FSR_AI;

class UserController extends Controller{

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';
        $filterFunction = '';
        $filterSort = 'ORDER BY FUNCTION_FSR_ID';
        $this->_params['valueFilter'] = 0;
        $this->_params['valueSort'] = 1;
        //debug_to_logFile($_POST['functionFSRUser']);
        if(isset($_POST['functionFSRUser']) && $_POST['functionFSRUser'] != 0){
            $filterFunction = ' and FUNCTION_FSR_ID = '. $_POST['functionFSRUser'];
            $this->_params['valueFilter'] = $_POST['functionFSRUser'];
        }

        if(isset($_POST['sortByUser'])){
            switch ($_POST['sortByUser']){
                case 1: $filterSort = 'ORDER BY FUNCTION_FSR_ID';
                    break;
                case 2: $filterSort = 'ORDER BY FIRSTNAME';
                    break;
                case 3: $filterSort = 'ORDER BY FIRSTNAME DESC';
                    break;
                case 4: $filterSort = 'ORDER BY LASTNAME';
                    break;
                case 5: $filterSort = 'ORDER BY LASTNAME DESC';
            }
            $this->_params['valueSort'] = $_POST['sortByUser'];
        }

        $userList = User::find('END_DATE is null' . $filterFunction, 'getusermemberhistory', $filterSort);
        $this->_params['userList'] = $userList;
        $this->_params['allFunctions'] = Function_FSR::find();
    }

    public function actionLogin(){
        $this->_params['title'] = 'Login';
        $this->_params['errorMessage'] = 'Nutzername oder Passwort sind nicht korrekt!';
        $error = false;

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
        {
            if (isset($_POST['submit']) && isset($_POST['email'])&& isset($_POST['password'])) {
                $user = User::findUserByLoginDataFromPost() ?? null;
                if($user) {
                    User::writeLoginDataToActiveSession(true, $user['ID']);
                    $cookieData = array("userId"=>$user['ID'], "password"=>$user['PASSWORD']);
                    isset($_POST['rememberMe']) ? User::createLongLifeCookie($cookieData): null;
                    sendHeaderByControllerAndAction('user', 'profil');
                }else{
                    $error = true;
                    User::writeLoginDataToActiveSession(false);
                }
            }
        }else{
            sendHeaderByControllerAndAction('pages', 'error');
        }
        $this->_params['errorValid'] = $error;
    }

    public function actionLogOut(){
        setcookie('userId','',-1,'/');
        setcookie('password','',-1,'/');
        setcookie('colorMode','',-1,'/');
        unset($_SESSION['users']);
        session_destroy();
        session_write_close();
        sendHeaderByControllerAndAction('pages', 'Start');
    }

    public function actionUserManagement(){
        //Permissions for the page
        $accessUser = role::ADMIN;    // which user(role_id) has permission to join the page
        User::checkUserPermissionForPage($accessUser);

        $this->_params['title'] = 'Nutzerverwaltung';
        $sortMember = 'ORDER BY FIRSTNAME';
        $sortUser ='ORDER BY FIRSTNAME';
        $this->_params['valueSort'] = 1;
//        if(isset($_POST['sortByUser'])){
//            switch ($_POST['sortByUser']){
//
//                case 1:
//                    $sortMember = 'ORDER BY FIRSTNAME';
//                    $sortUser = 'ORDER BY FIRSTNAME';
//                    break;
//                case 2:
//                    $sortMember = 'ORDER BY FIRSTNAME DESC';
//                    $sortUser = 'ORDER BY FIRSTNAME DESC';
//                    break;
//                case 3:
//                    $sortMember = 'ORDER BY LASTNAME';
//                    $sortUser = 'ORDER BY LASTNAME';
//                    break;
//                case 4:
//                    $sortMember = 'ORDER BY LASTNAME DESC';
//                    $sortUser = 'ORDER BY LASTNAME DESC';
//                    break;
//                case 5:
//                    $sortMember = 'ORDER BY FUNCTION_FSR_ID';
//                    $sortUser = 'ORDER BY FIRSTNAME';
//                    break;
//                case 6:
//                    $sortMember = 'ORDER BY ROLE_ID';
//                    $sortUser = 'ORDER BY FIRSTNAME';
//
//            }
//            $this->_params['valueSort'] = $_POST['sortByUser'];
//        }

        if(isset($_GET['sortMember'])) {
            switch ($_GET['sortMember']) {

                case 1:
                    $sortMember = 'ORDER BY FIRSTNAME';
                    break;
                case 2:
                    $sortMember = 'ORDER BY FIRSTNAME DESC';
                    break;
                case 3:
                    $sortMember = 'ORDER BY LASTNAME';
                    break;
                case 4:
                    $sortMember = 'ORDER BY LASTNAME DESC';
                    break;
                case 5:
                    $sortMember = 'ORDER BY DATE_OF_BIRTH ';
                    break;
                case 6:
                    $sortMember = 'ORDER BY DATE_OF_BIRTH DESC';
                    break;
                case 7:
                    $sortMember = 'ORDER BY EMAIL ';
                    break;
                case 8:
                    $sortMember = 'ORDER BY EMAIL DESC';
                    break;
                case 9:
                    $sortMember = 'ORDER BY ROLE_ID ';
                    break;
                case 10:
                    $sortMember = 'ORDER BY ROLE_ID DESC';
                    break;
                case 11:
                    $sortMember = 'ORDER BY FUNCTION_FSR_ID';
                    break;
                case 12:
                    $sortMember = 'ORDER BY FUNCTION_FSR_ID DESC';

            }
            $this->_params['valueSort'] = $_GET['sortMember'];
        }

            if(isset($_GET['sortUser'])){
                switch ($_GET['sortUser']){

                    case 1:
                        $sortUser = 'ORDER BY FIRSTNAME';
                        break;
                    case 2:
                        $sortUser = 'ORDER BY FIRSTNAME DESC';
                        break;
                    case 3:
                        $sortUser = 'ORDER BY LASTNAME';
                        break;
                    case 4:
                        $sortUser = 'ORDER BY LASTNAME DESC';
                        break;
                    case 5:
                        $sortUser = 'ORDER BY DATE_OF_BIRTH ';
                        break;
                    case 6:
                        $sortUser = 'ORDER BY DATE_OF_BIRTH DESC';
                        break;
                    case 7:
                        $sortUser = 'ORDER BY EMAIL ';
                        break;
                    case 8:
                        $sortUser = 'ORDER BY EMAIL DESC';
                        break;
                    case 9:
                        $sortUser = 'ORDER BY ROLE_ID ';
                        break;
                    case 10:
                        $sortUser = 'ORDER BY ROLE_ID DESC';
                        break;
                    case 11:
                        $sortUser = 'ORDER BY FUNCTION_FSR_ID';
                        break;
                    case 12:
                        $sortUser = 'ORDER BY FUNCTION_FSR_ID DESC';

                }
            $this->_params['valueSort'] = $_GET['sortUser'];
        }

            $this->_params['accountsMember'] = User::find('ROLE_ID <> ' . role::USER, 'getusermemberhistory', $sortMember);
            $this->_params['accountsUser'] = User::find('ROLE_ID = ' . role::USER, null, $sortUser);//, 'getusermemberhistory', $sortUser);


        if(isset($_GET['userId'])){
            Booking::deleteWhere('USER_ID = '.$_GET['userId']);
            MemberHistory::deleteWhere('MEMBER_ID = '.$_GET['userId']);
            User::deleteWhere('ID = '.$_GET['userId']);
            sendHeaderByControllerAndAction('user', 'userManagement');
        }
    }

    public function actionProfil(){

        // generate Informations about the User
        //
        // decide the Informations based on 2 points:
        // the admin will change a user profil
        // or
        // a user (also the admin) will change his own profil
        $userProfilInformations = User::generateUserProfilInformations();

        $this->_params['userRole'] = $userProfilInformations['userRole'];
        $this->_params['userInformation'] = $userProfilInformations['userInformation'];
        $this->_params['title'] = $userProfilInformations['title'];
        $this->_params['colorModeChecked'] = $userProfilInformations['colorModeChecked'];
        $this->_params['userProfil'] = $userProfilInformations['userProfil'];
        $this->_params['errorMessage'] = $userProfilInformations['errorMessage'];
        $this->_params['userFunction'] = $userProfilInformations['userFunction'];
        $this->_params['allRoles'] = $userProfilInformations['allRoles'];
        $this->_params['allFunctions'] = $userProfilInformations['allFunctions'];

        // if the user was not found, than we go to the error page.
        // so we can ensure, that the user will be found by the system and not by an edit (e.g.: in the URL) from outside
        if($this->_params['userProfil'] == null){sendHeaderByControllerAndAction('pages', 'errorPage');}

        // Permissions for the page
        // if the role from the session is not equal to one of the roles from the accessUser, then we go to the errorPage
        User::checkUserPermissionForPage($userProfilInformations['accessUser']);

        // changes from the User
        if (isset($_POST['submitProfil'])) {

            // generate a Filename and replace the old File(Picture) with the new one
            $pictureName = User::putTheUploadetFileOnTheServerAndRemoveTheOldOne('pictureProfil', USER_PICTURE_PATH , $userProfilInformations['userProfil']['PICTURE']);

            $password = (isset($_POST['changePasswordCheckbox'])) ? $_POST['passwordProfil'] : null;

            $params = [
                'ID'            => $userProfilInformations['userProfil']['ID']  ?? null,
                'FIRSTNAME'     => $_POST['firstnameProfil']                    ?? null,
                'LASTNAME'      => $_POST['lastnameProfil']                     ?? null,
                'DATE_OF_BIRTH' => $_POST['dateOfBirthProfil']                  ?? null,
                'EMAIL'         => $_POST['emailProfil']                        ?? null,
                'PICTURE'       => $pictureName                                 ?? null,
                'DESCRIPTION'   => $_POST['descriptionProfil']                  ?? null,
                'PASSWORD'      => $password
            ];
            $newUser = new User($params);

            // validation from the inputFields
            $eingabeError = [];
            if(!$newUser->validate($eingabeError)){
                $this->_params['eingabeError'] = $eingabeError;
                return false;
            }

            // generate passwordHash and overwrite the clear password
            if(isset($_POST['changePasswordCheckbox'])){
              $newUser->__set('PASSWORD', User::generatePasswordHash($_POST['passwordProfil']));
             }

            if (User::checkUniqueUserEntity($params['EMAIL']) == $userProfilInformations['userProfil']['ID'] || User::checkUniqueUserEntity($params['EMAIL']) == null) {
                $newUser->save();

                $where = 'ID = ' . $_SESSION['userId'];
                $userAdmin = User::findOne($where);
                if ($userAdmin['ROLE_ID'] == Role::ADMIN) {
                    User::changeUserRoleAndFunction($userProfilInformations['userProfil']['ID'], $_POST['roleProfil'], $_POST['functionFSRProfil']);
                }

                // based on the incoming action: send the user to his main page (Profil, UserManagemant)
                sendHeaderByControllerAndAction('user', $userProfilInformations['action']);

            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }

            // check if the darkMode is enabled and create the cookie if its necessary
            if (!isset($_GET['userId'])) {
                if (isset($_POST['colorCheckbox'])) {
                    $colorModeData = array("colorMode" => true);
                    User::createLongLifeCookie($colorModeData);
                } else {
                    if (isset($_COOKIE['colorMode'])) {
                        $colorModeData = array("colorMode" => false);
                        User::createLongLifeCookie($colorModeData);
                    }
                }
            }
        }
    }

    public function actionRegistration(){
        $this->_params['title'] = 'Registrieren';
        $this->_params['errorMessage'] = '';

        if (isset($_POST['submitRegistration'])) {
            $params = [
                'FIRSTNAME' => $_POST['firstnameRegistration'],
                'LASTNAME' => $_POST['lastnameRegistration'],
                'DATE_OF_BIRTH' => $_POST['dateOfBirthRegistration'],
                'EMAIL' => $_POST['emailRegistration'],
                'PASSWORD' => User::generatePasswordHash($_POST['passwordRegistration']),
                'ROLE_ID' => 3
            ];

            $newUser = new User($params);
            if (User::checkUniqueUserEntity($params['EMAIL']) === null) {
                $newUser->save();
                sendHeaderByControllerAndAction('user', 'login');
            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }
        }
    }
}