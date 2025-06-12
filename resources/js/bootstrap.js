import axios from "axios";
import Alpine from "alpinejs";
import profile from "./components/profile.js";
import taskItem from "./components/taskItem.js";
import tasks from "./components/tasks.js";
import notes from "./components/notes.js";
import modal from "./components/modal.js";
import inviteUser from "./components/inviteUser.js";
import addProject from "./components/addProject.js";
import member from "./components/member.js";
import themeSwitcher from "./components/themeSwitcher.js";
import editProject from "./components/editProject.js";

const components = {
    profile,
    taskItem,
    tasks,
    notes,
    modal,
    inviteUser,
    addProject,
    member,
    themeSwitcher,
    editProject,
};

Object.entries(components).forEach(([key, component]) => {
    window[key] = component;
});

window.Alpine = Alpine;
Alpine.start();

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
