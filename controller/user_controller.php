<?php

namespace FSR_AI;

class UserController extends Controller{

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';
        $userList = User::find('ROLE_ID <> ' . role::USER);
        $this->_params['userList'] = $userList;
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
        $errorPage = 'Location: ?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser,$errorPage);

        $this->_params['title'] = 'Nutzerverwaltung';

        if(isset($_GET['role'])){
            $this->_params['accounts'] = User::find('ROLE_ID <> ' . role::USER);
        }else{
            $this->_params['accounts'] = User::find('1');
        }
        $this->_params['role'] = $_GET['role'] ?? false;
    }

    public function actionProfil()
    {

        if(isset($_GET['userId'])){
            $accessUser = role::ADMIN;    // which user(role_id) has permission to join the page
            $this->_params['title'] = 'Nutzer Ändern';
            $where = 'ID = ' . $_GET['userId'];
            $user = User::findOne($where);
            $this->_params['permissionSiteElements'] = role::ADMIN;
            $this->_params['userInformation'] = '&userId='.$_GET['userId'];

        }else{
            $accessUser = [role::ADMIN, role::MEMBER, role::USER];    // which user(role_id) has permission to join the page
            $this->_params['title'] = 'Profil';
            $where = 'ID = ' . $_SESSION['userId'];
            $user = User::findOne($where);
            $this->_params['permissionSiteElements'] = $user['ROLE_ID'];
            $this->_params['userInformation'] = '';
            if (isset($_COOKIE['colorMode']) && $_COOKIE['colorMode'] = true) {
                $this->_params['colorModeChecked'] = 'checked';
            }else{
                $this->_params['colorModeChecked'] = '';
            }
        }

        if($user == null){
            sendHeaderByControllerAndAction('pages', 'errorPage');
        }

        //Permissions for the page
        $errorPage = 'Location: ?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser, $errorPage);

        //$user = User::findOne($where);
        $this->_params['userProfil'] = $user;
        $this->_params['errorMessage'] = '';
        //$this->_params['userRole'] =  $_SESSION['userId']['ROLE_ID']


        if (isset($_POST['submitProfil'])) {
            if (basename($_FILES['pictureProfil']['name']) != null) {
                unlink(USER_PICTURE_PATH . $user['PICTURE']);
                $pictureName = createUploadedPictureName('user', 'pictureProfil');
                $picturePath = USER_PICTURE_PATH . $pictureName;
                move_uploaded_file($_FILES['pictureProfil']['tmp_name'], $picturePath);
            }
        }

        if (isset($_POST['submitProfil'])) {
            $params = [
                'ID' => $user['ID'],
                'FIRSTNAME' => $_POST['firstnameProfil'] ?? null,
                'LASTNAME' => $_POST['lastnameProfil'] ?? null,
                'DATE_OF_BIRTH' => $_POST['dateOfBirthProfil'] ?? null,
                'EMAIL' => $_POST['emailProfil'] ?? null,
                'PASSWORD' => $_POST['passwordProfil'] ?? null,
                'PICTURE' => $pictureName ?? null,
                'DESCRIPTION' => $_POST['descriptionProfil'] ?? null
            ];
            $newUser = new User($params);
            if (User::checkUniqueUserEntity($params['EMAIL']) === $user['ID'] || User::checkUniqueUserEntity($params['EMAIL']) === null) {
                $newUser->save();
                sendHeaderByControllerAndAction('user', 'userManagement');
            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }

            // TODO: an Admin can not change a color Mode from a user
            if(!isset($_GET['userId'])) {
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
                'PASSWORD' => $_POST['passwordRegistration'],
                'ROLE_ID' => 3
            ];

            $newUser = new user($params);
            if (User::checkUniqueUserEntity($params['EMAIL']) === null) {
                $newUser->save();
                sendHeaderByControllerAndAction('user', 'login');
            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }
        }
    }

    public function actionChangeUser(){

    }

}