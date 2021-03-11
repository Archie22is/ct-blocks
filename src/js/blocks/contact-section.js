/* global google, GOOGLE_MAPS_API_KEY */
import { select, on, getData, addClass, inViewPort } from 'lib/dom'
import { throttle } from 'lib/utils'
import { initMapScript } from 'lib/scripts'

export default el => {
  // Map elements
  const mapEl = select('.js-map', el)
  const mapMarkerEl = mapEl ? select('.js-marker', mapEl) : null
  let mapObj = null
  let loaded = false

  const initMap = () => {
    const mapOptions = {
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    mapObj = new google.maps.Map(mapEl, mapOptions)
  }

  const initMapMarker = () => {
    if (mapMarkerEl) {
      mapObj.markers = []

      const lat = getData('lat', mapMarkerEl)
      const lng = getData('lng', mapMarkerEl)
      const customMarkerImage = getData('marker', mapMarkerEl)

      const latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
      }

      const marker = new google.maps.Marker({
        position: latLng,
        map: mapObj,
        icon: customMarkerImage
      })

      mapObj.markers.push(marker)

      if (marker) {
        marker.addListener('click', () => {
          mapObj.setZoom(18)
          mapObj.setCenter(marker.getPosition())
        })
      }
    }
  }

  const centerMap = () => {
    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds()
    mapObj.markers.forEach(function (marker) {
      bounds.extend({
        lat: marker.position.lat(),
        lng: marker.position.lng()
      })
    })

    mapObj.setCenter(bounds.getCenter())
  }

  if (GOOGLE_MAPS_API_KEY) {
    const load = () => {
      setTimeout(function () {
        initMap()
        initMapMarker()
        centerMap()

        addClass('is-loaded', el)
        loaded = true
      }, 100)
    }

    on(
      'scroll',
      throttle(() => {
        if (!loaded && inViewPort(el)) {
          initMapScript(GOOGLE_MAPS_API_KEY)
          load()
        }
      }, 1000),
      window
    )
  }
}
