<?
if($create == true){
    $htmlButton = 'Event erstellen';
    $action = 'index.php?c=event&a=CreateEvent';
    $headline = 'Event erstellen';
    $required = 'required';
}else{
    $htmlButton = 'Änderungen speichern';
    $action = 'index.php?c=event&a=CreateEvent&eventId='.$eventData['ID'].'&pictureName='.$eventData['PICTURE'];
    $headline = 'Event bearbeiten';
    $required = '';
}

use FSR_AI\location; ?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/firework.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">

    <form autocomplete="off" action="<?=$action?>" method="post" enctype="multipart/form-data">

        <h1><?=$headline?></h1>

        <!-- name -->
        <label for="name">EVENTNAME</label>
        <input type = "text" id="eventName" name="eventName" placeholder="Eventname" required value="<?=isset($eventData['NAME']) ? $eventData['NAME'] : ''?>">

        <!-- date -->
        <label for="date">DATUM</label>
        <input type = "date" id="eventDate" name="eventDate" placeholder="Datum" required value="<?=isset($eventData['DATE']) ? $eventData['DATE'] : ''?>">

        <!-- location drop down menu -->
        <label for="location">ORT</label>
        <select name="eventLocation" required value="Test">

            <?foreach ($locationsList as $location) : ?>
                <?$selected = '';
                if($location['ID'] == $eventData['LOCATION_ID'])$selected = 'selected';?>
                    <option <?=$selected?> value="<?=$location['ID']?>">
                        <?=Location::buildLocationDetails($location['ID']);?>
                    </option>
            <?endforeach;?>
        </select>

        <!-- description -->
        <label for="description">BESCHREIBUNG</label>
        <textarea type = "textarea" id="eventDescription" name="eventDescription" placeholder="Beschreibung" required><?=isset($eventData['DESCRIPTION']) ? $eventData['DESCRIPTION'] : ''?></textarea>

        <label for="picture">BILD</label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="eventPicture" name="eventPicture" <?=$required?>>

        <!-- button -->
        <button type="submit" name="submitEvent"><?=$htmlButton?><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </form>
</div>