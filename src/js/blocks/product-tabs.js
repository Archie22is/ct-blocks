import { select, selectAll, on, trigger } from 'lib/dom'
import Tabs from 'lib/tabs'

export default el => {
  // eslint-disable-next-line no-unused-vars
  const tabState = new Tabs(el, {
    lazyload: true
  })

  const mobileSelect = select('.js-mobile', el)
  const triggerEls = el ? selectAll('[role="tab"]', el) : []

  on(
    'update',
    e => {
      console.log(e)
    },
    el
  )

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
