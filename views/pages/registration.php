<?php
use FSR_AI\User;

if(isset($_POST['submitRegistration'])){
    $params = [
        'FIRSTNAME'      => $_POST['firstname'],
        'LASTNAME'          => $_POST['lastname'],
        'DATE_OF_BIRTH'   => $_POST['dateOfBirth'],
        'EMAIL'   => $_POST['email'],
        'PASSWORD'   => $_POST['password']
    ];


    $newUser = new user($params);
    debug_to_logFile($newUser->params['FIRSTNAME']);
   foreach ($params as $key => $value) {
       $newUser->__set($key, $value);
    }
    $newUser->save();
}

?>

<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <form autocomplete= "off" action="index.php?c=user&a=Registration" method="post" >
        <h1>Registrierung</h1>
        <h5>Hier kannst du dich Registrieren!</h5>

        <!-- frontname -->
        <label for="firstname">VORNAME </label>
        <input type = "text" id="firstname" name="firstname" required>

        <!-- rearname -->
        <label for="lastname">NACHNAME </label>
        <input type = "text" id="lastname" name="lastname" required>

        <!-- email -->
        <label for="email">EMAIL </label>
        <input type = "email" id="email" name="email" required>

        <label for="password">PASSWORT </label>
        <input type = "password" id="password" name="password" required>

        <!-- date of birth -->
        <label for="dateOfBirth">GEBURTSDATUM </label>
        <input type = "date" id="dateOfBirth" name="dateOfBirth" required>

        <!-- buttons -->
        <button type="submit" name="submitRegistration">Speichern<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="reset"> Verwerfen</button>
    </form>
</div>
