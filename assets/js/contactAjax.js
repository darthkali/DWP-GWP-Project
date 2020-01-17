document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('form');
    var submit = form.querySelector('button[type="submit"]');

    submit.addEventListener('click', function (event) {
            event.stopPropagation();
            event.preventDefault();

            var request = new XMLHttpRequest();
            request.open(form.getAttribute('method'), form.getAttribute('action'), true);

            request.onreadystatechange = function(){
                if (this.readyState === 4){
                    if(this.status === 200){
                        alert(this.responseText);
                    } else {
                        alert(this.statusText);
                    }
                }
            }

            request.send(new FormData(form));
            alert(this.responseText);
    })



});