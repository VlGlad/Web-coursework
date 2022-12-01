function sendButtonRequest(event, table){
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