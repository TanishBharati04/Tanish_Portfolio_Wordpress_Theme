import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import edit from './edit';
import save from './save.js';

registerBlockType('tanish/social-icons', {
    title : __('Social Media Icons', 'tanish'),
    category : 'widgets',
    icon : 'share(alt2)',
    edit,
    save,
});