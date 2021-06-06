import {getAllPosts} from "./assets/js/apiPosts.js";
import {printPosts, showNewPostModal} from "./assets/js/printPosts.js";


let newPostButton = document.getElementById('new-post')
newPostButton.addEventListener('click', showNewPostModal);
getAllPosts(printPosts);