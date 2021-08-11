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
  let loaded = false

  const settings = getData('settings', el)
    ? JSON.parse(getData('settings', el))
    : {}

  const getRestUrl = () => {
    return `${codetotConfig.ajax.restUrl}/${settings.endpoint}/?categories=${settings.categories}&posts_per_page=${settings.postsPerPage}&query_type=${settings.queryType}`
  }

  const init = () => {
    if (loaded) {
      return true
    }

    if (contentEl && hasClass('is-not-loaded', contentEl)) {
      loadNoscriptContent(contentEl)
      removeClass('is-loading', el)
    }

    const listEl = select('.js-grid', el)

    if (listEl && hasClass('is-not-loaded', listEl)) {
      addClass('is-loading', el)

      window
        .fetch(getRestUrl())
        .then(parseJSON)
        .then(data => {
          if (data.html) {
            listEl.innerHTML = data.html
            removeClass('is-not-loaded', listEl)
          }

          removeClass('is-loading', el)
        })
    }

    loaded = true
  }

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
