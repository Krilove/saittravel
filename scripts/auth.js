let warning = document.getElementById('warning');
const submit = document.getElementById('submit');


submit.addEventListener('click', (event) =>  {
    const phone = document.getElementById('phone-input').value;
    const name = document.getElementById('name-input').value;
    const tour = document.getElementById('tour-select').value;
    if (phone == " "){
        warning.innerHTML = '<span class="warning" id="warning">Введите свой номер телефона!</span>'
    }
    if (name == " "){
        warning.innerHTML = '<span class="warning" id="warning">Введите своё имя!</span>'
    }
    if(tour == " "){
        warning.innerHTML = '<span class="warning" id="warning">Выберите тур из списка!</span>'
    }
    else if (tour != " " && name != " " && phone != " "){
        warning.innerHTML = '<span class="warning" id="warning">Заявка зарегестрирована. Вы получиле СМС, а так же уведомление на сайте</span>'
    }
})