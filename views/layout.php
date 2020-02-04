<?php
use FSR_AI\User;

if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
    if(isset($_COOKIE['userId'])) {
        $userId = $_COOKIE['userId'];
        $password = $_COOKIE['password'];

        $where = " ID = '" . $userId . "' and PASSWORD = '". $password .  "';'";
        $user = User::findOne($where);
        if($user) {
            $_SESSION['userId'] = $user['ID'];
            $_SESSION['loggedIn'] = 1;
        }else{
            $error = true;
            $_SESSION['loggedIn'] = 0;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title><?=$title?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=CSS_PATH.'design.css'?>">
    <link rel="stylesheet" href="<?=CSS_PATH.'navigation.css'?>">
    <link rel="stylesheet" href="<?=CSS_PATH.'responsive.css'?>">
    <link rel="stylesheet" href="<?=CSS_PATH.'aswesomeFonts.css'?>">
    
    <?  if(isset($_COOKIE['colorMode']) && $_COOKIE['colorMode'] == true) :?>
        <link rel="stylesheet" href="<?=CSS_PATH.'darkMode.css'?>">
    <?else : ?>
        <link rel="stylesheet" href="<?=CSS_PATH.'normalMode.css'?>">
    <?endif;?>

    <link rel="shortcut icon" type="image/png" href="<?=PAGE_IMAGE_PATH.'ailogo_groß.png'?>">
</head>
    <body onresize="changeCssWithJavaScriptForEventbox()" onload="changeCssWithJavaScriptForEventbox()">
        <? include __DIR__ . '/shared/navMenuBar.php'; ?>

			<?=$body?>

		<footer>
            <? include __DIR__ . '/shared/footer.php'; ?>
        </footer>
	</body>
</html>
<script src="<?=JAVA_SCRIPT_PATH.'script.js'?>"></script>