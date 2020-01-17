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

    public static function sendMail()
    {
        debug_to_logFile('asdasd');
        $header = array();
        $header[] = "MIME-Version: 1.0";
        $header[] = "Content-type: text/plain; charset=utf-8";
        $header[] = "From: FSRAI-Kontaktformular <fsraiformular@web.de>";
        $header[] = "Reply-To: " . $_POST['mail'];
        $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">\r\n\r\n" . $_POST['text'];

        mail("bratwurststinkt@web.de", utf8_decode($_POST['subject']), $msg, implode("\r\n", $header));
        sendHeaderByControllerAndAction('pages', 'Contact');
    }
}