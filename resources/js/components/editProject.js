export default (project) => ({
    title: project.title,
    description: project.description,

    editProject() {
        axios
            .patch(`/projects/${project.id}`, {
                title: this.title,
                description: this.description,
            })
            .then((r) => {
                window.location.reload();
            })
            .catch((error) => {
                let show = document.getElementById("edit_project_errors");

                show.innerHTML = "";
                if (error.response.data.errors) {
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
                }
            });
    },
});
