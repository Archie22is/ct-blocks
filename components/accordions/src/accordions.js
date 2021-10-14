import { selectAll } from './lib/dom';
import { map } from './lib/utils';
import Accordions from './lib/accordions';
import './accordions.scss';

const initAccordions = () => {
	const blockEls = selectAll('.ct-blocks-accordions');

	if (blockEls.length) {
		map(blockEl => {
			const newInstance = Accordions(blockEl, {});
		}, blockEls);
	}
}

document.addEventListener('DOMContentLoaded', initAccordions);
