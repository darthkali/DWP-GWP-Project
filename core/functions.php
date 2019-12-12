<?
const DEBUG = true;
const ERROR = true;

function debug_to_logFile($message, $class = null){

    if(DEBUG){
        $class= ($class != null) ? $class:  '';
        $message = '['.(new \DateTime())->format('Y-m-d H:i:s ').$class. ']' . $message. "\n";
        file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
    }

}

function error_to_logFile($message, $class = null){

    if(ERROR){
        $class= ($class != null) ? $class:  '';
        $message = '['.(new \DateTime())->format('Y-m-d H:i:s ').$class. ']' . $message. "\n";
        file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
    }

}


function crateDataOfFilesFromDirectory($dir, $numberOfOutputFiles){
    //create a grid with random pictures from a directory on the server
    $allFiles = scandir($dir);

    // delete the array indexes with '.' and '..'
    foreach ($allFiles as $delete => &$val) {
        if($allFiles[$delete] == "." or $allFiles[$delete] == '..'){
            unset($allFiles[$delete]);
        }
    }

    // random order of the array
    shuffle($allFiles);

    //check if the folder is TODO: Kommentieren und Testen
    if(count($allFiles) < $numberOfOutputFiles){
        $numberOfOutputFiles = count($allFiles);
    }

    // pics 12 random indexes from the Array
    $rand_keys = array_rand($allFiles, $numberOfOutputFiles);

    if($numberOfOutputFiles > 1){
        foreach ($rand_keys as $datei) {
            $randArray[] = $allFiles[$datei];
        }
    }else{
        $randArray = $allFiles[$rand_keys];
    }

    return $randArray;
}

function sendMail($isRegistration = false){

    if (isset($_POST['name'])) {
        $header = array();
        $header[] = "MIME-Version: 1.0";
        $header[] = "Content-type: text/plain; charset=utf-8";
        if ($isRegistration) {
            $header[] = "From: Eventanmeldung <fsraiformular@web.de>";

            $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">" . "\r\n\r\n" . $_POST['text'];
            //mail("fsai@fh-erfurt.de", $_POST['subject'], $msg, implode("\r\n", $header));
            mail("bratwurststinkt@web.de",'Eventanmeldung', $msg, implode("\r\n", $header));
            header('Location: ' . $_SERVER['PHP_SELF'] . '?p=event');
            exit();
        } else {
             $header[] = "From: FSRAI-Kontaktformular <fsraiformular@web.de>";

            $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] . " <" . $_POST['mail'] . ">" . "\r\n\r\n" . $_POST['text']."\r\n\r\nAnmeldung für das Event: ";
            //mail("fsai@fh-erfurt.de", $_POST['subject'], $msg, implode("\r\n", $header));
            mail("bratwurststinkt@web.de", $_POST['subject'], $msg, implode("\r\n", $header));
            header('Location: ' . $_SERVER['PHP_SELF'] . '?p=contact');
            exit();
        }
    }
}

function sendHeaderByControllerAndAction($controller, $action){
    header('Location: index.php?c=' .$controller . '&a=' . $action);
}

function createUploadedPictureName($modelName, $uploadedPictureFile){
    return $modelName.date('d-m-Y-H-i-s').strstr($_FILES[$uploadedPictureFile]['name'], '.');
}
