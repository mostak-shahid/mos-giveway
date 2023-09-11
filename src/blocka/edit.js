import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import './editor.scss';
const MOS_TEMPLATE = [
	["core/image", {}],
	["core/heading", {placeholder: "Giveway Title"}],
	["core/paragraph", {placeholder: "Giveway Description"}],
	// Custom block for Social Media!
	['create-block/mos-giveway-blockb'],
	["core/button", {placeholder: "Call to Action"}],
]
export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<InnerBlocks template={MOS_TEMPLATE} templateLock="all" /> {/*templateLock="all/insert"*/}
		</div>
	);
}
