<?php
use FSR_AI\Event;
?>
<div class="Content" id="fadeInIndexPage">
    <div class="pictureRaster">
        <div>
                <div class="startContent">
                    <h1>Herzlich Willkommen beim Fachschaftsrat der Angewandten Informatik</h1><br>
                    <p>
                        Alle Studierenden der Fachrichtung bilden die Fachschaft, aus deren Mitte die Vertreter für den Fachschaftsrat (FSR) gewählt werden. Wird speziell von der Fachschaft (FS) gesprochen, ist meist der Fachschaftsrat gemeint, d.h. die Gruppe von Studenten, die sich aktiv für die Interessen der Studierenden einsetzt.<br><br>
                        Die Fachschaft kümmert sich um die Kommunikation der Studenten untereinander und zwischen der Studenten- und Professorenschaft. Besonderes Engagement gilt der Gestaltung des studentischen Lebens, sowie der Einflussnahme auf die Entwicklung der FH und unseres Studienganges durch die Mitarbeit in den Gremien.<br><br>
                        Die Fachschaft organisiert und veranstaltet Parties zu besonderen Anlässen, z.B. zum Semesteranfang oder das Bergfest. Weiterhin beteiligen sich Fachschaftmitglieder als studentische Ansprechpartner am "Tag der offenen Tür" und arbeiten eng mit dem StuRa zusammen.<br>
                    </p>
                </div>
                <div class="eventCounterStart">

                    <h3>Tage bis zum nächsten Event</h3>
                    <div class="daysToEvent">
                        <div class="daysToEventDigit"><?=$daysUntilEvent['hundreds']?> </div>
                        <div class="daysToEventDigit"><?=$daysUntilEvent['tens']?> </div>
                        <div class="daysToEventDigit"><?=$daysUntilEvent['ones']?> </div>
                    </div>

                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=events">
                    <? if($nextEvent != null){?>
                    <?=$nextEvent['NAME']?> <br>
                        <?=date_format(date_create($nextEvent['DATE']), 'd.m.Y')?><br>
                        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=events">
                        <img src=<?=IMAGEPATH . 'upload/events/'.$nextEvent['PICTURE']?> alt = "Eventbild">
                            <? }else{?>
                            Aktuell ist kein weiteres Event geplant
                            <?}?>
                    <br>

                    <i class="fas fa-share"> Zur Eventseite</i>
                    </a>
                </div>
        </div>
        <hr>
        <ul>
            <?$images = crateDataOfFilesFromDirectory("assets/images/PictureRaster/", 12);?>
<!--            print the pictures which has selected before with the '$rand_keys'-->
            <?foreach($images as $datei) : ?> <!-- Ausgabeschleife-->
                <li><a href="<?=IMAGEPATH?>PictureRaster/<?=$datei?>" target="_blank"><img src="<?=IMAGEPATH?>PictureRaster/<?=$datei?>" alt = "Bilder der Fachschaft Angewandte Informatik"
            <?endforeach;?>
        </ul>
    </div>
</div>