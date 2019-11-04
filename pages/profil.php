<!DOCTYPE html>
<html lang="de">
<head>
    <title>Profil</title>
    <meta charset="UTF-8">
    <meta name="description" content="Kurzbeschreibung">
    <link rel="stylesheet" href="../assets/css/design.css">
    <link rel="shortcut icon" type="image/png" href="/DWP-GWP-Project/assets/images/ailogo.png">
</head>

<body>
<? include '../navMenuBar.php';?>

<div id="SitePicture" class="fadeInImg">
    <img class="center" src="/FSAI-Site/assets/images/matrix.jpg">
</div>

<div id="Content" class="fadeIn">
    <form>
        <h1>Meine Daten</h1>
        <h5>Hier kannst du deine Daten ändern!</h5>

        <label for="username">VORNAME </label>
        <input type = "text";id="username" name="username">

        <label for="username">NACHNAME </label>
        <input type = "text";id="username" name="username">

        <label for="username">GEBURTSDATUM </label>
        <input type = "text";id="username" name="username">

        <label for="username">NUTZERNAME </label>
        <input type = "text";id="username" name="username">

        <label for="username">BESCHREIBUNG </label>
        <input type = "text";id="username" name="username">

        <img src="/FSAI-Site/assets/images/loginIcon.png">
    </form>
</div>


<? include '../footer.php';?>
</body>
</html>