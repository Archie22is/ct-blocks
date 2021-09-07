import {
	select,
	inViewPort,
	on,
	removeClass,
	hasClass,
	loadNoscriptContent
} from 'lib/dom'
import { initStyle } from 'lib/scripts'
import { throttle } from 'lib/utils'
import Plyr from 'plyr'

const PLYR_STYLESHEET = 'https://cdn.plyr.io/3.6.4/plyr.css'
const LOADING_CLASS = 'is-loading'

export default el => {
	const contentEl = select('.js-main-content', el)
	let videoEl = null
	// eslint-disable-next-line no-unused-vars
	let player = null
	let loaded = false

	const initLoad = () => {
		if (loaded) {
			return
		}

		if (inViewPort(contentEl) && hasClass(LOADING_CLASS, el)) {
			loadNoscriptContent(contentEl, 'is-not-loaded')

			removeClass(LOADING_CLASS, el)
		}

		initStyle(PLYR_STYLESHEET)

		videoEl = select('.js-video', el)

		if (!videoEl) {
			return
		}

		player = new Plyr(videoEl)

		loaded = true
	}

	on('scroll', throttle(initLoad, 100), window)

	on('load', throttle(initLoad, 100), window)
}
