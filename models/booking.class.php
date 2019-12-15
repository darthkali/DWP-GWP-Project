<?php
namespace FSR_AI;

class Booking extends BaseModel{
    const TABLENAME = '`booking`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'EVENT_ID'        => [ 'type' => BaseModel::TYPE_INT ],
        'USER_ID'          => [ 'type' => BaseModel::TYPE_INT ]
    ];

    public static function buildWhereBooking($userId, $eventId){
        return " USER_ID = '" . $userId . "' and EVENT_ID = '". $eventId .  "';'";
    }

    public static function checkRegistrationForEvent($eventId){
        return Booking::find(Booking::buildWhereBooking($_SESSION['userId'], $eventId));
    }
}