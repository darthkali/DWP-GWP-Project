<?php
namespace FSR_AI;

use app\models\PPAll;
use app\models\Product;

class event extends BaseModel
{
    const TABLENAME = '`event`';

    protected $schema = [
        'id'               => [ 'type' => BaseModel::TYPE_INT ],
        'created_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'updated_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'name'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'date'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45  ],
        'description'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'picture'          => [ 'type' => BaseModel::TYPE_STRING ],
        'location_id'      => [ 'type' => BaseModel::TYPE_INT ]
    ];

}