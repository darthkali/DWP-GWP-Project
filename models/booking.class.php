<?php
namespace FSR_AI;

class booking extends BaseModel
{
    const TABLENAME = '`booking`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'EVENTS_ID'        => [ 'type' => BaseModel::TYPE_INT ],
        'MEMBER_ID'        => [ 'type' => BaseModel::TYPE_INT ]
    ];

    public static function buildWhereBooking($userId, $eventId){
        return " MEMBER_ID = '" . $userId . "' and EVENTS_ID = '". $eventId .  "';'";
    }
}