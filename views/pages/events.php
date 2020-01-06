<?php
use FSR_AI\Booking;
use FSR_AI\Event;
use FSR_AI\Location;

$eventList = $eventListFuture;
$design = '';
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'firework.jpg'?>" alt = "Großer Turm mit Feuerwerk">
</div>
<div class="Content" id="fadeIn">

    <h1>Unsere Events</h1>

    <div class="filterBox">
        <form>

                    <div class="sortFilterBox">
                        <label for="sortByUser">Sortieren nach: </label> <br>
                        <select name="sortByUser" id="sortByUser">
                            <option value = 1 >  ---------</option>
                            <option value = 2 >  Eventname - Aufsteigend</option>
                            <option value = 3 >  Eventname - Absteigend</option>
                            <option value = 4 >  Datum - Aufsteigend</option>
                            <option value = 5 >  Datum - Absteigend</option>
                        </select>
                    </div>

                    <div class="sortFilterBox">
                        <label for="startDateEventFilter">Anfangsdatum </label><br>
                        <input type = "date" id="startDateEventFilter" name="startDateEventFilter"/>
                    </div>

                    <div class="sortFilterBox">
                        <label for="endDateEventFilter">Enddatum </label><br>
                        <input type = "date" id="endDateEventFilter" name="endDateEventFilter"/>
                    </div>

                    <!-- buttons -->
                    <button type="submit" name="filterID">Filter anwenden</button>
        </form>
    </div>
    <?for($i = 0; $i <= 1; $i++) : ?>
        <?foreach($eventList as $event) :?>
            <div class="ContentEvents" <?=$design?>>
                <img src=<?=EVENT_PICTURE_PATH.$event['PICTURE']?> alt = "Eventbild">
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
                                <?
                                if(Booking::checkRegistrationForEvent($event['ID'])){
                                    $buttonText = 'Von dem Event abmelden';
                                    $buttonClass = 'RegistrationButton';
                                }else{
                                    $buttonText = 'Für das Event anmelden';
                                    $buttonClass = null;
                                }?>
                                <button class ="<?=$buttonClass?>"><?=$buttonText?></button></a>
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
    <?  $design = 'id="ContentEventsInPast"';
        $eventList = $eventListPast;?>
    <?endfor;?>
</div>