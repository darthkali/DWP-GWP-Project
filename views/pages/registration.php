<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="index.php?c=user&a=Registration" method="post" >
        <h1>Registrierung</h1>
        <h5>Hier kannst du dich Registrieren!</h5>


        <? if(isset($eingabeError)){ ;?> <div class="error"><?
            foreach($eingabeError as $error){?>
                <?=$error?><br>
            <?}?></div> <? } ?>

        <!-- firstname -->
        <label for="firstnameRegistration">VORNAME </label>
        <input type = "text" id="firstnameRegistration" name="firstnameRegistration" required
            <?=isset($_POST['firstnameRegistration']) ? 'value="'.htmlspecialchars($_POST['firstnameRegistration']).'"' : ''?>>

        <!-- lastname -->
        <label for="lastnameRegistration">NACHNAME </label>
        <input type = "text" id="lastnameRegistration" name="lastnameRegistration" required
        <?=isset($_POST['lastnameRegistration']) ? 'value="'.htmlspecialchars($_POST['lastnameRegistration']).'"' : ''?>>

        <!-- email -->
        <label for="emailRegistration">EMAIL </label>
        <input type = "email" id="emailRegistration" name="emailRegistration" required
        <?=isset($_POST['emailRegistration']) ? 'value="'.htmlspecialchars($_POST['emailRegistration']).'"' : ''?>>

        <? if($errorMessage != ''){?> <div class="error"><?echo $errorMessage?></div> <? } ?>

        <label for="passwordRegistration">PASSWORT </label>
        <input type = "password" id="passwordRegistration" name="passwordRegistration" required >

        <!-- date of birth -->
        <label for="dateOfBirthRegistration">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirthRegistration" name="dateOfBirthRegistration" required
        <?=isset($_POST['dateOfBirthRegistration']) ? 'value="'.htmlspecialchars($_POST['dateOfBirthRegistration']).'"' : ''?>>

        <!-- buttons -->
        <button type="submit" name="submitRegistration">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
