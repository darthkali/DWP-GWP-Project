<?php
use FSR_AI\function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\User;
?>

<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'team.jpg'?>" alt = "8 Männer beim Tauziehen">
</div>

<div class="Content" id="fadeIn">

    <div class="userPageBox">
    <h1>Unsere Mitglieder</h1>

        <form method="post" class="filterBox">
            <div class="sortFilterBox">
                <label for="sortByUser">Sortieren nach: </label><br>
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
            <br>
            <!-- buttons -->
            <div class="sortFilterBox" id="ButtonInCenter">
                <button class="FilterBoxButton" type="submit" name="filterID">Filter anwenden <i class="fas fa-filter" aria-hidden="true"></i></button>
            </div>
        </form>
        <? foreach($userList as $user) : ?>
            <div class="userBox">
                <img data-img class="center" src=<?=USER_PICTURE_PATH.$user['PICTURE']?> alt = "Bilder der mitglieder der Fachschaft der Angewandten informatik">
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
                <h3 data-descTitle>Beschreibung:</h3>
                <p data-desc><?=$user['DESCRIPTION']?></p>
                <button data-showMore class="FilterBoxButton" id="showMoreButton" onclick="showMoreButtonClicked(this);">mehr anzeigen</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
