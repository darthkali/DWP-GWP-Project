<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div action="#" method="post" class="Content" id="fadeIn">
    <form autocomplete= "off">
        <h1>Registrierung</h1>
        <h5>Hier kannst du dich Registrieren!</h5>

        <!-- frontname -->
        <label for="frontname">VORNAME </label>
        <input type = "text" id="frontname" name="frontname" required>

        <!-- rearname -->
        <label for="rearname">NACHNAME </label>
        <input type = "text" id="rearname" name="rearname" required>

        <!-- email -->
        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email" required>

        <label for="password">PASSWORT </label>
        <input type = "password" id="password" name="password" required>

        <!-- date of birth -->
        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth" required>

        <!-- buttons -->
        <button type="submit">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
