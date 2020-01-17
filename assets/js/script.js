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
    document.querySelectorAll()
     if(window.outerWidth < 700){

     }else{

     }
 }