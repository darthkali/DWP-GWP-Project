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
        $timestamp = time();
        $datum = date("Y-m-d", $timestamp);
        $params = [
            'START_DATE' => $datum,
            'MEMBER_ID' => $userID,
            'FUNCTION_FSR_ID' => $functionFSR,
        ];
        //debug_to_logFile();
        $newMemberHistory = new MemberHistory($params);
        $newMemberHistory->save();
    }

    public static function closeActualMemberHistory($userID){

        $memberHistory = self::generateActualMemberHistory($userID);
        if($memberHistory === null){
            return false;
        }else{
            $memberHistoryID = self::generateActualMemberHistory($userID)['ID'];
        }

        $timestamp = time();
        $datum = date("Y-m-d", $timestamp);
        $params = [
            'ID' => $memberHistoryID,
            'END_DATE' => $datum
        ];

        $newMemberHistory = new MemberHistory($params);
        $newMemberHistory->save();
    }
}