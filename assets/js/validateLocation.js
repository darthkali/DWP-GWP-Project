document.addEventListener('DOMContentLoaded', function () {

    // Validation Location
    if(typeof document.getElementsByName('submitCreateLocation')[0] != 'undefined') {
        document.getElementsByName('submitCreateLocation')[0].onclick = function () {
            return validateLocation();
        };
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
            validate = setErrorInput(locationStreet,'Die Straße muss mindestens 3 Zeichen besitzen!', 'locationStreet');
            window.location.hash = "locationStreet";
        }else if(locationStreet.value.length > 50){
            validate = setErrorInput(locationStreet,'Die Straße darf maximal 50 Zeichen besitzen!', 'locationStreet');
            window.location.hash = "locationStreet";
        }else if(locationStreet.value.match(/^[A-Za-z -ßäöü]*$/i) === null){
            validate = setErrorInput(locationStreet,'Der Straßenname darf nur aus Buchstaben, Leerzeichen und Bindestrichen bestehen!', 'locationStreet');
            window.location.hash = "locationStreet";
        }else{
            locationStreet.parentNode.className = locationStreet.parentNode.className.split(" errorinput").join("");
        }

        // NUMBER
        if(locationNumber.value.length < 1){
            validate = setErrorInput(locationNumber,'Die Nummer muss mindestens 1 Zeichen besitzen!', 'locationNumber');
            window.location.hash = "locationNumber";
        }else if(locationNumber.value.length > 5){
            validate = setErrorInput(locationNumber,'Die Nummer darf maximal 5 Zeichen besitzen!', 'locationNumber');
            window.location.hash = "locationNumber";
        }else if(locationNumber.value.match(/^[0-9]+[ ]?[a-z]?$/i) === null){
            validate = setErrorInput(locationNumber,'Es sind nur Zahlen und 1 Buchstabe zugelassen!', 'locationNumber');
            window.location.hash = "locationNumber";
        }else{
            locationNumber.parentNode.className = locationNumber.parentNode.className.split(" errorinput").join("");
        }

        // ZIPCODE
        console.log(locationZipcode.value.length)
        if(locationZipcode.value.length !== 5){
            validate = setErrorInput(locationZipcode,'Die Postleitzahl muss aus genau 5 Ziffern bestehen', 'locationZipcode');
            window.location.hash = "locationZipcode";
        }else if(locationZipcode.value.match(/^[0-9]*$/i) === null){
            validate = setErrorInput(locationZipcode,'Es sind nur Zahlen zugelassen!', 'locationZipcode');
            window.location.hash = "locationZipcode";
        }else{
            locationZipcode.parentNode.className = locationZipcode.parentNode.className.split(" errorinput").join("");
        }

        // CITY
        if(locationCity.value.length < 1){
            validate = setErrorInput(locationCity,'Die Stadt muss mindestens 1 Zeichen besitzen!', 'locationCity');
            window.location.hash = "locationCity";
        }else if(locationCity.value.length > 58){
            validate = setErrorInput(locationCity,'Die Stadt darf maximal 58 Zeichen besitzen!', 'locationCity');
            window.location.hash = "locationCity";
        }else if(locationCity.value.match(/^[A-Za-z -ßäöü]*$/i) === null){
            validate = setErrorInput(locationCity,'Die Stadt darf nur aus Buchstaben, Leerzeichen und Bindestrichen bestehen!', 'locationCity');
            window.location.hash = "locationCity";
        }else{
            locationCity.parentNode.className = locationCity.parentNode.className.split(" errorinput").join("");
        }

        // ROOM
        if(locationRoom.value.length > 9){
            validate = setErrorInput(locationRoom,'Der Raum darf maximal 9 Zeichen besitzen!', 'locationRoom');
            window.location.hash = "locationRoom";
        }else{
            locationRoom.parentNode.className = locationRoom.parentNode.className.split(" errorinput").join("");
        }

        return validate;
    }
});