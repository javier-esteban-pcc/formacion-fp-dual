export function getUser(userId, callback) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/users/" + UserId, requestOptions)
        .then(response => response.json())
        .then(post => callback(post))
}

export function getAllUsers(callback) {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost:9200/users", requestOptions)
        .then(response => response.json())
        .then(users => callback(users))
        .catch(error => console.log('error', error));
}


export function createUser(formData, callback) {
    let requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    fetch("http://localhost:9200/users", requestOptions)
        .then(response => response.json())
        .then(callback)
        .catch(error => console.log('error', error));
}