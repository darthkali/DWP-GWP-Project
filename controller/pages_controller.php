<?php

namespace FSR_AI;

class PagesController extends Controller
{

    protected function loggedInn(){

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
        $this->_params['title'] = 'Login';
        $this->_params['errorMessage'] = 'Nutzername oder Passwort sind nicht korrekt!';
        $error = false;

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
            if (isset($_POST['submit'])) {
                $email    = $_POST['loginName'] ?? null;
                $password = $_POST['loginPassword'] ?? null;
                // TODO SQL-Statement einfügen

                $where = User::buildWhereLogin($email,$password);   //Build the where statement to search the Login
                if(User::find($where))
                {
                    $_SESSION['loggedIn'] = true;
                    header('Location: index.php?c=pages&a=profil');
                }
                else
                {
                    $error = true;
                    $_SESSION['loggedIn'] = false;

                }
            }
        }else{
            header('Location: index.php?c=pages&a=start');
        }
        $this->_params['errorValid'] = $error;
    }

    public function actionLogOut()
    {
        $this->_params['title'] = 'Ausgeloggt';
    }


    public function actionUserManagement()
    {
        $this->_params['title'] = 'Nutzerverwaltung';

        if(0){
            $this->_params['accounts'] = User::find('not (ROLE_ID = 3)');
        }else{
            $this->_params['accounts'] = User::find('1');
        }

    }

    public function actionEventManagement()
    {
        $this->_params['title'] = 'Nutzerverwaltung';
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

    public function actionErrorPage()
    {
        $this->_params['title'] = 'Fehler';
    }



}