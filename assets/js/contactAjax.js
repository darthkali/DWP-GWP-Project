document.addEventListener('DOMContentLoaded', function(){

    var form = document.getElementById('formContact');
    var submit = document.getElementById('sendMail');


    submit.addEventListener('click', function(event){
        event.stopPropagation(); // no send to the top element
        event.preventDefault(); // no default action on submit

        var request = new XMLHttpRequest();
        request.open(form.getAttribute('method'), form.getAttribute('action') + '&ajax=1', true);

        request.onreadystatechange = function() {
            // request finished?
            if(this.readyState === 4) { // XMLHttpRequest.DONE
                console.log("1");
                // // HTTP-Status-Code is OK?
                if (this.status === 200) {
                    console.log("2");
                    var resJson2 = null;
                    try {
                        resJson2 = JSON.parse(this.response);
                    } catch (err) {
                        console.log('JSON invalid!');
                    }

                    if (resJson2 !== null) {
                        console.log("3");
                        if (resJson2.error == null) {
                            console.log("4");
                            var successContact = document.getElementById('successContact');
                            var formContact = document.getElementById('formContact');
                            formContact.style.pointerEvents = "none";
                            successContact.style.display = "block";
                            setTimeout(() => {
                                location.replace("?c=pages&a=start");
                            }, 3000);
                        }
                    }
                } else {
                    console.log('Worng Status Code, because of: ' + this.statusText);
                }
            }
        };

        var formData = new FormData(form);
        formData.append('sendMail', '1');
        request.send(formData);
    });
});