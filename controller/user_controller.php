<?php
namespace FSR_AI;

class UserController extends Controller{

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';
        $filterFunction = '';
        $filterSort = 'ORDER BY FUNCTION_FSR_ID';
        $this->_params['valueFilter'] = 0;
        $this->_params['valueSort'] = 1;

        if(isset($_POST['functionFSRUser']) && $_POST['functionFSRUser'] != 0){
            $filterFunction = ' and FUNCTION_FSR_ID = '. $_POST['functionFSRUser'];
            $this->_params['valueFilter'] = $_POST['functionFSRUser'];
        }

        if(isset($_POST['sortByUser'])){
            $filterSort = User::generateSortClauseForUserPage($_POST['sortByUser']);
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

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false){
            if (isset($_POST['submitLogin']) && isset($_POST['email'])&& isset($_POST['password'])) {
                $user = User::findUserByLoginDataFromPost() ?? null;
                if($user){
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
        session_destroy();
        sendHeaderByControllerAndAction('pages', 'Start');
    }

    public function actionUserManagement(){
        //Permissions for the page
        $accessUser = role::ADMIN;    // which user(role_id) has permission to join the page
        User::checkUserPermissionForPage($accessUser);

        $this->_params['title'] = 'Nutzerverwaltung';
        $sortMember             = 'ORDER BY FIRSTNAME';
        $sortUser               = 'ORDER BY FIRSTNAME';

        if(isset($_GET['sortMember'])) {
            $sortMember = User::generateSortClauseForMember($_GET['sortMember']);
        }

        if(isset($_GET['sortUser'])){
            $sortUser = User::generateSortClauseForUser($_GET['sortUser']);
        }

        $this->_params['accountsMember'] = User::find('ROLE_ID <> ' . role::USER . ' AND END_DATE is null', 'getusermemberhistory', $sortMember);
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

        $this->_params['userRole']          = $userProfilInformations['userRole'];
        $this->_params['userInformation']   = $userProfilInformations['userInformation'];
        $this->_params['title']             = $userProfilInformations['title'];
        $this->_params['colorModeChecked']  = $userProfilInformations['colorModeChecked'];
        $this->_params['userProfil']        = $userProfilInformations['userProfil'];
        $this->_params['errorMessage']      = $userProfilInformations['errorMessage'];
        $this->_params['userFunction']      = $userProfilInformations['userFunction'];
        $this->_params['allRoles']          = $userProfilInformations['allRoles'];
        $this->_params['allFunctions']      = $userProfilInformations['allFunctions'];
        $this->_params['pageTopic']         = $userProfilInformations['pageTopic'];
        $this->_params['pageSubTopic']      = $userProfilInformations['pageSubTopic'];
        $this->_params['errorMessagePassword'] = '';

        // if the user was not found, than we go to the error page.
        // so we can ensure, that the user will be found by the system and not by an edit (e.g.: in the URL) from outside
        if($this->_params['userProfil'] == null){sendHeaderByControllerAndAction('pages', 'errorPage');}

        // Permissions for the page
        // if the role from the session is not equal to one of the roles from the accessUser, then we go to the errorPage
        User::checkUserPermissionForPage($userProfilInformations['accessUser']);

        // changes from the User
        if (isset($_POST['submitProfil'])) {

            // generate a Filename and replace the old File(Picture) with the new one
            $pictureName = User::createUploadedPictureName('pictureProfil');

            $params = [
                'ID'               => ( $userProfilInformations['userProfil']['ID'] === '')  ? null : $userProfilInformations['userProfil']['ID'],
                'FIRSTNAME'        => ( $_POST['firstnameProfil']   === '')  ? null : $_POST['firstnameProfil'],
                'LASTNAME'         => ( $_POST['lastnameProfil']    === '')  ? null : $_POST['lastnameProfil'],
                'DATE_OF_BIRTH'    => ( $_POST['dateOfBirthProfil'] === '')  ? null : $_POST['dateOfBirthProfil'],
                'EMAIL'            => ( $_POST['emailProfil']       === '')  ? null : $_POST['emailProfil'],
                'PICTURE'          => ( $pictureName                === '')  ? null : $pictureName,
                'DESCRIPTION'      => ( $_POST['descriptionProfil'] === '')  ? null : $_POST['descriptionProfil'],
                'PASSWORD'         => null
            ];


            if(isset($_POST['passwordProfil'])){
                debug_to_logFile('password: ' . $_POST['passwordProfil']);
                $params['PASSWORD' ] = ( $_POST['passwordProfil']    === '')  ? null : $_POST['passwordProfil'];
            }

            $newUser = new User($params);

            $eingabeError = [];

            if(!User::validateUser($newUser, $eingabeError)){
                $this->_params['eingabeError'] = $eingabeError;
                return false;
            }

            User::putTheUploadedFileOnTheServerAndRemoveTheOldOne('pictureProfil', USER_PICTURE_PATH , $userProfilInformations['userProfil']['PICTURE'], $pictureName);

            // generate passwordHash and overwrite the clear password
            if(isset($_POST['changePasswordCheckbox'])){
                if(!User::checkPassword($_POST['passwordProfil'], $this->_params['errorMessagePassword'])){return false;}
                $newUser->__set('PASSWORD', User::generatePasswordHash($_POST['passwordProfil']));
             }

            if (User::checkUniqueUserEntityAndReturnID($params['EMAIL']) == $userProfilInformations['userProfil']['ID'] || User::checkUniqueUserEntityAndReturnID($params['EMAIL']) == null) {
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
        $this->_params['errorMessagePassword'] = '';

        if (isset($_POST['submitRegistration'])) {

            $params = [
                'FIRSTNAME'        => ( $_POST['firstnameRegistration']   === '')  ? null : $_POST['firstnameRegistration']  ,
                'LASTNAME'         => ( $_POST['lastnameRegistration']    === '')  ? null : $_POST['lastnameRegistration']   ,
                'DATE_OF_BIRTH'    => ( $_POST['dateOfBirthRegistration'] === '')  ? null : $_POST['dateOfBirthRegistration'],
                'EMAIL'            => ( $_POST['emailRegistration']       === '')  ? null : $_POST['emailRegistration']      ,
                'PASSWORD'         => ( $_POST['passwordRegistration'] === '')  ? null : $_POST['passwordRegistration'],
                'ROLE_ID'          => 3
            ];

            $newUser = new User($params);
            if (User::checkUniqueUserEntityAndReturnID($params['EMAIL']) === null) {

                // validation from the inputFields
                $eingabeError = [];
                if(!User::validateUser($newUser, $eingabeError)){
                    $this->_params['eingabeError'] = $eingabeError;
                    return false;
                }

                if(!User::checkPassword($_POST['passwordRegistration'], $this->_params['errorMessagePassword'])){return false;}
                $newUser->__set('PASSWORD', User::generatePasswordHash($_POST['passwordRegistration']));

                $newUser->save();
                sendHeaderByControllerAndAction('user', 'login');
            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }
        }
    }
}