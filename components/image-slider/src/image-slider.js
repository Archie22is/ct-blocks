import Flickity from 'flickity';

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
	if (el.classList.contains('is-not-loaded')) {
		imageSliderLazyloadSection(el);
	}

	const sliderEl = el.querySelector('.js-slider');
	let slider = null;

	let settings = sliderEl.getAttribute('data-settings') ? JSON.parse(sliderEl.getAttribute('data-settings')) : {}

	if (settings && el.classList.contains('is-lazyload-not-viewport')) {
		settings.on = {
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

	console.log(settings);

	if (!sliderEl || !settings) {
		return;
	}

	slider = new Flickity(sliderEl, settings);
}

window.addEventListener('DOMContentLoaded', () => {
	const imageSliderEls = Array.prototype.slice.call(document.querySelectorAll('[data-component="ct-blocks-image-slider"]'));

	if (imageSliderEls.length) {
		imageSliderEls.map(imageSliderInit);
	}
})
