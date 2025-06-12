export default () => ({
    title: null,
    description: null,
    tasks: [],
    tasksCount: 0,

    addTask() {
        this.tasksCount++;
        let tasksContainer = document.getElementById("tasks-container");
        let task = document.createElement("input");
        task.placeholder = `Task ${this.tasksCount}`;
        task.setAttribute("x-model", `tasks[${this.tasksCount - 1}]`);
        task.className =
            "w-full placeholder-secondary-fonce outline-1 font-normal rounded p-2 bg-extra-muted" +
            " shadow focus:outline outline-muted text-normal";
        tasksContainer.appendChild(task);
    },
    addProject() {
        axios
            .post("/projects", {
                title: this.title,
                description: this.description,
                tasks: this.tasks,
            })
            .then((response) => {
                window.location.href = response.data;
            })
            .catch((error) => {
                let show = document.getElementById("add_project_errors");

                show.innerHTML = "";

                for (const [key, messages] of Object.entries(
                    error.response.data.errors,
                )) {
                    messages.forEach((message) => {
                        const errorItem = document.createElement("p");
                        errorItem.textContent = message;
                        errorItem.className = "text-error text-sm";
                        show.appendChild(errorItem);
                    });
                }
            });
    },
});
