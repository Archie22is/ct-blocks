/* global jQuery */
import { selectAll, select } from 'lib/dom'

const $ = jQuery
export default el => {
  const counters = selectAll('.js-counter', el)

  const showCount = select('.counters__col', el)
  let a = 0
  $(window).scroll(function () {
    const top = $(showCount).offset().top - window.innerHeight + 50
    if (a === 0 && $(window).scrollTop() > top) {
      if (counters) {
        counters.forEach(function (item) {
          $(item)
            .prop('Counter', 0)
            .animate(
              {
                Counter: $(item).text()
              },
              {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(item).text(Math.ceil(now))
                }
              }
            )
        })
      }
      a = 1
    }
  })
}
