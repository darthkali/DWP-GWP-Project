<?php

namespace FSR_AI;


class PagesController extends Controller{


    public function actionStart(){
        $this->_params['title'] = 'Startseite';
    }

    public function actionAboutUs(){
        $this->_params['title'] = 'Über Uns';
    }

    public function actionContact(){
        $this->_params['title'] = 'Kontakt';

        if (isset($_POST['sendMail'])) {

            $header = array();
            $header[] = "MIME-Version: 1.0";
            $header[] = "Content-type: text/plain; charset=utf-8";
            $header[] = "From: FSRAI-Kontaktformular <fsraiformular@web.de>";
            $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">" . "\r\n\r\n" . $_POST['text'];
            mail("bratwurststinkt@web.de", $_POST['subject'], $msg, implode("\r\n", $header));
            sendHeaderByControllerAndAction('pages', 'Contact');
            exit();
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
        $errorPage = 'Location: ?c=pages&a=error'; // send the user to the error page if he has no permission
        User::checkUserPermissionForPage($accessUser,$errorPage);

        $this->_params['title'] = 'Nutzer Löschen';

    }
}