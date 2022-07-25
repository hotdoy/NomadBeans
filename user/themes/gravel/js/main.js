window.addEventListener("DOMContentLoaded", (event) => {
  console.log("DOM fully loaded and parsed")
})

document.addEventListener("alpine:init", () => {
  Alpine.store("gravel", {
    mobileMenuShowing: false,
    loginModalShowing: false,
    onScrollHandler() {
      const siteMain = document.getElementById("site-main")
      if (siteMain) {
        if (siteMain.getBoundingClientRect().top < 64) {
          document.body.classList.add("scrolled")
        } else {
          document.body.classList.remove("scrolled")
        }
      }
    },
    init() {
      const drawer = document.getElementById("drawer-content")
      window.addEventListener("load", this.onScrollHandler)
      if (drawer) drawer.addEventListener("scroll", this.onScrollHandler)
    },
    toggle() {
      this.on = !this.on
    },
    async fetchPost(url, data = {}, successCallback, errorCallback) {
      await fetch(url, {
        method: "POST", 
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      })
        .then((response) => response.json())
        .then((data) => {
          if (typeof successCallback === 'function') {
            successCallback(data)
          }
        })
        .catch((error) => {
          if (typeof errorCallback === 'function') {
            errorCallback(error)
          }
        })
    }
  })

  Alpine.data('locationRatings', () => ({
    ratingMode: false,
    init() {
      console.log('locationRatings component loaded')
    },
    send() {
      console.log('send rating');
    }
  }))
})
