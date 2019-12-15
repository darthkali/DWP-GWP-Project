<?php

namespace FSR_AI;


class EventController extends Controller
{
    public function actionEvents(){
        $this->_params['title'] = 'Events';
        $eventListFuture = Event::find('to_days(curdate()) - to_days(DATE) <= 0', 'geteventinfo', ' order by DATE');
        $eventListPast = Event::find('to_days(curdate()) - to_days(DATE) > 0', 'geteventinfo', ' order by DATE desc');
//        die($eventListPast[1]['NAME']);
        $this->_params['eventListFuture'] = $eventListFuture;
        $this->_params['eventListPast'] = $eventListPast;
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

//if($_FILES['eventPicture']['name'] != null){
//
//$pictureName = 'event'.date('d-m-Y-H-i-s').strstr($_FILES['eventPicture']['name'], '.');
//if(isset($_GET['picturePath'])){
//unlink($dataDir.$_GET['picturePath']);
//}
//}

    public function actionCreateEvent(){

        $this->_params['locationsList'] = Location::find();
        $dataDir = 'assets/images/upload/events/';

        if(isset($_GET['eventAction'])) {
            if ($_GET['eventAction'] == 'edit') {

                $this->_params['title'] = 'Event Bearbeiten';
                $this->_params['eventData'] = Event::findOne('id = ' . $_GET['eventId']);
                $this->_params['create'] = false;
            }elseif($_GET['eventAction'] == 'create'){

                $this->_params['title'] = 'Event Erstellen';
                $this->_params['create'] = true;
            }elseif($_GET['eventAction'] == 'delete'){

                unlink($dataDir . $_GET['pictureName']);
                Event::deleteWhere('id = '.$_GET['eventId']);
                sendHeaderByControllerAndAction('event', 'Events');
            }
        }

        if(isset($_POST['submitEvent'])){
            $eventId = $_GET['eventId'] ?? null;
            $pictureName = null;
            $pictureName = 'event'.date('d-m-Y-H-i-s').strstr($_FILES['eventPicture']['name'], '.');

            if(isset($_GET['pictureName'])){
                unlink($dataDir.$_GET['pictureName']);
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
            sendHeaderByControllerAndAction('event', 'EventManagement');
        }
    }
    public function actionEventManagement(){

        //Permissions for the page
        $accessUser = [role::ADMIN, role::MEMBER];    // which user(role_id) has permission to join the page
        $errorPage = 'Location: index.php?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser,$errorPage);


        $this->_params['title'] = 'Eventverwaltung';
        $this->_params['eventList'] = Event::find('', 'geteventinfo', ' ORDER BY DATE DESC');
    }
}