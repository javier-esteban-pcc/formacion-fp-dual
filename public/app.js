import {getAllPosts} from "./js/postsApiClient.js";
import {renderPosts, showNewPostModal} from "./js/postsTable.js";

let newPostButton = document.getElementById('new-post')
newPostButton.addEventListener('click', showNewPostModal);

getAllPosts(renderPosts);