export default () => ({
  body: document.body,

  updateTheme (theme) {
    this.body.classList.remove("dark-theme", "light-theme");
    this.body.classList.add(theme);
    localStorage.setItem("theme", theme);
  }
});
