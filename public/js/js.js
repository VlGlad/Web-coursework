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

        debugger;
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
});

function isValidDate(date) {
    return date && Object.prototype.toString.call(date) === "[object Date]" && !isNaN(date);
}