<?php

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
                <th>Optionen</th>
            </tr>

        <?foreach($accounts as $index => $account) : ?>
            <tr>
                <td><?=$accounts[$index]['FIRSTNAME'    ]?></td>
                <td><?=$accounts[$index]['LASTNAME'     ]?></td>
                <td><?=$accounts[$index]['DATE_OF_BIRTH']?></td>
                <td><?=$accounts[$index]['EMAIL'        ]?></td>
                <td><?=Role::generateRoleByRoleID($accounts[$index]['ROLE_ID'])?></td>
                <td>
                    <? if($_SESSION['userId'] <> $accounts[$index]['ID']){?>
                    <a href="?c=user&a=profil&userId=<?=$accounts[$index]['ID']?>"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>
                    <a href="?c=user&a=userManagement&userId=<?=$accounts[$index]['ID']?>"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User löschen" src="/FSAI-Site/assets/images/entfernen.png" alt="Edit" style="outline:0;"></a>
                    <?}?>
                </td>
            </tr>
        <?endforeach;?>
        </table>
    </div>
