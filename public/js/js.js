document.addEventListener('DOMContentLoaded', (e) => {
    signInForm.onsubmit = async (e) => {
        e.preventDefault();

        loginFailMessage.style.display = "none";

        data = new FormData(signInForm);
        
        // Проверяем на пустоту поля формы
        if (!data.get('login') || !data.get('password')){
            loginFailMessage.style.display = "block";
            return;
        }
        
        // Отправляем запрос
        let response = await fetch('signin', {
            method: 'POST',
            body: data
        });
        
        let result = await response.json();

        console.log(result);

        if (!result.login){
            loginFailMessage.style.display = "block";
            return;
        }

        window.location.href = "/";
    };

    signUpForm.onsubmit = async (e) => {
        e.preventDefault();

        let errors = [];

        // Очищаем стили инпутов
        registerFailMessage.style.display = "none";
        signUpForm.elements.login.style.borderBottom = "1px solid gray";
        signUpForm.elements.password.style.borderBottom = "1px solid gray";
        signUpForm.elements.password_check.style.borderBottom = "1px solid gray";

        data = new FormData(signUpForm);

        // Валидация
        if (!data.get('login')){
            signUpForm.elements.login.style.borderBottom = "1px solid red";
            errors.push("Login field can not be empty!")
        }

        const login_regex = /^[a-zA-Z0-9-._]{3,15}$/;
        if (!login_regex.test(data.get('login'))){
            signUpForm.elements.login.style.borderBottom = "1px solid red";
            errors.push("Login can be 3-15 characters long and can contain only Latin letters, numbers and \"-\", \"_\", \".\"");
        }

        if (!data.get('password')){
            signUpForm.elements.password.style.borderBottom = "1px solid red";
            errors.push("Password field can not be empty!")
        }

        if (data.get('password').length < 3 || data.get('password').length > 256){
            signUpForm.elements.password.style.borderBottom = "1px solid red";
            errors.push("Password must be 3-255 characters long!")
        }

        if (data.get('password_check') != data.get('password')){
            signUpForm.elements.password_check.style.borderBottom = "1px solid red";
            errors.push("Password and password check fields does not match!")
        }
        
        if (errors.length != 0){
            registerFailMessage.style.display = "block";
            registerFailMessage.textContent = errors.shift();
            return;
        }
        
        // Отправляем запрос
        let response = await fetch('signup', {
            method: 'POST',
            body: data
          });
      
        let result = await response.json();

        if (result.register){
            registerFailMessage.style.color = "green";
            registerFailMessage.style.display = "block";
            registerFailMessage.textContent = "Registration completed successfully!"
            return;
        }
    };

    addPointForm.onsubmit = async (e) => {
        e.preventDefault();

        data = new FormData(addPointForm);

        input_weight = data.get('weight');
        input_date = new Date(data.get('date'));

        // Валидация
        if (!isValidDate(input_date)){
            console.log('Not a valid date');
            return;
        }

        if (!input_weight || isNaN(input_weight) || input_weight.length > 10){
            console.log(input_weight);
            console.log('Not a valid number');
            return;
        }
        // Поведение, если пользователь не залогинен
        if (!is_user_logged_in){
            addData(myChart, input_date.getDate() + '.' + (input_date.getMonth() + 1) + '.' + input_date.getFullYear(), input_weight);
            return;
        }

        /* console.log(input_date); */
        addData(myChart, input_date.getDate() + '.' + (input_date.getMonth() + 1) + '.' + input_date.getFullYear(), input_weight);

       
        // Отправляем запрос
        let response = await fetch('addpoint', {
            method: 'POST',
            body: data,
        });
        
        let result = await response.json();
    };

    addDiseaseForm.onsubmit = async (e) => {
        e.preventDefault();

        data = new FormData(addDiseaseForm);

        let selector = addDiseaseForm.elements["diseasesSelect"]
        let value = selector.value;
        let id = selector.options[selector.selectedIndex].id;

        post_data = "id=" + id + "&date=" + data.get('date');

        // Отправляем запрос
        let response = await fetch('add_disease', {
            method: 'POST',
            body: post_data,
            headers:{"content-type": "application/x-www-form-urlencoded"}
        });

        let result = await response.json();

        window.location.href = "/";
    };

    let btns = document.getElementsByClassName("diseaseDelButton")

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', function(event) {
            sendDelRequest(event, 'disease');
        })
    }

    let btns2 = document.getElementsByClassName("diseaseEditButton")

    for (var i = 0; i < btns2.length; i++) {
        btns2[i].addEventListener('click', function(event) {
            sendEditRequest(event, 'user_diseases');
        })
    }
});
 
function isValidDate(date) {
    return date && Object.prototype.toString.call(date) === "[object Date]" && !isNaN(date);
}

/*
if (response.status !== 200) {           
    return;
}
let mas = document.getElementsByClassName("diseaseRow");
let mas2 = [];
for (let inner_div of mas){
    mas2.push([inner_div.childNodes[3].textContent.slice(0, 10), inner_div.childNodes[3].textContent.slice(11, inner_div.childNodes[3].textContent.length)]);
}
mas2.push([data.get('date'), value]);
mas2.sort(); */