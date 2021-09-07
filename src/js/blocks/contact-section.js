/* global google, GOOGLE_MAPS_API_KEY */
import { select, on, getData, addClass, inViewPort } from 'lib/dom'
import { throttle } from 'lib/utils'
import { initMapScript } from 'lib/scripts'

export default el => {
	// Map elements
	const mapEl = select('.js-map', el)
	const defaultZoom =
		mapEl && getData('default-zoom', mapEl)
			? parseInt(getData('default-zoom', mapEl))
			: 14
	const clickedZoom =
		mapEl && getData('clicked-zoom', mapEl)
			? parseInt(getData('clicked-zoom', mapEl))
			: 18
	const mapMarkerEl = mapEl ? select('.js-marker', mapEl) : null
	let mapObj = null
	let loaded = false

	const initMap = () => {
		const mapOptions = {
			zoom: defaultZoom,
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
					mapObj.setZoom(clickedZoom)
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
			'load',
			() => {
				initMapScript(GOOGLE_MAPS_API_KEY)

				if (!loaded && inViewPort(el)) {
					load()
				}
			},
			window
		)

		on(
			'scroll',
			throttle(() => {
				if (!loaded && inViewPort(el)) {
					load()
				}
			}, 1000),
			window
		)
	}
}
