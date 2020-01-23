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
    <div class="eventPageBox">
        <h1>Unsere Events</h1>

            <form method="post" class="filterBox">

                <div class="sortFilterBox">
                    <label for="sortByEvent">Sortieren nach: </label> <br>
                    <select name="sortByEvent" id="sortByEvent">
                        <option value = 1 <?=($valueSort == 1) ? 'selected' : ''?> >  Eventname - Aufsteigend</option>
                        <option value = 2 <?=($valueSort == 2) ? 'selected' : ''?> >  Eventname - Absteigend</option>
                        <option value = 3 <?=($valueSort == 3) ? 'selected' : ''?> >  Datum - Aufsteigend</option>
                        <option value = 4 <?=($valueSort == 4) ? 'selected' : ''?> >  Datum - Absteigend</option>
                        <option value = 5 <?=($valueSort == 5) ? 'selected' : ''?> >  Ort - Aufsteigend</option>
                        <option value = 6 <?=($valueSort == 6) ? 'selected' : ''?> >  Ort - Absteigend</option>
                    </select>
                </div>

                <div class="sortFilterBox">
                    <label for="startDateEventFilter">Anfangsdatum: </label><br>
                    <input type = "date" id="startDateEventFilter" name="startDateEventFilter" placeholder="Datum"
                           value="<?=isset($earliestDate) ? $earliestDate : ''?>">
                </div>

                <div class="sortFilterBox">
                    <label for="endDateEventFilter">Enddatum: </label><br>
                    <input type = "date" id="endDateEventFilter" name="endDateEventFilter" value="<?=isset($latestDate) ? $latestDate : ''?>"/>
                </div>

                <!-- buttons -->
                <div class="sortFilterBox" id="ButtonInCenter">
                    <button class="FilterBoxButton" type="submit" name="filterID">Filter anwenden <i class="fas fa-filter" aria-hidden="true"></i></button>
                </div>
            </form>

        <?if($eventListPast == null && $eventListFuture == null) : ?>
        <div class="ContentEvents">
            <h1>Leider gibt es zu diesem Zeitpunkt keine Events:(</h1>
        </div>
        <?endif;?>

        <?for($i = 0; $i <= 1; $i++) : ?>
            <?foreach($eventList as $event) :?>
                <div class="ContentEvents" <?=$design?>>
                    <img id="eventBox" src=<?=EVENT_PICTURE_PATH.$event['PICTURE']?> alt = "Eventbild">
                    <div>
                        <h2><?=$event['NAME']?></h2>
                        <p>
                            <strong>Datum: </strong><?=date_format(date_create($event['DATE']), 'd.m.Y')?><br>
                            <strong>Ort: </strong><?=Location::buildLocationDetails($event['LOCATION_ID']);?> </p>
                        <p><?=$event['DESCRIPTION']?></p>
                    </div>

                    <?if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && Event::getDateDiffBetweenEventAndCurrentDate($event['DATE']) <= 0) : ?>
                        <!--What happened when logged in and event is in future-->
                        <div class="ContentEvents" id="EventButton">
                            <a href="?c=event&a=Booking&eventId=<?=$event['ID']?>#<?=$event['ID']?>-event">
                                <?
                                if(Booking::checkRegistrationForEvent($event['ID'])){
                                    $buttonText = 'Von dem Event abmelden';
                                    $buttonClass = 'RegistrationButton';
                                }else{
                                    $buttonText = 'Für das Event anmelden';
                                    $buttonClass = null;
                                }?>
                            <button id="eventBox" class ="<?=$buttonClass?>"><?=$buttonText?></button></a>
                        </div>
                    <?else : ?>
                        <?if(Event::getDateDiffBetweenEventAndCurrentDate($event['DATE']) <= 0): ?>
                            <!--What happened when not logged in but event is in future -->
                            <?$buttonText = 'Zum anmelden bitte anmelden!!'?>
                        <?else :?>
                            <!--What happened when not logged in and event is in past -->
                            <?$buttonText = 'Das Event ist vorbei!'?>
                        <?endif;?>
                        <div ><strong><?=isset($buttonText) ? $buttonText : ''?></strong></div>
                        <!--<a id="buttonForShowMore"></a>-->
                    <?endif;?>
                </div>
            <?endforeach;?>
        <?  $design = 'id="ContentEventsInPast"';
            $eventList = $eventListPast;?>
        <?endfor;?>
    </div>
</div>