<?php
use FSR_AI\Event;
use FSR_AI\User;
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'network.jpg'?>" alt = "mehrere Netwerkswitches mit Kabeln">
</div>

<div class="Content" id="fadeIn">
    <img src="<?=PAGE_IMAGE_PATH.'caution.png'?>" alt="ProfilPageImage">

    <?if(isset($_GET['userId'])){
      $title = 'Wollen Sie den Nutzer:';
        $user = User::findOne('ID = ' . $_GET['userId']);
        $Name = User::getFullName($user['FIRSTNAME'], $user['LASTNAME']);
        $hrefTarget = '?c=user&a=userManagement';
        $hrefDelete = '&userId=' . $_GET['userId'];
    }else{
        $title = 'Wollen Sie das Event:';
        $event = Event::findOne('ID = ' . $_GET['eventId']);
        $Name = $event['NAME'];
        $hrefTarget = '?c=event&a=eventManagement';
        $hrefDelete = '&eventId='. $_GET['eventId'] . '&pictureName='.$_GET['pictureName'];
    }?>

    <div class="deleteQuestion">
        <h3><?=$title?></h3>
        <h1><?=$Name ?></h1>
        <h3> wirklich Löschen?</h3><br>

        <a href="<?=$hrefTarget?><?=$hrefDelete?>"><button type="button">Löschen</button></a>
        <a href="<?=$hrefTarget?>"><button type="button">Abbrechen</button></a>
    </div>



</div>
