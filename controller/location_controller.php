<?php

namespace FSR_AI;


class LocationController extends Controller{

    public function actionCreateLocation(){

        $this->_params['title'] = 'Location Erstellen';

        if (isset($_POST['submitCreateLocation'])) {

            $params = [
                'STREET'    => ($_POST['locationStreet'  ] === '')  ? null : $_POST['locationStreet'  ],
                'NUMBER'    => ($_POST['locationNumber'  ] === '')  ? null : $_POST['locationNumber'  ],
                'ZIPCODE'   => ($_POST['locationZipcode' ] === '')  ? null : $_POST['locationZipcode' ],
                'CITY'      => ($_POST['locationCity'    ] === '')  ? null : $_POST['locationCity'    ],
                'ROOM'      => ($_POST['locationRoom'    ] === '')  ? null : $_POST['locationRoom'    ]
            ];
            $location = new location($params);

            $eingabeError = [];
            if(!$location->validate($eingabeError)){
                $this->_params['eingabeError'] = $eingabeError;
                return false;
            }

            $location->save();
            sendHeaderByControllerAndAction('event', 'EventManagement');
        }
    }
}