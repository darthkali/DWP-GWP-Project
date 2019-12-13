<?php
namespace FSR_AI;

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

    public static function generateRoleByRoleID($roleID)
    {
        $function = self::findOne('ID = '. $roleID);
        return $function['NAME'];
    }
}