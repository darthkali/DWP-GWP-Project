<?php

use FSR_AI\function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\team.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">

    <div class="userPageBox">
    <h1>Unsere Mitglieder</h1>

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
            <!-- buttons -->
            <button type="submit" name="submitRegistration">Filter anwenden<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

        </div>

        <? foreach($userList as $user) : ?>
            <?// TODO: generate Method for functionsFSR wich generates the name by itself ?>
            <div class="userBox">
                <img class="center" src="/FSAI-Site/assets/images/upload/users/<?=$user['PICTURE']?>" alt="ProfilPageImage">
                <p><?=User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);?><br>
                    <?=User::getAge($user['DATE_OF_BIRTH'])?> Jahre<br><br>
                    <? $member1 =  MemberHistory::generateActualMemberHistory($user['ID'])?>
                    Funktion: <?=function_FSR::generateFunctionFSRByFunctionID($member1['FUNCTION_FSR_ID'])?><br>
                    <? $userMember = MemberHistory::generateAllClosedMemberHistory($user['ID']);?>
                    <? foreach ($userMember as $member) :?>
                        <?=$member['START_DATE'];?> bis <?=$member['END_DATE'];?> : <?=function_FSR::generateFunctionFSRByFunctionID($member['FUNCTION_FSR_ID']);?> <br>
                    <?php endforeach; ?>
                </p>
                <h1>Beschreibung:</h1>
                <p><?=$user['DESCRIPTION']?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
