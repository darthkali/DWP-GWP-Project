<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div action="#" method="post" class="Content" id="fadeIn">
    <form autocomplete= "off">
        <h1>Meine Daten</h1>
        <h5>Hier kannst du deine Daten ändern!</h5>

        <!-- frontname -->
        <label for="frontname">VORNAME </label>
        <input type = "text" id="frontname" name="frontname"
                value = "<?=htmlspecialchars($userProfil['FIRSTNAME'])?>">

        <!-- rearname -->
        <label for="rearname">NACHNAME </label>
        <input type = "text" id="rearname" name="rearname"
               value = "<?=htmlspecialchars($userProfil['LASTNAME'])?>">

        <!-- email -->
        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email"
               value = "<?=htmlspecialchars($userProfil['EMAIL'])?>">

        <!-- date of birth -->
        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth"
               value = "<?=htmlspecialchars($userProfil['DATE_OF_BIRTH'])?>">

        <!-- picture -->
        <label for="picture">BILD </label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="picture" name="picture"
               value = "<?=htmlspecialchars($userProfil['PICTURE'])?>">

        <!-- description -->
        <label for="description">BESCHREIBUNG  </label>
            <textarea name="description" id="description" cols="44" rows="5"><?=htmlspecialchars($userProfil['DESCRIPTION'])?></textarea>

        <!-- buttons -->
        <button type="submit">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="button">Passwort Ändern</button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
