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
        if (!$newLocation->validate($eingabeError)) {
            return false;
        }
        if (!preg_match('/^[A-Za-z -]*$/', $newLocation->__get('STREET'))) {
            array_push($eingabeError, 'Der Vorname darf nur aus Buchstaben bestehen');
        }

        if (!preg_match('/^[0-9]*[a-z]*$/', $newLocation->__get('NUMBER'))) {
            array_push($eingabeError, 'Der Nachname darf nur aus Buchstaben bestehen');
        }

        if (!preg_match('/^[0-9]*$/', $newLocation->__get('NUMBER'))) {
            array_push($eingabeError, 'Der Nachname darf nur aus Zahlen bestehen');
        }

        if (!preg_match('/^[A-Za-z]*$/', $newLocation->__get('CITY'))) {
            array_push($eingabeError, 'Der Vorname darf nur aus Buchstaben bestehen');
        }

        if (!preg_match('/[.]/', $newLocation->__get('EMAIL'))) {
            array_push($eingabeError, 'Die E-Mail muss eine Domain enthalten');
        }

        if(count($eingabeError) == 0){
            return true;
        }else{
            return false;
        }
    }
}