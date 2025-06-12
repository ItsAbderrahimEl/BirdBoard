export default (project) => ({
  project: project,
  newTask: null,

  createTask () {
    axios
      .post(`/projects/${this.project.id}/tasks`, {
        body: this.newTask
      })
      .then((response) => {
        window.location.reload();
      });
  }
});
