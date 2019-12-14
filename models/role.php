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


    public static function changeUserRole($userID, $newRole, $functionFSR = null){
        $user = self::findOne('ID = ' . $userID);
        $actualRole = $user['ROLE_ID'];

        if($actualRole == Role::USER){
            if($functionFSR != null) {
                MemberHistory::closeActualMemberHistory($userID);
                MemberHistory::createNewMemberHistory($userID, $functionFSR);
            }else{
                return false;
            }
        }else if($newRole == Role::USER){
            MemberHistory::closeActualMemberHistory($userID);
            MemberHistory::createNewMemberHistory($userID, 6);
        }

        $params = [
            'ID' => $userID,
            'ROLE_ID' => $newRole,
        ];
        $newUser = new user($params);
        $newUser->save();
        return true;
    }

}