<?
function printTable($content, $borderIsVisible = true){
    $rows = count($content);
    $cols = count($content[0]);

        $border = $borderIsVisible ? 'border ="1"' : '';
        $html = '<table ' . $border . '>';
        $html .= '<tr>'.
                     '<th>Vorname</th>'.
                     '<th>Nachname</th>'.
                     '<th>GebDatum</th>'.
                     '<th>Funktion FSR</th>'.
                     '<th>Rolle</th>'.
                     '<th>Optionendd</th>'.
                 '</tr>';


        for($row = 0; $row < $rows; ++$row) {

            $html .= '<tr>';
            for($col = 0; $col < $cols; ++$col) {
                $html .= '<td>';
                $html .= isset($content[$row][$col]) ? $content[$row][$col] : '---';
                $html .= '</td>';
            }

            $html .= '<td>';
            $html .= '<a href="';
            $html .= $_SERVER['SCRIPT_NAME'];
            $html .= '/?p=profil">';
            $html .= '<input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>';
            $html .= '<input type="image" name="message[8c9aa635455b033d2bcb9c3b24489ec7]" title="Nachricht senden" src="/FSAI-Site/assets/images/email.png" alt="Nachricht" style="outline:0;">';
            $html .= '<input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="User entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;" onclick="return confirm("Soll der Benutzer: Test Test wirklich entfernt werden?")">';


            $html .= '</td>';
            $html .= '</tr>';

        }
        $html .= '</table>';
        echo $html;
}
// create an Array which has all users included
function allUsers(){
    $dbString =file_get_contents(DATABASE);
    $users =json_decode($dbString,true);
    return $users['users'];
}

function user($id){
    $users = allUsers();
    foreach($users as $userData) {
        if($userData['id'] === $id) {
            return $userData;
        }
    }
    return false;
}

function logIn(&$error, $rememberMe = false)
{
    $users = allUsers(); // create an Array with all users from the db.json
    $userRef = isset($_POST['validationName']) ? $_POST['validationName'] : '';
    $password = isset($_POST['validationPassword']) ? $_POST['validationPassword'] : '';

    $userId = null;
    if($rememberMe === true && empty ($_POST['validationName']) && empty($_POST['validationPassword'])) {
        $userId = $_COOKIE['userId'];
        $password =$_COOKIE['password'];
    }

    foreach($users as $idx => $userData) {
        if($userData['email'] === $userRef
            || $userData['username'] === $userRef
            || $userData['id'] === $userId) {

            $userIdx = $idx;
            $userId = $userData['id'];
            break;
        }
    }

    if (isset($userId)) {
        if($users[$userIdx]['password'] === $password)
        {
            $error = false;

            if(isset($_POST['rememberMe'])) {
                rememberMe($userId, $users[$userIdx]['password']); // set a cookie with the user login
            }
            return $userId;
        }else {
            $error= 'Ihr Passwort ist falsch!';
        }
    } else {
        $error =' Diesen Nutzer gibt es nicht.<br>Überprüfen Sie den Benutzernamen bzw. die E-Mail- Adresse!';
    }
    return false;
}

function logOut(){
    setcookie('userId','',-1,'/');
    setcookie('password','',-1,'/');
    unset($_SESSION['users']);
    session_destroy();
}

function rememberMe($id, $password){
    $duration = time() + 3600 * 24 * 30;
    setcookie('userId', $id, $duration, '/');
    setcookie('password', $password, $duration, '/');
}

function sendMail(){

    if (isset($_POST['name'])) {
        $header = "From: " ."fsraiformular@web.de";
        $msg = "Gesendet am: " . date("d.m.Y H:i:s") . "\r\nGesendet von: " . $_POST['name'] ."(".$_POST['mail'].")"."\r\n\r\n" . $_POST['text'];
        mail("bratwurststinkt@web.de", $_POST['subject'], $msg, $header);
        header('Location: '.$_SERVER['PHP_SELF'].'?p=contact');
        exit();
    }
}