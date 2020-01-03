<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'street.jpg'?>" alt = "Alte Straße durch eine Häuserschlucht">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="?c=location&a=CreateLocation" method="post">

        <h1>Location erstellen</h1>

        <? if(isset($eingabeError)){?> <div class="error"><?
            foreach($eingabeError as $error){?>
                <?=$error?><br>
            <?}?></div> <? } ?>

        <!-- street -->
        <div class="input">
            <label for="locationStreet">Straße</label>
            <input type = "text" id="locationStreet" name="locationStreet" placeholder="Straße" required
                   value = "<?=isset($_POST['locationStreet']) ? htmlspecialchars($_POST['locationStreet']) : ''?>">
            <span class="error-message" id="errorLocationStreet"></span>
        </div>

        <!-- number -->
        <div class="input">
            <label for="locationNumber">Nummer</label>
            <input type = "text" id="locationNumber" name="locationNumber" placeholder="Nummer" required
                   value = "<?=isset($_POST['locationNumber']) ? htmlspecialchars($_POST['locationNumber']) : ''?>">
            <span class="error-message" id="errorLocationNumber"></span>
        </div>

        <!-- zipcode -->
        <div class="input">
            <label for="locationZipcode">Postleitzahl</label>
            <input type = "text" id="locationZipcode" name="locationZipcode" placeholder="Postleitzahl" required
                   value = "<?=isset($_POST['locationZipcode']) ? htmlspecialchars($_POST['locationZipcode']) : ''?>">
            <span class="error-message" id="errorLocationZipcode"></span>
        </div>

        <!-- city -->
        <div class="input">
            <label for="locationCity">Stadt</label>
            <input type = "text" id="locationCity" name="locationCity" placeholder="Stadt" required
                   value = "<?=isset($_POST['locationCity']) ? htmlspecialchars($_POST['locationCity']) : ''?>">
            <span class="error-message" id="errorLocationCity"></span>
        </div>

        <!-- room -->
        <div class="input">
            <label for="locationRoom">Raum</label>
            <input type = "text" id="locationRoom" name="locationRoom" placeholder="Raum (Optional)"
                   value = "<?=isset($_POST['locationRoom']) ? htmlspecialchars($_POST['locationRoom']) : ''?>">
            <span class="error-message" id="errorLocationRoom"></span>
        </div>

        <!-- button -->
        <button type="submit" name="submitCreateLocation" id="submitCreateLocation">Location erstellen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset">Eingaben Löschen <i class="fa fa-times" aria-hidden="true"></i> </button>
    </form>
</div>
<script src="<?=JAVA_SCRIPT_PATH.'script.js'?>"></script>