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
          if (typeof successCallback === "function") {
            successCallback(data)
          }
        })
        .catch((error) => {
          if (typeof errorCallback === "function") {
            errorCallback(error)
          }
        })
    }
  })

  Alpine.data("megaSearchComponent", () => ({
    keywords: '',
    city: 'All Cities',
    cityInput: '',
    citiesExpanded: false,
    cities: {},
    amenities: [],
    loading: false,
    amenitiesExpanded: true,
    init() {
      this.initAmenities()
      this.initCity()
    },
    initCity() {
      fetch('/cities.json')
        .then((response) => {
          return response.json()
        })
        .then((data) => {
          this.cities = data

          if (this.city !== 'All Cities') {
            Object.entries(this.cities).forEach((element) => {
              if (element[0] === this.city) {
                this.cityInput = element[1].ascii_name + ', ' + element[1].country_long
              }
            })
          }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    },
    initAmenities() {
      let deviceWidthChecker = (x) => {
        if (x.matches) {
          this.amenitiesExpanded = false
        } else {
          this.amenitiesExpanded = true
        }
      }

      var x = window.matchMedia("(max-width: 639px)")
      deviceWidthChecker(x)

      x.addEventListener("change", deviceWidthChecker)
    },
    get query() {
      let cityQuery = `${this.city && this.city !== 'All Cities' ? 'city:' + this.city + '/' : ''}`
      let keywordsQuery = `${this.keywords ? 'search:' + encodeURI(this.keywords) + '/' : ''}`
      let amenitiesQuery = `${this.amenities.length ? 'amenities:' + this.amenities.join('%2C') + '/' : ''}`

      return `/locations/results/${cityQuery}${keywordsQuery}${amenitiesQuery}`
    },
    get queryWithoutResults() {
      let cityQuery = `${this.city && this.city !== 'All Cities' ? 'city:' + this.city + '/' : ''}`
      let keywordsQuery = `${this.keywords ? 'search:' + encodeURI(this.keywords) + '/' : ''}`
      let amenitiesQuery = `${this.amenities.length ? 'amenities:' + this.amenities.join('%2C') + '/' : ''}`

      return `/locations/${cityQuery}${keywordsQuery}${amenitiesQuery}`
    },
    amenitiesChangeHandler(e) {
      const v = e.target.value
      const c = e.target.checked

      if (c) {
        if (!this.amenities.includes(v)) {
          this.amenities.push(v)
        }
      } else {
        this.amenities = this.amenities.filter(element => element !== v)
      }
    },
    get matchedCities() {
      if (this.cityInput == '') {
        return this.cities
      } else {
        const citiesArray = Object.entries(this.cities)
  
        const filtered = citiesArray.filter(([key, value]) => {
          const name = value.ascii_name.toLowerCase()
          return name.includes(this.cityInput.toLowerCase())
        })
  
        return Object.fromEntries(filtered)
      }
    },
    replaceResults() {
      this.loading = true

      fetch(this.query)
        .then((response) => {
          return response.text()
        })
        .then((responseText) => {
          this.loading = false

          const html = new DOMParser().parseFromString(responseText, 'text/html')
          const resultsSource = html.getElementById('results-grid')
          const resultsDestination = document.getElementById('results-grid')

          if (resultsSource && resultsDestination) resultsDestination.innerHTML = resultsSource.innerHTML;

          window.history.pushState(null, 'Locations', this.queryWithoutResults);
        })
        .catch((error) => {
          this.loading = false

          console.error('Error:', error);
        });
    }
  }))
})
