<?
require_once './core/config.php';
require_once './core/functions.php';
$page=isset($_GET['p']) ? $_GET['p']:'start';

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Fachschaftsrat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/design.css'?>">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/navigation.css'?>">
        <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/responsive.css'?>">
        <link rel="shortcut icon" type="image/png" href="<?=ROOTPATH.'assets/images/ailogo_groß.png'?>">
    </head>

    <body>
    <?
    include 'navMenuBar.php';
        switch($page)
        {
        // Navigation-----------------------------------------
            case 'start':
                include(PAGEPATH.'start.php');
                break;
            case 'event':
                include(PAGEPATH.'events.php');
                break;
            case 'aboutUs':
                include(PAGEPATH.'aboutUs.php');
                break;
            case 'contact':
                include(PAGEPATH.'contact.php');
                break;
            case 'users':
                include(PAGEPATH.'users.php');
                break;

            // login-----------------------------------------
            case 'login':
                include(PAGEPATH.'login.php');
                break;
            case 'profil':
                include(PAGEPATH.'profil.php');
                break;
            case 'userManagement':
                include(PAGEPATH.'userManagement.php');
                break;
            case 'newUser':
                include(PAGEPATH.'newUser.php');
                break;
            case 'eventManagement':
                include(PAGEPATH.'eventManagement.php');
                break;
            case 'logOut':
                include(PAGEPATH.'logOut.php');
                break;

            // Footer-----------------------------------------
            case 'impressum':
                include(PAGEPATH.'impressum.php');
                break;
            case 'dataProtection':
                include(PAGEPATH.'dataProtection.php');
                break;

            // Error-----------------------------------------
            default:
                include(PAGEPATH.'error.php');
                break;
        }

    include 'footer.php';
        ?>
    </body>
</html>