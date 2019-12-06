<?php

use FSR_AI\booking;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/laptop.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">
    <h1>Unsere Events</h1>

    <?foreach($eventList as $event) :?>
    <??>
    <div class="ContentEvents">
        <img src="/FSAI-Site/assets/images/upload/<?=$event['PICTURE']?>">
        <div>
            <h2><?=$event['NAME']?></h2>
            <p>
                <strong>Datum: </strong> <?=$event['DATE']?><br>
                <strong>Ort: </strong> </p>
            <p><?=$event['DESCRIPTION']?></p>
        </div>
        <?if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) : ?>
           <?if(date_diff(date_create($event['DATE']), date_create(date('d.m.Y')))->format('%R%a') < 0) : ?>
                <div class="ContentEvents" id="EventButton">
                    <a href="index.php?c=pages&a=Booking&eventId=<?=$event['ID']?>">
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
</div>