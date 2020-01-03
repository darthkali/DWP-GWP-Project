<?php
use FSR_AI\Booking;
?>

<div class="Content" id="fadeIn">
    <h1>Eventverwaltung</h1>

    <a href="?c=event&a=CreateEvent&eventAction=create">
        <button type="button">Neues Event anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </a>
    <a href="?c=location&a=CreateLocation">
        <button type="button">Neue Location erstellen</button>
    </a>

    <?  // generate Variables for the new Events
    $topic          = 'Noch kommende Events';
    $sortEvent = 'sortEvent';
    $events      = $eventList;

    for ($i = 1; $i <= 2; $i++) { ?>
   <table>
       <tr>
       <th><?=$topic?></th>
       </tr>
        <tr>
            <? $sortName = (isset($_GET[$sortEvent]) && $_GET[$sortEvent] == 1) ? 2 : 1;?>
            <? $sortDate = (isset($_GET[$sortEvent]) && $_GET[$sortEvent] == 3) ? 4 : 3;?>

            <th><a href="?c=event&a=eventManagement&<?=$sortEvent?>=<?=$sortName?>"> Eventname <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th><a href="?c=event&a=eventManagement&<?=$sortEvent?>=<?=$sortDate?>"> Datum <i class="fa fa-sort" aria-hidden="true"></i></a></th>
            <th>Registrierungen</th>
            <th>Bild</th>
            <th>Optionen</th>
        </tr>
        <?foreach($events as $event) : ?>
            <tr>
                <td><?=$event['NAME']?></td>
                <td><?=date_format(date_create($event['DATE']), 'd.m.Y')?></td>
                <td><?=Booking::getRegistrationsByEventID($event['ID'])['EVENT']?></td>
                <td><?=$event['PICTURE']?></td>
                <td>
                    <a href="?c=event&a=CreateEvent&eventAction=edit&eventId=<?=$event['ID']?>">
                        <input alt="Edit" type="image" title="Event bearbeiten" src=<?=PAGE_IMAGE_PATH.'edit.png'?>>
                    </a>
                    <a href="?c=pages&a=deleteQuestion&eventAction=delete&eventId=<?=$event['ID']?>&pictureName=<?=$event['PICTURE']?>"
                       onclick="return deleteQuestionEvent(this, <?=$event['ID']?>, <?=$event['PICTURE']?>)">
                        <input alt="Delete" type="image" title="Event entfernen" src=<?=PAGE_IMAGE_PATH.'entfernen.png'?>>
                    </a>
                </td>
            </tr>
        <?endforeach;

        // generate Variables for the old Events
        $topic          = 'Abgelaufene Events';
        $sortEvent = 'sortEventOld';
        $events      = $eventListOld;

        ?>
   </table>
    <? } ?>

</div>

<script src="<?=JAVA_SCRIPT_PATH.'script.js'?>"></script>
