<?php

namespace FSR_AI;


class EventController extends Controller
{
    public function actionEvents(){
        $this->_params['title'] = 'Events';

        $whereForEventsInPast = 'to_days(curdate()) - to_days(DATE) > 0';

        $this->_params['earliestDate'] = Event::getDateFromTheEarliestEvent();  //Get earliest date of event list
        $this->_params['latestDate']   = Event::getDateFromTheLatestEvent();    //Get latest date of event list

        $filterFunction = '';
        $filterSort = 'ORDER BY DATE';
        $this->_params['valueFilter']   = 0;
        $this->_params['valueSort']     = 3;

        if(isset($_POST['sortByEvent'])){
            $filterSort = Event::generateSortClauseForEvent($_POST['sortByEvent']);
            $this->_params['valueSort'] = $_POST['sortByEvent'];
        }

        if(isset($_POST['startDateEventFilter']) && isset($_POST['endDateEventFilter'])){
            if($_POST['startDateEventFilter'] != null && $_POST['endDateEventFilter'] != null) {
                $filterFunction = ' and DATE BETWEEN "' . $_POST['startDateEventFilter'] . '" AND "' . $_POST['endDateEventFilter'].'"';
                $this->_params['earliestDate']  = $_POST['startDateEventFilter'];
                $this->_params['latestDate']    = $_POST['endDateEventFilter'];
            }
        }else{
            $whereForEventsInPast .= ' AND to_days(curdate()) - to_days(DATE) < 183';
        }

        $eventListFuture    = Event::find('to_days(curdate()) - to_days(DATE) <= 0' . $filterFunction, 'geteventinfo', $filterSort);
        $eventListPast      = Event::find($whereForEventsInPast . $filterFunction, 'geteventinfo', $filterSort);

        $this->_params['eventListFuture']   = $eventListFuture;
        $this->_params['eventListPast']     = $eventListPast;
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
        sendHeaderByControllerAndAction('event', 'events');
        exit(0);
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
                $pictureName = Event::createUploadedPictureName('eventPicture');
            }

            if (isset($_POST['eventName'])) {
                $params = [
                    'ID'            => ($eventId                    === '')  ? null : $eventId,
                    'NAME'          => ($_POST['eventName'  ]       === '')  ? null : $_POST['eventName' ],
                    'DATE'          => ($_POST['eventDate'  ]       === '')  ? null : $_POST['eventDate' ],
                    'PICTURE'       => ($pictureName                === '')  ? null : $pictureName,
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
                Event::putTheUploadedFileOnTheServerAndRemoveTheOldOne('eventPicture', $dataDir, $_GET['pictureName'], $pictureName) ;
            }
            sendHeaderByControllerAndAction('event', 'EventManagement');
        }
    }

    public function actionEventManagement(){

        //Permissions for the page
        $accessUser = [role::ADMIN, role::MEMBER];    // which user(role_id) has permission to join the page
        User::checkUserPermissionForPage($accessUser);


        $this->_params['title'] = 'Eventverwaltung';

        if(isset($_GET['eventId'])) {
            $dataDir = 'assets/images/upload/events/';
            unlink($dataDir . $_GET['pictureName']);
            Booking::deleteWhere('EVENT_ID = '.$_GET['eventId']);
            Event::deleteWhere('ID = ' . $_GET['eventId']);
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