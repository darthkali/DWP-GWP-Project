document.addEventListener('DOMContentLoaded', function () {

    // Validation Event
    if(typeof document.getElementsByName('submitEvent')[0] != 'undefined') {
        document.getElementsByName('submitEvent')[0].onclick = function () {
            return validateEvent();
        };
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
        }else if(eventName.value.match(/^[A-Za-z0-9 -ßäöü]*$/i) === null){
            validate = setErrorInput(eventNlocationStreetame,'Der Eventname darf nur aus Buchstaben, Zahlen, Leerzeichen und Bindestrichen bestehen!');
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
});