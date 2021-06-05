export function getAllPosts(printAllPosts) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts", requestOptions)
        .then(response => response.json())
        .then(printAllPosts)
        .catch(error => console.log('error', error));
}

export function getPost(postId, printPost) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts/" + postId, requestOptions)
        .then(response => response.json())
        .then(printPost)
        .catch(error => console.log('error', error));
}