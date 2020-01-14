<?php
namespace FSR_AI;

class Contact extends BaseModel{
    public $schema = [
        'NAME'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'EMAIL'     => [ 'type' => BaseModel::TYPE_STRING, 'min' => 3,  'max' => 62   ],
        'SUBJECT'   => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'TEXT'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 10, 'max' => 1000 ]
    ];


    public static function validateLocation($newContact, &$eingabeError){
        if (!$newContact->validate($eingabeError)) {
            return false;
        }
        if (!preg_match('/^[A-Za-z ]*$/', $newContact->__get('NAME'))) {
            array_push($eingabeError, 'Der Vorname darf nur aus Buchstaben bestehen');
        }

        if (!preg_match('/[.]/', $newContact->__get('EMAIL'))) {
            array_push($eingabeError, 'Die E-Mail muss eine Domain enthalten');
        }

        if(count($eingabeError) == 0){
            return true;
        }else{
            return false;
        }
    }


}