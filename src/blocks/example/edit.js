import { RichText } from "@wordpress/block-editor";

export default props => {
	const {
		classname,
		attributes: { content },
		setAttributes
	} = props;
	return (
		<RichText
			tagName="p"
			className={classname}
			value={content}
			onChange={newContent => {
				setAttributes({ content: newContent });
			}}
		/>
	);
};
