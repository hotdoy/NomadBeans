window.addEventListener("DOMContentLoaded", (event) => {
  console.log("NomadBeans Frontend Scripts Loaded")
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
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
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
    },
  })

  Alpine.data("megaSearchComponent", () => ({
    keywords: "",
    city: "All Cities",
    cityInput: "",
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
      fetch("/cities.json")
        .then((response) => {
          return response.json()
        })
        .then((data) => {
          this.cities = data

          if (this.city !== "All Cities") {
            Object.entries(this.cities).forEach((element) => {
              if (element[0] === this.city) {
                this.cityInput =
                  element[1].ascii_name + ", " + element[1].country_long
              }
            })
          }
        })
        .catch((error) => {
          console.error("Error:", error)
        })
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
      let cityQuery = `${
        this.city && this.city !== "All Cities" ? "city:" + this.city + "/" : ""
      }`
      let keywordsQuery = `${
        this.keywords ? "search:" + encodeURI(this.keywords) + "/" : ""
      }`
      let amenitiesQuery = `${
        this.amenities.length
          ? "amenities:" + this.amenities.join("%2C") + "/"
          : ""
      }`

      return `/locations/results/${cityQuery}${keywordsQuery}${amenitiesQuery}`
    },
    get queryWithoutResults() {
      let cityQuery = `${
        this.city && this.city !== "All Cities" ? "city:" + this.city + "/" : ""
      }`
      let keywordsQuery = `${
        this.keywords ? "search:" + encodeURI(this.keywords) + "/" : ""
      }`
      let amenitiesQuery = `${
        this.amenities.length
          ? "amenities:" + this.amenities.join("%2C") + "/"
          : ""
      }`

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
        this.amenities = this.amenities.filter((element) => element !== v)
      }
    },
    get matchedCities() {
      if (this.cityInput == "") {
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
    cityWrapperClickOutsideHandler() {
      this.citiesExpanded = false

      if (this.city === "All Cities") {
        this.cityInput = ""
      } else {
        Object.entries(this.cities).forEach((element) => {
          if (element[0] === this.city) {
            this.cityInput =
              element[1].ascii_name + ", " + element[1].country_long
          }
        })
      }
    },
    sendAjaxSearch() {
      this.reInitMap()
      this.replaceResults()
    },
    async reInitMap() {
      if (this.city && this.city !== "All Cities") {
        var map
        var infowindow = new google.maps.InfoWindow();

        await fetch("/cities.json/city:" + this.city)
          .then((response) => {
            return response.json()
          })
          .then((cityObj) => {
            const loc = {
              lat: Number(cityObj.lat),
              lng: Number(cityObj.lng),
            }

            map = new google.maps.Map(document.getElementById("map"), {
              zoom: 11,
              center: loc,
            })
          })
          .catch((error) => {
            console.error("Error:", error)
          })

        await fetch("/locations.json/city:" + this.city)
          .then((response) => {
            return response.json()
          })
          .then((locations) => {
            console.log(map)
            Object.values(locations).forEach((val) => {
              let marker = new google.maps.Marker({
                position: new google.maps.LatLng(val["lat"], val["lng"]),
                map: map,
              })

              let markup = `
                  <a href="/locations/${val['slug']}" class="text-center font-poppins leading-tight">
                    <div class="font-bold leading-tight text-[16px]">${val['name']}</div>
                    <div class="">
                      Overall Rating: ${val['rating_overall'] / 2}
                    </div>
                    <button class="btn btn-primary btn-xs w-full mt-[4px]">View Cafe</button>
                  </a>
              `

              google.maps.event.addListener(marker, 'click', (function(marker) {
                return function() {
                  infowindow.setContent(markup);
                  infowindow.open(map, marker);
                }
              })(marker));
            })
          })
          .catch((error) => {
            console.error("Error:", error)
          })

        document.getElementById("map").style.display = "block"
        document.getElementById("no-map-content").style.display = "none"
      } else {
        document.getElementById("map").style.display = "none"
        document.getElementById("no-map-content").style.display = "block"
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

          const html = new DOMParser().parseFromString(
            responseText,
            "text/html"
          )
          const resultsSource = html.getElementById("results-grid")
          const resultsDestination = document.getElementById("results-grid")

          if (resultsSource && resultsDestination)
            resultsDestination.innerHTML = resultsSource.innerHTML

          window.history.pushState(null, "Locations", this.queryWithoutResults)
        })
        .catch((error) => {
          this.loading = false

          console.error("Error:", error)
        })
    },
  }))
})
