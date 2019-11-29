<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="<?=$_SERVER['PHP_SELF'].'?p=contact';?>" method="post">
        <h1>Kontakt</h1>

        <!-- frontname -->
        <label for="name">NAME</label>
        <input type = "text" id="name" name="name" placeholder="Vor- und Nachname" required>

        <!-- email -->
        <label for="mail">EMAIL</label>
        <input type = "email" id="mail" name="mail" placeholder="Ihre E-Mail-Adresse" required>

        <!-- subject -->
        <label for="subject">BETREFF</label>
        <input type = "text" id="subject" name="subject" placeholder="Betreff" required>

        <!-- subject -->
        <label for="textarea">DEIN ANLIEGEN</label>
        <textarea type = "textarea" id="textarea" name="text" required placeholder="Dein Anliegen"></textarea>

        <!-- button -->
        <button type="submit" name="senden" onclick="<?sendMail();?>">Abschicken</button>
        <button type="reset">Löschen</button>
    </form>
</div>

<!---------------------------------------------   Damit du von Xampp Email senden kannst  -------------------------------------------------------->
<!------------------------------- Zur zeit gehen alle emails an eine web adresse von mir die ich nie benutze  ------------------------------------>
<!-- Um sie zu unsere email der FS weiter zu leiten musst du in der functions.php Zeile: 199, bei mail(to: "unsere richtige mail",.....) ändern -->


<!-- Füge das in deine php.ini unter [mail function] ein und kommentiere alles andere aus

    SMTP=smtp.web.de
    smtp_port=587
    sendmail_from = fsraiformular@web.de
    sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

-->

<!-- Füge das in deine sendmail.ini unter [sendmail] ein und kommentiere alles andere aus

    smtp_server=smtp.web.de
    smtp_port=587
    error_logfile=error.log
    debug_logfile=debug.log
    auth_username=fsraiformular@web.de
    auth_password=Di1sP4dKontaktformular!
    force_sender=fsraiformular@web.de

-->