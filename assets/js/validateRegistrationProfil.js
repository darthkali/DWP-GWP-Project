document.addEventListener('DOMContentLoaded', function () {

    // Validation Profil
    if(typeof document.getElementsByName('submitProfil')[0] != 'undefined'){
        document.getElementsByName('submitProfil')[0].onclick = function () {
            return validateRegistrationOrProfil('Profil');
        };
    }

    // Validation Registration
    if(typeof document.getElementsByName('submitRegistration')[0] != 'undefined') {
        document.getElementsByName('submitRegistration')[0].onclick = function () {
            return validateRegistrationOrProfil('Registration');
        };
    }

    function validateRegistrationOrProfil(pageName) {

        var firstname  = document.getElementById('firstname' + pageName);
        var lastname = document.getElementById('lastname'+ pageName);
        var email= document.getElementById('email'+ pageName);
        var password = document.getElementById('password'+ pageName);
        var dateOfBirth = document.getElementById('dateOfBirth'+ pageName);
        var description = document.getElementById('description'+ pageName);
        var changePasswordCheckbox = document.getElementById('changePasswordCheckbox');
        var validate = true;


        // FIRSTNAME
        if(firstname.value.length < 2){
            validate = setErrorInput(firstname,'Der Vorname muss mindestens 2 Zeichen besitzen!', 'firstname' + pageName);
        }else if(firstname.value.length > 21){
            validate = setErrorInput(firstname,'Der Vorname darf maximal 21 Zeichen besitzen!','firstname' + pageName);
        }else if(firstname.value.match(/^[A-Za-z]*$/i) === null){
            validate = setErrorInput(firstname,'Der Vorname darf nur aus Buchstaben bestehen!','firstname' + pageName);
        }else{
            firstname.parentNode.className = firstname.parentNode.className.split(" errorinput").join("");
        }

        // LASTNAME
        if(lastname.value.length < 2){
            validate = setErrorInput(lastname,'Der Nachname muss mindestens 2 Zeichen besitzen!', 'lastname' + pageName);
        }else if(lastname.value.length > 24){
            validate = setErrorInput(lastname,'Der Nachname darf maximal 24 Zeichen besitzen!', 'lastname' + pageName);
        }else if(lastname.value.match(/^[A-Za-z]*$/i) === null){
            validate = setErrorInput(lastname,'Der Nachname darf nur aus Buchstaben bestehen!', 'lastname' + pageName);
        }else{
            lastname.parentNode.className = lastname.parentNode.className.split(" errorinput").join("");
        }

        //EMAIL
        if(email.value.length < 3){
            validate = setErrorInput(email,'Die E-Mail muss mind. 3 Zeichen lang sein!', 'email' + pageName);
        }else if(email.value.length > 62){
            validate = setErrorInput(email,'Die E-Mail darf max. 62 Zeichen lang sein!', 'email' + pageName);
        }else if(email.value.match(/[@]/i) === null){
            validate = setErrorInput(email,'Die E-Mail muss ein @-Zeichen enthalten!', 'email' + pageName);
        }else if(email.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@]/i) === null){
            validate = setErrorInput(email,'Vor dem @ muss eine Eingabe erfolgen!', 'email' + pageName);
        }else if(email.value.match(/[@][0-9A-Z.]/i) === null){
            validate = setErrorInput(email,'Direkt nach dem @ muss eine Eingabe erfolgen!', 'email' + pageName);
        }else if(email.value.match(/[@][0-9A-Z]/i) === null){
            validate = setErrorInput(email,'Direkt nach dem @ darf kein Punkt folgen!', 'email' + pageName);
        }else if(email.value.match(/[@][0-9A-Z-.]+[.]{1}[a-z]+/i) === null){
            validate = setErrorInput(email,'Die E-Mail muss eine Domain enthalten!', 'email' + pageName);
        }else{
            email.parentNode.className = email .parentNode.className.split(" errorinput").join("");
        }

        if (document.getElementById('password'+ pageName)) {
            if(pageName === 'Registration' || changePasswordCheckbox.checked === true){
                //PASSWORT
                if (password.value.length < 8) {
                    validate = setErrorInput(password, 'Das Passwort muss mind. 8 Zeichen lang sein!', 'password' + pageName);
                } else if (password.value.length > 60) {
                    validate = setErrorInput(password, 'Das Passwort darf max. 60 lang sein!', 'password' + pageName);
                } else if (password.value.match(/[A-Z]/) === null) {
                    validate = setErrorInput(password, 'Das Passwort muss mind. einen Großbuchstaben besitzen!', 'password' + pageName);
                } else if (password.value.match(/[a-z]/) === null) {
                    validate = setErrorInput(password, 'Das Passwort muss mind. einen Kleinbuchstaben besitzen!', 'password' + pageName);
                } else if (password.value.match(/[0-9]/) === null) {
                    validate = setErrorInput(password, 'Das Passwort muss mind. eine Zahl besitzen!', 'password' + pageName);
                } else if (password.value.match(/[!@#.$%&?]/) === null) {
                    validate = setErrorInput(password, 'Das Passwort muss mind. ein Sonderzeichen besitzen (!@#.$%&?)!', 'password' + pageName);
                } else {
                    password.parentNode.className = password.parentNode.className.split(" errorinput").join("");
                }
            }
        }

        //DATE OF BIRTH
        if(dateOfBirth.value.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/i) === null){
            validate = setErrorInput(dateOfBirth,'Das Datum muss im Format TT-MM-JJJJ sein', 'dateOfBirth' + pageName);
        }else{
            dateOfBirth.parentNode.className = dateOfBirth .parentNode.className.split(" errorinput").join("");
        }

        if (document.getElementById('description'+ pageName)) {
            console.log('description'+ pageName);
            // DESCRIPTION
            if(description.value.length < 100){
                validate = setErrorInput(description,'Der Beschreibung muss mindestens 100 Zeichen besitzen!', 'description' + pageName);
            }else if(description.value.length > 1000){
                validate = setErrorInput(description,'Der Beschreibung darf maximal 1000 Zeichen besitzen!', 'description' + pageName);
            }else{
                description.parentNode.className = description.parentNode.className.split(" errorinput").join("");
            }
        }

        return validate;
    }

});