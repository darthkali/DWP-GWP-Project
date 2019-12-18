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
               value = "<?=isset($_POST['firstnameRegistration']) ? htmlspecialchars($_POST['firstnameRegistration']) : ''?>">

        <!-- lastname -->
        <label for="lastnameRegistration">NACHNAME </label>
        <input type = "text" id="lastnameRegistration" name="lastnameRegistration" required
               value = "<?=isset($_POST['lastnameRegistration']) ? htmlspecialchars($_POST['lastnameRegistration']) : ''?>">

        <!-- email -->
        <label for="emailRegistration">EMAIL </label>
        <input type = "email" id="emailRegistration" name="emailRegistration" required
               value = "<?=isset($_POST['emailRegistration']) ? htmlspecialchars($_POST['emailRegistration']) : ''?>">

        <? if($errorMessage != ''){?> <div class="error"><?echo $errorMessage?></div> <? } ?>

        <label for="passwordRegistration">PASSWORT </label>
        <input type = "password" id="passwordRegistration" name="passwordRegistration" required >
        <? if($errorMessagePassword != ''){?> <div class="error"><?echo $errorMessagePassword?></div> <? } ?>
        <!-- date of birth -->
        <label for="dateOfBirthRegistration">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirthRegistration" name="dateOfBirthRegistration" required
               value = "<?=isset($_POST['dateOfBirthRegistration']) ? htmlspecialchars($_POST['dateOfBirthRegistration']) : ''?>">

        <!-- buttons -->
        <button type="submit" name="submitRegistration">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
