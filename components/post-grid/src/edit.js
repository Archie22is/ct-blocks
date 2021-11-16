import { __ } from '@wordpress/i18n'
import ServerSideRender from '@wordpress/server-side-render'
import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
	PanelBody,
	TextControl,
	RangeControl,
	ToggleControl
} from '@wordpress/components'

import './editor.scss'

export default function Edit (props) {
	const { setAttributes, attributes } = props

	const {
		categoryId,
		className,
		anchorName,
		postCount,
		columns,
		showDate,
		showCategory,
		showReadMore,
		showThumbnail
	} = attributes

	function setCategoryId (value) {
		setAttributes({ categoryId: value })
	}

	function setClassName (value) {
		setAttributes({ className: value })
	}

	function setAnchorName (value) {
		setAttributes({ anchorName: value })
	}

	function setPostCount (value) {
		setAttributes({ postCount: value })
	}

	function setColumns (value) {
		setAttributes({ columns: value })
	}

	function setShowDate () {
		setAttributes({ showDate: !showDate })
	}

	function setShowCategory () {
		setAttributes({ showCategory: !showCategory })
	}

	function setShowReadMore () {
		setAttributes({ showReadMore: !showReadMore })
	}

	function setShowThumbnail () {
		setAttributes({ showThumbnail: !showReadMore })
	}

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__('Post Grid settings', 'ct-blocks')}>
					<TextControl
						label='Category ID'
						value={categoryId}
						onChange={setCategoryId}
					/>

					<TextControl
						label='Class Name'
						value={className}
						onChange={setClassName}
					/>

					<TextControl
						label='Anchor Name'
						value={anchorName}
						onChange={setAnchorName}
					/>

					<RangeControl
						label={__('Post Count', 'ct-blocks')}
						min={3}
						max={24}
						value={postCount}
						onChange={setPostCount}
					/>

					<RangeControl
						label={__('Columns', 'ct-blocks')}
						min={2}
						max={6}
						value={columns}
						onChange={setColumns}
					/>

					<ToggleControl
						label={__('Show Date', 'ct-blocks')}
						checked={showDate}
						onChange={setShowDate}
					/>

					<ToggleControl
						label={__('Show Category', 'ct-blocks')}
						checked={showCategory}
						onChange={setShowCategory}
					/>

					<ToggleControl
						label={__('Show Read More', 'ct-blocks')}
						checked={showReadMore}
						onChange={setShowReadMore}
					/>

					<ToggleControl
						label={__('Show Thumbnail', 'ct-blocks')}
						checked={showThumbnail}
						onChange={setShowThumbnail}
					/>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block='ct-blocks/post-grid' attributes={attributes} />
		</div>
	)
}
