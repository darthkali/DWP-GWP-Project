<?php
namespace FSR_AI;

class event extends BaseModel
{
    const TABLENAME = '`event`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'NAME'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45 ],
        'DATE'             => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45  ],
        'DESCRIPTION'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300 ],
        'PICTURE'          => [ 'type' => BaseModel::TYPE_STRING ],
        'LOCATION_ID'      => [ 'type' => BaseModel::TYPE_INT ]
    ];

    public static function findEventInfo(){
        $db  = $GLOBALS['db'];
        $result = null;

        try
        {
            $sql = 'SELECT * FROM ' . 'geteventinfo';

            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where .  ';';
            }

            $result = $db->query($sql)->fetchAll();
        }
        catch(\PDOException $e)
        {
            die('Select statment failed: ' . $e->getMessage());
        }

        return $result;
    }
}