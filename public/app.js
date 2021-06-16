import {createPost, getAllPost, getPost} from "./js/post/apiClient.js";
import {renderPostTable, showNewPostModal} from "./js/post/table.js";
import {getAllUsers} from "./js/user/apiClient.js";
import {renderUserTable, showNewUserModal} from "./js/user/table.js";

getSessionInfo(showSessionInfo);
getAllPost(renderPostTable);
getAllUsers(renderUserTable);

 let newPostButton = document.getElementById('new-post');
newPostButton.addEventListener('click', showNewPostModal)




function getSessionInfo(callback) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/session", requestOptions)
        .then(response => response.json())
        .then(callback);
}

function showSessionInfo(session) {
    let userElement = document.getElementById('user-info');
    userElement.innerHTML = '';
    if (session.email === null) {
        const button = createLoginButton();
        userElement.appendChild(button);
    } else {
        userElement.textContent = `Hello, ${session.name}`;
    }
}

function createLoginButton()
{
    let button = document.createElement('button');
    button.setAttribute('data-bs-toggle', "modal");
    button.setAttribute('data-bs-target', "#post-modal");
    button.classList.add('btn', 'btn-primary');
    // button.addEventListener('click', function (event) {
    //     getPost(postId, showPostModal)
    // });
    button.textContent = 'Login';
    button.addEventListener('click', showLoginModal);

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




