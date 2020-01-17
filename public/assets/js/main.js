const dict = {
    'ru': {
        'invalid_email_msg': 'Неправильно введен email адрес.',
        'password_short_msg': 'Пароль должен содержать как минимум 6 символов.',
        'password_confirm_msg': 'Пароли не совпадают.'
    },
    'en': {
        'invalid_email_msg': 'Please enter a valid email address.',
        'password_short_msg': 'Password must be at least 6 characters.',
        'password_confirm_msg': 'Passwords do not match.'
    }
};

let lang = getCookie('lang');

let inputs = document.querySelectorAll('.input-group > input[name]');

for (let input of inputs) {
    input.addEventListener('input', function () {
        let name = this.getAttribute('name');
        let value = this.value;
        let check = true;
        let message = '';

        switch (name) {
            case 'email':
                check = validateEmail(value);
                message = dict[lang]['invalid_email_msg'];
                break;
            case 'password':
                check = validatePassword(value);
                message = dict[lang]['password_short_msg'];
                break;
            case 'passwordConfirm':
                let password = document.querySelector('input[name="password"]').value;

                if (password !== value) {
                    check = false;
                }

                message = dict[lang]['password_confirm_msg'];
                break;
        }

        this.parentElement.classList.remove('invalid');
        this.classList.remove('invalid-text');

        if (document.contains(this.parentElement.querySelector('div.invalid-text'))) {
            this.parentElement.querySelector('div.invalid-text').remove();
        }

        if (!check) {
            let errorMsg = document.createElement('div');
            errorMsg.classList.add('invalid-text');
            errorMsg.innerText = message;
            this.parentElement.append(errorMsg);

            this.parentElement.classList.add('invalid');
            this.classList.add('invalid-text');
        }
    })
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    if (password.length >= 6) {
        return true
    }

    return false;
}

function getCookie(key) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + key.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}