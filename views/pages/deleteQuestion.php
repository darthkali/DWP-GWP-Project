<?php

use FSR_AI\function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\network.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">

    <?if(isset($_GET['userId'])){?>
    <h1>Wollen Sie den User wirklich Löschen?</h1>
        <a href="?c=user&a=userManagement&userId=<?= $_GET['userId']?>"><button type="button">Löschen</button></a>
        <a href="?c=user&a=userManagement"><button type="button">Abbrechen</button></a>
    <?}else{?>
    <h1>Wollen Sie das Event wirklich Löschen?</h1>
    <a href="?c=event&a=eventManagement&eventId=<?=$_GET['eventId']?>&pictureName=<?=$_GET['pictureName']?>"><button type="button">Löschen</button></a>
    <a href="?c=event&a=eventManagement"><button type="button">Abbrechen</button></a>
    <?}?>
</div>
