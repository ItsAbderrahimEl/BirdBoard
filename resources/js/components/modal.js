export default () => ({
    isOpen: false,

    open() {
        this.isOpen = !this.isOpen;
    },

    close() {
        this.isOpen = false;
    },
});
