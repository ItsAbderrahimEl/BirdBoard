export default ({
    isModalOpen: false,

    open()  {
      this.isModalOpen = !this.isModalOpen
    },

    close() {
      this.isModalOpen = false
    }
})