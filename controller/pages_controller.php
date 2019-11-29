<?php

namespace FSR_AI;

class PagesController extends Controller
{

    protected function loggedInn(){
        if (isset($_POST['submitLogin'])) {
            $error = true;
            $user = logIn($error);
            if (!$error) {
                $_SESSION['user'] = $user;
            }
        } else if (isset($_POST['submitLogout'])) {
            logOut();
        } else if (isset($_COOKIE['userId'])) {
            $error = true;
            $user = logIn($error, true);
            if (!$error) {
                $_SESSION['user'] = $user;
            }
        }

        $loggedIn = isset($_SESSION['user']);
        return $loggedIn;
    }


	public function actionStart()
	{
		$this->_params['title'] = 'Startseite';
	}

    public function actionEvents()
    {
        $this->_params['title'] = 'Events';
    }

    public function actionAboutUs()
    {
        $this->_params['title'] = 'Über Uns';
    }

    public function actionContact()
    {
        $this->_params['title'] = 'Kontakt';
    }

    public function actionUsers()
    {
        $this->_params['title'] = 'Mitglieder';
    }

    public function actionLogin()
    {
        $loggedIn = $this->loggedInn();
        $this->_params['title'] = 'Login';
        if ($loggedIn) {
            $this->_params['changePage'] = 'profil';
        }else{
            $this->_params['changePage'] = 'Login';
        }
    }

    public function actionUserManagement()
    {
        $this->_params['title'] = 'Nutzerverwaltung';
    }

    public function actionEventManagement()
    {
        $this->_params['title'] = 'Nutzerverwaltung';
    }

    public function actionLogOut()
    {
        $this->_params['title'] = 'Ausgeloggt';
    }

    public function actionprofil()
    {
        $this->_params['title'] = 'Profil';
    }

	public function actionImprint()
	{
		$this->_params['title'] = 'Impressum';
	}

    public function actionDataprotection()
    {
        $this->_params['title'] = 'Datenschutz';
    }



}