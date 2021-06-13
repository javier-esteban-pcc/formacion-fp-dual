import {getAllPost} from "./js/postApiClient.js";
import {renderPostTable, showNewPostModal} from "./js/postTable.js";

getAllPost(renderPostTable);

 let button = document.getElementById('new-post');
button.addEventListener('click', showNewPostModal)

