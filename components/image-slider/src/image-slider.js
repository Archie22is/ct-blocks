import Flickity from 'flickity';

const debounce = (callback, wait) => {
	let timeoutId = null;

	return (...args) => {
	  window.clearTimeout(timeoutId);
	  timeoutId = window.setTimeout(() => {
		callback.apply(null, args);
	  }, wait);
	};
}

const inViewport = el => {
	let bounding, html;
    if ( !el || 1 !== el.nodeType ) { return false; }
    html = document.documentElement;
    bounding = el.getBoundingClientRect();

    return ( !!bounding
      && bounding.bottom >= 0
      && bounding.right >= 0
      && bounding.top <= html.clientHeight
      && bounding.left <= html.clientWidth
    );
}

const getNoScriptContent = el => {
	if (!el) {
		return ''
	}

	const contextEls = el.getElementsByTagName('noscript')
	return contextEls && contextEls.length
		? contextEls[0].textContent || contextEls[0].innerHTML
		: ''
}

const imageSliderLazyloadSection = el => {
	const noscriptContent = getNoScriptContent(el)

	if (noscriptContent) {
		el.innerHTML = noscriptContent
		el.classList.remove('is-not-loaded')

		return el;
	} else {
		return null;
	}
}

const imageSliderInit = el => {
	if ( !inViewport(el) ) {
		return el;
	}

	if (el.classList.contains('is-not-loaded')) {
		imageSliderLazyloadSection(el);
	}

	const sliderEl = el.querySelector('.js-slider');
	let slider = null;

	let settings = sliderEl.getAttribute('data-settings') ? JSON.parse(sliderEl.getAttribute('data-settings')) : {}

	if (settings && el.classList.contains('is-lazyload-not-viewport')) {
		settings.on = {
			ready: function () {
				setTimeout(() => {
					if (slider) {
						slider.resize();
					}
				}, 1000)
			},
			change: function () {
				if (slider) {
					if (slider.selectedElement.classList.contains('is-not-loaded')) {
						const noscriptContext = getNoScriptContent(slider.selectedElement);

						slider.selectedElement.innerHTML = noscriptContext;
						slider.selectedElement.classList.remove('is-not-loaded');

						slider.reloadCells();
					}
				}
			}
		}
	}

	if (!sliderEl || !settings) {
		return;
	}

	slider = new Flickity(sliderEl, settings);
}

window.addEventListener('DOMContentLoaded', () => {
	const imageSliderEls = Array.prototype.slice.call(document.querySelectorAll('[data-component="ct-blocks-image-slider"]'));

	const imageSliderLoad = () => {
		if (imageSliderEls.length) {
			const unloadedSliderEls = imageSliderEls.map(imageSliderInit);

			imageSliderEls = unloadedSliderEls;
		}
	}

	imageSliderLoad();

	document.addEventListener('scroll', debounce(imageSliderLoad, 100));
});
