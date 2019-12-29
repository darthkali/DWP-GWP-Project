<?php
use FSR_AI\Event;
use FSR_AI\User;
?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=IMAGEPATH.'network.jpg'?>" alt = "mehrere Netwerkswitches mit Kabeln">
</div>

<div class="Content" id="fadeIn">

    <img src="<?=IMAGEPATH.'caution.png'?>" alt="ProfilPageImage">
    <?if(isset($_GET['userId'])){?>
        <div class="deleteQuestion">
    <h3>Wollen Sie den Nutzer:</h3>
    <h1>
        <?
        $user = User::findOne('ID = '. $_GET['userId']);
        echo User::getFullName($user['FIRSTNAME'] , $user['LASTNAME'])

        ?>
    </h1>
    <h3> wirklich Löschen?</h3><br>

        <a href="?c=user&a=userManagement&userId=<?= $_GET['userId']?>"><button type="button">Löschen</button></a>
        <a href="?c=user&a=userManagement"><button type="button">Abbrechen</button></a>
    </div>
    <?}else{?>
        <div class="deleteQuestion">
    <h3>Wollen Sie das Event:</h3>
    <h1>
        <?
        $event = Event::findOne('ID = '. $_GET['eventId']);
        echo $event['NAME']
        ?>
    </h1>
    <h3> wirklich Löschen?</h3>

        <a href="?c=event&a=eventManagement&eventId=<?=$_GET['eventId']?>&pictureName=<?=$_GET['pictureName']?>"><button type="button">Löschen</button></a>
        <a href="?c=event&a=eventManagement"><button type="button">Abbrechen</button></a>
    </div>
    <?}?>
</div>
