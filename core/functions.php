<?

function debug_to_logFile($message){
    $message = '['.(new \DateTime())->format('Y-m-d H:i:s'). ']' .$message. "\n";
    file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
}


function crateImageOfFilesFromAFolder($dir, $numberOfOutputFiles){
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

function pictureRaster(){
    $images = crateImageOfFilesFromAFolder("assets/images/PictureRaster/", 180);

    // print the pictures which has selected before with the '$rand_keys'
    foreach ($images as $datei) { // Ausgabeschleife
        $html ='<li><img src="'.ROOTPATH.'assets/images/PictureRaster/'.$datei.'" alt="AiLogo">';
        debug_to_logFile($html);
        echo $html;
    }
}

function errorPageGifs(){

    $gif = crateImageOfFilesFromAFolder("assets/images/ErrorGifs", 1);

    // print the pictures which has selected before with the '$rand_keys'
    $html ='<img src="'.ROOTPATH.'assets/images/ErrorGifs/'.$gif.'" alt="AiLogo">';
    echo $html;
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
