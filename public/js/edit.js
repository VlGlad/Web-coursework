document.addEventListener("DOMContentLoaded", function(e) {
    let btns = document.getElementsByClassName("weightsButtons")

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', function(event) {
            sendButtonRequest(event, 'weight')
        })
    }


    btns = document.getElementsByClassName("weightsEditButtons")

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', function(event) {
            sendEditWeightRequest(event, 'weight')
        })
    }
})