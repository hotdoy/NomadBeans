window.addEventListener("DOMContentLoaded", (event) => {
  console.log("DOM fully loaded and parsed")
})

document.addEventListener("alpine:init", () => {
  Alpine.store("gravel", {
    onScrollHandler() {
      if (window.scrollY > 0) {
        document.body.classList.add("scrolled")
      } else {
        document.body.classList.remove("scrolled")
      }
    },
    init() {
      window.addEventListener("load", this.onScrollHandler)
      window.addEventListener("scroll", this.onScrollHandler)
    },
    toggle() {
      this.on = !this.on
    }
  })
})
