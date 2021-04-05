/* global jQuery, google, GOOGLE_MAPS_API_KEY */
import { selectAll, getData } from 'lib/dom'
import { initMapScript } from 'lib/scripts'
initMapScript(GOOGLE_MAPS_API_KEY)

const $ = jQuery

const positions = []

export default el => {
  const locationEls = selectAll('.js-data-location', el)
  const icons = {
    parking: {
      icon:
        'https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50'
    }
  }

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

  const initMap = () => {
    const uk = positions[0].position

    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: uk
    })

    const InfoWindows = new google.maps.InfoWindow({})

    positions.forEach(airport => {
      const marker = new google.maps.Marker({
        position: { lat: airport.position.lat, lng: airport.position.lng },
        map: map,
        icon: icons[airport.icon].icon
      })

      if (marker.getAnimation() !== null) {
        marker.setAnimation(null)
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE)
      }

      marker.addListener('click', () => {
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

  let data = {
    action: 'filter-store'
  }

  $('.js-area select').change(() => {
    $.ajax({
      data: data,
      success: () => {
        const valueId = $('.js-area select').val()
        const districtEls = $('.js-province option')

        districtEls.each((e, ele) => {
          $('.js-province').find('option').addClass('hide')
          $('.js-province')
            .find('.js-province-' + valueId)
            .removeClass('hide')
          $('.js-province select').val('Select district')
        })
      }
    })
  })
}
