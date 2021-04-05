/* global google, GOOGLE_MAPS_API_KEY */
import { selectAll, getData } from 'lib/dom'
import { initMapScript } from 'lib/scripts'
initMapScript(GOOGLE_MAPS_API_KEY)

export default el => {
  const locationEls = selectAll('.js-data-location', el)

  var icons = {
    parking: {
      icon:
        'https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50'
    }
  }

  const positions = []

  locationEls.forEach((ele, index) => {
    const positionEle = {
      position: {
        lat: parseFloat(getData('lat', ele)),
        lng: parseFloat(getData('lng', ele))
      },
      icon: 'parking',
      content:
        '<span class="store-locator__marker-title">' +
        getData('title', ele) +
        '</span>'
    }

    positions.push(positionEle)
  })

  function initMap() {
    const uk = positions[0].position

    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: uk
    })

    var InfoWindows = new google.maps.InfoWindow({})

    positions.forEach(function (airport) {
      var marker = new google.maps.Marker({
        position: { lat: airport.position.lat, lng: airport.position.lng },
        map: map,
        icon: icons[airport.icon].icon
      })

      if (marker.getAnimation() !== null) {
        marker.setAnimation(null)
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE)
      }

      marker.addListener('click', function () {
        map.setZoom(14)
        map.setCenter(marker.getPosition())
        InfoWindows.open(map, this)
        InfoWindows.setContent(airport.content)
      })
    })
  }

  setTimeout(() => {
    initMap()
  }, 2000)
}
