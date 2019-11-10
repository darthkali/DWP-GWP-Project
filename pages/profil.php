<!DOCTYPE html>
<html lang="de">
<head>
    <title>Profil</title>
    <meta name="description" content="Profil">
    <? include_once '../head.php';?>
</head>


<body>
<? include '../navMenuBar.php';?>

<div class="SitePicture" class="fadeInImg">
    <img class="center" src="/FSAI-Site/assets/images/matrix.jpg" alt="ProfilPageImage">
</div>

<div id="Content" class="fadeIn">
    <form autocomplete= "off">
        <h1>Meine Daten</h1>
        <h5>Hier kannst du deine Daten ändern!</h5>

        <label for="frontname">VORNAME </label>
        <input type = "text" id="frontname" name="frontname">

        <label for="rearname">NACHNAME </label>
        <input type = "text" id="rearname" name="rearname">

        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email">

        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth">

        <label for="username">NUTZERNAME </label>
        <input type = "text" id="username" name="username">

        <label for="description">BESCHREIBUNG </label>
        <textarea name=“description” cols=“44” rows=“5”></textarea>

        <button type="submit">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="button">Passwort Ändern</button>
        <button type="reset"> Verwerfen</button>
        <button type="button">Bild Ändern</button>


    </form>
</div>


<? include '../footer.php';?>
</body>
</html>