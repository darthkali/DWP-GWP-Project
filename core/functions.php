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

function sendHeaderByControllerAndAction($controller, $action){
    header('Location: ?c=' .$controller . '&a=' . $action);
}



function testLogOut(){
    setcookie('userId','',-1,'/');
    setcookie('password','',-1,'/');
    setcookie('colorMode','',-1,'/');
    unset($_SESSION['users']);
    session_destroy();
    session_write_close();
    sendHeaderByControllerAndAction('pages', 'Start');
}




