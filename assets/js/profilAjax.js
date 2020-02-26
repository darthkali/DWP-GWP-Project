document.addEventListener('DOMContentLoaded', function(){

    var form = document.getElementById('formProfil');
    var submit = document.getElementById('submitProfil');
    var email = document.getElementById('emailProfil');

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
                        form.style.pointerEvents = "all";
                        console.log('JSON invalid!');
                    }

                    if(resJson !== null) {
                        if(resJson.error !== 0) {
                            setErrorInput(email,resJson.error, 'errorEmailProfil');
                        }else{
                            location.reload();
                        }
                    }
                }else{
                    console.log('Worng Status Code, because of: ' + this.statusText);
                }
                form.style.pointerEvents = "all";
            }
        };

        var formData = new FormData(form);
        formData.append('submitProfil', '1');
        request.send(formData);
    });
});