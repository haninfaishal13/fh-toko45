document.querySelector('#login').addEventListener('click', () => {
    document.querySelector('#login').classList.add('active')
    document.querySelector('#register').classList.remove('active')
    document.querySelector('#login-page').classList.remove('d-none')
    document.querySelector('#register-page').classList.add('d-none')
})

const password = getId('register-password')
const confirm_password = getId('register-confirm-password')
const password_warning = getId('password-warning')
password.addEventListener('keyup', () => {
    if(password.value != confirm_password.value) {
        password_warning.classList.remove('d-none');
    } else {
        password_warning.classList.add('d-none')
    }
})
confirm_password.addEventListener('keyup', () => {
    if(password.value != confirm_password.value) {
        password_warning.classList.remove('d-none');
    } else {
        password_warning.classList.add('d-none')
    }
})

const auth_modal = new bootstrap.Modal(document.getElementById('auth-modal'))
document.querySelector('#register').addEventListener('click', () => {
    document.querySelector('#login').classList.remove('active')
    document.querySelector('#register').classList.add('active')
    document.querySelector('#login-page').classList.add('d-none')
    document.querySelector('#register-page').classList.remove('d-none')
})

document.querySelector('#login-form').addEventListener('submit', (event) => {
    event.preventDefault()
    const form = document.getElementById('login-form')
    const formData = new FormData(form)
    const url = base_url + '/auth/login'

    fetch(url, {
        headers: {
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        body: formData
    })
    .then((response) => {
        if(response.ok) {
            return response.json();
        }
        return response.text().then(text => {throw new Error(text)})
    })
    .then((data) => {
        location.reload()
    })
    .catch((error) => {
        resp = JSON.parse(error.message)
        let messages = ``
        resp.message.forEach(element => {
            console.log(element)
            messages += `${element}<br>`
        });
        swal.fire('Error', messages, 'error')
    })
})

document.querySelector('#register-form').addEventListener('submit', (event) => {
    event.preventDefault()
    const form = document.getElementById('register-form')
    const formData = new FormData(form);
    const url = base_url + '/auth/register'

    fetch(url, {
        headers: {
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        body: formData
    })
    .then((response) => {
        if(response.ok) {
            return response.json();
        }
        return response.text().then(text => {throw new Error(text)})
    })
    .then((data) => {
        location.reload()
    })
    .catch((error) => {
        resp = JSON.parse(error.message)
        let messages = ``
        resp.message.forEach(element => {
            console.log(element)
            messages += `${element}<br>`
        });
        swal.fire('Error', messages, 'error')
    })
})
