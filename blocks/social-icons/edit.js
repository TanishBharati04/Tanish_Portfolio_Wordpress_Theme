import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, MediaUploadCheck, RichText } from '@wordpress/block-editor';
import { Button, TextControl } from '@wordpress/components';
import './editor.css';
import { platform } from '@floating-ui/dom';

export default function edit({ attributes, setAttributes}) {
    const { socialLinks } = attributes;

    const updateLink = (platform, value) => {
        setAttributes({
            socialLinks : { ...socialLinks, [platform]: value }
        });
    };

    return (
        <div {...useBlockProps()}>
            <h4>{__('Social Media Icons', 'tanish-portfolio')}</h4>
            {['GitHub', 'LinkedIn', 'X', 'Youtube', 'Facebook'].map(platform => (
                <TextControl
                    key={platform}
                    label={platform + ' URL'}
                    value={socialLinks[platform.toLowerCase()] || ''}
                    onChange={(value) => updateLink(platform.toLowerCase(), value)}
                />
            ))}
        </div>
    );
}