<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <?
    $resetButton = '';
    if($create == true){
        $htmlButton = 'Event erstellen';
        $resetButton = '<button type="reset">Eingaben Löschen</button>';
        $action = 'index.php?c=pages&a=IntoDatabase&siteId=0';
    }else{
        $htmlButton = 'Änderungen speichern';
        $action = 'index.php?c=pages&a=IntoDatabase&siteId=0&eventId='.$eventData['ID'].'&picturePath='.$eventData['PICTURE'];
    }
    ?>
    <form autocomplete="off" action="<?=$action?>" method="post" enctype="multipart/form-data">

        <h1>Event erstellen</h1>

        <!-- name -->
        <label for="name">EVENTNAME</label>
        <input type = "text" id="eventName" name="eventName" placeholder="Eventname" required value="<?=htmlspecialchars($eventData['NAME'])?>">

        <!-- date -->
        <label for="date">DATUM</label>
        <input type = "date" id="eventDate" name="eventDate" placeholder="Datum" required value="<?=htmlspecialchars($eventData['DATE'])?>">

        <!-- location drop down menu -->
        <label for="location">ORT</label>
        <select name="eventLocation" required value="Test">
            <?
            foreach ($locationsList as $location) {
                $selected = '';
                if($location['ID'] == $eventData['LOCATION_ID']){
                    $selected = 'selected';
                }
                $html = '<option '.$selected.' value="'.$location['ID'].'">'.$location['CITY'].', '.$location['STREET'].' '.$location['NUMBER'].', '.$location['ZIPCODE'];
                if($location['ROOM']){
                    $html .= ', Raum: '.$location['ROOM'];
                }
                $html .= '</option>';
                echo $html;
            }?>
        </select>

        <!-- description -->
        <label for="description">BESCHREIBUNG</label>
        <textarea type = "textarea" id="eventDescription" name="eventDescription" placeholder="Beschreibung" required><?=htmlspecialchars($eventData['DESCRIPTION'])?></textarea>

        <label for="picture">BILD</label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="eventPicture" name="eventPicture">

        <!-- button -->
        <?
        echo '<button type="submit">'.$htmlButton.'
              <i class="fa fa-floppy-o" aria-hidden="true"></i></button>'.$resetButton;
        ?>
    </form>
</div>