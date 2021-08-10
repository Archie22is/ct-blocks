/* eslint-disable no-unused-vars */
/* global codetotConfig */
import {
  select,
  selectAll,
  on,
  trigger,
  getData,
  addClass,
  hasClass,
  removeClass,
  loadNoscriptContent,
  inViewPort
} from 'lib/dom'
import { map, throttle } from 'lib/utils'
import Tabs from 'lib/tabs'
require('whatwg-fetch')

const parseJSON = response => response.json()

export default el => {
  const contentEl = select('.js-main-content', el)
  let tabState = null
  let tabPanels = []
  let mobileSelect = null
  let desktopTriggerEls = []
  let loaded = false

  const settings = getData('settings', el)
    ? JSON.parse(getData('settings', el))
    : {}

  const getRestUrl = categoryId => {
    return `${codetotConfig.ajax.restUrl}/${settings.endpoint}/?category_id=${categoryId}&posts_per_page=${settings.postsPerPage}&query_type=${settings.queryType}`
  }

  const init = () => {
    if (loaded) {
      return true
    }

    if (hasClass('is-not-loaded', contentEl)) {
      loadNoscriptContent(contentEl)
      removeClass('is-loading', el)
    }

    tabState = new Tabs(el)
    mobileSelect = select('.js-mobile', el)
    desktopTriggerEls = selectAll('[role="tab"]', el)
    tabPanels = selectAll('.js-tab-content', el)

    if (mobileSelect) {
      on(
        'change',
        e => {
          const options = selectAll('option', e.target)
          let selectedOption = null
          map(option => {
            if (option.value === e.target.value) {
              selectedOption = option
            }
          }, options)

          trigger(
            {
              event: 'update',
              data: {
                currentIndex: options.indexOf(selectedOption)
              }
            },
            el
          )
        },
        mobileSelect
      )
    }

    if (desktopTriggerEls) {
      on(
        'click',
        e => {
          trigger(
            {
              event: 'update',
              data: {
                currentIndex: desktopTriggerEls.indexOf(e.target)
              }
            },
            el
          )
        },
        desktopTriggerEls
      )
    }

    loaded = true
  }

  on(
    'update',
    e => {
      const index = e.detail.currentIndex
      const currentTabEl = tabPanels[index]
      const categoryId = currentTabEl
        ? getData('category-id', currentTabEl)
        : null
      const listEl = currentTabEl ? select('.js-grid', currentTabEl) : null

      if (listEl && hasClass('is-not-loaded', listEl) && categoryId) {
        addClass('is-loading', currentTabEl)

        window
          .fetch(getRestUrl(categoryId))
          .then(parseJSON)
          .then(data => {
            if (data.html) {
              listEl.innerHTML = data.html
              removeClass('is-not-loaded', listEl)
            }

            removeClass('is-loading', currentTabEl)
          })
      }
    },
    el
  )

  if (inViewPort(el)) {
    init()
  }

  on(
    'scroll',
    throttle(() => {
      if (inViewPort(el) && !loaded) {
        init()
      }
    }, 300),
    window
  )
}
