<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/laptop.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">
    <h1>Unsere Events</h1>
    <?
    $eventButton = "Anmelden";
    foreach($eventList as $event) {
        $locationData = $event['CITY'] . ', ' . $event['STREET'] . ' ' . $event['NUMBER'] . ', ' . $event['ZIPCODE'];
        if ($event['ROOM']) {
            $locationData .= ', Raum: ' . $event['ROOM'];
        }
        $html = '
        <div class="ContentEvents">
            <img src="/FSAI-Site/assets/images/upload/' . $event['PICTURE'] . '">
            <div>
                <h2>' . $event['NAME'] . '</h2>
                <p>
                    <strong>Datum: </strong>' . $event['DATE'] . '<br>
                    <strong>Ort: </strong>' . $locationData . '</p>
                <p>' . $event['DESCRIPTION'] . '</p>
            </div>';
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            $html .= '  <div class="ContentEventsButton">
                        <a href="index.php?c=pages&a=subscribe&event=' . $event['ID'] . '"><button>' . $eventButton . '</button></a>
                        </div>';
        } else {

            $html .= '<strong>Zum anmelden bitte anmelden!</strong>';
        }
        $html .= '</div>';
        echo $html;
    }
    ?>
</div>