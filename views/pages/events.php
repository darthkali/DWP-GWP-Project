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
                $htmlButton = '<div class="ContentEvents" id="EventButton">
                <a href="index.php?c=pages&a=Booking&eventId=' . $event['ID'] . '"><button>' . $eventButton . '</button></a>
                </div>';
            }else{
                $htmlButton = '<div><strong>Das Event ist schonvorbei!!</strong></div>';
                Booking::deleteWhere('EVENT_ID = '.$event['ID']);
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

<?/*HTML CODE


<div class="accordion-bral">

  <div>
    <!-- accordion item 1 -- start -->
    <input class="ac-input" id="ac-1" name="accordion-1" type="checkbox" checked/>
    <label class="ac-label" for="ac-1">

      <h2>Test</h2>
      <img src="https://www.fotocommunity.de/photo/hintergrundbild-mit-tuerkisfarbenem-roman-mikhailov/39197116">
                <p>
                    <strong>Datum: </strong>12.12.2018<br>
                    <strong>Ort: </strong>Efurt Hauptbahnhof</p></label>
    <div class="article ac-content">
            <div>
                <p>DaS IST EINE bESCHREIBUNG</p>
            </div>
    </div>
  </div>
  <!-- accordion item 1 -- end -->

<div>

CSS CODE

https://codepen.io/edcotty/pen/RPWEmN?editors=1100

.accordion-bral {
  min-height: 0;
  min-width: 80%;
  width: 100%;
  height: 100%;
  background-color: #FFF;
  margin: 0px!important;
}

.accordion-bral .ac-label {
  font-family: Arial, sans-serif;
  //padding: 5px 20px;
  position: relative;
  display: block;
  height: auto;
  cursor: pointer;
  color: #777;
  line-height: 33px;
  font-size: 19px;
  background: #EFEFEF;
  border: 1px solid #CCC;
}
.accordion-bral .ac-label:hover {
  background: #BBB;
}
.accordion-bral input.ac-input {
  display: none;
}
.accordion-bral .article {
  background: rgb(240, 240, 240);
  overflow: hidden;
  height: 0px;
  max-height: auto;
}
.accordion-bral .article p {
  color: #777;
  line-height: 23px;
  font-size: 14px;
  //padding: 20px;
}
.accordion-bral input:checked ~ .article.ac-content {
  height: auto;
}

.accordion-bral i {
  position: absolute;
  transform: translate(-30px, 0);
  margin-top: 16px;
  right: 0;
}
.accordion-bral i:before, .accordion-bral i:after {
  position: absolute;
  background-color: #808080;
  width: 3px;
  height: 9px;
}
@media (max-width: 550px) {
  .accordion-bral .ac-label {
  font-family: Arial, sans-serif;
  padding: 5px 20px;
  position: relative;
  display: block;
  height: auto;
  padding-right: 40px;
  cursor: pointer;
  color: #777;
  line-height: 33px;
  font-size: 19px;
  background: #EFEFEF;
  border: 1px solid #CCC;
}
  .accordion-bral i {
  position: absolute;
  transform: translate(-30px, 0);
  margin-top: 2%;
  right: 0;
}
}
*/?>