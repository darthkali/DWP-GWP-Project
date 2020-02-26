<?php
namespace FSR_AI;

class Location extends BaseModel{
    const TABLENAME = '`location`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT    ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'STREET'           => [ 'type' => BaseModel::TYPE_STRING, 'min' => 3, 'max' => 50 ],
        'NUMBER'           => [ 'type' => BaseModel::TYPE_STRING, 'min' => 1, 'max' => 5  ],
        'ZIPCODE'          => [ 'type' => BaseModel::TYPE_STRING, 'min' => 5, 'max' => 5  ],
        'CITY'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 1, 'max' => 58 ],
        'ROOM'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 0, 'max' => 9  ]
    ];

    public static function buildLocationDetails($locationId){

        $location = self::findOne('id = '.$locationId);
        $locationDetails = $location['CITY'].', '.$location['ZIPCODE'].', '.$location['STREET'].' '.$location['NUMBER'];
        if(isset($location['ROOM'])) $locationDetails .= ', Raum: '.$location['ROOM'];
        return $locationDetails;
    }

    public static function validateLocation($newLocation, &$eingabeError){
        $newLocation->validate($eingabeError);

        if ($newLocation->__get('STREET') === null) {
            array_push($eingabeError, 'Der Straßenname muss augefüllt werden!');
        }else  if (!preg_match('/^[A-Za-zßäöü][A-Za-z \-ßäöü]*$/', $newLocation->__get('STREET'))) {
           array_push($eingabeError, 'Der Straßenname darf nur aus Buchstaben, Leerzeichen und Bindestrichen bestehen!');
        }

        if ($newLocation->__get('NUMBER') === null) {
            array_push($eingabeError, 'Die Nummer muss augefüllt werden!');
        }else if (!preg_match('/^[0-9]+[ ]?[a-z]?$/', $newLocation->__get('NUMBER'))) {
            array_push($eingabeError, 'Die Nummer darf nur aus Zahlen und Buchstaben bestehen (Zahl als erstes)!');
        }

        if ($newLocation->__get('ZIPCODE') === null) {
            array_push($eingabeError, 'Die Postleitzahl muss augefüllt werden!');
        }else if (!preg_match('/^[0-9]*$/', $newLocation->__get('ZIPCODE'))) {
            array_push($eingabeError, 'Die Postleitzahl darf nur aus Zahlen bestehen!');
        }

        if ($newLocation->__get('CITY') === null) {
            array_push($eingabeError, 'Die Stadt muss augefüllt werden!');
        }else if (!preg_match('/^[A-Za-zßäöü][A-Za-z \-ßäöü]*$/', $newLocation->__get('CITY'))) {
            array_push($eingabeError, 'Die Stadt darf nur aus Buchstaben, Leerzeichen und Bindestrichen bestehen!');
        }

        if(count($eingabeError) == 0){
            return true;
        }else{
            return false;
        }
    }
}