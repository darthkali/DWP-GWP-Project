<?php

use FSR_AI\roles;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="index.php?c=user&a=profil" method="post" enctype="multipart/form-data" >
        <h1>Meine Daten</h1>
        <h5>Hier kannst du deine Daten ändern!</h5>

        <!-- frontname -->
        <label for="firstnameProfil">VORNAME </label>
        <input type = "text" id="firstnameProfil" name="firstnameProfil" required
               value = "<?=isset($_POST['firstnameProfil']) ? htmlspecialchars($_POST['firstnameProfil']) : htmlspecialchars($userProfil['FIRSTNAME'])?>">

        <!-- rearname -->
        <label for="lastnameProfil">NACHNAME </label>
        <input type = "text" id="lastnameProfil" name="lastnameProfil" required
               value = "<?=isset($_POST['lastnameProfil']) ? htmlspecialchars($_POST['lastnameProfil']) : htmlspecialchars($userProfil['LASTNAME'])?>">

        <!-- email -->
        <label for="emailProfil">EMAIL </label>
        <input type = "email" id="emailProfil" name="emailProfil"
               value = "<?=isset($_POST['emailProfil']) ? htmlspecialchars($_POST['emailProfil']) : htmlspecialchars($userProfil['EMAIL'])?>">

        <? if($errorMessage != ''){?> <div class="error"><?echo $errorMessage?></div> <? } ?>

        <label for="passwordProfil">PASSWORT </label>
        <input type = "password" id="passwordProfil" name="passwordProfil" required
               value = "<?=isset($_POST['passwordProfil']) ? htmlspecialchars($_POST['passwordProfil']) : htmlspecialchars($userProfil['PASSWORD'])?>">

        <!-- date of birth -->
        <label for="dateOfBirthProfil">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirthProfil" name="dateOfBirthProfil"
               value = "<?=isset($_POST['dateOfBirthProfil']) ? htmlspecialchars($_POST['dateOfBirthProfil']) : htmlspecialchars($userProfil['DATE_OF_BIRTH'])?>">



        <? if($userProfil['ROLE_ID'] == roles::ADMIN ||  $userProfil['ROLE_ID'] == roles::MEMBER){ ?>

        <!-- picture -->
        <label for="pictureProfil">BILD </label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="pictureProfil" name="pictureProfil">

        <!-- description -->
        <label for="descriptionProfil">BESCHREIBUNG  </label>
        <textarea name="descriptionProfil" id="descriptionProfil" cols="44" rows="5"><?=isset($_POST['descriptionProfil']) ? htmlspecialchars($_POST['descriptionProfil']) : htmlspecialchars($userProfil['DESCRIPTION'])?></textarea>
        <? } ?>


        <? if($userProfil['ROLE_ID'] == roles::ADMIN){ ?>
        <label for="sortBy">Rolle: </label> <br>
        <select name="sortBy" id="sortBy">
            <option>Administrator</option>
            <option>Mitglied</option>
            <option selected>Nutzer</option>
        </select>

        <label for="functionFSR">Filtern nach:</label><br>
        <select name="functionFSR" id="functionFSR">
            <option selected>Sprecher</option>
            <option>stellv. Sprecher</option>
            <option>Finanzer</option>
            <option>stellv. Finanzer</option>
            <option selected>Mitglied</option>
            <option>archiviertes Mitglied</option>
        </select>
        <? } ?>

        <div class="checkBox">
            <input type="checkbox" name="colorCheckbox" id="colorCheckbox" <?=$colorModeChecked?> >
            <label for="colorCheckbox">DarkMode? </label>
        </div>


        <!-- buttons -->
        <button type="submit" name="submitProfil">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
