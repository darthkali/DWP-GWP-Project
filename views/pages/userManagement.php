<?php

use FSR_AI\Function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\Role;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>

    <div class="filterButton">
    <?if($role === false) : ?>
        <a href="?c=user&a=userManagement&role=3"><button type="button">Nur Mitarbeiter anzeigen</button></a>
    <?else : ?>
        <a href="?c=user&a=userManagement"><button type="button">Alle anzeigen</button></a>
    <?endif;?>
    <?
    $active = filter_input(INPUT_POST, 'onlyMember', FILTER_VALIDATE_BOOLEAN);
    ?>
    </div>

        <table border ="1">
            <tr>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Geburtstag</th>
                <th>E-Mail</th>
                <th>Rolle</th>
                <th>Funktion FSR</th>
                <th>Optionen</th>
            </tr>

        <?foreach($accounts as $index => $account) : ?>
            <tr>
                <td><?=$account['FIRSTNAME']?></td>
                <td><?=$account['LASTNAME']?></td>
                <td><?=date("d.m.Y",strtotime($account['DATE_OF_BIRTH']));?></td>
                <td><?=$account['EMAIL']?></td>
                <td><?=Role::generateRoleByRoleID($account['ROLE_ID'])?></td>
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
