<?php

namespace FSR_AI;


class EventController extends Controller
{
    public function actionEvents(){
        $this->_params['title'] = 'Events';
        $eventListFuture = Event::find('to_days(curdate()) - to_days(DATE) <= 0', 'geteventinfo', ' order by DATE');
        $eventListPast = Event::find('to_days(curdate()) - to_days(DATE) > 0', 'geteventinfo', ' order by DATE desc');
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

    public function actionCreateEvent(){

        $this->_params['locationsList'] = Location::find();
        $dataDir = 'assets/images/upload/events/';

        if(isset($_GET['eventAction'])) {
            if ($_GET['eventAction'] == 'edit') {

                $this->_params['title'      ] = 'Event Bearbeiten';
                $this->_params['eventData'  ] = Event::findOne('id = ' . $_GET['eventId']);
                $this->_params['create'     ] = false;
                $this->_params['htmlButton' ] = 'Änderungen speichern';
                $this->_params['headline'   ] = 'Event bearbeiten';
            }elseif($_GET['eventAction'] == 'create'){

                $this->_params['title'      ] = 'Event Erstellen';
                $this->_params['create'     ] = true;
                $this->_params['htmlButton' ] = 'Event erstellen';
                $this->_params['headline'   ] = 'Event erstellen';
                $this->_params['required'   ] = 'required';
            }
        }

        if(isset($_POST['submitEvent'])){

            $eventId = $_GET['eventId'] ?? null;
            if($_FILES['eventPicture']['name'] != null){
                $pictureName = createUploadedPictureName('event', 'eventPicture');
                if(isset($_GET['pictureName'])){
                    unlink($dataDir.$_GET['pictureName']);
                }
            }

            if (isset($_POST['eventName'])) {
                $params = [
                    'ID'            => ($eventId === '')  ? null : $eventId,
                    'NAME'          => ($_POST['eventName'  ] === '')  ? null : $_POST['eventName' ],
                    'DATE'          => ($_POST['eventDate'  ] === '')  ? null : $_POST['eventDate' ],
                    'PICTURE'       => ($pictureName === '')  ? null : $pictureName,
                    'LOCATION_ID'   => ($_POST['eventLocation'    ] === '')  ? null : $_POST['eventLocation'    ],
                    'DESCRIPTION'   => ($_POST['eventDescription' ] === '')  ? null : $_POST['eventDescription' ],
                ];
                $event = new event($params);
                foreach ($params as $key => $value) {
                    $event->__set($key, $value);
                }

                $eingabeError = [];
                if(!$event->validate($eingabeError)){
                    $this->_params['eingabeError'] = $eingabeError;
                    return false;
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
        User::checkUserPermissionForPage($accessUser);


        $this->_params['title'] = 'Eventverwaltung';

        if(isset($_GET['eventId'])) {
            $dataDir = 'assets/images/upload/events/';
            unlink($dataDir . $_GET['pictureName']);
            Event::deleteWhere('id = ' . $_GET['eventId']);
            sendHeaderByControllerAndAction('event', 'EventManagement');
        }


        $sortEvent = 'ORDER BY DATE';
        $sortEventOld = 'ORDER BY DATE';

        if(isset($_GET['sortEvent'])) {
            $sortEvent = Event::generateSortClauseForEvent($_GET['sortEvent']);
        }

        if(isset($_GET['sortEventOld'])) {
            $sortEventOld = Event::generateSortClauseForEvent($_GET['sortEventOld']);
        }


        $this->_params['eventList'] = Event::find('DATE >= CURDATE()', null, $sortEvent);
        $this->_params['eventListOld'] = Event::find('DATE < CURDATE()', null, $sortEventOld);

    }
}