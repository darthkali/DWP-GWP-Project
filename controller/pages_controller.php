<?php

namespace FSR_AI;

class PagesController extends Controller{

    protected function loggedInn(){

    }

	public function actionStart(){
		$this->_params['title'] = 'Startseite';
	}

    public function actionEvents(){
        $this->_params['title'] = 'Events';
        $this->_params['eventList'] = Event::find('', 'geteventinfo');
    }

    public function actionSubscribe(){
        $eventId = $_GET['event'] ?? '';
        $_SESSION['event'] = isset($_SESSION['event']) ? !$_SESSION['event'] : true;

        header('Location: index.php?c=pages&a=events&id='.$eventId);
        exit(0);
    }

    public function actionCreateEvent(){
        $this->_params['title'] = 'Event Erstellen';
        $this->_params['locationsList'] = Location::find();
    }

    public function actionIntoDatabase(){
        $siteId = $_GET['siteId'];
        if($siteId == 0) {
            $this->_params['title'] = 'Event Erstellen';
            if (isset($_POST['eventName'])) {
                $params = [
                    'NAME'          => $_POST['eventName'],
                    'DATE'          => $_POST['eventDate'],
                    'PICTURE'       => '20191025-_MG_2335.jpg',
                    'LOCATION_ID'   => $_POST['eventLocation'],
                    'DESCRIPTION'   => $_POST['eventDescription']
                ];
                $event = new event($params);
                foreach ($params as $key => $value) {
                    $event->__set($key, $value);
                }
                $event->save();
            }
        }elseif($siteId == 1){
            $this->_params['title'] = 'Location Erstellen';
            if (isset($_POST['locationStreet'])) {
                $params = [
                    'STREET'        => $_POST['locationStreet'],
                    'NUMBER'        => $_POST['locationNumber'],
                    'ZIPCODE'       => $_POST['locationZipcode'],
                    'CITY'          => $_POST['locationCity'],
                    'ROOM'          => $_POST['locationRoom']
                ];
                $location = new location($params);
                foreach ($params as $key => $value) {
                    $location->__set($key, $value);
                }
                $location->save();
            }
        }
    }

    public function actionCreateLocation(){
        $this->_params['title'] = 'Location Erstellen';
    }

    public function actionAboutUs(){
        $this->_params['title'] = 'Über Uns';
    }

    public function actionContact(){
        $this->_params['title'] = 'Kontakt';
    }

    public function actionUsers(){
        $this->_params['title'] = 'Mitglieder';
    }

    public function actionLogin(){
        $this->_params['title'] = 'Login';
        $this->_params['errorMessage'] = 'Nutzername oder Passwort sind nicht korrekt!';
        $error = false;

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
            if (isset($_POST['submit'])) {
                $email    = $_POST['loginName'] ?? null;
                $password = $_POST['loginPassword'] ?? null;
                // TODO SQL-Statement einfügen

                $where = User::buildWhereLogin($email,$password);   //Build the where statement to search the Login
                if(User::find($where)){
                    $_SESSION['loggedIn'] = true;
                    header('Location: index.php?c=pages&a=profil');
                }
                else{
                    $error = true;
                    $_SESSION['loggedIn'] = false;
                }
            }
        }else{
            header('Location: index.php?c=pages&a=start');
        }
        $this->_params['errorValid'] = $error;
    }

    public function actionLogOut(){
        $this->_params['title'] = 'Ausgeloggt';
    }

    public function actionUserManagement(){
        $this->_params['title'] = 'Nutzerverwaltung';

        if(0){
            $this->_params['accounts'] = User::find('not (ROLE_ID = 3)');
        }else{
            $this->_params['accounts'] = User::find('1');
        }
    }

    public function actionEventManagement(){
        $this->_params['title'] = 'Nutzerverwaltung';
    }

    public function actionprofil(){
        $this->_params['title'] = 'Profil';
    }

	public function actionImprint(){
		$this->_params['title'] = 'Impressum';
	}

    public function actionDataprotection(){
        $this->_params['title'] = 'Datenschutz';
    }

    public function actionErrorPage(){
        $this->_params['title'] = 'Fehler';
    }
}