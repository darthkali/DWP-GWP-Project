<?php

use FSR_AI\booking;
use FSR_AI\location;

$eventList = $eventListFuture;
$counter = 0;
$design = '';
//$eventHistory = 'Zukünftige Events';
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/laptop.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">

    <h1>Unsere Events</h1>

    <?while($counter <= 1) :?>
<!--        <h3>--><?//=$eventHistory?><!--</h3>-->
        <?foreach($eventList as $event) :?>
            <div class="ContentEvents" <?=$design?>>
                <img src="/FSAI-Site/assets/images/upload/events/<?=$event['PICTURE']?>">
                <div>
                    <h2><?=$event['NAME']?></h2>
                    <p>
                        <strong>Datum: </strong> <?=date_format(date_create($event['DATE']), 'd.m.Y')?><br>
                        <strong>Ort: </strong><?=Location::buildLocationDetails($event['STREET'], $event['NUMBER'], $event['ZIPCODE'], $event['ROOM'], $event['CITY']);?> </p>
                    <p><?=$event['DESCRIPTION']?></p>
                </div>
                <?if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) : ?>
                    <?if(date_diff(date_create($event['DATE']), date_create(date('d.m.Y')))->format('%R%a') <= 0) : ?>
                        <div class="ContentEvents" id="EventButton">
                            <a href="index.php?c=event&a=Booking&eventId=<?=$event['ID']?>">
                                <button><?=Booking::find(Booking::buildWhereBooking($_SESSION['userId'], $event['ID'])) ? 'Von dem Event abmelden' : 'Für das Event anmelden';?></button></a>
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
        <?if($counter == 0) :?>
<!--        <hr id="ContentEventsLine"/>-->
        <?endif;?>
    <?  $counter++;
        $design = 'id="ContentEventsInPast"';
        $eventList = $eventListPast;
        //$eventHistory = 'Vergangene Events'?>
    <?endwhile;?>
</div>