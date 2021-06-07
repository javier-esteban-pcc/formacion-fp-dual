import {createPost, getPost, publishPost} from "./postsApiClient.js";

const showPostModal = event => {
    getPost(event.toElement.getAttribute('data-post-id'), (post) => {
        var modalTitle = document.querySelector('.modal-title')
        var modalBodyInput = document.querySelector('.modal-body')

        modalTitle.textContent = post.id

        modalBodyInput.innerHTML =     `
                    <h2>${post.title}</h2>
                    <p>${post.body}</p>
                    <p>Published by ${post.userId} at ${post.createdAt}</p>`

        if (post.status === 'Pending') {
            const button = createPublishButton(post);
            modalBodyInput.appendChild(button);
        }
    });
}

function createPublishButton(post) {
    let button = document.createElement('button', );
    button.setAttribute('type', "button");
    button.setAttribute("data-bs-toggle", "modal");
    button.setAttribute("data-bs-target", "#post-modal");
    button.setAttribute("class", "btn btn-primary view-post" );
    button.setAttribute("data-post-id", post.id);
    button.textContent = 'Publish';

    button.addEventListener('click', (event) => {
        const postId = event.toElement.getAttribute('data-post-id');
        publishPost(postId, refreshRow);
    })

    return button;
}

function createViewButton(post) {
    let button = document.createElement('button', );
    button.setAttribute('type', "button");
    button.setAttribute("data-bs-toggle", "modal");
    button.setAttribute("data-bs-target", "#post-modal");
    button.setAttribute("class", "btn btn-primary view-post" );
    button.setAttribute("data-post-id", post.id);
    button.textContent = 'view';
    button.addEventListener('click', showPostModal);

    return button;
}

function refreshRow(postId) {
    getPost(postId, function(post) {
        const row = createPostRow(post);
        let oldRow = document.getElementById(`row-${postId}`)
        oldRow.innerHTML = row.outerHTML;
    })
}

function createPostRow(post) {
    let row = document.createElement('tr');
    row.setAttribute('id', `row-${post.id}`)
    row.setAttribute('data-post-id', post.id)
    const button = createViewButton(post);
    let buttonCell = document.createElement('td');
    buttonCell.appendChild(button);
    row.innerHTML = `<td>${post.id}</td><td>${post.title}</td><td>${post.userId}</td><td>${post.status}</td>`;
    row.appendChild(buttonCell);
    return row;
}

export const renderPosts = posts => {
    let postTable = document.getElementById('post-table');
    let tableHead = postTable.querySelector('thead');
    let tableBody = postTable.querySelector('tbody');

    tableHead.innerHTML = '<tr><th>id</th><th>Title</th><th>Author</th><th>State</th><th></th></tr>';
    posts.forEach( (post) => {
            tableBody.appendChild(createPostRow(post));
        }
    )
}

export function submitPostForm(event) {
    event.preventDefault();

    let form = document.getElementById('new-post-form');
    let formData = new FormData(form);

    const data = {
        "title": formData.get('title'),
        "body": formData.get('body'),
        "userId": formData.get('userId')
    };

    createPost(JSON.stringify( data))

    let buttonClose = document.querySelector('.btn-close');
    buttonClose.click();
}

export function showNewPostModal() {
    let modalTitle = document.querySelector('.modal-title')
    let modalBodyInput = document.querySelector('.modal-body')

    modalTitle.textContent = 'New Post';
    modalBodyInput.innerHTML = `
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

    let newPostButton = document.getElementById('submit-new-post')
    newPostButton.addEventListener('click', submitPostForm);

}