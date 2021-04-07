import { selectAll, on, addClass, removeClass, hasClass } from 'lib/dom'
import { map } from 'lib/utils'

const ACTIVE_CLASS = 'account-tabs--register-screen'
const ITEM_ACTIVE_CLASS = 'account-tabs__nav-button--active'

export default el => {
  const triggers = selectAll('.js-tab-trigger', el)

  if (triggers && triggers.length) {
    on(
      'click',
      e => {
        if (hasClass('js-tab-trigger-change', e.target)) {
          addClass(ACTIVE_CLASS, el)
        } else {
          removeClass(ACTIVE_CLASS, el)
        }

        map(trigger => {
          if (trigger !== e.target) {
            removeClass(ITEM_ACTIVE_CLASS, trigger)
          } else {
            addClass(ITEM_ACTIVE_CLASS, trigger)
          }
        }, triggers)
      },
      triggers
    )
  }
}
