<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=PAGE_IMAGE_PATH.'mail.jpg'?>" alt = "Roter Postkasten">
</div>
<div class="Content" id="fadeIn">
    <form autocomplete="off" action="?c=pages&a=Contact" method="post" id="form">
        <h1>Kontakt</h1>

        <?if(isset($eingabeError)) :?>
            <div class="error">
                <?foreach($eingabeError as $error) :?>
                    <?=$error?><br>
                <?endforeach;?>
            </div>
        <? endif; ?>

        <!-- name -->
        <div class="input">
            <label for="name">NAME</label>
            <input type = "text" id="name" name="name" placeholder="Vor- und Nachname" required
                   value = "<?=isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''?>">
            <span class="error-message" id="errorName"></span>
        </div>

        <!-- email -->
        <div class="input">
            <label for="mail">EMAIL</label>
            <input type = "email" id="mail" name="mail" placeholder="Ihre E-Mail-Adresse" required
                   value = "<?=isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''?>">
            <span class="error-message" id="errorMail"></span>
        </div>

        <!-- subject -->
        <div class="input">
            <label for="subject">BETREFF</label>
            <input type = "text" id="subject" name="subject" placeholder="Betreff" required
                   value = "<?=isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''?>">
            <span class="error-message" id="errorSubject"></span>
        </div>

        <!-- text -->
        <div class="input">
            <label for="text">DEIN ANLIEGEN</label>
            <textarea type = "textarea" id="text" name="text" required placeholder="Dein Anliegen"><?=isset($_POST['textarea']) ? htmlspecialchars($_POST['textarea']) : ''?></textarea>
            <span class="error-message" id="errorTextarea"></span>
        </div>

        <!-- button -->
        <button type="submit" name="sendMail" id="sendMail">Abschicken <i class="far fa-paper-plane" aria-hidden="true"></i></button>
        <button type="reset">Löschen <i class="fa fa-times" aria-hidden="true"></i></button>
    </form>
</div>

<script src="<?=JAVA_SCRIPT_PATH.'validateContact.js'?>"></script>

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