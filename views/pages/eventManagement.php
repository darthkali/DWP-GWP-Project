
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <h1>Eventverwaltung</h1>
    <?
    $myArray = array(
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
        array('Timo','Weiß','','Archiviertes Mitglied','User'),
    );
    printTable($myArray);
    ?>
    <a href="index.php?c=pages&a=CreateEvent"><button type="button">Neues Event anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>
    <a href=""><button type="button">Event bearbeiten<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>
</div>
