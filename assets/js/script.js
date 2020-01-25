function setErrorInput(inputField, errorMessage, jumpToDiv) {
    inputField.parentNode.className += " errorinput";
    document.getElementById('error' + setFirstLetterToUpperCase(inputField.name)).innerText = errorMessage;
    window.location.hash = jumpToDiv;
    return false;
}

function setFirstLetterToUpperCase(inputString){
    if(typeof  inputString !== 'string'){
        return ''
    }
    return inputString.charAt(0).toUpperCase()+ inputString.slice(1);
}

function deleteQuestionUser(link, userID) {
    link.href = "?c=user&a=userManagement&userId=" + userID;
    return window.confirm("Wollen Sie den Nutzer wirklich löschen?");
}

function deleteQuestionEvent(link, eventID, pictureID) {
    link.href = "?c=event&a=eventManagement&eventId=" + eventID + "&pictureName=" + pictureID;
    return window.confirm("Wollen Sie das Event wirklich löschen?");
}
//Noch im Test bzw Aufbau

function changeCssWithJavaScriptForEventbox(){
    var elements = document.querySelectorAll("#eventBox");
    var showMoreButtons = document.querySelectorAll("#showMoreButton");

    if (window.outerWidth < 700) {
        showMoreButtons.forEach(function (buttons) {
            buttons.style.display = "block";
        });
        elements.forEach(function (items) {
            items.style.display = "none";
        });
    } else {
        showMoreButtons.forEach(function (buttons) {
            buttons.style.display = "none";
        });
        elements.forEach(function (items) {
            items.style.display = "block";
        });
    }
 }