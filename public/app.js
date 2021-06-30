import {getAllUsers, getSessionInfo} from "./js/user/apiClient.js";
import {renderUserTable} from "./js/user/table.js";
import {showSessionInfo} from "./js/user/login.js";

getSessionInfo(showSessionInfo);
getAllUsers(renderUserTable);




