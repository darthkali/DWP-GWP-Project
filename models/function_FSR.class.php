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

    public static function changeUserFunction($userID, $newFunction){
        // TODO: transaction Control? Maybe we need a rollback if some of this inserts / updates will fail
        // TODO: find actual MemberHistory for user
        $user = self::findOne('ID = ' . $userID);
        $actualFunction = $user['ROLE_ID'];

        if($actualRole === $newRole) {
            return true;
        }

        if($actualRole === Role::USER){
            // from user to Admin or Member
            // create new Member History
            // check that the FunctionFSR is added
            if($functionFSR != null){
                MemberHistory::createNewMemberHistory($userID, $functionFSR);
            }else{
                return false;
            }

        }else if($newRole === Role::USER){
            // from Admin or Member to User
            // close open Member History
            // create new Member History with functionFSR.class = inaktives Mitglied
            MemberHistory::closeActualMemberHistory($userID);
            MemberHistory::createNewMemberHistory($userID, 6);   // TODO: Es wird aktuell direkt die 6 übergeben, das kann ggf zu problemen führen
        }

        $params = [
            'ID' => $userID,
            'ROLE' => $newRole,
        ];
        $newUser = new user($params);
        $newUser->save();
    }
}