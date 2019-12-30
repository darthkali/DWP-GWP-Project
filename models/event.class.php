<?php
namespace FSR_AI;

class Event extends BaseModel{
    const TABLENAME = '`event`';

    protected $schema = [
        'ID'            => ['type' => BaseModel::TYPE_INT    ],
        'LOCATION_ID'   => ['type' => BaseModel::TYPE_INT    ],
        'CREATED_AT'    => ['type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'    => ['type' => BaseModel::TYPE_STRING ],
        'DATE'          => ['type' => BaseModel::TYPE_STRING ],
        'NAME'          => ['type' => BaseModel::TYPE_STRING, 'min' => 8,   'max' => 64   ],
        'DESCRIPTION'   => ['type' => BaseModel::TYPE_STRING, 'min' => 100, 'max' => 1000 ],
        'PICTURE'       => ['type' => BaseModel::TYPE_STRING, 'min' => 1,   'max' => 29   ]
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