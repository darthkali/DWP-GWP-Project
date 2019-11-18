<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="topnav" id="myTopnav">
    <div class="topnavfloat">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=event">Events</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=aboutUs">Über uns</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=contact">Kontakt</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=users">Mitglieder</a>

        <div class="dropdown">
                <button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">

                <? if(!$loggedIn){?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=login">Login</a>
                <? } else { ?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=profil">Profil</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=userManagement">Nutzerverwaltung</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=eventManagement">Eventverwaltung</a>

                    <form action="<?=$_SERVER['PHP_SELF'].'?p=logOut';?>" method="post">
                        <input type="submit" name="submitLogout" value="Abmelden">
                    </form>



                <?}?>
            </div>
        </div>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</div>

<div class="NavContent">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=start">
        <img src="/FSAI-Site/assets/images/ailogo_groß.png" alt="AiLogo">
        <h4>Fachschaftsrat</h4>
    </a>
</div>

<script>
    function myFunction() {
        const x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>