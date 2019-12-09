<div class="Content" id="fadeInIndexPage">
    <div class="pictureRaster">
        <h1>Herzlich Willkommen beim Fachschaftsrat der Angewandten Informatik</h1>
        <div class="startContent">
            <p>
                Alle Studierenden der Fachrichtung bilden die Fachschaft, aus deren Mitte die Vertreter für den Fachschaftsrat (FSR) gewählt werden. Wird speziell von der Fachschaft (FS) gesprochen, ist meist der Fachschaftsrat gemeint, d.h. die Gruppe von Studenten, die sich aktiv für die Interessen der Studierenden einsetzt.<br><br>
                Die Fachschaft kümmert sich um die Kommunikation der Studenten untereinander und zwischen der Studenten- und Professorenschaft. Besonderes Engagement gilt der Gestaltung des studentischen Lebens, sowie der Einflussnahme auf die Entwicklung der FH und unseres Studienganges durch die Mitarbeit in den Gremien.<br><br>
                Die Fachschaft organisiert und veranstaltet Parties zu besonderen Anlässen, z.B. zum Semesteranfang oder das Bergfest. Weiterhin beteiligen sich Fachschaftmitglieder als studentische Ansprechpartner am "Tag der offenen Tür" und arbeiten eng mit dem StuRa zusammen.<br>
            </p>
        <img src="/FSAI-Site/assets/images/ailogo_groß_schatten.png" alt="AiLogo">
        </div>
        <ul>
            <?$images = crateDataOfFilesFromDirectory("assets/images/PictureRaster/", 12);?>
<!--            print the pictures which has selected before with the '$rand_keys'-->
            <?foreach($images as $datei) : ?> <!-- Ausgabeschleife-->
                <li><img src="<?=ROOTPATH?>assets/images/PictureRaster/<?=$datei?>" alt="AiLogo"
            <?endforeach;?>
        </ul>
    </div>
</div>
<?//
//$images = crateDataOfFilesFromDirectory("assets/images/PictureRaster/", 12);
//
//// print the pictures which has selected before with the '$rand_keys'
//foreach ($images as $datei) { // Ausgabeschleife
//    $html ='<li><img src="'.ROOTPATH.'assets/images/PictureRaster/'.$datei.'" alt="AiLogo">';
//    debug_to_logFile($html);
//    echo $html;
//}
//?>