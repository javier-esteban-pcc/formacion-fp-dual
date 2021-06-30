import {getSessionInfo} from "./apiClient.js";
import {showNewUserModal} from "./table.js";

export function showSessionInfo(session) {
    let userElement = document.getElementById('user-info');
    userElement.innerHTML = '';
    if (session.email === null) {
        const loginButton = createLoginButton();
        userElement.appendChild(loginButton);
        userElement.appendChild(createRegisterButton())
    } else {
        userElement.textContent = `Hello, ${session.name}`;
    }
}

function createLoginButton() {
    let button = document.createElement('button');
    button.setAttribute('data-bs-toggle', "modal");
    button.setAttribute('data-bs-target', "#post-modal");
    button.classList.add('btn', 'btn-primary');
    button.textContent = 'Login';
    button.addEventListener('click', showLoginModal);

    return button;
}

function createRegisterButton() {
    let button = document.createElement('button');
    button.setAttribute('data-bs-toggle', "modal");
    button.setAttribute('data-bs-target', "#post-modal");
    button.classList.add('btn', 'btn-primary');
    button.textContent = 'New User';
    button.addEventListener('click', showNewUserModal);

    return button;
}

function showLoginModal() {
    let modalTitle = document.querySelector('.modal-title');
    let modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = 'Login';
    modalBody.innerHTML = `
                <form id="login-form">
                    <div class="mb-3">
                        <label class="form-label" for="user-title">Email</label>
                        <input type="text" name="email" class="form-control" id="login-email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-title">Password</label>
                        <input type="password" name="password" class="form-control" id="login-password">
                    </div>
                    <div id="login-error"></div>
                    <button  id="submit-login" class="btn btn-primary">Login</button>
                </form>`

    let submitLogin = document.getElementById('submit-login');
    submitLogin.addEventListener('click', doLogin);

}

function doLogin(event) {
    event.preventDefault();
    let errorSection = document.getElementById('login-error');
    errorSection.textContent = '';
    let form = document.getElementById('login-form');
    let formData = new FormData(form);
    login(formData,
        () => {
            getSessionInfo(showSessionInfo);
        },
        catchLoginError);
}

function catchLoginError(error) {
    error.then(
        (errorText) => {
            let errorSection = document.getElementById('login-error');
            errorSection.textContent = errorText;
        }
    )
}

function login(formData, callback, error) {
    let requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    fetch("http://localhost:9200/login", requestOptions)
        .then(response => {
            if (response.status === 401) {
                catchLoginError(response.json());
                return;
            }
            return response.json();
        })
        .then(callback)
        .catch(error);
}