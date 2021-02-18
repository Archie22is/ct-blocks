import { on, selectAll, setAttribute, trigger } from 'lib/dom'

export default (el, customOptions = {}) => {
  const defaultOptions = {
    tabNavSelector: '[role="tab"]',
    tabPanelSelector: '[role="tabpanel"]'
  }

  const options = { ...defaultOptions, ...customOptions }
  const navItems = selectAll(options.tabNavSelector, el)
  const panels = selectAll(options.tabPanelSelector, el)

  on(
    'update',
    e => {
      for (let index = 0; index < navItems.length; index++) {
        if (index === e.detail.currentIndex) {
          setAttribute('aria-selected', 'true', navItems[index])
          navItems[index].focus()
          setAttribute('aria-expanded', 'true', panels[index])
        } else {
          setAttribute('aria-selected', 'false', navItems[index])
          setAttribute('aria-expanded', 'false', panels[index])
        }
      }
    },
    el
  )

  on(
    'click',
    e => {
      const navItem = e.target

      trigger(
        {
          event: 'update',
          data: {
            currentIndex: navItems.indexOf(navItem)
          }
        },
        el
      )
    },
    navItems
  )

  on(
    'load',
    () => {
      trigger(
        {
          event: 'update',
          data: {
            currentIndex: 0
          }
        },
        el
      )
    },
    window
  )
}
