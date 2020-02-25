document.addEventListener('DOMContentLoaded', function () {

    // Validation Contact
    if(typeof document.getElementsByName('sendMail')[0] != 'undefined') {
        document.getElementsByName('sendMail')[0].onclick = function () {
            return validateContact();
        };
    }

    function validateContact(){

        var contactName  = document.getElementById('name');
        var contactMail = document.getElementById('mail');
        var contactSubject= document.getElementById('subject');
        var contactText= document.getElementById('text');
        var validate = true;


        // NAME
        if(contactName.value.length < 2){
            validate = setErrorInput(contactName,'Der Name muss mindestens 2 Zeichen besitzen!', 'contactName');
        }else if(contactName.value.length > 50){
            validate = setErrorInput(contactName,'Der Name darf maximal 50 Zeichen besitzen!', 'contactName');
        }else if(contactName.value.match(/^[A-Za-zßäöü]*$/i) === null){
            validate = setErrorInput(contactName,'Der Name darf nur aus Buchstaben, Leerzeichen und Bindestrichen bestehen!', 'contactName');
        }else{
            contactName.parentNode.className = contactName.parentNode.className.split(" errorinput").join("");
        }

        //EMAIL
        if(contactMail.value.length < 3){
            validate = setErrorInput(contactMail,'Die E-Mail muss mind. 3 Zeichen lang sein!', 'contactMail');
        }else if(contactMail.value.length > 62){
            validate = setErrorInput(contactMail,'Die E-Mail darf max. 62 Zeichen lang sein!', 'contactMail');
        }else if(contactMail.value.match(/[@]/i) === null){
            validate = setErrorInput(contactMail,'Die E-Mail muss ein @-Zeichen enthalten!', 'contactMail');
        }else if(contactMail.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@]/i) === null){
            validate = setErrorInput(contactMail,'Vor dem @ muss eine Eingabe erfolgen!', 'contactMail');
        }else if(contactMail.value.match(/[@][0-9A-Z.]/i) === null){
            validate = setErrorInput(contactMail,'Direkt nach dem @ muss eine Eingabe erfolgen!', 'contactMail');
        }else if(contactMail.value.match(/[@][0-9A-Z]/i) === null){
            validate = setErrorInput(contactMail,'Direkt nach dem @ darf kein Punkt folgen!', 'contactMail');
        }else if(contactMail.value.match(/[@][0-9A-Z-.]+[.]{1}[a-z]+/i) === null){
            validate = setErrorInput(contactMail,'Die E-Mail muss eine Domain enthalten!', 'contactMail');
        }else{
            contactMail.parentNode.className = contactMail .parentNode.className.split(" errorinput").join("");
        }

        // SUBJECT
        if(contactSubject.value.length < 2){
            validate = setErrorInput(contactSubject,'Der Titel muss mindestens 2 Zeichen besitzen!', 'contactSubject');
        }else if(contactSubject.value.length > 50){
            validate = setErrorInput(contactSubject,'Der Titel darf maximal 50 Zeichen besitzen!', 'contactSubject');
        }else{
            contactSubject.parentNode.className = contactSubject.parentNode.className.split(" errorinput").join("");
        }

        // TEXT
        if(contactText.value.length < 10){
            validate = setErrorInput(contactText,'Das Anliegen muss mindestens 10 Zeichen besitzen!', 'contactText');
        }else if(contactText.value.length > 1000){
            validate = setErrorInput(contactText,'Das Anliegen darf maximal 1000 Zeichen besitzen!', 'contactText');
        }else{
            contactText.parentNode.className = contactText.parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }
});