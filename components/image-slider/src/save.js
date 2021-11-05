import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';

export default function save({ attributes }) {
	const {
		lazyload,
		enableAutoplay,
		autoplayTiming,
		pageDots,
		prevNextButtons,
		adaptiveHeight,
		cellAlign,
		wrapAround,
		linkTarget,
		images
	} = attributes;

	const settings = {
		autoPlay: enableAutoplay && autoplayTiming ? autoplayTiming * 1000 : false,
		arrowShape: 'M5.474 75.72l43.62-45.166 45.541 43.278a3.121 3.121 0 0 0 4.48-.094 3.121 3.121 0 0 0-.094-4.448L51.249 23.905a3.543 3.543 0 0 0-1.202-.718 3.2 3.2 0 0 0-3.371.78L.886 71.382a3.121 3.121 0 0 0 .093 4.448 3.121 3.121 0 0 0 4.495-.11z',
		pageDots,
		prevNextButtons,
		adaptiveHeight,
		cellAlign,
		wrapAround
	}

	const blockProps = useBlockProps.save()
	blockProps.className += ' ct-blocks-image-slider';

	if (lazyload && lazyload !== 'none') {
		blockProps.className += ' has-lazyload is-lazyload-' + lazyload;
	}

	if (lazyload && lazyload === 'section') {
		blockProps.className += ' is-not-loaded';
	}

	if (adaptiveHeight) {
		blockProps.className += ' has-height-animation';
	}

	const imagesMarkup =
		<div className={'ct-blocks-image-slider__slider js-slider'} data-settings={JSON.stringify(settings)}>
			{ images.map((image, index) => {
			let itemClass = 'ct-blocks-image-slider__item';

			if (index > 0 && lazyload ==='not-viewport') {
				itemClass += ' is-not-loaded';
			}

			const imageBlock = <img className={'ct-blocks-image-slider__image'} src={image.url} alt={image.alt} width={image.width} height={image.height} />
			const itemBlock = image.link ? <a className={'ct-blocks-image-slider__link'} href={image.link} target={linkTarget} rel={linkTarget === '_blank' ? 'noopener' : ''}>{ imageBlock }</a> : imageBlock

			return <div className={itemClass} data-slider-index={image.index}>
				{ index > 0 && lazyload ==='not-viewport' ? <noscript>{ itemBlock }</noscript> : itemBlock }
			</div>
		})}
	</div>

	return (
		<div {...blockProps} data-component="ct-blocks-image-slider">
			<Fragment>
				{ lazyload === 'section' ? <noscript>{ imagesMarkup }</noscript> : imagesMarkup }
			</Fragment>
			<div className={'ct-blocks-image-slider__loader'}><span className={'loader'}></span></div>
		</div>
	);
}
