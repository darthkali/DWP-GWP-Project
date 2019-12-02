<?php

namespace FSR_AI;

use DateTime;

class PagesController extends Controller{

    protected function loggedInn(){

    }

    public function actionBooking(){
        $this->_params['title'] = 'Eventanmeldung';
        $userId = $_SESSION['userId'];
        $eventId = $_GET['eventId'];
        $where = Booking::buildWhereBooking($userId, $eventId);
        if(Booking::find($where)){
            if (isset($_GET['eventId'])) {
                $params = [
                    'EVENTS_ID'   => $eventId,
                    'MEMBER_ID'   => $userId
                ];
                $booking = new booking($params);
                foreach ($params as $key => $value) {
                    $booking->__set($key, $value);
                }
                $booking->save();
            }
        }else{
            die('Sie sind schon angemeldet!');
        }
    }

	public function actionStart(){
		$this->_params['title'] = 'Startseite';
	}

    public function actionEvents(){
        $this->_params['title'] = 'Events';
        $this->_params['eventList'] = Event::find('', 'geteventinfo');
        $this->_params['eventButton'] = 'Anmelden';
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


        //Musst dir die view noch anlegen
        //CREATE VIEW geteventinfo  AS  select e.`ID` AS `ID`,e.`NAME` AS `NAME`,e.`DATE` AS `DATE`,e.DESCRIPTION AS DESCRIPTION,e.PICTURE AS PICTURE,e.LOCATION_ID AS LOCATION_ID,l.STREET AS STREET,l.`NUMBER` AS `NUMBER`,l.ZIPCODE AS ZIPCODE,l.CITY AS CITY,l.ROOM AS ROOM from (`event` e join location l on(e.LOCATION_ID = l.`ID`)) ;
    }

    public function actionIntoDatabase(){
        $siteId = $_GET['siteId'];
        if($siteId == 0) {
            $this->_params['title'] = 'Event Erstellen';
            if (isset($_POST['eventName'])) {
                $params = [
                    'NAME'          => $_POST['eventName'],
                    'DATE'          => date_format(new DateTime($_POST['eventDate']), 'd.m.Y'),  //date_format(new DateTime($_POST['date']), 'd.m.Y')
                    'PICTURE'       => $_FILES['eventPicture']['name'],
                    'LOCATION_ID'   => $_POST['eventLocation'],
                    'DESCRIPTION'   => $_POST['eventDescription']
                ];
                $event = new event($params);
                foreach ($params as $key => $value) {
                    $event->__set($key, $value);
                }
                $event->save();
                $dataDir = 'assets/images/upload/'.$_FILES['eventPicture']['name'];
                move_uploaded_file($_FILES['eventPicture']['tmp_name'], $dataDir);
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
    }

    public function actionprofil(){
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