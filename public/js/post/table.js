import {createPost, getPost, publishPost} from "./apiClient.js";

function createViewButton(postId) {
    let button = document.createElement('button');
    button.setAttribute('data-post-id', postId);
    button.setAttribute('data-bs-toggle', "modal");
    button.setAttribute('data-bs-target', "#post-modal");
    button.classList.add('view-post', 'btn', 'btn-primary');
    button.addEventListener('click', function (event) {
        getPost(postId, showPostModal)
    });
    button.textContent = 'View';

    return button;
}

export function createPostRow(post) {
    const button = createViewButton(post.id);

    let row = document.createElement('tr');
    row.setAttribute('id', 'post-id-' + post.id);
    let cell1 = document.createElement('td');
    cell1.innerText = post.id;
    let cell2 = document.createElement('td');
    cell2.innerText = post.title;
    let cell3 = document.createElement('td');
    cell3.innerText = post.userId;
    let cell4 = document.createElement('td');
    cell4.innerText = post.status;
    let cell5 = document.createElement('td');
    cell5.appendChild(button);

    row.appendChild(cell1);
    row.appendChild(cell2)
    row.appendChild(cell3)
    row.appendChild(cell4)
    row.appendChild(cell5);
    return row;
}

export function renderPostTable(posts) {
    let postTable = document.getElementById('post-table')
    let postHeadRow = postTable.querySelector('thead')
    let postTableBody = postTable.querySelector('tbody')

    postHeadRow.innerHTML = '<tr><th>id</th><th>Title</th><th>Author</th><th>State</th><th></th></tr>'

    for (let post of posts) {
        let row = createPostRow(post);

        postTableBody.appendChild(row);
    }

    let buttons = document.getElementsByClassName('view-post');

    for (let i = 0; i < buttons.length - 1; i++) {
        buttons.item(i).addEventListener('click', function (event) {
            const postId = event.toElement.getAttribute('data-post-id');
            getPost(postId, showPostModal)
        });
    }
}

function showPostModal(post) {
    let modalTitle = document.querySelector('.modal-title');
    let modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = post.id;
    modalBody.innerHTML = `<p>${post.title}</p><p>${post.body}</p>`

    if (post.status === 'Pending') {
        modalBody.innerHTML += `<button data-post-id="${post.id}" id="publish-post" class="btn btn-primary">Publish</button>`
        let publishButton = document.getElementById('publish-post');
        publishButton.addEventListener('click', function (event) {
            const postId = event.toElement.getAttribute('data-post-id');
            publishPost(postId, refreshRow)
        })
    }
}

function refreshRow(postId) {
    getPost(postId, (post) => {
        let oldRow = document.getElementById('post-id-' + postId);
        oldRow.replaceWith(createPostRow(post));

        const buttonClose = document.querySelector('.btn-close');
        buttonClose.click()
    })
}

function addNewPostRow(post) {

    const postId = post.postId;

    getPost(postId, (post) => {
        let tableBody = document.querySelector('tbody');
        tableBody.appendChild(createPostRow(post));
    })

    const buttonClose = document.querySelector('.btn-close');
    buttonClose.click();

}

function submitNewPost(event) {
    event.preventDefault();
    let form = document.getElementById('new-post-form');
    let formData = new FormData(form);
    createPost(formData, addNewPostRow);
}

export function showNewPostModal() {
    let modalTitle = document.querySelector('.modal-title');
    let modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = 'New Post';
    modalBody.innerHTML = `
                <form id="new-post-form">
                    <div class="mb-3">
                        <label class="form-label" for="post-title">Title</label>
                        <input type="text" name="title" class="form-control" id="post-title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="post-body">Body</label>
                        <textarea name="body" class="form-control" id="post-body" cols="30" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="userId" value="772fc60b194f3">
                    <button type="submit" id="submit-new-post" class="btn btn-primary">Submit</button>
                </form>`

    let submitNewPostButton = document.getElementById('submit-new-post');
    submitNewPostButton.addEventListener('click', submitNewPost);
}