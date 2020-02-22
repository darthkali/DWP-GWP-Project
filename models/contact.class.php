<?php
namespace FSR_AI;

class Contact extends BaseModel{
    public $schema = [
        'NAME'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'EMAIL'     => [ 'type' => BaseModel::TYPE_STRING, 'min' => 3,  'max' => 62   ],
        'SUBJECT'   => [ 'type' => BaseModel::TYPE_STRING, 'min' => 2,  'max' => 50   ],
        'TEXT'      => [ 'type' => BaseModel::TYPE_STRING, 'min' => 10, 'max' => 1000 ]
    ];


    public static function validateContact($newContact, &$eingabeError){
        $newContact->validate($eingabeError);

       if ($newContact->__get('NAME') === null) {
            array_push($eingabeError, 'Der Name muss augefüllt werden!');
        }else  if (!preg_match('/^[A-Za-z ]*$/', $newContact->__get('NAME'))) {
           array_push($eingabeError, 'Der Name darf nur aus Buchstaben und Leerzeichen!');
       }

       if ($newContact->__get('EMAIL') === null) {
           array_push($eingabeError, 'Die E-Mail muss augefüllt werden!');
       }else if (!preg_match('/[0-9A-Za-z_.]*[@][0-9A-Za-z-.]+[.][a-z]*/', $newContact->__get('EMAIL'))) {
           array_push($eingabeError, 'Die E-Mail muss eine Domain enthalten');
       }

       if ($newContact->__get('SUBJECT') === null) {
           array_push($eingabeError, 'Der Betreff muss augefüllt werden!');
       }else if (!preg_match('/^[A-Za-z0-9 ]*$/', $newContact->__get('SUBJECT'))) {
           array_push($eingabeError, 'Der Betreff darf nur aus Buchstaben, Zahlen und Leerzeichen!');
       }

        if ($newContact->__get('TEXT') === null) {
            array_push($eingabeError, 'Das Anliegen muss augefüllt werden!');
        }

       if(count($eingabeError) == 0){
            return true;
        }else{
            return false;
        }
    }

    public static function sendMail(){
        $header = array();
        $header[] = "MIME-Version: 1.0";
        $header[] = "Content-type: text/plain; charset=utf-8";
        $header[] = "From: FSRAI-Kontaktformular <fsraiformular@web.de>";
        $header[] = "Reply-To: " . $_POST['mail'];
        $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">\r\n\r\n" . $_POST['text'];

        mail("bratwurststinkt@web.de", utf8_decode($_POST['subject']), $msg, implode("\r\n", $header));
    }
}