document.addEventListener('DOMContentLoaded', function () {

    if(typeof document.getElementsByName('submitProfil')[0] != 'undefined'){
        document.getElementsByName('submitProfil')[0].onclick = function () {
            return validateRegistrationOrProfil('Profil');
        };
    }

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
            validate = setErrorInput(firstname,'Der Vorname muss mindestens 2 Zeichen besitzen!');
        }else if(firstname.value.length > 21){
            validate = setErrorInput(firstname,'Der Vorname darf maximal 21 Zeichen besitzen!');
        }else{
            firstname.parentNode.className = firstname.parentNode.className.split(" errorinput").join("");
        }

        // LASTNAME
        if(lastname.value.length < 2){
            validate = setErrorInput(lastname,'Der Nachname muss mindestens 2 Zeichen besitzen!');
        }else if(lastname.value.length > 24){
            validate = setErrorInput(lastname,'Der Nachname darf maximal 24 Zeichen besitzen!');
        }else{
            lastname.parentNode.className = lastname.parentNode.className.split(" errorinput").join("");
        }

        //EMAIL
        if(email.value.length < 3){
            validate = setErrorInput(email,'Die E-Mail muss mind. 3 Zeichen lang sein!');
        }else if(email.value.length > 62){
            validate = setErrorInput(email,'Die E-Mail darf max. 62 Zeichen lang sein!');
        }else if(email.value.match(/[@]/i) === null){
            validate = setErrorInput(email,'Die E-Mail muss ein @-Zeichen enthalten!');
        }else if(email.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@]/i) === null){
            validate = setErrorInput(email,'Vor dem @ muss eine Eingabe erfolgen!');
        }else if(email.value.match(/[@][0-9A-Z.]/i) === null){
            validate = setErrorInput(email,'Direkt nach dem @ muss eine Eingabe erfolgen!');
        }else if(email.value.match(/[@][0-9A-Z]/i) === null){
            validate = setErrorInput(email,'Direkt nach dem @ darf kein Punkt folgen!');
        }else{
            email.parentNode.className = email .parentNode.className.split(" errorinput").join("");
        }

        if(pageName === 'Registration' || changePasswordCheckbox.checked === true){
            //PASSWORT
            if(password.value.length < 8){
                validate = setErrorInput(password,'Das Passwort muss mind. 8 Zeichen lang sein!');
            }else if(password.value.length > 60){
                validate = setErrorInput(password,'Das Passwort darf max. 60 lang sein!');
            }else if(password.value.match(/[A-Z]/) === null){
                validate = setErrorInput(password,'Das Passwort muss mind. einen Großbuchstaben besitzen!');
            }else if(password.value.match(/[a-z]/) === null) {
                validate = setErrorInput(password,'Das Passwort muss mind. einen Kleinbuchstaben besitzen!');
            }else if(password.value.match(/[0-9]/) === null) {
                validate = setErrorInput(password,'Das Passwort muss mind. eine Zahl besitzen!');
            }else if(password.value.match(/[!@#.$%&?]/) === null) {
                validate = setErrorInput(password,'Das Passwort muss mind. ein Sonderzeichen besitzen (!@#.$%&?)!');
            }else{
                password.parentNode.className = password .parentNode.className.split(" errorinput").join("");
            }
        }

        //DATE OF BIRTH
        if(dateOfBirth.value.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/i) === null){
            validate = setErrorInput(dateOfBirth,'Das Datum muss im Format TT-MM-JJJJ sein');
        }else{
            dateOfBirth.parentNode.className = dateOfBirth .parentNode.className.split(" errorinput").join("");
        }

        // only for Profil Page
        if(pageName === 'Profil'){ // TODO:  && Role  === ADMIN OR MEMBER ){
            // DESCRIPTION
            if(description.value.length < 100){
                validate = setErrorInput(description,'Der Beschreibung muss mindestens 100 Zeichen besitzen!');
            }else if(description.value.length > 1000){
                validate = setErrorInput(description,'Der Beschreibung darf maximal 1000 Zeichen besitzen!');
            }else{
                description.parentNode.className = description.parentNode.className.split(" errorinput").join("");
            }
        }




        return validate;
    }



    function setErrorInput(inputField, errorMessage) {
        inputField.parentNode.className += " errorinput";
        document.getElementById('error' + setFirstLetterToUpperCase(inputField.name)).innerText = errorMessage;
        return false;
    }

    function setFirstLetterToUpperCase(inputString){
        if(typeof  inputString !== 'string'){
            return ''
        }
        return inputString.charAt(0).toUpperCase()+ inputString.slice(1);
    }

});


