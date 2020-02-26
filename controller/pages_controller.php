<?php
namespace FSR_AI;

class PagesController extends Controller{

    public function actionStart(){
        $this->_params['title'] = 'Startseite';

        $nextEvent = Event::findOne('DATE >= curdate() order by DATE LIMIT 1;');
        $this->_params['nextEvent']  = $nextEvent;

        $days = str_replace(['-', '+'],'',Event::getDateDiffBetweenEventAndCurrentDate(empty($nextEvent) ? null : $nextEvent['DATE']));

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
                if(isset($_GET['ajax'])) {
                    echo json_encode(['error' => "Vailation Failed"]);
                    exit(0); // Valid EXIT with JSON OUTPUT
                }
                return false;
            }

            $header = array();
            $header[] = "MIME-Version: 1.0";
            $header[] = "Content-type: text/plain; charset=utf-8";
            $header[] = "From: FSRAI-Kontaktformular <fsraiformular@web.de>";
            $header[] = "Reply-To: " . $_POST['mail'];
            $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">\r\n\r\n" . $_POST['text'];

            //TODO: Kann erst genutzt werden, wenn der Mailserver eingerichtet ist
            //mail("bratwurststinkt@web.de", utf8_decode($_POST['subject']), $msg, implode("\r\n", $header));


            if(isset($_GET['ajax'])) {
                debug_to_logFile("adasdasd");
                echo json_encode(['error' => null]);
                exit(0); // Valid EXIT with JSON OUTPUT
            }else{
                sendHeaderByControllerAndAction('pages', 'start');
            }

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

        $this->_params['title'] = 'Registrieren';
        //Permissions for the page
        if(isset($_GET['eventId'])){
            $accessUser = [Role::ADMIN, Role::MEMBER];    // which user(role_id) has permission to join the page

            $this->_params['title'] = 'Wollen Sie das Event:';
            $event = Event::findOne('ID = ' . $_GET['eventId']);
            $this->_params['Name'] = $event['NAME'];
            $this->_params['hrefTarget'] = '?c=event&a=eventManagement';
            $this->_params['hrefDelete'] = '&eventId='. $_GET['eventId'] . '&pictureName='.$_GET['pictureName'];
        }else{
            $accessUser = Role::ADMIN;    // which user(role_id) has permission to join the page

            $this->_params['title'] = 'Wollen Sie den Nutzer:';
            $user = User::findOne('ID = ' . $_GET['userId']);
            $this->_params['Name'] = User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);
            $this->_params['hrefTarget'] = '?c=user&a=userManagement';
            $this->_params['hrefDelete'] = '&userId=' . $_GET['userId'];
        }
        User::checkUserPermissionForPage($accessUser);

    }

    public function actionDocumentation(){
        $this->_params['title'] = 'Dokumentation';
    }
}