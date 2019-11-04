<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="description" content="Kurzbeschreibung">
        <link rel="stylesheet" href="../assets/css/design.css">
        <link rel="shortcut icon" type="image/png" href="/DWP-GWP-Project/assets/images/ailogo.png">
    </head>

    <body>
        <? include '../navMenuBar.php';?>

        <div id="SitePicture" class="fadeInImg">
            <img class="center" src="/FSAI-Site/assets/images/key.jpg">
        </div>

        <div id="Content" class="fadeIn">
            <form>
                <h1>Mitgliederlogin</h1>
                NUTZERNAME<br>
                <input type = "text";id="username" name="username">
                <br>
                PASSWORT<br>
                <input type = "password"; id="password" name="password">
                <img src="/FSAI-Site/assets/images/loginIcon.png">
            </form>
        </div>


        <? include '../footer.php';?>
    </body>
</html>