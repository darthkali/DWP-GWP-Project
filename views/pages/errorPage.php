<div class="ErrorPage">
   <h1>Ups... Da lief wohl etwas schief!</h1>
    <?$gif = crateDataOfFilesFromDirectory("assets/images/ErrorGifs", 1);?>

    <!--print the pictures which has selected before with the '$rand_keys'-->
    <img src="<?=ROOTPATH?>assets/images/ErrorGifs/<?=$gif?>" alt="AiLogo">;
</div>