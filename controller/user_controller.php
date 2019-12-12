<?php

namespace FSR_AI;

class UserController extends Controller{

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';
        $userList = User::find('ROLE_ID <> ' . roles::USER);
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
        $this->_params['title'] = 'Ausgeloggt';
    }

    public function actionUserManagement(){
        //Permissions for the page
        $accessUser = roles::ADMIN;    // which user(role_id) has permission to join the page
        $errorPage = 'Location: index.php?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser,$errorPage);

        $this->_params['title'] = 'Nutzerverwaltung';

        if(isset($_GET['role'])){
            $this->_params['accounts'] = User::find('ROLE_ID <> ' . roles::USER);
        }else{
            $this->_params['accounts'] = User::find('1');
        }
        $this->_params['role'] = $_GET['role'] ?? false;
    }

    public function actionProfil()
    {
        //Permissions for the page
        $accessUser = [roles::ADMIN, roles::MEMBER, roles::USER];    // which user(role_id) has permission to join the page
        $errorPage = 'Location: index.php?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser, $errorPage);

        $this->_params['title'] = 'Profil';
        $where = 'ID = ' . $_SESSION['userId'];
        $user = User::findOne($where);
        $this->_params['userProfil'] = $user;
        $this->_params['errorMessage'] = '';


        if (isset($_POST['submitProfil'])) {
            if (basename($_FILES['pictureProfil']['name']) != null) {
                unlink(USER_PICTURE_PATH . $user['PICTURE']);
                debug_to_logFile(basename($_FILES['pictureProfil']['name']));
                $pictureName = createUploadedPictureName('user', 'pictureProfil');
                $picturePath = USER_PICTURE_PATH . $pictureName;
                move_uploaded_file($_FILES['pictureProfil']['tmp_name'], $picturePath);
            }
        }

        if (isset($_POST['submitProfil'])) {
            $params = [
                'ID' => $_SESSION['userId'],
                'FIRSTNAME' => $_POST['firstnameProfil'] ?? null,
                'LASTNAME' => $_POST['lastnameProfil'] ?? null,
                'DATE_OF_BIRTH' => $_POST['dateOfBirthProfil'] ?? null,
                'EMAIL' => $_POST['emailProfil'] ?? null,
                'PASSWORD' => $_POST['passwordProfil'] ?? null,
                'PICTURE' => $pictureName ?? null,
                'DESCRIPTION' => $_POST['descriptionProfil'] ?? null
            ];
            $newUser = new User($params);
            if (User::checkUniqueUserEntity($params['EMAIL']) === $_SESSION['userId'] || User::checkUniqueUserEntity($params['EMAIL']) === null) {
                $newUser->save();
                sendHeaderByControllerAndAction('user', 'profil');
            } else {
                $this->_params['errorMessage'] = "Diese E-Mail wurde schon einmal verwendet. Bitte wählen Sie eine andere!";
            }

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
        if (isset($_COOKIE['colorMode']) && $_COOKIE['colorMode'] = true) {
            $this->_params['colorModeChecked'] = 'checked';
        }else{
            $this->_params['colorModeChecked'] = '';
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

//    public function deleteUserById($userId){
//        User::deleteWhere('id = '.$userId);
//    }
}