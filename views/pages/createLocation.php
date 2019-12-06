<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="index.php?c=event&a=IntoDatabase&siteId=1" method="post">

        <h1>Location erstellen</h1>

        <!-- street -->
        <label for="locationStreet">Straße</label>
        <input type = "text" id="locationStreet" name="locationStreet" placeholder="Straße" required>

        <!-- number -->
        <label for="locationNumber">Nummer</label>
        <input type = "text" id="locationNumber" name="locationNumber" placeholder="Nummer" required>

        <!-- zipcode -->
        <label for="locationZipcode">Postleitzahl</label>
        <input type = "text" id="locationZipcode" name="locationZipcode" placeholder="Postleitzahl" required>

        <!-- city -->
        <label for="locationCity">Stadt</label>
        <input type = "text" id="locationCity" name="locationCity" placeholder="Stadt" required>

        <!-- room -->
        <label for="locationRoom">Raum</label>
        <input type = "text" id="locationRoom" name="locationRoom" placeholder="Raum (Optional)">

        <!-- button -->
        <button type="submit">Location erstellen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset">Eingaben Löschen</button>
    </form>
</div>