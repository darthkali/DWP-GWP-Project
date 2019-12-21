document.addEventListener('DOMContentLoaded', function () {

    document.getElementsByName('submitRegistration')[0].onclick = function () {
        return validate();
    };

    function validate() {

        var firstnameRegistration   = document.getElementById('firstnameRegistration');
        var lastnameRegistration    = document.getElementById('lastnameRegistration');
        var emailRegistration       = document.getElementById('emailRegistration');
        var passwordRegistration    = document.getElementById('passwordRegistration');
        var dateOfBirthRegistration = document.getElementById('dateOfBirthRegistration');
        var input = document.getElementsByClassName('input');
        var validate = true;

        // FIRSTNAME
        if(firstnameRegistration.value.length < 2){
            firstnameRegistration.parentNode.className += " errorinput";
            document.getElementById('errorFirstnameRegistration').innerText = 'Der Vorname muss mindestens 2 Zeichen besitzen!';
            validate = false;
        }else if(firstnameRegistration.value.length > 21){
            firstnameRegistration.parentNode.className += " errorinput";
            document.getElementById('errorFirstnameRegistration').innerText = 'Der Vorname darf maximal 21 Zeichen besitzen!';
            validate = false;
        }else{
            firstnameRegistration.parentNode.className = firstnameRegistration.parentNode.className.split(" errorinput").join("");
        }

        // LASTNAME
        if(lastnameRegistration.value.length < 2){
            lastnameRegistration.parentNode.className += " errorinput";
            document.getElementById('errorLastnameRegistration').innerText = 'Der Nachname muss mindestens 2 Zeichen besitzen!';
            validate = false;
        }else if(lastnameRegistration.value.length > 24){
            lastnameRegistration.parentNode.className += " errorinput";
            document.getElementById('errorLastnameRegistration').innerText = 'Der Nachname darf maximal 24 Zeichen besitzen!';
            validate = false;
        }else{
            lastnameRegistration.parentNode.className = lastnameRegistration.parentNode.className.split(" errorinput").join("");
        }

        //EMAIL
        if(emailRegistration.value.length < 3){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Die E-Mail muss mind. 3 Zeichen lang sein!';
            validate = false;
        }else if(emailRegistration.value.length > 62){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Die E-Mail darf max. 62 Zeichen lang sein!';
            validate = false;
        }else if(emailRegistration.value.match(/[@]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Die E-Mail muss ein @-Zeichen enthalten!';
            validate = false;
        }else if(emailRegistration.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Vor dem @ muss eine Eingabe erfolgen!';
            validate = false;
        }else if(emailRegistration.value.match(/[@][0-9A-Z.]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Direkt nach dem @ muss eine Eingabe erfolgen!';
            validate = false;
        }else if(emailRegistration.value.match(/[@][0-9A-Z]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            document.getElementById('errorEmailRegistration').innerText = 'Direkt nach dem @ darf kein Punkt folgen!';
            validate = false;
        }else{
            emailRegistration.parentNode.className = emailRegistration .parentNode.className.split(" errorinput").join("");
        }

        //PASSWORT
        if(passwordRegistration.value.length < 8){
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort muss mind. 8 Zeichen lang sein!';
            validate = false;
        }else if(passwordRegistration.value.length > 60){
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort darf max. 60 lang sein!';
            validate = false;
        }else if(passwordRegistration.value.match(/[A-Z]/) === null){
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort muss mind. einen Großbuchstaben besitzen!';
            validate = false;
        }else if(passwordRegistration.value.match(/[a-z]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort muss mind. einen Kleinbuchstaben besitzen!';
            validate = false;
        }else if(passwordRegistration.value.match(/[0-9]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort muss mind. eine Zahl besitzen!';
            validate = false;
        }else if(passwordRegistration.value.match(/[!@#.$%&?]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            document.getElementById('errorPasswordRegistration').innerText = 'Das Passwort muss mind. ein Sonderzeichen besitzen (!@#.$%&?)!';
            validate = false;
        }else{
            passwordRegistration.parentNode.className = passwordRegistration .parentNode.className.split(" errorinput").join("");
        }

        if(dateOfBirthRegistration.value.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/i) === null){
            dateOfBirthRegistration.parentNode.className += " errorinput";
            document.getElementById('errorDateOfBirthRegistration').innerText = 'Das Datum muss im Format TT-MM-JJJJ sein';
            validate = false;
        }else{
            dateOfBirthRegistration.parentNode.className = dateOfBirthRegistration .parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }


});


