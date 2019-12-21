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
        var validate = true;

        if(firstnameRegistration.value.length < 2 || firstnameRegistration.value.length > 21){
            firstnameRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            firstnameRegistration.parentNode.className = firstnameRegistration.parentNode.className.split(" errorinput").join("");
        }

        if(lastnameRegistration.value.length < 2 || lastnameRegistration.value.length > 24){
            lastnameRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            lastnameRegistration.parentNode.className = lastnameRegistration .parentNode.className.split(" errorinput").join("");
        }

        if(emailRegistration.value.length < 3 || emailRegistration.value.length > 62 || emailRegistration.value.match(/[0-9A-Z!#$%&'*+-/=?^_`.{|}~][@][0-9A-Z][0-9A-Z.]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            emailRegistration.parentNode.className = emailRegistration .parentNode.className.split(" errorinput").join("");
        }

        // TODO: je nach Fall passende Errormeldung ausgeben
        if(passwordRegistration.value.length < 8 || passwordRegistration.value.length > 60){
            passwordRegistration.parentNode.className += " errorinput";
            validate = false;
        }else if(passwordRegistration.value.match(/[A-Z]/) === null || passwordRegistration.value.match(/[a-z]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            validate = false;
        }else if(passwordRegistration.value.match(/[0-9]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            validate = false;
        }else if(passwordRegistration.value.match(/[!@#.$%&?]/) === null) {
            passwordRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            passwordRegistration.parentNode.className = passwordRegistration .parentNode.className.split(" errorinput").join("");
        }

        if(dateOfBirthRegistration.value.match(/[0-9]{4}-[0-9]{2}-[0-9]{2}/i) === null){
            dateOfBirthRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            dateOfBirthRegistration.parentNode.className = dateOfBirthRegistration .parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }


});


