<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'key.jpg'?>" alt = "Statue mit großem Schlüssel in der Hand">
</div>

<div class="Content" id="fadeIn">
    <form  method="post" autocomplete= "off">
        <h1>Mitgliederlogin</h1>
        <h5>Bitte einloggen um dein Profil zu sehen!</h5>

        <? if($errorValid){ ?> <div class="error"><?echo $errorMessage?></div> <? } ?>
        <div class="input">
            <span class="error-message" id="errorEmailLogin"></span>
        </div>
        <!-- username -->
        <label for="email">EMAIL </label>
        <input type = "text" id="email" name="email" required
               value = "<?=isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">

        <!-- password -->
        <label for="password">PASSWORT </label>
        <input type = "password" id="password" name="password" >

        <!-- button -->
        <button type="submit" name="submitLogin" id="submitLogin" value="anmelden">LOGIN<i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></button>

        <!-- checkbox -->
        <div class="checkBox">
            <input type="checkbox" name="rememberMe" id="rememberMe">
            <label for="rememberMe">angemeldet bleiben? </label>
        </div>
            <?=isset($_POST['rememberMe']) ? 'checked' : ''?>
    </form>
</div>
<script src="<?=JAVA_SCRIPT_PATH.'script.js'?>"></script>
