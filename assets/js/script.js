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

        // TODO: Reihenfolge muss geprüft werden x@x
        if(emailRegistration.value.length < 3 || emailRegistration.value.length > 62 || emailRegistration.value.match(/[@]/i) === null){
            emailRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            emailRegistration.parentNode.className = emailRegistration .parentNode.className.split(" errorinput").join("");
        }

        // TODO: Regex korrekt einbauen
        if(passwordRegistration.value.length < 8 || passwordRegistration.value.length > 60){
            passwordRegistration.parentNode.className += " errorinput";
            validate = false;
        }else{
            passwordRegistration.parentNode.className = passwordRegistration .parentNode.className.split(" errorinput").join("");
        }

        // TODO: DateOfBirth einbauen
        // if(dateOfBirthRegistration.value.length < 3){
        //     dateOfBirthRegistration.parentNode.className += " errorinput";
        //     validate = false;
        // }else{
        //     dateOfBirthRegistration.parentNode.className = dateOfBirthRegistration .parentNode.className.split(" errorinput").join("");
        // }

        return validate;
    }


});


