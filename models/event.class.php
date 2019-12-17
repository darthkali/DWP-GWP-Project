<?php
namespace FSR_AI;

class Event extends BaseModel
{
    const TABLENAME = '`event`';

    protected $schema = [
        'ID'            => ['type' => BaseModel::TYPE_INT   ],
        'CREATED_AT'    => ['type' => BaseModel::TYPE_STRING],
        'UPDATED_AT'    => ['type' => BaseModel::TYPE_STRING],
        'NAME'          => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'DATE'          => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'DESCRIPTION'   => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 300],
        'PICTURE'       => ['type' => BaseModel::TYPE_STRING],
        'LOCATION_ID'   => ['type' => BaseModel::TYPE_INT   ]
    ];

    public static function getDateDiffBetweenEventAndCurrentDate($eventDate){

        return date_diff(date_create($eventDate), date_create(date('d.m.Y')))->format('%R%a');
    }

    public static function generateSortClauseForEvent($sortEventGET){
        switch ($sortEventGET) {
            case 1:
                return $sortEvent = 'ORDER BY NAME';
            case 2:
                return $sortEvent = 'ORDER BY NAME DESC';
            case 3:
                return $sortEvent = 'ORDER BY DATE';
            case 4:
                return $sortEvent = 'ORDER BY DATE DESC';
            default:
                return $sortEvent = '';
        }
    }


}