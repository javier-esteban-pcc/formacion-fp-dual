export function getPost(postId, callback) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts/" + postId, requestOptions)
        .then(response => response.json())
        .then(post => callback(post))
}

export function getAllPost(callback) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts", requestOptions)
        .then(response => response.json())
        .then(posts => callback(posts))
        .catch(error => console.log('error', error));
}

export function publishPost(postId, callback) {
    var requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };

    fetch(`http://localhost:9200/posts/${postId}/publish`, requestOptions)
        .then(() => callback(postId))
        .catch(error => console.log('error', error));
}

export function createPost(formData, callback) {
    let requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts", requestOptions)
        .then(response => response.json())
        .then(callback)
        .catch(error => console.log('error', error));
}