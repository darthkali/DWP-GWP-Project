<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Login</title>
        <meta name="description" content="Login">
        <? include_once '../head.php';?>
    </head>
    <body>
        <? include '../navMenuBar.php';?>
        <div class="SitePicture" id="fadeInImg">
            <img class="center" src="/FSAI-Site/assets/images/key.jpg" alt="LoginPagePicture">
        </div>

        <div class="Content" id="fadeIn">
            <form autocomplete= "off">
                <h1>Mitgliederlogin</h1>
                <h5>Bitte einloggen um dein Profil zu sehen!</h5>

                <!-- username -->
                <label for="username">NUTZERNAME </label>
                <input type = "text" id="username" name="username">

                <!-- password -->
                <label for="password">PASSWORT </label>
                <input type = "password" id="password" name="password">

                <!-- button -->
                <button type="submit">LOGIN<i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></button>
            </form>
        </div>
        <? include '../footer.php';?>
    </body>
</html>