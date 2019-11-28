<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="<?=$_SERVER['PHP_SELF'].'?p=eventRegistration';?>" method="post">
        <h1>Eventanmeldung</h1>

        <!-- name -->
        <label for="name">NAME</label>
        <input type = "text" id="name" name="name" placeholder="Vor- und Nachname" required>

        <!-- email -->
        <label for="mail">EMAIL</label>
        <input type = "email" id="mail" name="mail" placeholder="Ihre E-Mail-Adresse" required>

        <!-- subject -->
        <label for="textarea">ANMERKUNGEN</label>
        <textarea type = "textarea" id="textarea" name="text" placeholder="Anmerkungen"></textarea>

        <!-- button -->
        <button type="submit" name="senden" onclick="<?sendMail(true);?>">Anmelden</button>
        <button type="reset">Eingaben Löschen</button>
    </form>
</div>