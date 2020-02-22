document.addEventListener('DOMContentLoaded', function(){

    var form = document.getElementById('formRegistration');
    var submit = document.getElementById('submitRegistration');
    var email = document.getElementById('emailRegistration');

    submit.addEventListener('click', function(event){
        event.stopPropagation(); // no send to the top element
        event.preventDefault(); // no default action on submit
        form.style.pointerEvents = "none";

        var request = new XMLHttpRequest();
        request.open(form.getAttribute('method'), form.getAttribute('action') + '&ajax=1', true);

        request.onreadystatechange = function() {
            if(this.readyState === 4){ // XMLHttpRequest.DONE

                // HTTP-Status-Code is OK?
                if(this.status === 200) {
                    var resJson = null;
                    try {
                        resJson = JSON.parse(this.response);
                    }
                    catch(err) {
                        console.log('JSON invalid!');
                    }

                    if(resJson !== null) {
                        if(resJson.error !== null) {
                            setErrorInput(email,resJson.error, 'errorEmailRegistration');
                            form.style.pointerEvents = "all";
                        } else {
                            location.replace("?c=user&a=login");
                        }
                    }
                }else{
                    console.log('Worng Status Code, because of: ' + this.statusText);
                }
            }
        };

        var formData = new FormData(form);
        formData.append('submitRegistration', '1');
        request.send(formData);
    });
});