<?

function debug_to_logFile($message){
    $message = '['.(new \DateTime())->format('Y-m-d H:i:s'). ']' .$message. "\n";
    file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
}

function errorPageGifs(){
    //create a grid with random pictures from a directory on the server
    // image folder
    $allegifs = scandir("assets/images/ErrorGifs");

    // delete the array indexes with '.' and '..'
    foreach ($allegifs as $delete => &$val) { // Ausgabeschleife
        if($allegifs[$delete] == "." or $allegifs[$delete] == '..'){
            unset($allegifs[$delete]);
        }
    }

    // random order of the array
    shuffle($allegifs);

    // pics 12 random indexes from the Array
    $rand_keys_gifs = array_rand($allegifs, 1);

    // print the pictures which has selected before with the '$rand_keys'
    $html ='<img src="'.ROOTPATH.'assets/images/ErrorGifs/'.$allegifs[$rand_keys_gifs].'" alt="AiLogo">';

    echo $html;
}

function pictureRaster(){
    //create a grid with random pictures from a directory on the server
    // image folder
    $alledateien = scandir("assets/images/PictureRaster");


    // delete the array indexes with '.' and '..'
    foreach ($alledateien as $delete => &$val) { // Ausgabeschleife
        if($alledateien[$delete] == "." or $alledateien[$delete] == '..'){
            unset($alledateien[$delete]);
        }
    }

    // random order of the array
    shuffle($alledateien);

    // pics 12 random indexes from the Array
    $rand_keys = array_rand($alledateien, 18);

    // print the pictures which has selected before with the '$rand_keys'
    foreach ($rand_keys as $datei) { // Ausgabeschleife
        $html ='<li><img src="'.ROOTPATH.'assets/images/PictureRaster/'.$alledateien[$datei].'" alt="AiLogo">';

        echo $html;
    }
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
