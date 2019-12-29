<?php
namespace FSR_AI;

class Function_FSR extends BaseModel
{

    const TABLENAME = '`FUNCTION_FSR`';

    protected $schema = [
        'ID'               => [ 'type' => BaseModel::TYPE_INT    ],
        'CREATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'UPDATED_AT'       => [ 'type' => BaseModel::TYPE_STRING ],
        'NAME'             => [ 'type' => BaseModel::TYPE_STRING,'min' => 6, 'max' => 30 ]
    ];

    public static function generateFunctionFSRNameByFunctionID($functionID){
        if($functionID != ''){
            $function = self::findOne('ID = '. $functionID);
            return $function['NAME'];
        }
        return '';
    }

    public  static function generateFunctionFSRNameByUserID($userID){
        $memberHistory = MemberHistory::generateActualMemberHistory($userID);
        return Function_FSR::generateFunctionFSRNameByFunctionID($memberHistory['FUNCTION_FSR_ID']);
    }

    public static function changeUserFunction($userID, $newFunction){
        $memberHistory = MemberHistory::generateActualMemberHistory($userID);
        $actualFunction = $memberHistory['FUNCTION_FSR_ID'];
        if($actualFunction === $newFunction) {
            return true;
        }
        MemberHistory::closeActualMemberHistory($userID);
        MemberHistory::createNewMemberHistory($userID, $newFunction);
        return true;
    }
}