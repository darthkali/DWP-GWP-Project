<!DOCTYPE html>
<html lang="de">

    <head>
        <title>Neuen Nutzer anlegen</title>
        <meta name="description" content="Neuen Nutzer anlegen">
        <? include_once '../head.php';?>
    </head>


<body>
<? include '../navMenuBar.php';?>

<div id="SitePicture" class="fadeInImg">
    <img class="center" src="/FSAI-Site/assets/images/matrix.jpg" alt="ProfilPageImage">
</div>

<div id="Content" class="fadeIn">
    <form autocomplete= "off">
        <h1>Neuen Nutzer anlegen</h1>

        <label for="frontname">VORNAME </label>
        <input type = "text" id="frontname" name="frontname">

        <label for="rearname">NACHNAME </label>
        <input type = "text" id="rearname" name="rearname">

        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email">

        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth">

        <label for="functionFSR">FUNKTION IM FSR </label>
        <select name="functionFSR" id="functionFSR">
            <option>Sprecher</option>
            <option>stellv. Sprecher</option>
            <option>Finanzer</option>
            <option>stellv. Finanzer</option>
            <option selected>Mitglied</option>
            <option>archiviertes Mitglied</option>
        </select>

        <label for="role">ROLLE </label>
        <select name="role" id="role">
            <option>Admin</option>
            <option selected>User</option>
        </select>

        <button type="submit">Anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <a href="userManagement.php"> <button type="button">Abbrechen</button></a>


    </form>
</div>


<? include '../footer.php';?>
</body>
</html>