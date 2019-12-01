<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/laptop.jpg'?>" alt="Bild Eventseite">
</div>
<div class="Content" id="fadeIn">
    <h1>Unsere Events</h1>

    <?foreach($eventList as $output){
        foreach($locationList as $location){
            if($output['LOCATION_ID'] === $location['ID']){
                $locationDescription = $location['CITY'].', '.$location['STREET'].' '.$location['NUMBER'].', '.$location['ZIPCODE'];
                if($location['ROOM']){
                    $locationDescription .= ', Raum: '.$location['ROOM'];
                }
            }
        }
        echo '<div class="ContentEvents">
        <img src="/FSAI-Site/assets/images/PictureRaster/'.$output['PICTURE'].'">
        <div>
            <h2>'.$output['NAME'].'</h2>
            <p>
                <strong>Datum: </strong>'.$output['DATE'].'<br>
                <strong>Ort: </strong>'.$locationDescription.'</p>
            <p>'.$output['DESCRIPTION'].'</p>
        </div>
        <div class="ContentEventsButton">
            <button type="button">Für das Event Anmelden</button>
        </div>
    </div>';
    }
    ?>
</div>

