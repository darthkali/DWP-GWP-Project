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
        'ID'               => [ 'type' => BaseModel::TYPE_INT    ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'NAME'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 6, 'max' => 13 ]
    ];

    public static function generateRoleByRoleID($roleID){
        $role = self::findOne('ID = '. $roleID);
        return $role['NAME'];
    }


    public static function changeUserRole($userID, $newRole){
        $params = [
            'ID' => $userID,
            'ROLE_ID' => $newRole,
        ];
        $newUser = new user($params);
        $newUser->save();
        return true;
    }

}