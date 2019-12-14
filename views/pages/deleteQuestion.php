<?php

use FSR_AI\function_FSR;
use FSR_AI\MemberHistory;
use FSR_AI\User;

?>
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\team.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">

    <h1>Wollen SIe den User wirklich Löschen?</h1>
        <a href="?c=user&a=userManagement&userId=<?= $_GET['userId']?>"><button type="button">Löschen</button></a>
        <a href="?c=user&a=userManagement"><button type="button">Abbrechen</button></a>

</div>
