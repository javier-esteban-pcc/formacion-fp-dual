import {getPost, publishPost} from "./apiPosts.js";

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
        publishPost(postId);
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

function createPostRow(post) {
    let row = document.createElement('tr');
    row.setAttribute('data-post-id', post.id)
    const button = createViewButton(post);
    let buttonCell = document.createElement('td');
    buttonCell.appendChild(button);
    row.innerHTML = `<td>${post.id}</td><td>${post.title}</td><td>${post.userId}</td><td>${post.status}</td>`;
    row.appendChild(buttonCell);
    return row;
}

export const printPosts = posts => {
    let postTable = document.getElementById('post-table');
    let tableHead = postTable.querySelector('thead');
    let tableBody = postTable.querySelector('tbody');

    tableHead.innerHTML = '<tr><th>id</th><th>Title</th><th>Author</th><th>State</th><th></th></tr>';
    posts.forEach( (post) => {
            tableBody.appendChild(createPostRow(post));
        }
    )

}