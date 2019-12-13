<?php
namespace FSR_AI;

use MongoDB\BSON\Timestamp;

class Role extends BaseModel
{
    const TABLENAME = '`ROLE`';

    const ADMIN  = 1;
    const MEMBER = 2;
    const USER   = 3;

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'NAME'             => [ 'type' => BaseModel::TYPE_STRING ]
    ];

    public static function generateRoleByRoleID($roleID){
        $role = self::findOne('ID = '. $roleID);
        return $role['NAME'];
    }

    public  static  function changeRole($userID){
        //TODO: change this Method for the role class
        $memberHistoryID = self::generateActualMemberHistory($userID)['ID'];
        $params = [
            'ID' => $memberHistoryID,
            'END_DATE' => new Timestamp,
        ];

        $newMemberHistory = new user($params);
        $newMemberHistory->save();
    }
}