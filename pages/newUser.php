<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Neuen Nutzer anlegen</title>
        <meta name="description" content="Neuen Nutzer anlegen">
        <? include_once '../head.php';?>
    </head>
    <body>
        <? include '../navMenuBar.php';?>
        <div class="SitePicture" class="fadeInImg">
            <img class="center" src="/FSAI-Site/assets/images/matrix.jpg" alt="ProfilPageImage">
        </div>
        <div id="Content" class="fadeIn">
            <form autocomplete= "off">
                <h1>Neuen Nutzer anlegen</h1>

                <!-- frontname -->
                <label for="frontname">VORNAME </label>
                <input type = "text" id="frontname" name="frontname">

                <!-- rearname -->
                <label for="rearname">NACHNAME </label>
                <input type = "text" id="rearname" name="rearname">

                <!-- email -->
                <label for="email">EMAIL </label>
                <input type = "email" id="email" name="email">

                <!-- date of birth -->
                <label for="dateOfBirth">GEBURTSDATUM </label>
                <input type = "date" id="dateOfBirth" name="dateOfBirth">

                <!-- function FSR -->
                <label for="functionFSR">FUNKTION IM FSR </label>
                <select name="functionFSR" id="functionFSR">
                    <option>Sprecher</option>
                    <option>stellv. Sprecher</option>
                    <option>Finanzer</option>
                    <option>stellv. Finanzer</option>
                    <option selected>Mitglied</option>
                    <option>archiviertes Mitglied</option>
                </select>

                <!-- role -->
                <label for="role">ROLLE </label>
                <select name="role" id="role">
                    <option>Admin</option>
                    <option selected>User</option>
                </select>

                <!-- button -->
                <button type="submit">Anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                <a href="userManagement.php"> <button type="button">Abbrechen</button></a>
            </form>
        </div>
        <? include '../footer.php';?>
    </body>
</html>