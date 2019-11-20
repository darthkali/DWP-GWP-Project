<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="<?=$_SERVER['PHP_SELF'].'?p=contact';?>" method="post">
        <h1>Kontakt</h1>

        <!-- frontname -->
        <label for="name">NAME</label>
        <input type = "text" id="name" name="name" placeholder="Vor- und Nachname" required>

        <!-- email -->
        <label for="mail">EMAIL</label>
        <input type = "email" id="mail" name="mail" placeholder="Ihre E-Mail-Adresse" required>

        <!-- subject -->
        <label for="subject">BETREFF</label>
        <input type = "text" id="subject" name="subject" placeholder="Betreff" required>

        <!-- subject -->
        <label for="textarea">DEIN ANLIEGEN</label>
        <textarea type = "textarea" id="textarea" name="text" required placeholder="Dein Anliegen"></textarea>

        <!-- button -->
        <button type="submit" name="senden" onclick="<?sendMail();?>">Abschicken</button>
        <button type="reset">Löschen</button>
    </form>
</div>