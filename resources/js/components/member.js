export default ({ projectId, memberId }) => ({
    projectId: projectId,
    memberId: memberId,

    deleteMember() {
        axios
            .delete(`/projects/${this.projectId}/members/${this.memberId}`)
            .then((r) => window.location.reload());
    },
});
