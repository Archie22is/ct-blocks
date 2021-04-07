/* global jQuery, google, GOOGLE_MAPS_API_KEY */
import { select, selectAll, getData, on, removeClass, addClass } from 'lib/dom'
import { initMapScript } from 'lib/scripts'
import { map } from 'lib/utils'

initMapScript(GOOGLE_MAPS_API_KEY)

const $ = jQuery

const LOADING_CLASS = 'is-loading'

export default el => {
  const mapContentEl = select('#map', el)
  const locationEls = selectAll('.js-data-location', el)
  const sidebarSectionEl = select('.js-sidebar-section', el)
  const sidebarEl = select('.sidebar-section__inner', el)
  const mapMarkerEl = select('.js-marker', el)
  const customMarkerImage = getData('marker', mapMarkerEl)

  // Filter
  const levelFilter = (ChildFilterEl, optionEls, levelData, parentValue) => {
    if (optionEls) {
      map(optionEl => {
        if (getData(levelData, optionEl) === parentValue) {
          removeClass('hide', optionEl)
          addClass('show', optionEl)
        } else {
          addClass('hide', optionEl)
          removeClass('show', optionEl)
        }
      }, optionEls)

      $(ChildFilterEl).val($(select('.show', ChildFilterEl)).val())
    }
  }

  const initMap = positions => {
    const mapPosition = positions[0].position

    const map = new google.maps.Map(mapContentEl, {
      zoom: 14,
      center: mapPosition
    })

    const InfoWindows = new google.maps.InfoWindow()

    positions.forEach((positionIndex, index) => {
      const marker = new google.maps.Marker({
        position: {
          lat: positionIndex.position.lat,
          lng: positionIndex.position.lng
        },
        map: map,
        icon: customMarkerImage
      })

      marker.addListener('click', () => {
        map.setZoom(15)
        map.setCenter(marker.getPosition())
        InfoWindows.setContent(positionIndex.content)
        InfoWindows.open(map, marker)
      })

      let markerActionEls = selectAll('.js-marker-action', sidebarEl)
      if (markerActionEls[index]) {
        on(
          'click',
          () => {
            google.maps.event.trigger(marker, 'click')
          },
          markerActionEls[index]
        )
      }
    })
  }

  const mapFilter = () => {
    const noResultEl = select('.js-no-result', el)

    setTimeout(() => {
      if (getData('post-type', el)) {
        removeClass('show', noResultEl)
      } else {
        addClass('show', locationEls)
      }

      removeClass('hide', sidebarSectionEl)

      let positions = []
      let locationShowEls = selectAll('.show', sidebarEl)

      if (locationShowEls.length !== 0) {
        locationShowEls.forEach(ele => {
          const title = getData('title', ele)
          const contentString = `<span class="store-locator__marker-title">${title}</span>`

          const positionEle = {
            position: {
              lat: parseFloat(getData('lat', ele)),
              lng: parseFloat(getData('lng', ele))
            },
            icon: customMarkerImage,
            content: contentString
          }

          positions.push(positionEle)
        })

        initMap(positions)
      } else {
        if (getData('post-type', el)) {
          addClass('show', noResultEl)
        }

        addClass('hide', sidebarSectionEl)
      }
    }, 500)
  }

  const filter = selectEl => {
    $.ajax({
      beforeSend: () => {
        addClass(LOADING_CLASS, el)
      },
      success: () => {
        const countryFilterEl = select('.js-country', el)
        const provinceFilterEl = select('.js-province', el)
        const districtFilterEl = select('.js-district', el)
        const provinceOptionEls = selectAll('option', provinceFilterEl)
        const districtOptionEls = selectAll('option', districtFilterEl)

        const provinceFilter = () => {
          const countryValue = countryFilterEl.value
          levelFilter(
            provinceFilterEl,
            provinceOptionEls,
            'country',
            countryValue
          )
        }

        const districtFilter = () => {
          const provinceValue = provinceFilterEl.value

          levelFilter(
            districtFilterEl,
            districtOptionEls,
            'province',
            provinceValue
          )
        }

        const sidebarFilter = () => {
          const countryValue = countryFilterEl.value
          const provinceValue = provinceFilterEl.value
          const districtValue = districtFilterEl.value

          locationEls.forEach(ele => {
            const tempData = getData('categories', ele).split(' ')

            if (
              tempData.includes(countryValue) &&
              tempData.includes(provinceValue) &&
              tempData.includes(districtValue)
            ) {
              removeClass('hide', ele)
              addClass('show', ele)
            } else {
              addClass('hide', ele)
              removeClass('show', ele)
            }
          })
        }

        switch (selectEl) {
          case countryFilterEl:
            provinceFilter()
            districtFilter()
            sidebarFilter()
            mapFilter()
            break
          case provinceFilterEl:
            districtFilter()
            sidebarFilter()
            mapFilter()
            break
          default:
            sidebarFilter()
            mapFilter()
        }
      },
      complete: () => {
        removeClass(LOADING_CLASS, el)
      }
    })
  }

  if (getData('post-type', el)) {
    const storeLocatorFormEl = select('.store-locator-form', el)

    if (storeLocatorFormEl) {
      const selects = selectAll('select', storeLocatorFormEl)

      if (selects) {
        map(select => {
          if (select) {
            on(
              'change',
              el => {
                filter(el.target)
              },
              select
            )
          }
        }, selects)
      }
    }
  } else {
    mapFilter()
  }

  on(
    'load',
    () => {
      if (getData('post-type', el)) {
        const countryFilterEl = select('.js-country', el)

        filter(countryFilterEl)
      } else {
        mapFilter()
      }
    },
    window
  )
}
