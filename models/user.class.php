<?php
namespace FSR_AI;

class User extends BaseModel
{
    const TABLENAME = '`user`';

    protected $schema = [
        'id'               => [ 'type' => BaseModel::TYPE_INT ],
        'created_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'updated_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'firstname'        => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'lastname'         => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'date_of_birth'    => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45  ],
        'description'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'picture'          => [ 'type' => BaseModel::TYPE_STRING ],
        'email'          => [ 'type' => BaseModel::TYPE_STRING ],
        'password'          => [ 'type' => BaseModel::TYPE_STRING ],
        'location_id'      => [ 'type' => BaseModel::TYPE_INT ]
    ];


    public static function buildWhereLogin($email, $password){
        return " email = '" . $email . "' and password = '". $password .  "';'";
    }
}