<?php
namespace FSR_AI;

class PagesController extends Controller{

    public function actionStart(){
        $this->_params['title'] = 'Startseite';

        $nextEvent = Event::findOne('DATE >= curdate() order by DATE LIMIT 1;');
        $this->_params['nextEvent']  = $nextEvent;
        $days = str_replace(['-', '+'],'',Event::getDateDiffBetweenEventAndCurrentDate($nextEvent['DATE']));

        switch(strlen($days)){
            case 1:
                $days = '00'.$days;
                break;
            case 2:
                $days = '0'.$days;
                break;
        }

        $daysUntilEvent=[
            'hundreds'  => $days[0],
            'tens'      => $days[1],
            'ones'      => $days[2]
            ];
        $this->_params['daysUntilEvent'] = $daysUntilEvent;

foreach ($daysUntilEvent as $digit){

        debug_to_logFile($digit);
}
    }

    public function actionAboutUs(){
        $this->_params['title'] = 'Unser Team';
    }

    public function actionContact(){
        $this->_params['title'] = 'Kontakt';


        if (isset($_POST['sendMail'])) {

            $params = [
                'NAME'          => ($_POST['name']      === '') ? null : $_POST['name'],
                'EMAIL'         => ($_POST['mail']      === '') ? null : $_POST['mail'],
                'SUBJECT'         => ($_POST['subject']   === '') ? null : $_POST['subject'],
                'TEXT'   => ($_POST['text']      === '') ? null : $_POST['text']
            ];

            $newContact = new Contact($params);
            // validation from the inputFields
            $eingabeError = [];

            if(!Contact::validateContact($newContact, $eingabeError)){
                $this->_params['eingabeError'] = $eingabeError;
                return false;
            }

            Contact::sendMail();
        }
    }

    public function actionImprint(){
        $this->_params['title'] = 'Impressum';
    }

    public function actionDataprotection(){
        $this->_params['title'] = 'Datenschutz';
    }

    public function actionErrorPage(){
        $this->_params['title'] = 'Fehler';
    }

    public function actionDeleteQuestion(){
        //Permissions for the page
        $accessUser = role::ADMIN;    // which user(role_id) has permission to join the page
        User::checkUserPermissionForPage($accessUser);
        $this->_params['title'] = 'Nutzer Löschen';
    }
}