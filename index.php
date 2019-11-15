<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Fachschaftsrat</title>
        <? include_once 'head.php';?>
    </head>

    <body>
        <? include 'navMenuBar.php';?>
        <div class="Content" id="fadeInIndexPage">
            <div class="pictureRaster">
                <h1>Herzlich Willkommen beim Fachschaftsrat der Angewandten Informatik</h1>
                <p>
                    Alle Studierenden der Fachrichtung bilden die Fachschaft, aus deren Mitte die Vertreter für den Fachschaftsrat (FSR) gewählt werden. Wird speziell von der Fachschaft (FS) gesprochen, ist meist der Fachschaftsrat gemeint, d.h. die Gruppe von Studenten, die sich aktiv für die Interessen der Studierenden einsetzt.
                </p>
                <p>
                    Die Fachschaft kümmert sich um die Kommunikation der Studenten untereinander und zwischen der Studenten- und Professorenschaft. Besonderes Engagement gilt der Gestaltung des studentischen Lebens, sowie der Einflussnahme auf die Entwicklung der FH und unseres Studienganges durch die Mitarbeit in den Gremien.
                </p>
                <p>
                    Die Fachschaft organisiert und veranstaltet Parties zu besonderen Anlässen, z.B. zum Semesteranfang oder das Bergfest. Weiterhin beteiligen sich Fachschaftmitglieder als studentische Ansprechpartner am "Tag der offenen Tür" und arbeiten eng mit dem StuRa zusammen.
                </p>
                <ul>
                    <?php
                    //create a grid with random pictures from a directory on the server
                    // image folder
                    $alledateien = scandir("assets\images\PictureRaster");

                    // delete the array indexes with '.' and '..'
                    foreach ($alledateien as $delete => &$val) { // Ausgabeschleife
                        if($alledateien[$delete] == "." or $alledateien[$delete] == '..'){
                            unset($alledateien[$delete]);
                        }
                    }

                    // random order of the array
                    shuffle($alledateien);

                    // pics 12 random indexes from the Array
                    $rand_keys = array_rand($alledateien, 18);

                    // print the pictures which has selected before with the '$rand_keys'
                    foreach ($rand_keys as $datei) { // Ausgabeschleife
                        $html ='<li><img src="/FSAI-Site/assets/images/PictureRaster/'.$alledateien[$datei].'" alt="AiLogo">';
                        echo $html;
                    }
                    ?>
                </ul>
            </div>
        </div>
        <? include 'footer.php';?>
    </body>
</html>