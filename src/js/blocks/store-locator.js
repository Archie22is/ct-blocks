/* global google, GOOGLE_MAPS_API_KEY */
import { initMapScript } from 'lib/scripts'
initMapScript(GOOGLE_MAPS_API_KEY)

export default el => {
  const icons = {
    parking: {
      icon:
        'https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50'
    }
  }

  const airports = [
    {
      title: 'Manchester Airport',
      position: {
        lat: 53.3588026,
        lng: -2.274919
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Manchester Airport - from £30</h1><div id="bodyContent"><p><b>Manchester Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
      title: 'Leeds Airport',
      position: {
        lat: 53.8679434,
        lng: -1.6637193
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Leeds Airport - from £30</h1><div id="bodyContent"><p><b>Leeds Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
      title: 'Belfast Airport',
      position: {
        lat: 54.661781,
        lng: -6.2184331
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Belfast Airport - from £30</h1><div id="bodyContent"><p><b>Belfast Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
      title: 'Edinburgh Airport',
      position: {
        lat: 55.950785,
        lng: -3.3636419
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Edinburgh Airport - from £30</h1><div id="bodyContent"><p><b>Edinburgh Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
      title: 'Cardiff Airport',
      position: {
        lat: 51.3985498,
        lng: -3.3416461
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Cardiff Airport - from £30</h1><div id="bodyContent"><p><b>Cardiff Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
      title: 'Heathrow Airport',
      position: {
        lat: 51.4700223,
        lng: -0.4542955
      },
      icon: 'parking',
      content:
        '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Heathrow Airport - from £50</h1><div id="bodyContent"><p><b>Heathrow Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    }
  ]

  const initMap = () => {
    const uk = {
      lat: 53.990221,
      lng: -3.911132
    }

    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: uk,
      disableDefaultUI: true
    })

    const InfoWindows = new google.maps.InfoWindow({})

    airports.forEach(function (airport) {
      var marker = new google.maps.Marker({
        position: { lat: airport.position.lat, lng: airport.position.lng },
        map: map,
        icon: icons[airport.icon].icon,
        title: airport.title
      })
      marker.addListener('mouseover', function () {
        InfoWindows.open(map, this)
        InfoWindows.setContent(airport.content)
      })
    })
  }

  setTimeout(() => {
    initMap()
  }, 3000)
}
