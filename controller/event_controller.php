<?php

namespace FSR_AI;


class EventController extends Controller
{
    public function actionEvents(){
        $this->_params['title'] = 'Events';

        $eventList = Event::find('', 'geteventinfo', ' ORDER BY DATE DESC');
        $this->_params['eventList'] = $eventList;
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

    public function actionCreateEvent(){

        $this->_params['title'] = 'Event Erstellen';
        $this->_params['locationsList'] = Location::find();
        $this->_params['create'] = true;
        if(isset($_GET['eventId'])) {
            $this->_params['title'] = 'Event Bearbeiten';
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
            $dataDir = 'assets/images/upload/events/';

            if($_FILES['eventPicture']['name'] != null){

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
                $event = new event($params);
                foreach ($params as $key => $value) {
                    $event->__set($key, $value);
                }
                $event->save();
                $dataDir .= $pictureName;
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

    public function actionEventManagement(){

        //Permissions for the page
        $accessUser = [roles::ADMIN, roles::MEMBER];    // which user(role_id) has permission to join the page
        $errorPage = 'Location: index.php?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser,$errorPage);


        $this->_params['title'] = 'Eventverwaltung';
        $this->_params['eventList'] = Event::find('', 'geteventinfo', ' ORDER BY DATE DESC');
    }
}