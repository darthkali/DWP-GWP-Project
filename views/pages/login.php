<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/key.jpg'?>" alt="LoginPagePicture">
</div>

<div class="Content" id="fadeIn">
    <form  method="post" autocomplete= "off">
        <h1>Mitgliederlogin</h1>
        <h5>Bitte einloggen um dein Profil zu sehen!</h5>

        <? if($errorValid){ ?> <div class="error"><?echo $errorMessage?></div> <? } ?>


        <!-- username -->
        <label for="loginName">NUTZERNAME </label>
        <input type = "text" id="loginName" name="loginName" required
            <?=isset($_POST['loginName']) ? 'value="'.htmlspecialchars($_POST['loginName']).'"' : ''?>>

        <!-- password -->
        <label for="loginPassword">PASSWORT </label>
        <input type = "password" id="loginPassword" name="loginPassword" required>

        <!-- button -->
        <button type="submit" name="submit" value="anmelden">LOGIN<i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></button>
       <!-- <input type="submit" name="submit" value="Login now!" /><br />-->

        <!-- checkbox -->
        <div class="checkBox">
            <input type="checkbox" name="rememberMe" id="rememberMe">
            <label for="rememberMe">angemeldet bleiben? </label>

        </div>

            <?=isset($_POST['rememberMe']) ? 'checked' : ''?>
    </form>
</div>

