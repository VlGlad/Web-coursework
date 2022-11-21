function sendButtonRequest(event){
    button_id = event.target.id;
    let data_body = ["button_id=" + button_id];

    fetch("delete", { 
        method: "POST",
        body: data_body,
        headers:{"content-type": "application/x-www-form-urlencoded"}
        })
    .then((response) => {
            if (response.status !== 200) {           
                return Promise.reject();
            }
    return response.text()
    })
    .catch();

    event.target.parentNode.remove()
}


document.addEventListener("DOMContentLoaded", function(e) {
    console.log('hi');

    getWeights.onsubmit = async (e) => {
        e.preventDefault();

        weights_points.innerHTML = '';

        data = new FormData(getWeights);
        
        // Отправляем запрос
        let response = await fetch('get_names', {
            method: 'POST',
            body: data
          });
      
        let result = await response.json();

        console.log(result);
        
        for (let row of result){
            console.log(row.weight);
            let liDiv = document.createElement('div');
            liDiv.className = 'weights';
            let liButton = document.createElement('button');
            liButton.className = 'btn btn-danger';
            liButton.id = row.weight_id;
            liButton.textContent = 'del';
            liButton.addEventListener('click', function(event) {
                console.log('bruh');
                sendButtonRequest(event)
              })
            let liLast = document.createElement('li');
            liLast.textContent = row.date + ' ' + row.weight + 'kg';
            liLast.id = row.user_id;
            liDiv.append(liButton, liLast);
            weights_points.append(liDiv);
        }
        
    };
})