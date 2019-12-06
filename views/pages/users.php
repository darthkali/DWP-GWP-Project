<?php

use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\team.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">

    <div class="userPageBox">
    <h1>Meine Daten</h1>
    <h5>Hier kannst du deine Daten ändern!</h5><br>

        <div class="filterBox">
        <div class="sortFilterBox">
            <label for="sortBy">Sortieren nach: </label> <br>
            <select name="sortBy" id="sortBy">
                <option selected>Vorname - Aufsteigend</option>
                <option>Vorname - Absteigend</option>
                <option>Nachname - Aufsteigend</option>
                <option>Nachname - Absteigend</option>
                <option>Funktion</option>
                <option>Mitglied seit</option>
            </select>
        </div>

        <div class="sortFilterBox">
            <label for="functionFSR">Filtern nach:</label><br>
            <select name="functionFSR" id="functionFSR">
                <option selected>alle</option>
                <option>Sprecher</option>
                <option>stellv. Sprecher</option>
                <option>Finanzer</option>
                <option>stellv. Finanzer</option>
                <option>Mitglied</option>
                <option>archiviertes Mitglied</option>
            </select>
        </div>


        </div>
        <div class="checkBox">
            <label for="activeUsers">Nur aktive mitglieder?</label>
            <input type="checkbox"  id="activeUsers" name="activeUsers"> <br>
        </div>
        <? foreach($userList as $user) : ?>

            <div class="userBox">
                <img class="center" src="/FSAI-Site/assets/images/<?=$user['PICTURE']?>" alt="ProfilPageImage">
                <p><?=User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);?><br>
                    <?=User::getAge($user['DATE_OF_BIRTH'])?> Jahre<br><br>
                    Funktion: <?=$user['ROLE']?><br><br>
                </p>
                    <h1>Beschreibung:</h1>
                <p><?=$user['DESCRIPTION']?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
