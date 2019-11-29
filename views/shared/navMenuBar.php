
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav>
    <input type="checkbox" id="responsive-nav">
    <label for="responsive-nav" class="responsive-nav-label">&#9776;</label>
    <div class="navfloat">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=events">Events</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=aboutUs">Über uns</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=contact">Kontakt</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=users">Mitglieder</a>

        <div class="dropdown">
                <button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">


                <? if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false){?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=login">Login</a>
                <? } else { ?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=profil">Profil</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=userManagement">Nutzerverwaltung</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/? c=pages&a=eventManagement">Eventverwaltung</a>

                    <form action="<?=$_SERVER['PHP_SELF'].'?c=pages&a=logOut';?>" method="post">
                        <input type="submit" name="submitLogout" value="Abmelden">
                    </form>
                <?}?>
            </div>
        </div>
    </div>
</nav>

<div class="NavContent">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=start">
        <img src="/FSAI-Site/assets/images/ailogo_groß.png" alt="AiLogo">
        <h4>Fachschaftsrat</h4>
    </a>
</div>
