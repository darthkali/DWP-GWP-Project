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


                // // HTTP-Status-Code is OK?
                if (this.status === 200) {
                    var resJson = null;
                    try {
                        resJson = JSON.parse(this.response);
                    } catch (err) {
                        console.log('JSON invalid!');
                    }

                    if (resJson !== null) {
                        if (resJson.error !== null) {
                            var successContact = document.getElementById('successContact');
                            var formContact = document.getElementById('formContact');
                            formContact.style.pointerEvents = "all";
                            successContact.style.display = "block";
                            setTimeout(() => {
                                window.location = "?c=user&a=login"
                            }, 30000);
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