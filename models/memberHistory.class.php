<?php


namespace FSR_AI;


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

    public static function generateActualFunctionFSRFromUser($userID){
        $member = self::findOne('MEMBER_ID = '. $userID . ' and END_DATE is null');
        return Function_FSR::generateFunctionFSRByFunctionID($member['FUNCTION_FSR_ID']);
    }

    public static function generateAllClosedFunctionsFSRFromUser($userID){
        return self::find('MEMBER_ID = '. $userID . ' and END_DATE is not null');
    }
}