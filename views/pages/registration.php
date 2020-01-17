<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'matrix.jpg'?>" alt = "Silhouette  eines Mannes umhüllt mit einer grünen Matrix">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="?c=user&a=Registration" method="post"  id="formRegistration">
        <h1>Registrierung</h1>
        <h5>Hier kannst du dich Registrieren!</h5>


        <div class="errorBox" style="display: <?=isset($eingabeError)?'':'none'?>;" id="errorBox">
            <? if(isset($eingabeError)){?>
                <div class="error"><?
                    foreach($eingabeError as $error){?>
                        <?=$error?><br>
                    <?}?>
                </div>
            <? } ?>
        </div>


        <!-- firstname -->
        <div class="input">
            <label for="firstnameRegistration">VORNAME </label>
            <input type = "text" id="firstnameRegistration" name="firstnameRegistration" required
                   value = "<?=isset($_POST['firstnameRegistration']) ? htmlspecialchars($_POST['firstnameRegistration']) : ''?>"/>
            <span class="error-message" id="errorFirstnameRegistration"></span>
        </div>

        <!-- lastname -->
        <div class="input">
            <label for="lastnameRegistration">NACHNAME </label>
            <input type = "text" id="lastnameRegistration" name="lastnameRegistration" required
                   value = "<?=isset($_POST['lastnameRegistration']) ? htmlspecialchars($_POST['lastnameRegistration']) : ''?>" />
            <span class="error-message" id="errorLastnameRegistration"></span>
        </div>

        <!-- email -->
        <div class="input">
            <label for="emailRegistration">EMAIL </label>
            <input type = "email" id="emailRegistration" name="emailRegistration" required
                   value = "<?=isset($_POST['emailRegistration']) ? htmlspecialchars($_POST['emailRegistration']) : ''?>">
             <span class="error-message" id="errorEmailRegistration" ></span>
            <? if($errorMessage != ''){?> <div class="error"><?echo $errorMessage?></div> <? } ?>
        </div>

        <!-- password -->
        <div class="input">
            <label for="passwordRegistration">PASSWORT </label>
            <input type = "password" id="passwordRegistration" name="passwordRegistration" required >
            <span class="error-message" id="errorPasswordRegistration"></span>
            <? if($errorMessagePassword != ''){?> <div class="error"><?echo $errorMessagePassword?></div><? } ?>
        </div>

        <!-- date of birth -->
        <div class="input">
            <label for="dateOfBirthRegistration">GEBURTSDATUM </label>
            <input type = "date" id="dateOfBirthRegistration" name="dateOfBirthRegistration" required
                   value = "<?=isset($_POST['dateOfBirthRegistration']) ? htmlspecialchars($_POST['dateOfBirthRegistration']) : ''?>">
            <span class="error-message" id="errorDateOfBirthRegistration"></span>
        </div>

        <!-- buttons -->
        <button type="submit" id="submitRegistration" name="submitRegistration">Registrieren<i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen <i class="fa fa-times" aria-hidden="true"></i></button>
    </form>
</div>
<script src="<?=JAVA_SCRIPT_PATH.'validateRegistrationProfil.js'?>"></script>
<script src="<?=JAVA_SCRIPT_PATH.'registrationAjax.js'?>"></script>
