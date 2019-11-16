<? require_once './core/config.php';
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
                include(VIEWPATH.'start.php');
                break;
            case 'event':
                include(VIEWPATH.'events.php');
                break;
            case 'aboutUs':
                include(VIEWPATH.'aboutUs.php');
                break;
            case 'contact':
                include(VIEWPATH.'contact.php');
                break;
            case 'users':
                include(VIEWPATH.'users.php');
                break;

            // login-----------------------------------------
            case 'login':
                include(VIEWPATH.'login.php');
                break;
            case 'profil':
                include(VIEWPATH.'profil.php');
                break;
            case 'userManagement':
                include(VIEWPATH.'userManagement.php');
                break;
            case 'newUser':
                include(VIEWPATH.'newUser.php');
                break;
            case 'eventManagement':
                include(VIEWPATH.'eventManagement.php');
                break;
            case 'logOut':
                include(VIEWPATH.'logOut.php');
                break;

            // Footer-----------------------------------------
            case 'impressum':
                include(VIEWPATH.'impressum.php');
                break;
            case 'dataProtection':
                include(VIEWPATH.'dataProtection.php');
                break;

            // Error-----------------------------------------
            default:
                echo 'Error 404';
                break;
        }

    include 'footer.php';
        ?>
    </body>
</html>