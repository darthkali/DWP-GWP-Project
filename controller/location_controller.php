<?php

namespace FSR_AI;


class LocationController extends Controller{

    public function actionCreateLocation(){
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
        sendHeaderByControllerAndAction('event', 'EventManagement');
    }
}