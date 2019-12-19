<?php
use FSR_AI\Function_FSR;
use FSR_AI\Role;
?>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>
    <table>
        <tr>
            <th>Mitarbeiter</th>
        </tr>
        <tr>
            <? $sortFirstname = (isset($_GET['sortMember']) && $_GET['sortMember'] == 1) ? 2 : 1;?>
            <? $sortLastname = (isset($_GET['sortMember']) && $_GET['sortMember'] == 3) ? 4 : 3;?>
            <? $sortBirthDay = (isset($_GET['sortMember']) && $_GET['sortMember'] == 5) ? 6 : 5;?>
            <? $sortEmail = (isset($_GET['sortMember']) && $_GET['sortMember'] == 7) ? 8 : 7;?>
            <? $sortRole = (isset($_GET['sortMember']) && $_GET['sortMember'] == 9) ? 10 : 9;?>
            <? $sortFunction = (isset($_GET['sortMember']) && $_GET['sortMember'] == 11) ? 12 : 11;?>

            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortFirstname?>"> Vorname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortLastname?>"> Nachname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortBirthDay?>"> Geburtstag <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortEmail?>"> E-Mail <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortRole?>"> Rolle <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortMember=<?=$sortFunction?>"> Funktion FSR <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th>Optionen</th>
        </tr>
    <?foreach($accountsMember as $index => $account) : ?>
        <tr>
            <td><?=$account['FIRSTNAME']?></td>
            <td><?=$account['LASTNAME']?></td>
            <td><?=date("d.m.Y", strtotime($account['DATE_OF_BIRTH']));?></td>
            <td><?=$account['EMAIL']?></td>
            <td><?=Role::generateRoleByRoleID($account['ROLE_ID'])?></td>
            <td><?=Function_FSR::generateFunctionFSRNameByUserID($account['MEMBER_ID'])?></td>
            <td>
                <? if($_SESSION['userId'] <> $account['MEMBER_ID']){?>
                <a href="?c=user&a=profil&userId=<?=$account['MEMBER_ID']?>">
                    <input type="image" title="User bearbeiten" src=<?=IMAGEPATH.'edit.png'?> alt="Edit"></a>
                <a href="?c=pages&a=deleteQuestion&userId=<?=$account['MEMBER_ID']?>">
                    <input type="image" title="User löschen" src=<?=IMAGEPATH.'entfernen.png'?> alt="Delete"></a>
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

            <? $sortFirstname = (isset($_GET['sortUser']) && $_GET['sortUser'] == 1) ? 2 : 1;?>
            <? $sortLastname = (isset($_GET['sortUser']) && $_GET['sortUser'] == 3) ? 4 : 3;?>
            <? $sortBirthDay = (isset($_GET['sortUser']) && $_GET['sortUser'] == 5) ? 6 : 5;?>
            <? $sortEmail = (isset($_GET['sortUser']) && $_GET['sortUser'] == 7) ? 8 : 7;?>
            <? $sortRole = (isset($_GET['sortUser']) && $_GET['sortUser'] == 9) ? 10 : 9;?>
            <? $sortFunction = (isset($_GET['sortUser']) && $_GET['sortUser'] == 11) ? 12 : 11;?>

            <th><a href="?c=user&a=userManagement&sortUser=<?=$sortFirstname?>"> Vorname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortUser=<?=$sortLastname?>"> Nachname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortUser=<?=$sortBirthDay?>"> Geburtstag <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=user&a=userManagement&sortUser=<?=$sortEmail?>"> E-Mail <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th>Optionen</th>
        </tr>
        <?foreach($accountsUser as $index => $account) : ?>
            <tr>
                <td><?=$account['FIRSTNAME']?></td>
                <td><?=$account['LASTNAME']?></td>
                <td><?=date("d.m.Y", strtotime($account['DATE_OF_BIRTH']));?></td>
                <td><?=$account['EMAIL']?></td>
                <td>
                    <? if($_SESSION['userId'] <> $account['ID']){?>
                        <a href="?c=user&a=profil&userId=<?=$account['ID']?>">
                            <input type="image" title="User bearbeiten" src=<?=IMAGEPATH.'edit.png'?> alt="Edit"></a>
                        <a href="?c=pages&a=deleteQuestion&userId=<?=$account['ID']?>">
                            <input type="image" title="User löschen" src=<?=IMAGEPATH.'entfernen.png'?> alt="Delete"></a>
                    <?}?>
                </td>
            </tr>
        <?endforeach;?>
    </table>
</div>
