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
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/design.css'?>">
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/navigation.css'?>">
    <link rel="stylesheet" href="<?=ROOTPATH.'assets/css/responsive.css'?>">
    <link rel="shortcut icon" type="image/png" href="<?=ROOTPATH.'assets/images/ailogo_groß.png'?>">
</head>
	<body>
        <?include __DIR__ . '/shared/navMenuBar.php'; ?>

			<?=$body?>

		<footer>
            <?include __DIR__ . '/shared/footer.php'; ?>
        </footer>
	</body>
</html>
