<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="<?=$_SERVER['PHP_SELF'].'?p=createEvent';?>" method="post">

        <h1>Event erstellen</h1>

        <!-- name -->
        <label for="name">EVENTNAME</label>
        <input type = "text" id="eventname" name="eventname" placeholder="Eventname" required>

        <!-- date -->
        <label for="date">DATUM</label>
        <input type = "date" id="date" name="date" placeholder="Datum" required>

        <!-- location drop down menu -->
        <label for="location">ORT</label>
        <select name="location" required>
            <option selected="selected">---Ort auswählen!---</option>
            <?getLocations();?>
        </select>

        <!-- description -->
        <label for="description">BESCHREIBUNG</label>
        <textarea type = "textarea" id="description" name="description" placeholder="Beschreibung" required></textarea>

        <!-- button -->
        <button type="submit" name="senden" onclick=" <?newEvent();?>">Event Erstellen</button>
        <button type="reset">Eingaben Löschen</button>
    </form>
</div>