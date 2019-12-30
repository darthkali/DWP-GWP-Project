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
}