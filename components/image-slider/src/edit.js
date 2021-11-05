import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps, MediaPlaceholder, URLInputButton } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl, ToggleControl, Toolbar, ToolbarButton } from '@wordpress/components';
import { useEffect, useState, useRef } from '@wordpress/element';
import Flickity from 'flickity';
import './editor.scss';
import { lazy } from 'react';

export default function Edit(props) {
	const {
		setAttributes,
		attributes
	} = props;

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

	const [slider, setSlider] = useState(null);
	const sliderEl = useRef(null);

	useEffect(() => {
		if (images && images.length > 1) {
			const settings = {
				autoPlay: enableAutoplay && autoplayTiming ? autoplayTiming * 1000 : false,
				arrowShape: 'M5.474 75.72l43.62-45.166 45.541 43.278a3.121 3.121 0 0 0 4.48-.094 3.121 3.121 0 0 0-.094-4.448L51.249 23.905a3.543 3.543 0 0 0-1.202-.718 3.2 3.2 0 0 0-3.371.78L.886 71.382a3.121 3.121 0 0 0 .093 4.448 3.121 3.121 0 0 0 4.495-.11z',
				pageDots,
				prevNextButtons,
				adaptiveHeight,
				cellAlign,
				wrapAround
			};

			if (slider) {
				slider.destroy();
			}

			setSlider(new Flickity(sliderEl.current, settings));
		}
	}, [attributes]);

	function setAutoplay() {
		setAttributes({ enableAutoplay: !enableAutoplay });
	}

	function setAutoplayTiming(value) {
		setAttributes({ autoplayTiming: value });
	}

	function setPageDots() {
		setAttributes({ pageDots: !pageDots });
	}

	function setPrevNextButtons() {
		setAttributes({ prevNextButtons: !prevNextButtons });
	}

	function setAdaptiveHeight() {
		setAttributes({ adaptiveHeight: !adaptiveHeight });
	}

	function setCellAlign(value) {
		setAttributes({ cellAlign: value });
	}

	function setWrapAround() {
		setAttributes({ wrapAround: !wrapAround });
	}

	function setLazyload(value) {
		setAttributes({ lazyload: value });
	}

	function setLinkTarget(value) {
		setAttributes({ linkTarget: value });
	}

	function updateImage(selectedImages) {
		const newImages = selectedImages.map((selectedImage, index) => {
			return {
				id: selectedImage.id,
				url: selectedImage.url,
				alt: selectedImage.alt,
				width: selectedImage.width,
				height: selectedImage.height,
				index: index
			}
		})

		setAttributes({
			images: newImages
		});
	}

	function updateSingleImageUrl(url, image) {
		const newImages = images.map(singleImage => {
			if (singleImage.id === image.id) {
				singleImage.link = url;
			}

			return singleImage;
		})

		setAttributes({
			images: newImages
		});
	}

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Slider settings', 'ct-blocks' ) }>
					<SelectControl
						label={ __('Lazyload', 'ct-blocks') }
						value={lazyload}
						options={[
							{ label: __('Section', 'ct-blocks'), value: 'section' },
							{ label: __('Not in viewport (Recommended)', 'ct-blocks'), value: 'not-viewport' },
							{ label: __('None', 'ct-blocks'), value: 'none' },
						]}
						onChange={setLazyload}
					/>
					<ToggleControl
						label={ __( 'Enable autoplay', 'ct-blocks' ) }
						checked={enableAutoplay}
						onChange={setAutoplay}
					/>
					<RangeControl
						label={__('Autoplay timing', 'ct-blocks')}
						min={3}
						max={10}
						value={autoplayTiming}
						onChange={setAutoplayTiming}
					></RangeControl>
					<ToggleControl
						label={ __( 'Enable Page Dots', 'ct-blocks' ) }
						checked={pageDots}
						onChange={setPageDots}
					/>
					<ToggleControl
						label={ __( 'Enable Previous/Next Button', 'ct-blocks' ) }
						checked={prevNextButtons}
						onChange={setPrevNextButtons}
					/>
					<ToggleControl
						label={ __( 'Enable Adaptive Height', 'ct-blocks' ) }
						checked={adaptiveHeight}
						onChange={setAdaptiveHeight}
					/>
					<SelectControl
						label={ __('Cell Alignment', 'ct-blocks') }
						value={cellAlign}
						options={[
							{ label: __('Left', 'ct-blocks'), value: 'left' },
							{ label: __('Center', 'ct-blocks'), value: 'center' },
							{ label: __('Right', 'ct-blocks'), value: 'right' },
						]}
						onChange={setCellAlign}
					/>
					<SelectControl
						label={ __('Link Target', 'ct-blocks') }
						value={linkTarget}
						options={[
							{ label: __('Same Window', 'ct-blocks'), value: '_self' },
							{ label: __('New Tab', 'ct-blocks'), value: '_blank' },
						]}
						onChange={setLinkTarget}
					/>
					<ToggleControl
						label={ __( 'Wrap around', 'ct-blocks' ) }
						checked={wrapAround}
						onChange={setWrapAround}
					/>
				</PanelBody>
			</InspectorControls>
			{ images.length ?
				<div className={'ct-blocks-image-slider'}>
					<div className={'ct-blocks-image-slider__slider'} ref={sliderEl}>
						{
							images.map(image => {
								const imageBlock = <img className={'ct-blocks-image-slider__image'} src={image.url} alt={image.alt} width={image.width} height={image.height} />

								return <div className={'ct-blocks-image-slider__item'} data-slider-index={image.index}>
									<div className={'ct-blocks-image-slider__item__toolbar'}>
										<Toolbar>
											<URLInputButton
												url={image.link || null}
												onChange={url => {
													updateSingleImageUrl(url, image);
												}}
											/>
										</Toolbar>
									</div>
									{ imageBlock }
								</div>
							})
						}
					</div>
					<div className={'ct-blocks-image-slider__placeholder'}>
						<MediaPlaceholder
						handleUpload={false}
						multiple={true}
						onSelect = {(selectedImages) => updateImage(selectedImages)}
						></MediaPlaceholder>
					</div>
				</div>
			:
				<div className= {'ct-blocks-image-slider__placeholder'}>
					<MediaPlaceholder
					handleUpload={false}
					multiple={true}
					onSelect = {(selectedImages) => updateImage(selectedImages)}
					></MediaPlaceholder>
				</div>
			}
		</div>
	);
}
