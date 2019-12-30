<?php
namespace FSR_AI;

class Contact extends BaseModel{
    public $schema = [
        'NAME'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'EMAIL'     => [ 'type' => BaseModel::TYPE_STRING, 'min' => 3,  'max' => 62   ],
        'SUBJECT'   => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'TEXT'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 10, 'max' => 1000 ]
    ];
}