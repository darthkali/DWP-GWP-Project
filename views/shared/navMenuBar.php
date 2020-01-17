<?php
use FSR_AI\role;
use FSR_AI\User;
?>
<nav>
    <input type="checkbox" id="responsive-nav">
    <label for="responsive-nav" class="responsive-nav-label">&#9776;</label>
    <div class="navfloat">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=events"><i class="fas fa-glass-cheers" aria-hidden="true"></i> Events</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=aboutUs"><i class="fas fa-info-circle" aria-hidden="true"></i>  Über uns</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=contact"><i class="far fa-address-card" aria-hidden="true"></i> Kontakt</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=users"><i class="fas fa-users" aria-hidden="true"></i> Mitglieder</a>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <? if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false){?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=login"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Login</a>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=registration"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Registrieren</a>
                <? } else {
                    $user = User::findUserBySessionUserID();
                    $roleID = $user['ROLE_ID'];
                    ?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=profil"> <i class="fas fa-user" aria-hidden="true"></i> Profil</a>

                    <? if($roleID == role::ADMIN || $roleID == role::MEMBER){?>
                        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=event&a=eventManagement"> <i class="fas fa-glass-cheers" aria-hidden="true"></i> Eventverwaltung </a>
                    <?}

                    if($roleID == role::ADMIN){?>
                        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=userManagement"> <i class="fas fa-users" aria-hidden="true"></i> Nutzerverwaltung</a>
                    <?}?>
                    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=user&a=logOut"> <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Abmelden</a>
                <?}?>
            </div>
        </div>
    </div>
</nav>

<div class="NavContent">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=start">
        <img src=<?=PAGE_IMAGE_PATH.'ailogo_groß.png'?> alt = "Logo der Angewandten Informatik">
        <h4>Fachschaftsrat</h4>
    </a>
</div>
