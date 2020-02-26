<?php
use FSR_AI\Event;
use FSR_AI\User;
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'network.jpg'?>" alt = "mehrere Netwerkswitches mit Kabeln">
</div>

<div class="Content" id="fadeIn">
    <img src="<?=PAGE_IMAGE_PATH.'caution.png'?>" alt="ProfilPageImage">

    <div class="deleteQuestion">
        <h3><?=$title?></h3>
        <h1><?=$Name ?></h1>
        <h3> wirklich Löschen? </h3>

        <a href="<?=$hrefTarget?><?=$hrefDelete?>"><button type="button">Löschen <i class="fas fa-user-slash"></i></button></a>
        <a href="<?=$hrefTarget?>"><button type="button">Abbrechen <i class="fas fa-window-close"></i></button></a>
    </div>

</div>
