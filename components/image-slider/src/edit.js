import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps, BlockControls, MediaPlaceholder } from '@wordpress/block-editor';
import { PanelBody, RangeControl, ToggleControl, ToolbarGroup, ToolbarButton } from '@wordpress/components';
import { edit } from '@wordpress/icons';
import { useEffect, useState, useRef } from '@wordpress/element';
import Flickity from 'flickity';
import './editor.scss';

export default function Edit(props) {
	const {
		setAttributes,
		attributes
	} = props;

	const {
		enableAutoplay,
		autoplayTiming,
		images
	} = attributes;

	const [slider, setSlider] = useState(null);
	const sliderEl = useRef(null);

	useEffect(() => {
		if (images && images.length) {
			const settings = {
				cellAlign: 'left',
				autoPlay: enableAutoplay && autoplayTiming ? autoplayTiming * 1000 : false,
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

	function updateImage(selectedImages) {
		const newImages = selectedImages.map(selectedImage => {
			return {
				id: selectedImage.id,
				url: selectedImage.url,
				alt: selectedImage.alt,
				width: selectedImage.width,
				height: selectedImage.height
			}
		})

		setAttributes({
			images: newImages
		});
	}

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Slider settings', 'ct-blocks' ) }>
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
				</PanelBody>
			</InspectorControls>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton
						icon={ edit }
						label="Edit"
						onClick={ () => console.log( 'Editing' ) }
					/>
				</ToolbarGroup>
			</BlockControls>
			{ images.length ?
				<div className={'ct-blocks-image-slider'}>
					<div className={'ct-blocks-image-grid__slider'} ref={sliderEl}>
					{
						images.map(image => {
							return <div className={'ct-blocks-image-slider__item'}>
								<img className={'ct-blocks-image-slider__image'} src={image.url} alt={image.alt} width={image.width} height={image.height} />
							</div>
						})
					}
				</div>
				<div className= {'ct-blocks-image-slider__placeholder'}>
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
