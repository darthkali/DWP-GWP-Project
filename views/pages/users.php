<?php

use FSR_AI\function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=IMAGEPATH.'team.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">

    <div class="userPageBox">
    <h1>Unsere Mitglieder</h1>
<div class="filterBox">
    <form method="post">

        <div class="sortFilterBox">
            <label for="sortByUser">Sortieren nach: </label> <br>
            <select name="sortByUser" id="sortByUser">
                <option value = 1 <?=($valueSort == 1) ? 'selected' : ''?> >  Funktion</option>
                <option value = 2 <?=($valueSort == 2) ? 'selected' : ''?> >  Vorname - Aufsteigend</option>
                <option value = 3 <?=($valueSort == 3) ? 'selected' : ''?> >  Vorname - Absteigend</option>
                <option value = 4 <?=($valueSort == 4) ? 'selected' : ''?> >  Nachname - Aufsteigend</option>
                <option value = 5 <?=($valueSort == 5) ? 'selected' : ''?> >  Nachname - Absteigend</option>
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
                <img class="center" src=<?=IMAGEPATH.'upload/users/'.$user['PICTURE']?> alt="ProfilPageImage">
                <p><h2><?=User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);?></h2>
                <strong><?=function_FSR::generateFunctionFSRNameByUserID($user['MEMBER_ID'])?></strong>
                    <?=User::getAge($user['DATE_OF_BIRTH'])?> Jahre<br>
                    <? $userMember = MemberHistory::generateAllClosedMemberHistory($user['MEMBER_ID']);

                    ?>
                    <? foreach ($userMember as $member):?>
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
