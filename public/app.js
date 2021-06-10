var requestOptions = {
    method: 'GET',
    redirect: 'follow'
};

fetch("http://localhost:9200/posts", requestOptions)
    .then(response => response.json())
    .then(function (posts) {
        let postTable = document.getElementById('post-table')
        let postHeadRow = postTable.querySelector('thead')
        let postTableBody = postTable.querySelector('tbody')

        postHeadRow.innerHTML =  '<tr><th>id</th><th>Title</th><th>Author</th><th>State</th><th></th></tr>'
        
        for (let post of posts) {
            postTableBody.innerHTML += `<tr><td>${post.id}</td><td>${post.title}</td><td>${post.userId}</td><td>${post.status}</td>
                <td><button data-post-id="${post.id}" data-bs-toggle="modal" data-bs-target="#post-modal" class="view-post btn btn-primary">View</button></td></tr>`
        }

        let buttons = document.getElementsByClassName('view-post');

        for (let i = 0; i < buttons.length - 1; i++) {
            buttons.item(i).addEventListener('click', function(event) {
                const postId = event.toElement.getAttribute('data-post-id');

                var requestOptions = {
                    method: 'GET',
                    redirect: 'follow'
                };

                fetch("http://localhost:9200/posts/" + postId, requestOptions)
                    .then(response => response.json())
                    .then(post => {
                        let modalTitle = document.querySelector('.modal-title');
                        let modalBody = document.querySelector('.modal-body');

                        modalTitle.textContent = post.id;
                        modalBody.innerHTML = `<p>${post.title}</p><p>${post.body}</p>`

                        if (post.status === 'Pending') {
                            modalBody.innerHTML = `<button data-post-id="${post.id}" id="publish-post" class="btn btn-primary">Publish</button>`
                            let publishButton = document.getElementById('publish-post');
                            publishButton.addEventListener('click', function(event) {
                                const postId = event.toElement.getAttribute('data-post-id');
                                var requestOptions = {
                                    method: 'POST',
                                    redirect: 'follow'
                                };

                                fetch(`http://localhost:9200/post/${postId}/publish`, requestOptions)
                                    .then(response => response.json())
                                    .catch(error => console.log('error', error));
                            })
                        }
                    })
                    .catch(error => console.log('error', error));
            });
        }
    })
    .catch(error => console.log('error', error));