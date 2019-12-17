<?php

use FSR_AI\Booking;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/network.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <h1>Eventverwaltung</h1>

    <a href="?c=event&a=CreateEvent&eventAction=create"><button type="button">Neues Event anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>
    <a href="?c=location&a=CreateLocation"><button type="button">Neue Location erstellen</button></a>

   <table>
       <tr>
       <th>Noch kommende Events</th>
       </tr>
        <tr>
            <? $sortName = (isset($_GET['sortEvent']) && $_GET['sortEvent'] == 1) ? 2 : 1;?>
            <? $sortDate = (isset($_GET['sortEvent']) && $_GET['sortEvent'] == 3) ? 4 : 3;?>

            <th><a href="?c=event&a=eventManagement&sortEvent=<?=$sortName?>"> Eventname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=event&a=eventManagement&sortEvent=<?=$sortDate?>"> Datum <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th>Registrierungen</th>
            <th>Bild</th>
            <th>Optionen</th>
        </tr>
        <?foreach($eventList as $event) : ?>
            <tr>
                <td><?=$event['NAME']?></td>
                <td><?=date_format(date_create($event['DATE']), 'd.m.Y')?></td>
                <td><?=Booking::getRegistrationsByEventID($event['ID'])['EVENT']?></td>
                <td><?=$event['PICTURE']?></td>
                <td>
                    <a href="?c=event&a=CreateEvent&eventAction=edit&eventId=<?=$event['ID']?>"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>
                    <a href="?c=pages&a=deleteQuestion&eventAction=delete&eventId=<?=$event['ID']?>&pictureName=<?=$event['PICTURE']?>"><input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;"></a>
                </td>
            </tr>
        <?endforeach;?>
   </table>


    <table>
        <tr>
            <th>Abgelaufene Events</th>
        </tr>
        <tr>
            <? $sortName = (isset($_GET['sortEventOld']) && $_GET['sortEventOld'] == 1) ? 2 : 1;?>
            <? $sortDate = (isset($_GET['sortEventOld']) && $_GET['sortEventOld'] == 3) ? 4 : 3;?>

            <th><a href="?c=event&a=eventManagement&sortEventOld=<?=$sortName?>"> Eventname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=event&a=eventManagement&sortEventOld=<?=$sortDate?>"> Datum <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th>Registrierungen</th>
            <th>Bild</th>
            <th>Optionen</th>
        </tr>
        <?foreach($eventListOld as $event) : ?>
            <tr>
                <td><?=$event['NAME']?></td>
                <td><?=date_format(date_create($event['DATE']), 'd.m.Y')?></td>
                <td><?=Booking::getRegistrationsByEventID($event['ID'])['EVENT']?></td>
                <td><?=$event['PICTURE']?></td>
                <td>
                    <a href="?c=event&a=CreateEvent&eventAction=edit&eventId=<?=$event['ID']?>"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>
                    <a href="?c=pages&a=deleteQuestion&eventAction=delete&eventId=<?=$event['ID']?>&pictureName=<?=$event['PICTURE']?>"><input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;"></a>
                </td>
            </tr>
        <?endforeach;?>
    </table>

</div>