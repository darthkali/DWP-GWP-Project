<?php

use FSR_AI\Function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\Role;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\network.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>


<!--    --><?//if($role === false) : ?>
<!--        <a href="?c=user&a=userManagement&role=3"><button type="button">Nur Mitarbeiter anzeigen</button></a>-->
<!--    --><?//else : ?>
<!--        <a href="?c=user&a=userManagement"><button type="button">Alle anzeigen</button></a>-->
<!--    --><?//endif;?>
<!--    --><?//
//    $active = filter_input(INPUT_POST, 'onlyMember', FILTER_VALIDATE_BOOLEAN);
//    ?>

<!--    <div class="filterButton">-->
<!--    </div>-->
    <form method="post">
    <div class="filterBox">
        <div class="sortFilterBox">
            <label for="sortByUser">Sortieren nach: </label> <br>
            <select name="sortByUser" id="sortByUser">
                <option value = 1 <?=($valueSort == 1) ? 'selected' : ''?> > Vorname - Aufsteigend</option>
                <option value = 2 <?=($valueSort == 2) ? 'selected' : ''?> > Vorname - Absteigend</option>
                <option value = 3 <?=($valueSort == 3) ? 'selected' : ''?> > Nachname - Aufsteigend</option>
                <option value = 4 <?=($valueSort == 4) ? 'selected' : ''?> > Nachname - Absteigend</option>
                <option value = 5 <?=($valueSort == 5) ? 'selected' : ''?> > Funktion</option>
                <option value = 6 <?=($valueSort == 6) ? 'selected' : ''?> > Rolle</option>
            </select>
        </div>
        <!-- buttons -->
        <button type="submit" name="filterID">Filter anwenden</button>
    </div>
    </form>

    <table>
        <tr>
            <th>Mitarbeiter</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Geburtstag</th>
            <th>E-Mail</th>
            <th>Rolle</th>
            <th>Funktion FSR</th>
            <th>Optionen</th>
        </tr>
    <?foreach($accountsMember as $index => $account) : ?>
        <tr>
            <td><?=User::getFullName($account['FIRSTNAME'], $account['LASTNAME'])?></td>
            <td><?=date("d.m.Y", strtotime($account['DATE_OF_BIRTH']));?></td>
            <td><?=$account['EMAIL']?></td>
            <td><?=Role::generateRoleByRoleID($account['ROLE_ID'])?></td>
            <td><?=Function_FSR::generateFunctionFSRNameByUserID($account['MEMBER_ID'])?></td>
            <td>
                <? if($_SESSION['userId'] <> $account['ID']){?>
                <a href="?c=user&a=profil&userId=<?=$account['ID']?>">
                    <input type="image" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit"></a>
                <a href="?c=pages&a=deleteQuestion&userId=<?=$account['ID']?>">
                    <input type="image"  title="User löschen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete"></a>
                <?}?>
            </td>
        </tr>
    <?endforeach;?>
    </table>

    <br>

    <table>
        <tr>
            <th>Nutzer</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Geburtstag</th>
            <th>E-Mail</th>
            <th>Inaktives Mitglied?</th>
            <th>Optionen</th>
        </tr>
        <?foreach($accountsUser as $index => $account) : ?>
            <tr>
                <td><?=User::getFullName($account['FIRSTNAME'], $account['LASTNAME'])?></td>
                <td><?=date("d.m.Y", strtotime($account['DATE_OF_BIRTH']));?></td>
                <td><?=$account['EMAIL']?></td>
                <td><?=Function_FSR::generateFunctionFSRNameByUserID($account['ID'])?></td>
                <td>
                    <? if($_SESSION['userId'] <> $account['ID']){?>
                        <a href="?c=user&a=profil&userId=<?=$account['ID']?>">
                            <input type="image" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit"></a>
                        <a href="?c=pages&a=deleteQuestion&userId=<?=$account['ID']?>">
                            <input type="image"  title="User löschen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete"></a>
                    <?}?>
                </td>
            </tr>
        <?endforeach;?>
    </table>
</div>
