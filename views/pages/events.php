<?php

use FSR_AI\booking;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/laptop.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">
    <h1>Unsere Events</h1>
    <?
    foreach($eventList as $event) {
        $html = null;
        //check if logged in
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
        //when logged in
            //check if event is in the past
            if(date_diff(date_create($event['DATE']), date_create(date('d.m.Y')))->format('%R%a') < 0) {
                //check if user booked event
                if (Booking::find(Booking::buildWhereBooking($_SESSION['userId'], $event['ID']))) {
                    //when booked
                    $eventButton = 'Von dem Event abmelden';
                } else {
                    //when not booked
                    $eventButton = 'Für das Event anmelden';
                }
                //create the button if logged in
                $htmlButton = '<div class="ContentEventsButton">
                <a href="index.php?c=pages&a=Booking&eventId=' . $event['ID'] . '"><button>' . $eventButton . '</button></a>
                </div>';
            }else{
                $htmlButton = '<div class="ContentEventsButton"><strong>Das Event ist schonvorbei!!</strong></div>';
            }
        }else{
        //when not logged in then print text
            $htmlButton = '<div class="ContentEventsButton"><strong>Zum anmelden bitte anmelden!</strong></div>';
        }
        //print all Events from database
        $locationData = $event['CITY'] . ', ' . $event['STREET'] . ' ' . $event['NUMBER'] . ', ' . $event['ZIPCODE'];
        //If Room == null then dont print roomnumber
        if ($event['ROOM'])$locationData .= ', Raum: ' . $event['ROOM'];
        echo '
        <div class="ContentEvents">
            <img src="/FSAI-Site/assets/images/upload/' . $event['PICTURE'] . '">
            <div>
                <h2>' . $event['NAME'] . '</h2>
                <p>
                    <strong>Datum: </strong>' . date_format(date_create($event['DATE']), 'd.m.Y') . '<br>
                    <strong>Ort: </strong>' . $locationData . '</p>
                <p>' . $event['DESCRIPTION'] . '</p>
            </div>
            '.$htmlButton.'
        </div>';
    }
    ?>
</div>