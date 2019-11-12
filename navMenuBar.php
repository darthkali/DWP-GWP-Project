<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="topnav" id="myTopnav">
    <div class="topnavfloat">
        <a href="/FSAI-Site/pages/events.php" title="Unsere Veranstaltungen">Events</a>
        <a href="/FSAI-Site/pages/ueberUns.php" title="Das sind wir">Über uns</a>
        <a href="#" title="">Kontakt</a>
        <div class="dropdown">
            <button class="dropbtn">Mitglieder
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#" title="">Aktuelle Mitglieder</a>
                <a href="#" title="">Archivierte Mitglieder</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-user" aria-hidden="true" sizes="62x62"></i>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/FSAI-Site/pages/login.php" title="">Login</a>
                <a href="/FSAI-Site/pages/profil.php" title="">Profil</a>
                <a href="/FSAI-Site/pages/userManagement.php" title="">Nutzerverwaltung</a>
                <a href="/FSAI-Site/pages/eventManagement.php" title="">Eventverwaltung</a>
                <a href="#" title="">Abmelden</a>
            </div>
        </div>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</div>

<div class="NavContent">
    <a href="/FSAI-Site/" title="Startseite">
        <img src="/FSAI-Site/assets/images/ailogo_groß.png" alt="AiLogo">
        <h4>Fachschaftsrat</h4>
    </a>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>