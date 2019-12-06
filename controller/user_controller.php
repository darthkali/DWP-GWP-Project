<?php

namespace FSR_AI;


class UserController extends Controller{



    /*------------------------------
    -----------User-----------------
    ------------------------------*/

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';

        $userList = USER::find('', 'getuserinfo');
        $this->_params['userList'] = $userList;
    }

    public function actionLogin()
    {
        $this->_params['title'] = 'Login';
        $this->_params['errorMessage'] = 'Nutzername oder Passwort sind nicht korrekt!';
        $error = false;

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {

            if (isset($_POST['submit']) && isset($_POST['email'])&& isset($_POST['password'])) {
                $user = User::findUserByLoginDataFromPost() ?? null;
                if($user) {
                    User::writeLoginDataToActiveSession(true, $user['ID']);
                    isset($_POST['rememberMe']) ? User::createLongLifeCookie($user['ID'], $user['PASSWORD']): null;
                    header('Location: index.php?c=pages&a=profil');
                }else{
                    $error = true;
                    User::writeLoginDataToActiveSession(false);
                }
            }
        }else{
            header('Location: index.php?c=pages&a=error');
        }
        $this->_params['errorValid'] = $error;
    }

    public function actionLogOut(){
        $this->_params['title'] = 'Ausgeloggt';
    }

    public function actionUserManagement(){

        //Permissions for the page
        $accessUser = 1;    // which user(role_id) has permission to join the page
        $errorPage = 'Location: index.php?c=pages&a=error'; // send the user to the error page if he has no permission
        checkUserPermissionForPage($accessUser,$errorPage);

        $this->_params['title'] = 'Nutzerverwaltung';

        if(isset($_GET['role'])){
            $this->_params['accounts'] = User::find('ROLE_ID <> 3');
        }else{
            $this->_params['accounts'] = User::find('1');
        }

        $this->_params['role'] = $_GET['role'] ?? false;
    }

    public function actionProfil(){
        $this->_params['title'] = 'Profil';
        $where = 'ID = '. $_SESSION['userId'];
        $user = User::findOne($where);
        $this->_params['userProfil'] = $user;
        //debug_to_console($user[0]);

    }

    public function actionRegistration(){
        $this->_params['title'] = 'Registrieren';

    }





}