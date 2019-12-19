<?php

use FSR_AI\Booking;
use FSR_AI\Event;
use FSR_AI\Location;

$eventList = $eventListFuture;
$counter = 0;
$design = '';
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=IMAGEPATH.'firework.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">

    <h1>Unsere Events</h1>


    <?while($counter <= 1) :?>
        <?foreach($eventList as $event) :?>
            <div class="ContentEvents" <?=$design?>>
                <img src=<?=IMAGEPATH.'upload/events/'.$event['PICTURE']?>>
                <div>
                    <h2><?=$event['NAME']?></h2>
                    <p>
                        <strong>Datum: </strong> <?=date_format(date_create($event['DATE']), 'd.m.Y')?><br>
                        <strong>Ort: </strong><?=Location::buildLocationDetails($event['LOCATION_ID']);?> </p>
                    <p><?=$event['DESCRIPTION']?></p>
                </div>
                <?if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) : ?>
                    <?if(Event::getDateDiffBetweenEventAndCurrentDate($event['DATE']) <= 0) : ?>
                        <div class="ContentEvents" id="EventButton">
                            <a href="?c=event&a=Booking&eventId=<?=$event['ID']?>">
                                <button><?=Booking::checkRegistrationForEvent($event['ID']) ? 'Von dem Event abmelden' : 'Für das Event anmelden';?></button></a>
                        </div>
                    <?else: ?>
                        <div><strong>Das Event ist schonvorbei!!</strong></div>
                        <?Booking::deleteWhere('EVENT_ID = '.$event['ID']);?>
                    <?endif;?>
                <?else : ?>
                    <div class="ContentEventsButton"><strong>Zum anmelden bitte anmelden!</strong></div>
                <?endif;?>
            </div>
        <?endforeach;?>
    <?  $counter++;
        $design = 'id="ContentEventsInPast"';
        $eventList = $eventListPast;?>
    <?endwhile;?>
</div>