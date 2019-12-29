<?php

use FSR_AI\role;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=IMAGEPATH.'matrix.jpg'?>" alt = "Silhouette  eines Mannes umhüllt mit einer grünen Matrix">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="?c=user&a=profil<?=$userInformation?>" method="post" enctype="multipart/form-data" >
        <h1>Meine Daten</h1>
        <h5>Hier kannst du deine Daten ändern!</h5>

        <? if(isset($eingabeError)){?> <div class="error"><?
            foreach($eingabeError as $error){?>
                <?=$error?><br>
            <?}?></div> <? } ?>

        <!-- firstname -->
        <div class="input">
            <label for="firstnameProfil">VORNAME </label>
            <input type = "text" id="firstnameProfil" name="firstnameProfil" required
               value = "<?=isset($_POST['firstnameProfil']) ? htmlspecialchars($_POST['firstnameProfil']) : htmlspecialchars($userProfil['FIRSTNAME'])?>">
            <span class="error-message" id="errorFirstnameProfil"></span>
        </div>

        <!-- lastname -->
        <div class="input">
            <label for="lastnameProfil">NACHNAME </label>
            <input type = "text" id="lastnameProfil" name="lastnameProfil" required
               value = "<?=isset($_POST['lastnameProfil']) ? htmlspecialchars($_POST['lastnameProfil']) : htmlspecialchars($userProfil['LASTNAME'])?>">
            <span class="error-message" id="errorLastnameProfil"></span>
        </div>

        <!-- email -->
        <div class="input">
            <label for="emailProfil">EMAIL </label>
            <input type = "email" id="emailProfil" name="emailProfil"
               value = "<?=isset($_POST['emailProfil']) ? htmlspecialchars($_POST['emailProfil']) : htmlspecialchars($userProfil['EMAIL'])?>">
            <span class="error-message" id="errorEmailProfil"></span>
        </div>
        <? if($errorMessage != ''){?> <div class="error"><?echo $errorMessage?></div> <? } ?>

        <? if($userProfil['ID'] === $_SESSION['userId']){?>

        <div class="input">
            <label for="passwordProfil">PASSWORT </label>
            <input type = "password" id="passwordProfil" name="passwordProfil">
            <? if($errorMessagePassword != ''){?> <div class="error"><?echo $errorMessagePassword?></div> <? } ?>
            <span class="error-message" id="errorPasswordProfil"></span>
        </div>
        <div class="checkBox">
            <input type="checkbox" name="changePasswordCheckbox" id="changePasswordCheckbox">
            <label for="changePasswordCheckbox">Passwort ändern? </label>
        </div>
        <? } ?>

        <!-- date of birth -->
        <div class="input">
            <label for="dateOfBirthProfil">GEBURTSDATUM </label>
            <input type = "date" id="dateOfBirthProfil" name="dateOfBirthProfil"
               value = "<?=isset($_POST['dateOfBirthProfil']) ? htmlspecialchars($_POST['dateOfBirthProfil']) : htmlspecialchars($userProfil['DATE_OF_BIRTH'])?>">
            <span class="error-message" id="errorDateOfBirthProfil"></span>
        </div>


        <? if($userRole == role::ADMIN ||  $userRole == role::MEMBER){ ?>

        <!-- picture -->
        <div class="input">
            <label for="pictureProfil">BILD </label>
            <input type = "file"  accept=".jpg, .jpeg, .png" id="pictureProfil" name="pictureProfil">
            <span class="error-message" id="errorPictureProfil"></span>
        </div>

        <!-- description -->
        <div class="input">
            <label for="descriptionProfil">BESCHREIBUNG  </label>
            <textarea name="descriptionProfil" id="descriptionProfil" cols="44" rows="5"><?=isset($_POST['descriptionProfil']) ? htmlspecialchars($_POST['descriptionProfil']) : htmlspecialchars($userProfil['DESCRIPTION'])?></textarea>
                <span class="error-message" id="errorDescriptionProfil"></span>
        </div>
        <? } ?>


        <? if($userRole == role::ADMIN){?>
            <? if($userProfil['ID'] <> $_SESSION['userId']){?>
        <div class="input">
            <label for="roleProfil">Rolle: </label> <br>
            <select name="roleProfil" id="roleProfil">
                <? foreach ($allRoles as $role) { ?>
                    <option value= <?=$role['ID']?> <?=($userRole == $role['ID']) ? 'selected' : ''?> ><?=$role['NAME']?></option>
                <? } ?>
            </select>
            <span class="error-message" id="errorRoleProfil"></span>
        </div>
            <? } ?>

        <div class="input">
            <label for="functionFSRProfil">Funktion im Fachschaftsrat:</label><br>
            <select name="functionFSRProfil" id="functionFSRProfil">
                <? foreach ($allFunctions as $function) { ?>
                <option value= <?=$function['ID']?> <?=($userFunction == $function['ID']) ? 'selected' : ''?> ><?=$function['NAME']?></option>
                <? } ?>
            </select>
            <span class="error-message" id="errorFunctionFSRProfil"></span>
        </div>
        <? } ?>

        <? if($userProfil['ID'] === $_SESSION['userId']){?>
        <div class="checkBox">
            <input type="checkbox" name="colorCheckbox" id="colorCheckbox" <?=$colorModeChecked?> >
            <label for="colorCheckbox">DarkMode? </label>
        </div>
        <? } ?>

        <!-- buttons -->
        <button type="submit" name="submitProfil" id="submitProfil">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
<!--        <button type="reset"> Verwerfen</button>-->
        <button type="reset"> Eingabe Löschen <i class="fa fa-times" aria-hidden="true"></i> </button>
    </form>
</div>
<script src="<?=JAVASCRIPTPATH.'script.js'?>"></script>
