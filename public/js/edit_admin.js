document.addEventListener("DOMContentLoaded", function(e) {
    getWeights.onsubmit = async (e) => {
        e.preventDefault();

        weights_points.innerHTML = '';
        diseases_points.innerHTML = '';

        data = new FormData(getWeights);
        
        // Отправляем запрос
        let response = await fetch('get_names', {
            method: 'POST',
            body: data
          });
      
        let result = await response.json();

        console.log(result);
        
        for (let row of result['weight']){
            let liDiv = document.createElement('div');
            liDiv.className = 'weights';
            let liButton = document.createElement('button');
            liButton.className = 'btn btn-danger';
            liButton.id = row.weight_id;
            liButton.textContent = 'del';
            liButton.addEventListener('click', function(event) {
              sendDelRequest(event, 'weight')
            })

            let editButton = document.createElement('button');
            editButton.className = 'weightsEditButtons btn btn-warning';
            editButton.id = row.weight_id;
            editButton.textContent = 'edit';
            editButton.addEventListener('click', function(event) {
              sendEditWeightRequest(event, 'weight')
            })

            let liLast = document.createElement('li');
            liLast.textContent = row.date + ' ' + row.weight + 'kg';
            liLast.id = row.user_id;
            liDiv.append(liButton, editButton, liLast);
            weights_points.append(liDiv);
        }

        for (let row of result['disease']){
            let liDiv = document.createElement('div');
            liDiv.className = 'diseaseRow';
            let liButton = document.createElement('button');
            liButton.className = 'diseaseDelButton btn btn-danger';
            liButton.id = row.user_disease_id;
            liButton.textContent = 'del';
            liButton.addEventListener('click', function(event) {
                console.log('bruh');
                sendDelRequest(event, 'disease')
            })

            let editButton = document.createElement('button');
            editButton.className = 'diseaseEditButton btn btn-warning';
            editButton.id = row.user_disease_id;
            editButton.textContent = 'edit';
            editButton.addEventListener('click', function(event) {
              sendEditRequest(event, 'user_diseases')
            })

            let liLast = document.createElement('li');
            liLast.textContent = row.disease_date + ' ' + row.disease_fr_id;
            liLast.id = row.user_fr_id;
            liDiv.append(liButton, editButton, liLast);
            diseases_points.append(liDiv);
        }
    };
})