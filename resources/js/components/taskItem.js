export default (task) => ({
    task: task,
    isDeleted: false,

    update(event) {
        event.target.blur();
        axios
            .patch(`/tasks/${task.id}`, {
                body: this.task.body,
            })
            .then((response) => {
                window.location.reload();
            });
    },

    complete() {
        this.task.complete = !this.task.complete;

        axios
            .patch(`/tasks/${this.task.id}`, {
                complete: this.task.complete,
            })
            .then((response) => {
                window.location.reload();
            });
    },

    deleteTask() {
        this.isDeleted = true;
        axios
            .delete(`/tasks/${this.task.id}`)
            .then((response) => {
                window.location.reload();
            })
            .then((response) => {
                window.location.reload();
            });
    },
});
