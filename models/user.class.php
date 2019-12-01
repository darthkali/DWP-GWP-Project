<?php
namespace FSR_AI;

class User extends BaseModel
{
    const TABLENAME = '`user`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'FIRSTNAME'        => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'LASTNAME'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'DATE_OF_BIRTH'    => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45  ],
        'DESCRIPTION'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'PICTURE'          => [ 'type' => BaseModel::TYPE_STRING ],
        'EMAIL'          => [ 'type' => BaseModel::TYPE_STRING ],
        'PASSWORD'          => [ 'type' => BaseModel::TYPE_STRING ],
        'ROLE_ID'      => [ 'type' => BaseModel::TYPE_INT ]
    ];


    public static function buildWhereLogin($email, $password){
        return " email = '" . $email . "' and password = '". $password .  "';'";
    }


}