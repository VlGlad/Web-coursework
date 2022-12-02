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
    let my_form=document.createElement('FORM');
    my_form.name='myForm';
    my_form.method='POST';
    my_form.action='http://www.another_page.com/index.htm';
    let selector = document.getElementById('selectorDisease').cloneNode(true);
    let date = document.getElementById('date_input').cloneNode(true);
    date.style = "margin: 5px;";
    let sub = document.createElement('INPUT');
    sub.type='SUBMIT';
    sub.value='sendsend';
    my_form.appendChild(selector);
    my_form.appendChild(date);
    my_form.appendChild(sub);
    console.log(event.target.parentNode);
    event.target.parentNode.after(my_form);
    return;
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