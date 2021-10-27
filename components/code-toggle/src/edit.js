/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { TextControl, TextareaControl, PanelBody, ToggleControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const [displayIcon, setDislayIcon] = useState(false);
	const [darkTheme, setDarkTheme] = useState(false);

	useEffect(() => {
		if (attributes.displayIcon) {
			setDislayIcon(true);
		}

		if (attributes.isDarkTheme) {
			setDarkTheme(true);
		}
	}, [attributes]);

	const updateDisplayIcon = () => {
		setDislayIcon(!displayIcon);
		setAttributes({ displayIcon: !displayIcon })
	}

	const updateDarkTheme = () => {
		setDarkTheme(!darkTheme);
		setAttributes({ isDarkTheme: !darkTheme })
	}

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={__('Block Settings', 'ct-blocks')}>
					<ToggleControl label={__('Display Copy Source Icon', 'ct-bones')} checked={displayIcon} onChange={updateDisplayIcon} />
					<ToggleControl label={__('Enable Dark Theme', 'ct-bones')} checked={darkTheme} onChange={updateDarkTheme} />
				</PanelBody>
			</InspectorControls>
			<TextControl label={__('Title', 'ct-blocks')} value={attributes.title} onChange={ ( value ) => setAttributes( { title: value } ) } />
			<TextareaControl label={__('Code', 'ct-blocks')} value={attributes.code} onChange={ ( value ) => setAttributes( { code: value } ) } />
		</div>
	);
}
