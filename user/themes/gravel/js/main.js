window.addEventListener("DOMContentLoaded", (event) => {
  console.log("DOM fully loaded and parsed")
})

document.addEventListener("alpine:init", () => {
  Alpine.store("gravel", {
    onScrollHandler() {
      const siteMain = document.getElementById('site-main')
      if (siteMain.getBoundingClientRect().top < 64) {
        document.body.classList.add("scrolled")
      } else {
        document.body.classList.remove("scrolled")
      }
    },
    init() {
      const drawer = document.getElementById('drawer-content')
      window.addEventListener("load", this.onScrollHandler)
      drawer.addEventListener("scroll", this.onScrollHandler)
    },
    toggle() {
      this.on = !this.on
    }
  })
})
