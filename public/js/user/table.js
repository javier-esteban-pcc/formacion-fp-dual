import {createUser, getUser} from "./apiClient.js";

function createViewButton(userId) {
    let button = document.createElement('button');
    button.setAttribute('data-user-id', userId);
    button.setAttribute('data-bs-toggle', "modal");
    button.setAttribute('data-bs-target', "#user-modal");
    button.classList.add('view-user', 'btn', 'btn-primary');
    button.addEventListener('click', function (event) {
        getUser(userId, showUserModal)
    });
    button.textContent = 'View';

    return button;
}

export function createUserRow(user) {
    const button = createViewButton(user.id);
    let row = document.createElement('tr');
    row.setAttribute('id', 'user-id-' + user.id);
    let cell1 = document.createElement('td');
    cell1.innerText = user.id;
    let cell2 = document.createElement('td');
    cell2.innerText = user.name;
    let cell3 = document.createElement('td');
    cell3.innerText = user.email;
    let cell4 = document.createElement('td');
    cell4.innerText = user.role;
    let cell5 = document.createElement('td');
    cell5.appendChild(button);

    row.appendChild(cell1);
    row.appendChild(cell2)
    row.appendChild(cell3)
    row.appendChild(cell4)
    row.appendChild(cell5);
    return row;
}

export function renderUserTable(users) {
    let userTable = document.getElementById('user-table')
    let userHeadRow = userTable.querySelector('thead')
    let userTableBody = userTable.querySelector('tbody')

    userHeadRow.innerHTML = '<tr><th>id</th><th>name</th><th>email</th><th>role</th><th></th></tr>'

    for (let user of users) {
        let row = createUserRow(user);
        userTableBody.appendChild(row);
    }
}

function showUserModal(user) {
    let modalTitle = document.querySelector('.modal-title');
    let modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = user.id;
    modalBody.innerHTML = `<p>${user.name}</p><p>${user.email}</p>`

    if (user.status === 'Pending') {
        modalBody.innerHTML += `<button data-user-id="${user.id}" id="publish-user" class="btn btn-primary">Publish</button>`
        let publishButton = document.getElementById('publish-user');
        publishButton.addEventListener('click', function (event) {
            const userId = event.toElement.getAttribute('data-user-id');
            publishUser(userId, refreshRow)
        })
    }
}

function refreshRow(userId) {
    getUser(userId, (user) => {
        let oldRow = document.getElementById('user-id-' + userId);
        oldRow.replaceWith(createUserRow(user));

        const buttonClose = document.querySelector('.btn-close');
        buttonClose.click()
    })
}

function addNewUserRow(user) {

    const userId = user.userId;

    getUser(userId, (user) => {
        let tableBody = document.querySelector('tbody');
        tableBody.appendChild(createUserRow(user));
    })

    const buttonClose = document.querySelector('.btn-close');
    buttonClose.click();

}

function submitNewUser(event) {
    event.preventDefault();
    let form = document.getElementById('new-user-form');
    let formData = new FormData(form);
    createUser(formData, addNewUserRow);
}

export function showNewUserModal() {
    let modalTitle = document.querySelector('.modal-title');
    let modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = 'New User';
    modalBody.innerHTML = `
                <form id="new-user-form">
                    <div class="mb-3">
                        <label class="form-label" for="user-title">Title</label>
                        <input type="text" name="title" class="form-control" id="user-title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-body">Body</label>
                        <textarea name="body" class="form-control" id="user-body" cols="30" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="userId" value="772fc60b194f3">
                    <button type="submit" id="submit-new-user" class="btn btn-primary">Submit</button>
                </form>`

    let submitNewUserButton = document.getElementById('submit-new-user');
    submitNewUserButton.addEventListener('click', submitNewUser);
}