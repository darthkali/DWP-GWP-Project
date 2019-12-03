<?php

namespace FSR_AI;

use DateTime;

class PagesController extends Controller{

    protected function loggedInn(){

    }

    public function actionStart(){
        $this->_params['title'] = 'Startseite';
    }

    public function actionBooking(){
        $this->_params['title'] = 'Eventanmeldung';
        $userId = $_SESSION['userId'];
        $eventId = $_GET['eventId'];

        $booking = Booking::find(Booking::buildWhereBooking($userId, $eventId));

        if(!$booking){
                $params = [
                    'EVENT_ID'   => $eventId,
                    'USER_ID'     => $userId
                ];
                $booking = new booking($params);
                foreach ($params as $key => $value) {
                    $booking->__set($key, $value);
                }
                $booking->save();
                $_SESSION['eventButton'] = 'Abmelden';
        }else{
            Booking::deleteWhere(Booking::buildWhereBooking($userId, $eventId));
        }
    }

    public function actionEditEvent(){
        $this->_params['title'] = 'Event bearbeiten';
        $this->_params['delete'] = $_GET['delete'];
        $dataDir = 'assets/images/upload/';

        if($_GET['delete'] == 1){
            unlink($dataDir.$_GET['picturePath']);
            Event::deleteWhere('id = '.$_GET['eventId']);
        }else{
            $this->_params['eventData'] = Event::findOne('id = '.$_GET['eventId']);
        }
    }

    public function actionEvents(){
        $this->_params['title'] = 'Events';

        $eventList = Event::find('', 'geteventinfo', ' ORDER BY DATE DESC');
        $this->_params['eventList'] = $eventList;
    }

    public function actionCreateEvent(){
        $this->_params['title'] = 'Event Erstellen';
        $this->_params['locationsList'] = Location::find();
        $this->_params['eventData'] = null;
        $this->_params['create'] = true;
        if(isset($_GET['eventId'])) {
            $this->_params['eventData'] = Event::findOne('id = ' . $_GET['eventId']);
            $this->_params['create'] = false;
        }
    }

    public function actionIntoDatabase(){
        $siteId = $_GET['siteId'];
        $this->_params['siteId'] = $siteId;

        if($siteId == 0) {
            $this->_params['title'] = 'Event Erstellen';
            $eventId = $_GET['eventId'] ?? null;
            $pictureName = null;
            $dataDir = 'assets/images/upload/';

            if(!($_FILES['eventPicture']['name'] == null)){
                $pictureName = 'event'.date('d-m-Y-H-i-s').strstr($_FILES['eventPicture']['name'], '.');
                if(isset($_GET['picturePath'])){
                    unlink($dataDir.$_GET['picturePath']);
                }
            }
            if (isset($_POST['eventName'])) {
                $params = [
                    'ID'            => $eventId,
                    'NAME'          => $_POST['eventName'],
                    'DATE'          => $_POST['eventDate'],
                    'PICTURE'       => $pictureName,
                    'LOCATION_ID'   => $_POST['eventLocation'],
                    'DESCRIPTION'   => $_POST['eventDescription']
                ];
                //die(implode(', ', $params));
                $event = new event($params);
                foreach ($params as $key => $value) {
                    $event->__set($key, $value);
                }
                $event->save();
                $dataDir = 'assets/images/upload/'.$pictureName;
                move_uploaded_file($_FILES['eventPicture']['tmp_name'], $dataDir);
            }
        }elseif($siteId == 1) {
            $this->_params['title'] = 'Location Erstellen';
            if (isset($_POST['locationStreet'])) {
                $params = [
                    'STREET' => $_POST['locationStreet'],
                    'NUMBER' => $_POST['locationNumber'],
                    'ZIPCODE' => $_POST['locationZipcode'],
                    'CITY' => $_POST['locationCity'],
                    'ROOM' => $_POST['locationRoom']
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

                $where = User::buildWhereLogin($email, $password);   //Build the where statement to search the Login
                $user = User::find($where);
                if($user)
                {
                    $userID = $user[0]['ID'];
                    $_SESSION['userId'] = $userID;
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
        $this->_params['eventList'] = Event::find('', 'geteventinfo', ' ORDER BY DATE DESC');
    }

    public function actionProfil(){
        $this->_params['title'] = 'Profil';
        $where = 'ID = '. $_SESSION['userId'];
        $user = User::findOne($where);
        $this->_params['userProfil'] = $user;
        //debug_to_console($user[0]);

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