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

export function getPost(postId, callBack) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts/" + postId, requestOptions)
        .then(response => response.json())
        .then(callBack)
        .catch(error => console.log('error', error));
}

export const publishPost = (postId, callBack) => {
    var requestOptions = {
        method: 'POST',
        redirect: 'follow'
    };

    fetch(`http://localhost:9200/posts/${postId}/publish`, requestOptions)
        .then(callBack(postId))
        .catch(error => console.log('error', error));
}

export function createPost(data) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: data,
        redirect: 'follow'
    };

    fetch("http://localhost:9200/posts", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log('error', error));
}