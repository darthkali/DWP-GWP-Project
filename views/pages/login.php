<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/key.jpg'?>" alt="LoginPagePicture">
</div>

<div class="Content" id="fadeIn">
    <form action="<?=$_SERVER['PHP_SELF'].'?c=pages&a='.$changePage;?>" method="post" autocomplete= "off">
        <h1>Mitgliederlogin</h1>
        <h5>Bitte einloggen um dein Profil zu sehen!</h5>

        <!-- username -->
        <label for="loginName">NUTZERNAME </label>
        <input type = "text" id="loginName" name="validationName"
            <?=isset($_POST['validationName']) ? 'value="'.htmlspecialchars($_POST['validationName']).'"' : ''?>>

        <!-- password -->
        <label for="loginPassword">PASSWORT </label>
        <input type = "password" id="loginPassword" name="validationPassword">

        <!-- button -->
        <button type="submit" name="submitLogin" value="anmelden">LOGIN<i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></button>

        <!-- checkbox -->
        <input type="checkbox" name="rememberMe" id="check"
            <?=isset($_POST['rememberMe']) ? 'checked' : ''?>>
        <label for="check">angemeldet bleiben?</label>
    </form>
</div>

