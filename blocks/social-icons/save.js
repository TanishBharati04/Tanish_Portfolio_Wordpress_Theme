import { useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { socialLinks } = attributes;

    return (
        <div {...useBlockProps.save()}>
            {Object.entries(socialLinks).map(([platform, url]) =>
                url ? (
                    <a key={platform} href={url} target="_blank" rel="noopener noreferrer">
                        <img src={`assets/images/${platform}.jpg`} alt={platform} />
                    </a>
                ) : null
            )}
        </div>
    );
}
