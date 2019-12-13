<?php
namespace FSR_AI;

class Location extends BaseModel
{
    const TABLENAME = '`location`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'STREET'           => [ 'type' => BaseModel::TYPE_STRING ],
        'NUMBER'           => [ 'type' => BaseModel::TYPE_STRING ],
        'ZIPCODE'          => [ 'type' => BaseModel::TYPE_STRING ],
        'CITY'             => [ 'type' => BaseModel::TYPE_STRING ],
        'ROOM'             => [ 'type' => BaseModel::TYPE_STRING ]
    ];

    public function buildLocationDetails($street, $number, $zipcode, $room, $city){

        $location = $location = $city.', '.$zipcode.', '.$street.' '.$number;;
        if(isset($room)) $location .= ', Raum: '.$room;
        return $location;
    }
}