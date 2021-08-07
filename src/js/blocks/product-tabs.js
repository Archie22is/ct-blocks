/* global codetotConfig */
import {
  select,
  selectAll,
  on,
  trigger,
  getData,
  addClass,
  hasClass,
  removeClass
} from 'lib/dom'
import Tabs from 'lib/tabs'
require('whatwg-fetch')

const parseJSON = response => response.json()

export default el => {
  // eslint-disable-next-line no-unused-vars
  const tabState = new Tabs(el)

  const settings = getData('settings', el)
    ? JSON.parse(getData('settings', el))
    : {}

  const getRestUrl = categoryId => {
    return `${codetotConfig.restUrl}/${settings.endpoint}/?category_id=${categoryId}&posts_per_page=${settings.postsPerPage}&query_type=${settings.queryType}`
  }

  on(
    'update',
    e => {
      const currentTabEl = select('.js-tab-content.is-active', el)
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

  const mobileSelect = select('.js-mobile', el)
  const triggerEls = el ? selectAll('[role="tab"]', el) : []

  const syncChanges = () => {
    if (tabState) {
      on(
        'update',
        e => {
          mobileSelect.value = e.detail.currentIndex
        },
        el
      )
    }
  }

  if (mobileSelect) {
    on(
      'change',
      e => {
        if (tabState) {
          trigger(
            {
              event: 'update',
              data: {
                currentIndex: parseInt(e.target.value)
              }
            },
            el
          )
        }
      },
      mobileSelect
    )

    on('load', syncChanges, window)

    if (triggerEls) {
      on('click', syncChanges, triggerEls)
    }
  }
}
