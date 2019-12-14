<?php

use FSR_AI\role;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="?c=user&a=profil<?=$userInformation?>" method="post" enctype="multipart/form-data" >
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

        <? if($userProfil['ID'] === $_SESSION['userId']){?>
        <label for="passwordProfil">PASSWORT </label>
        <input type = "password" id="passwordProfil" name="passwordProfil" required
               value = "<?=isset($_POST['passwordProfil']) ? htmlspecialchars($_POST['passwordProfil']) : htmlspecialchars($userProfil['PASSWORD'])?>">
        <? } ?>

        <!-- date of birth -->
        <label for="dateOfBirthProfil">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirthProfil" name="dateOfBirthProfil"
               value = "<?=isset($_POST['dateOfBirthProfil']) ? htmlspecialchars($_POST['dateOfBirthProfil']) : htmlspecialchars($userProfil['DATE_OF_BIRTH'])?>">



        <? if($permissionSiteElements == role::ADMIN ||  $permissionSiteElements == role::MEMBER){ ?>

        <!-- picture -->
        <label for="pictureProfil">BILD </label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="pictureProfil" name="pictureProfil">

        <!-- description -->
        <label for="descriptionProfil">BESCHREIBUNG  </label>
        <textarea name="descriptionProfil" id="descriptionProfil" cols="44" rows="5"><?=isset($_POST['descriptionProfil']) ? htmlspecialchars($_POST['descriptionProfil']) : htmlspecialchars($userProfil['DESCRIPTION'])?></textarea>
        <? } ?>


        <? if($permissionSiteElements == role::ADMIN){?>
            <? if($userProfil['ID'] <> $_SESSION['userId']){?>
            <label for="roleProfil">Rolle: </label> <br>
            <select name="roleProfil" id="roleProfil">
                <? foreach ($allRoles as $role) { ?>
                    <option value= <?=$role['ID']?> <?=($userFunction == $role['ID']) ? 'selected' : ''?> ><?=$role['NAME']?></option>
                <? } ?>
            </select>
            <? } ?>

        <label for="functionFSRProfil">Funktion im Fachschaftsrat:</label><br>
        <select name="functionFSRProfil" id="functionFSRProfil">
            <? foreach ($allFunctions as $function) { ?>
            <option value= <?=$function['ID']?> <?=($userFunction == $function['ID']) ? 'selected' : ''?> ><?=$function['NAME']?></option>
            <? } ?>
        </select>

        <? } ?>

        <? if($userProfil['ID'] === $_SESSION['userId']){?>
        <div class="checkBox">
            <input type="checkbox" name="colorCheckbox" id="colorCheckbox" <?=$colorModeChecked?> >
            <label for="colorCheckbox">DarkMode? </label>
        </div>
        <? } ?>

        <!-- buttons -->
        <button type="submit" name="submitProfil">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
