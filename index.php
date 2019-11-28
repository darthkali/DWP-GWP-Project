<?
session_save_path(__DIR__.DIRECTORY_SEPARATOR.'data');
session_start();

require_once './core/config.php';
require_once './core/functions.php';
require_once './core/databaseConnection.php';
require_once './models/events.php';
require_once './models/location.php';

if(isset($_POST['submitLogin'])) {
    $error = true;
    $user = logIn($error);
    if(!$error) {
        $_SESSION['user'] = $user;
    }
}
else if (isset($_POST['submitLogout'])) {
    logOut();
}
else if(isset($_COOKIE['userId'])) {
    $error = true;
    $user = logIn($error, true);
    if(!$error) {
        $_SESSION['user'] = $user;
    }
}

$loggedIn =isset($_SESSION['user']);
$page=isset($_GET['p']) ? $_GET['p']:'start';
$title =$page;
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title><?=$title?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/design.css'?>">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/navigation.css'?>">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/responsive.css'?>">
        <link rel="shortcut icon" type="image/png" href="<?=ROOTPATH.'assets/images/ailogo_groß.png'?>">
    </head>

    <body>
    <? if(isset($error) && $error !== false) : ?>
        <div class="error">
            <span onclick="{this.parentNode.parentNode.removeChild(this.parentNode);}">
                x
            </span>
            <?=$error?>
        </div>
    <? endif; ?>
    <?
    include 'navMenuBar.php';
    $error = false;

        switch($page) {
            // Navigation-----------------------------------------
            case 'start':
                include(PAGEPATH . 'start.php');
                break;
            case 'event':
                include(PAGEPATH . 'events.php');
                break;
            case 'aboutUs':
                include(PAGEPATH . 'aboutUs.php');
                break;
            case 'contact':
                include(PAGEPATH . 'contact.php');
                break;
            case 'users':
                include(PAGEPATH . 'users.php');
                break;
            case 'login':
                include(PAGEPATH . 'login.php');
                break;
            case 'eventRegistration':
                include(PAGEPATH . 'eventRegistration.php');
                break;
            case 'createEvent':
                include(PAGEPATH . 'createEvent.php');
                break;
            case 'createLocation':
                include(PAGEPATH . 'createLocation.php');
                break;

            // Footer-----------------------------------------
            case 'impressum':
                include(PAGEPATH.'impressum.php');
                break;
            case 'dataProtection':
                include(PAGEPATH.'dataProtection.php');
                break;

            default:
                $error = true;
                break;
        }
    // login-----------------------------------------
    if($loggedIn) {
        $error = false;
        switch ($page) {
            case 'profil':
                include(PAGEPATH . 'profil.php');
                break;
            case 'userManagement':
                include(PAGEPATH . 'userManagement.php');
                break;
            case 'newUser':
                include(PAGEPATH . 'newUser.php');
                break;
            case 'eventManagement':
                include(PAGEPATH . 'eventManagement.php');
                break;
            case 'logOut':
                include(PAGEPATH . 'logOut.php');
                break;

            // Error-----------------------------------------
            default:
                $error = true;
                break;
        }
    }

    if($error) {
        include(PAGEPATH . 'error.php');
    }
    include 'footer.php';
        ?>
    </body>
</html>