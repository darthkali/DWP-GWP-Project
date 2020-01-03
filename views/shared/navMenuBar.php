<?php
use FSR_AI\role;
use FSR_AI\User;
?>
<nav>
    <input type="checkbox" id="responsive-nav">
    <label for="responsive-nav" class="responsive-nav-label">&#9776;</label>
    <div class="navfloat">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=events">Events</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=aboutUs">Über uns</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=contact">Kontakt</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=users">Mitglieder</a>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <? if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false){?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=login">Login</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=registration">Registrieren</a>
                <? } else {
                    $user = User::findUserBySessionUserID();
                    $roleID = $user['ROLE_ID'];
                    ?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=profil">Profil</a>

                    <? if($roleID == role::ADMIN || $roleID == role::MEMBER){?>
                        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=eventManagement">Eventverwaltung</a>
                    <?}

                    if($roleID == role::ADMIN){?>
                        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=userManagement">Nutzerverwaltung</a>
                    <?}?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=logOut">Abmelden</a>
                <?}?>
            </div>
        </div>
    </div>
</nav>

<div class="NavContent">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=start">
        <img src=<?=PAGE_IMAGE_PATH.'ailogo_groß.png'?> alt = "Logo der Angewandten Informatik">
        <h4>Fachschaftsrat</h4>
    </a>
</div>
