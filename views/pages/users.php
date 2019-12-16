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
    <form method="post">

        <div class="sortFilterBox">
            <label for="sortBy">Sortieren nach: </label> <br>
            <select name="sortBy" id="sortBy">
                <option value= 0 selected>Vorname - Aufsteigend</option>
                <option value = 1>  Vorname - Absteigend</option>
                <option value = 2>  Nachname - Aufsteigend</option>
                <option value = 3>  Nachname - Absteigend</option>
                <option value = 4>  Funktion</option>
                <option value = 5>  Mitglied seit</option>
            </select>
        </div>

        <div class="sortFilterBox">
            <label for="functionFSRUser">Funktion im FSR:</label><br>
            <select name="functionFSRUser" id="functionFSRUser">
                <option value= 0 >alle</option>
                <? foreach ($allFunctions as $function) { ?>
                    <option value= <?=$function['ID']?> <?=($valueFilter == $function['ID']) ? 'selected' : ''?> ><?=$function['NAME']?></option>
                <? } ?>
            </select>

        </div>

        <!-- buttons -->
        <button type="submit" name="filterID">Filter anwenden</button>


        </form>
            </div>
        <? foreach($userList as $user) : ?>
            <div class="userBox">
                <img class="center" src="/FSAI-Site/assets/images/upload/users/<?=$user['PICTURE']?>" alt="ProfilPageImage">
                <p><h1><?=User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);?></h1>
                <strong><?=function_FSR::generateFunctionFSRNameByUserID($user['ID'])?></strong>
                    <?=User::getAge($user['DATE_OF_BIRTH'])?> Jahre<br><br>
                    <? $userMember = MemberHistory::generateAllClosedMemberHistory($user['ID']);?>
                    <? foreach ($userMember as $member) :?>
                        <?  $startDate = date("d.m.y",strtotime($member['START_DATE']));
                            $endDate = date("d.m.y", strtotime($member['END_DATE']));
                            $functionFSR = function_FSR::generateFunctionFSRNameByFunctionID($member['FUNCTION_FSR_ID']);
                        ?>
                <?=$startDate?><strong> bis </strong><?=$endDate?> : <?=$functionFSR?> <br>
                    <?php endforeach; ?>
                </p>
                <br>
                <h3>Beschreibung:</h3>
                <p><?=$user['DESCRIPTION']?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
