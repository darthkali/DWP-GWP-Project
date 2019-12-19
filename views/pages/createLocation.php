<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=IMAGEPATH.'street.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="?c=location&a=CreateLocation" method="post">

        <h1>Location erstellen</h1>

        <? if(isset($eingabeError)){?> <div class="error"><?
            foreach($eingabeError as $error){?>
                <?=$error?><br>
            <?}?></div> <? } ?>

        <!-- street -->
        <label for="locationStreet">Straße</label>
        <input type = "text" id="locationStreet" name="locationStreet" placeholder="Straße" required
               value = "<?=isset($_POST['locationStreet']) ? htmlspecialchars($_POST['locationStreet']) : ''?>">

        <!-- number -->
        <label for="locationNumber">Nummer</label>
        <input type = "text" id="locationNumber" name="locationNumber" placeholder="Nummer" required
               value = "<?=isset($_POST['locationNumber']) ? htmlspecialchars($_POST['locationNumber']) : ''?>">

        <!-- zipcode -->
        <label for="locationZipcode">Postleitzahl</label>
        <input type = "text" id="locationZipcode" name="locationZipcode" placeholder="Postleitzahl" required
               value = "<?=isset($_POST['locationZipcode']) ? htmlspecialchars($_POST['locationZipcode']) : ''?>">

        <!-- city -->
        <label for="locationCity">Stadt</label>
        <input type = "text" id="locationCity" name="locationCity" placeholder="Stadt" required
               value = "<?=isset($_POST['locationCity']) ? htmlspecialchars($_POST['locationCity']) : ''?>">

        <!-- room -->
        <label for="locationRoom">Raum</label>
        <input type = "text" id="locationRoom" name="locationRoom" placeholder="Raum (Optional)"
               value = "<?=isset($_POST['locationRoom']) ? htmlspecialchars($_POST['locationRoom']) : ''?>">

        <!-- button -->
        <button type="submit" name="submitCreateLocation">Location erstellen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset">Eingaben Löschen <i class="fa fa-times" aria-hidden="true"></i> </button>
    </form>
</div>