import {getPost} from "./apiPosts.js";

const printSinglePostOnClickViewButtom = (event) => {
    console.log(event.toElement.getAttribute('data-post-id'));
    getPost(event.toElement.getAttribute('data-post-id'), () => alert('Imprimir post'));
}


export const printPosts = posts => {
    let postTable = document.getElementById('post-table');

    postTable.innerHTML = '<tr><th>id</th><th>Title</th><th>Author</th><th>State</th><th></th></tr>';
    posts.forEach( (post) => {
            let button = `<button type="button" class="btn btn-primary view-post" data-post-id="${post.id}">View</button>`
            postTable.innerHTML += `<tr><td>${post.id}</td><td>${post.title}</td><td>${post.userId}</td><td>${post.status}</td><td>${button}</td></tr>`;
        }
    )

    const postButtons =  document.getElementsByClassName('view-post')
    for (let button of postButtons) {
        button.addEventListener('click', printSinglePostOnClickViewButtom);
    }

}