function sendDelRequest(event, table){
    button_id = event.target.id;
    let data_body = "table=" + table + "&button_id=" + button_id;
    fetch("delete", { 
        method: "POST",
        body: data_body,
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        }
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

function sendEditRequest(event, table){
    parentButton = event.target;
    let my_form=document.createElement('FORM');
    my_form.name='myForm';
    my_form.method='POST';
    let selector = document.getElementById('selectorDisease').cloneNode(true);
    let date = document.getElementById('date_input').cloneNode(true);
    date.style = "margin: 5px;";
    let sub = document.createElement('INPUT');
    sub.type='SUBMIT';
    sub.value='sendsend';
    sub.addEventListener('click', function(event) {
        sendEdit(event, 'user_diseases', parentButton);})
    my_form.appendChild(selector);
    my_form.appendChild(date);
    my_form.appendChild(sub);
    
    event.target.parentNode.after(my_form);
    return;
}

function sendEdit(event, table, parentButton){
    event.preventDefault();

    data = new FormData(event.target.parentNode);
    data.append('table', table);
    data.append('button_id', parentButton.id);
    target_li = parentButton.parentNode.getElementsByTagName('li')[0];
    target_li.textContent = data.get('date') + " " + data.get('diseasesSelect')

    fetch("update", {
        method: "POST",
        body: data
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