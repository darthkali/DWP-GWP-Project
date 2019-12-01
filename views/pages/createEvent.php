<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="index.php?c=pages&a=IntoDatabase&siteId=0" method="post">

        <h1>Event erstellen</h1>

        <!-- name -->
        <label for="name">EVENTNAME</label>
        <input type = "text" id="eventName" name="eventName" placeholder="Eventname" required>

        <!-- date -->
        <label for="date">DATUM</label>
        <input type = "date" id="eventDate" name="eventDate" placeholder="Datum" required value="tt.mm.jjjj">

        <!-- location drop down menu -->
        <label for="location">ORT</label>
        <select name="eventLocation" required>
            <?
            foreach ($locationsList as $location) {
                $html = '<option value="'.$location['ID'].'">'.$location['CITY'].', '.$location['STREET'].' '.$location['NUMBER'].', '.$location['ZIPCODE'];
                if($location['ROOM']){
                    $html .= ', Raum: '.$location['ROOM'];
                }
                $html .= '</option>';
                echo $html;
            }?>
        </select>
        <a href="index.php?c=pages&a=CreateLocation"><button type="button">Neue Location erstellen</button></a>

        <!-- description -->
        <label for="description">BESCHREIBUNG</label>
        <textarea type = "textarea" id="eventDescription" name="eventDescription" placeholder="Beschreibung" required></textarea>

        <label for="picture">BILD </label>
        <input type = "file"  accept=".jpg, .jpeg, .png" id="picture" name="picture">

        <!-- button -->
        <button type="submit">Event Erstellen<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset">Eingaben Löschen</button>
    </form>
</div>