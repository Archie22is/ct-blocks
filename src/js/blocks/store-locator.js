/* global jQuery, google, GOOGLE_MAPS_API_KEY */
import {
  select,
  selectAll,
  getData,
  on,
  hasClass,
  removeClass,
  addClass
} from 'lib/dom'
import { initMapScript } from 'lib/scripts'
import { map } from 'lib/utils'

initMapScript(GOOGLE_MAPS_API_KEY)

const $ = jQuery

const LOADINGCLASS = 'is-loading'

const positions = []

export default el => {
  const locationEls = selectAll('.js-data-location', el)
  const storeLocatorFormEl = select('.store-locator-form', el)
  const areaFilterEl = select('.js-area', el)
  const provinceFilterEl = select('.js-province', el)
  const districtFilterEl = select('.js-district', el)
  const icons = {
    parking: {
      icon:
        'https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50'
    }
  }

  locationEls.forEach(ele => {
    const positionEle = {
      position: {
        lat: parseFloat(getData('lat', ele)),
        lng: parseFloat(getData('lng', ele))
      },
      icon: 'parking',
      content: `<span class="store-locator__marker-title">${getData(
        'title',
        ele
      )}</span>`
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

    positions.forEach(positionIndex => {
      const marker = new google.maps.Marker({
        position: {
          lat: positionIndex.position.lat,
          lng: positionIndex.position.lng
        },
        map: map,
        icon: icons[positionIndex.icon].icon
      })

      marker.addListener('click', el => {
        map.setZoom(14)
        map.setCenter(marker.getPosition())
        InfoWindows.setContent(positionIndex.content)
        InfoWindows.open(map, this)
      })

      console.log(positionIndex.content)
    })
  }

  setTimeout(() => {
    initMap()
  }, 3000)

  // Filter
  const filter = (parentFilterEl, childFilterEl, childClassName) => {
    $.ajax({
      beforeSend: () => {
        addClass(LOADINGCLASS, storeLocatorFormEl)
      },
      success: () => {
        const valueId = $(parentFilterEl).val()
        const optionChildEls = selectAll('option', childFilterEl)

        if (optionChildEls) {
          map(optionChildEl => {
            if (hasClass(`${childClassName}-${valueId}`, optionChildEl)) {
              removeClass('hide', optionChildEl)
            } else {
              addClass('hide', optionChildEl)
            }

            const selectedDefaultEL = select(
              `.${childClassName}-${valueId}`,
              childFilterEl
            )

            $(childFilterEl).val($(selectedDefaultEL).val()).change()
          }, optionChildEls)
        }
      },
      complete: () => {
        removeClass(LOADINGCLASS, storeLocatorFormEl)
      }
    })
  }

  if (areaFilterEl) {
    on(
      'change',
      () => {
        filter(areaFilterEl, provinceFilterEl, 'js-province')
        setTimeout(() => {
          filter(provinceFilterEl, districtFilterEl, 'js-district')
        }, 10)
      },
      areaFilterEl
    )
  }

  if (provinceFilterEl) {
    on(
      'change',
      () => {
        filter(provinceFilterEl, districtFilterEl, 'js-district')
      },
      provinceFilterEl
    )
  }

  on(
    'load',
    () => {
      filter(areaFilterEl, provinceFilterEl, 'js-province')
      filter(provinceFilterEl, districtFilterEl, 'js-district')
    },
    window
  )
}
