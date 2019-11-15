<? include '../helper/functions.php';?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Nutzerverwaltung</title>
        <meta name="description" content="Nutzerverwaltung">
        <? include_once '../head.php';?>
    </head>
    <body>
        <? include '../navMenuBar.php';?>
        <div class="SitePicture" id="fadeInImg">
            <img class="center" src="/FSAI-Site/assets/images/matrix.jpg" alt="ProfilPageImage">
        </div>

        <div class="Content" id="fadeIn">
            <h1>Nutzerverwaltung</h1>
            <?
            $activeUsers = array(
                array('Danny','Steinbrecher', '24.12.1989', 'Sprecher', 'Admin'),
                array('Anton','Bespablov','','Finanzer','User'),
                array('Frieder','Ullmann','','stellv. Finanzer','User'),
                array('Nico','Merkel','','stellv. Sprecher','User'),
                array('Marcel','van der Heide','','Mitglied','User'),
                array('Dennis','Krischal','','Mitglied','User'),
                array('Adrian','Petzold','','Mitglied','User'),
                array('Chritian','Harder','','Mitglied','User'),
                array('Michael','Hopp','','Mitglied','User'),
                array('Sarah','Stefan','','Mitglied','User'),
                array('Niclas','Jarowsky','','Mitglied','Admin'),
            );
            $notActiveUsers = array(
                array('Timo','Weiß','','Archiviertes Mitglied','User'),
            );
            ?>

            <a href="newUser.php"> <button type="button">neuen Nutzer anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>
            <br><br>
            <h3>Aktive Nutzer</h3>
                <? printTable($activeUsers);   ?>
            <br>
            <h3>Archivierte Nutzer</h3>
                <?printTable($notActiveUsers);   ?>
        </div>
        <? include '../footer.php';?>
    </body>
</html>