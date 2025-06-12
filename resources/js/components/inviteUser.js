export default (project) => ({
    invitedUser: null,
    project: project,

    inviteUser() {
        axios
            .post(`/projects/${this.project.id}/invitations`, {
                email: this.invitedUser,
            })
            .then((response) => {
                window.location.reload();
            })
            .catch((error) => {
                let validationErrors = error.response.data.errors;

                let show = document.getElementById("invite-errors");
                show.innerHTML = validationErrors.email;
            });
    },
});
