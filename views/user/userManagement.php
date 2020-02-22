<?php
use FSR_AI\Function_FSR;
use FSR_AI\Role;
?>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>

    <?  // generate Variables for the Members
    $topic          = 'Mitarbeiter';
    $ID             = 'MEMBER_ID';
    $sortMemberUser = 'sortMember';
    $accounts       = $accountsMember;

    for ($i = 1; $i <= 2; $i++) { ?>
    <table>
        <tr>
            <th><?=$topic?></th>
        </tr>


        <tr>
            <?  $sortFirstname  = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 1) ? 2 : 1;
                $sortLastname   = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 3) ? 4 : 3;
                $sortBirthDay   = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 5) ? 6 : 5;
                $sortEmail      = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 7) ? 8 : 7; ?>

            <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortFirstname?>"> Vorname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortLastname?>"> Nachname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortBirthDay?>"> Geburtstag <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortEmail?>"> E-Mail <i class="fa fa-sort" aria-hidden="true"></i></a></th>


            <? if($i === 1){
                $sortRole = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 9) ? 10 : 9;
                $sortFunction = (isset($_GET[$sortMemberUser]) && $_GET[$sortMemberUser] == 11) ? 12 : 11;
                ?>
                <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortRole?>"> Rolle <i class="fa fa-sort" aria-hidden="true"></i></a></th>
                <th><a href="?c=user&a=userManagement&<?=$sortMemberUser?>=<?=$sortFunction?>"> Funktion FSR <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <?}?>

            <th>Optionen</th>
        </tr>

    <?foreach($accounts as $index => $account) : ?>
        <tr>
            <td><?=$account['FIRSTNAME']?></td>
            <td><?=$account['LASTNAME']?></td>
            <td><?=date("d.m.Y", strtotime($account['DATE_OF_BIRTH']));?></td>
            <td><?=$account['EMAIL']?></td>
            <? if($i === 1){?>
                <td><?=Role::generateRoleByRoleID($account['ROLE_ID'])?></td>
                <td><?=Function_FSR::generateFunctionFSRNameByUserID($account[$ID])?></td>
            <?}?>
            <td>
                <? if($_SESSION['userId'] <> $account[$ID]){?>
                <a href="?c=user&a=profil&userId=<?=$account[$ID]?>">
                    <input alt="Edit" type="image" title="User bearbeiten" src=<?=PAGE_IMAGE_PATH.'edit.png'?> ></a>
                <a href="?c=pages&a=deleteQuestion&userId=<?=$account[$ID]?>" onclick="return deleteQuestionUser(this, <?=$account[$ID]?>);">
                    <input alt="Delete" type="image" title="User löschen" src=<?=PAGE_IMAGE_PATH.'entfernen.png'?> ></a>
                <?}?>
            </td>
        </tr>
    <?endforeach;

    // generate Variables for the Users
        $topic          = 'Nutzer';
        $ID             = 'ID';
        $accounts       = $accountsUser;
        $sortMemberUser = 'sortUser';

        ?>

    </table>
    <br>
    <? } ?>
</div>

<script src="<?=JAVA_SCRIPT_PATH.'script.js'?>"></script>
