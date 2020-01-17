<?
if($create == true){
    $action = 'index.php?c=event&a=CreateEvent&eventAction=create';
}else{
    $action = 'index.php?c=event&a=CreateEvent&eventAction=edit&eventId='.$eventData['ID'].'&pictureName='.$eventData['PICTURE'];
}
//die($required);
use FSR_AI\location; ?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'firework.jpg'?>" alt = "Großer Turm mit Feuerwerk">
</div>
<div class="Content" id="fadeIn">

    <form autocomplete="off" action="<?=$action?>" method="post" enctype="multipart/form-data">

        <h1><?=$headline?></h1>

        <? if(isset($eingabeError)){?> <div class="error"><?
            foreach($eingabeError as $error){?>
                <?=$error?><br>
            <?}?></div> <? } ?>

        <!-- name -->
        <div class="input">
            <label for="eventName">EVENTNAME</label>
            <input type = "text" id="eventName" name="eventName" placeholder="Eventname" required
                   value="<?=isset($eventData['NAME']) ? htmlspecialchars($eventData['NAME']) : ''?>">
                <span class="error-message" id="errorEventName"></span>
        </div>

        <!-- date -->
        <div class="input">
            <label for="eventDate">DATUM</label>
            <input type = "date" id="eventDate" name="eventDate" placeholder="Datum" required
                   value="<?=isset($eventData['DATE']) ? $eventData['DATE'] : ''?>">
                <span class="error-message" id="errorEventDate"></span>
        </div>

        <!-- location drop down menu -->
        <label for="eventLocation">ORT</label>
        <select class="dropDownMenu" id="eventLocation" name="eventLocation">

            <?foreach ($locationsList as $location) : ?>
                <?$selected = '';
                if($location['ID'] == $eventData['LOCATION_ID'])$selected = 'selected';?>
                    <option <?=$selected?> value="<?=$location['ID']?>">
                        <?=Location::buildLocationDetails($location['ID']);?>
                    </option>
            <?endforeach;?>
        </select>

        <!-- description -->
        <div class="input">
            <label for="eventDescription">BESCHREIBUNG</label>
            <textarea type = "textarea" id="eventDescription" name="eventDescription" placeholder="Beschreibung" required><?=isset($eventData['DESCRIPTION']) ? $eventData['DESCRIPTION'] : ''?></textarea>
                <span class="error-message" id="errorEventDescription"></span>
        </div>

        <label for="picture">BILD</label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="eventPicture" name="eventPicture" <?=isset($required) ? $required : ''?>>

        <!-- button -->
        <button type="submit" name="submitEvent" id="submitEvent"><?=$htmlButton?><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </form>
</div>
<script src="<?=JAVA_SCRIPT_PATH.'validateEvent.js'?>"></script>