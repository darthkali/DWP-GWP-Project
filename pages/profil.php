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
               value = "<?=htmlspecialchars(user($_SESSION['user'])['firstName'])?>">

        <!-- rearname -->
        <label for="rearname">NACHNAME </label>
        <input type = "text" id="rearname" name="rearname"
               value = "<?=htmlspecialchars(user($_SESSION['user'])['lastName'])?>">

        <!-- email -->
        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email"
               value = "<?=htmlspecialchars(user($_SESSION['user'])['email'])?>">

        <!-- date of birth -->
        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth"
               value = "<?=htmlspecialchars(user($_SESSION['user'])['dateOfBirth'])?>">

        <!-- username -->
        <label for="username">NUTZERNAME </label>
        <input type = "text" id="username" name="username"
               value = "<?=htmlspecialchars(user($_SESSION['user'])['username'])?>">

        <!-- picture -->
        <label for="picture">BILD </label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="picture" name="picture"
               value = "<?=htmlspecialchars(user($_SESSION['user'])['picture'])?>">

        <!-- description -->
        <label for="description">BESCHREIBUNG  </label>
            <textarea name="description" id="description" cols="44" rows="5"><?=htmlspecialchars(user($_SESSION['user'])['description'])?></textarea>

        <!-- buttons -->
        <button type="submit">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="button">Passwort Ändern</button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
