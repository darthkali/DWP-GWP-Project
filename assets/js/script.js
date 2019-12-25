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

    if(typeof document.getElementsByName('submitEvent')[0] != 'undefined') {
        document.getElementsByName('submitEvent')[0].onclick = function () {
            return validateEvent();
        };
    }

    if(typeof document.getElementsByName('test')[0] != 'undefined') {
        document.getElementsByName('test')[0].onclick = function () {
            ask_first();
        };
    }

    if(typeof document.getElementsByName('submitCreateLocation')[0] != 'undefined') {
        document.getElementsByName('submitCreateLocation')[0].onclick = function () {
            return validateLocation();
        };
    }

    if(typeof document.getElementsByName('sendMail')[0] != 'undefined') {
        console.log("aljcha")
        document.getElementsByName('sendMail')[0].onclick = function () {
            return validateContact();
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

    function validateEvent() {

        var eventName  = document.getElementById('eventName');
        var eventDate = document.getElementById('eventDate');
        var eventDescription= document.getElementById('eventDescription');
        var validate = true;


        // EVENTNAME
        if(eventName.value.length < 8){
            validate = setErrorInput(eventName,'Der Eventname muss mindestens 8 Zeichen besitzen!');
        }else if(eventName.value.length > 64){
            validate = setErrorInput(eventName,'Der Eventname darf maximal 64 Zeichen besitzen!');
        }else{
            eventName.parentNode.className = eventName.parentNode.className.split(" errorinput").join("");
        }

        //EVENTDATE
        if(eventDate.value.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/i) === null){
            validate = setErrorInput(eventDate,'Das Datum muss im Format TT-MM-JJJJ sein');
        }else{
            eventDate.parentNode.className = eventDate .parentNode.className.split(" errorinput").join("");
        }

        // DESCRIPTION
        if(eventDescription.value.length < 100){
            validate = setErrorInput(eventDescription,'Der Beschreibung muss mindestens 100 Zeichen besitzen!');
        }else if(eventDescription.value.length > 1000){
            validate = setErrorInput(eventDescription,'Der Beschreibung darf maximal 1000 Zeichen besitzen!');
        }else{
            eventDescription.parentNode.className = eventDescription.parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }

    function validateLocation(){

        var locationStreet  = document.getElementById('locationStreet');
        var locationNumber = document.getElementById('locationNumber');
        var locationZipcode= document.getElementById('locationZipcode');
        var locationCity= document.getElementById('locationCity');
        var locationRoom= document.getElementById('locationRoom');
        var validate = true;


        // STREET
        if(locationStreet.value.length < 3){
            validate = setErrorInput(locationStreet,'Die Straße muss mindestens 3 Zeichen besitzen!');
        }else if(locationStreet.value.length > 50){
            validate = setErrorInput(eventNlocationStreetame,'Die Straße darf maximal 50 Zeichen besitzen!');
        }else{
            locationStreet.parentNode.className = locationStreet.parentNode.className.split(" errorinput").join("");
        }

        // NUMBER
        if(locationNumber.value.length < 1){
            validate = setErrorInput(locationNumber,'Die Nummer muss mindestens 1 Zeichen besitzen!');
        }else if(locationNumber.value.length > 5){
            validate = setErrorInput(locationNumber,'Die Nummer darf maximal 5 Zeichen besitzen!');
        }else if(locationNumber.value.match(/^[0-9]*$/i) === null){
            validate = setErrorInput(locationNumber,'Es sind nur Zahlen zugelassen!');
        }else{
            locationNumber.parentNode.className = locationNumber.parentNode.className.split(" errorinput").join("");
        }

        // ZIPCODE
        if(locationZipcode.value.length !== 5){
            validate = setErrorInput(locationZipcode,'Die Postleitzahl muss aus genau 5 Ziffern bestehen');
        }else if(locationZipcode.value.match(/^[0-9]*$/i) === null){
            validate = setErrorInput(locationZipcode,'Es sind nur Zahlen zugelassen!');
        }else{
            locationZipcode.parentNode.className = locationZipcode.parentNode.className.split(" errorinput").join("");
        }

        // CITY
        if(locationCity.value.length < 1){
            validate = setErrorInput(locationCity,'Die Stadt muss mindestens 1 Zeichen besitzen!');
        }else if(locationCity.value.length > 58){
            validate = setErrorInput(locationCity,'Die Stadt darf maximal 58 Zeichen besitzen!');
        }else{
            locationCity.parentNode.className = locationCity.parentNode.className.split(" errorinput").join("");
        }

        // ROOM
        if(locationRoom.value.length > 9){
            validate = setErrorInput(locationRoom,'Der Raum darf maximal 9 Zeichen besitzen!');
        }else{
            locationRoom.parentNode.className = locationRoom.parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }

    function validateContact(){

        var contactName  = document.getElementById('name');
        var contactMail = document.getElementById('mail');
        var contactSubject= document.getElementById('subject');
        var contactText= document.getElementById('text');
        var validate = true;


        // NAME
        if(contactName.value.length < 2){
            validate = setErrorInput(contactName,'Der Name muss mindestens 2 Zeichen besitzen!');
        }else if(contactName.value.length > 50){
            validate = setErrorInput(contactName,'Der Name darf maximal 50 Zeichen besitzen!');
        }else{
            contactName.parentNode.className = contactName.parentNode.className.split(" errorinput").join("");
        }

        //EMAIL
        if(contactMail.value.length < 3){
            validate = setErrorInput(contactMail,'Die E-Mail muss mind. 3 Zeichen lang sein!');
        }else if(contactMail.value.length > 62){
            validate = setErrorInput(contactMail,'Die E-Mail darf max. 62 Zeichen lang sein!');
        }else if(contactMail.value.match(/[@]/i) === null){
            validate = setErrorInput(contactMail,'Die E-Mail muss ein @-Zeichen enthalten!');
        }else if(contactMail.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@]/i) === null){
            validate = setErrorInput(contactMail,'Vor dem @ muss eine Eingabe erfolgen!');
        }else if(contactMail.value.match(/[@][0-9A-Z.]/i) === null){
            validate = setErrorInput(contactMail,'Direkt nach dem @ muss eine Eingabe erfolgen!');
        }else if(contactMail.value.match(/[@][0-9A-Z]/i) === null){
            validate = setErrorInput(contactMail,'Direkt nach dem @ darf kein Punkt folgen!');
        }else{
            contactMail.parentNode.className = contactMail .parentNode.className.split(" errorinput").join("");
        }

        // SUBJECT
        if(contactSubject.value.length < 2){
            validate = setErrorInput(contactSubject,'Der Titel muss mindestens 2 Zeichen besitzen!');
        }else if(contactSubject.value.length > 50){
            validate = setErrorInput(contactSubject,'Der Titel darf maximal 50 Zeichen besitzen!');
        }else{
            contactSubject.parentNode.className = contactSubject.parentNode.className.split(" errorinput").join("");
        }

        // TEXT
        if(contactText.value.length < 10){
            validate = setErrorInput(contactText,'Das Anliegen muss mindestens 10 Zeichen besitzen!');
        }else if(contactText.value.length > 1000){
            validate = setErrorInput(contactText,'Das Anliegen darf maximal 1000 Zeichen besitzen!');
        }else{
            contactText.parentNode.className = contactText.parentNode.className.split(" errorinput").join("");
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

function deleteQuestionUser(link, userID) {
    link.href = "?c=user&a=userManagement&userId=" + userID;
    return window.confirm("Wollen Sie den Nutzer wirklich löschen?");
}

function deleteQuestionEvent(link, eventID, pictureID) {
    console.log(link);
    link.href = "?c=event&a=eventManagement&eventId=" + eventID + "&pictureName=" + "'" + pictureID + "'";
    return window.confirm("Wollen Sie das Event wirklich löschen?");
}

