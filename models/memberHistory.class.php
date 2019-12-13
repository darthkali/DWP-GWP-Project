<?php


namespace FSR_AI;


use MongoDB\BSON\Timestamp;

class MemberHistory extends BaseModel
{

    const TABLENAME = '`MEMBER_HISTORY`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'START_DATE'       => [ 'type' => BaseModel::TYPE_STRING ],
        'END_DATE'         => [ 'type' => BaseModel::TYPE_STRING ],
        'MEMBER_ID'        => [ 'type' => BaseModel::TYPE_INT  ],
        'FUNCTION_FSR_ID'  => [ 'type' => BaseModel::TYPE_INT ]

    ];

    public static function generateActualMemberHistory($userID){
        return self::findOne('MEMBER_ID = '. $userID . ' and END_DATE is null');
    }

    public static function generateAllClosedMemberHistory($userID){
        return self::find('MEMBER_ID = '. $userID . ' and END_DATE is not null');
    }


    public static function createNewMemberHistory($userID, $functionFSR){
        $params = [
            'START_DATE' => new Timestamp,
            'MEMBER_ID' => $userID,
            'FUNCTION_FSR_ID' => $functionFSR,
        ];

        $newMemberHistory = new user($params);
        $newMemberHistory->save();
    }

    public  static  function closeActualMemberHistory($userID){
        $memberHistoryID = self::generateActualMemberHistory($userID)['ID'];
        $params = [
            'ID' => $memberHistoryID,
            'END_DATE' => new Timestamp,
        ];

        $newMemberHistory = new user($params);
        $newMemberHistory->save();
    }
}