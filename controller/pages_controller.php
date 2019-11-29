<?php

namespace FSR_AI;

class PagesController extends Controller
{
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

	public function actionImprint()
	{
		$this->_params['title'] = 'Impressum';
	}

    public function actionDataprotection()
    {
        $this->_params['title'] = 'Datenschutz';
    }



}