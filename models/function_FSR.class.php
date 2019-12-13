<?php
namespace FSR_AI;

class Function_FSR extends BaseModel
{

    const TABLENAME = '`FUNCTION_FSR`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'NAME'             => [ 'type' => BaseModel::TYPE_STRING ]
    ];

    public static function generateFunctionFSRByFunctionID($functionID)
    {
        $function = self::findOne('ID = '. $functionID);
        return $function['NAME'];
    }
}