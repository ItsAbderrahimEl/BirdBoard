export default (project) => ({
    project: project,

    updateNotes() {
        axios
            .patch(`/projects/${this.project.id}`, {
                notes: this.project.notes,
            })
            .then((response) => {
                window.location.reload();
            });
    },
});
