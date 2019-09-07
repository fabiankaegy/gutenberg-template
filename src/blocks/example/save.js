export default props => {
	const {
		classname,
		attributes: { content }
	} = props;
	return <p className={classname}>{content}</p>;
};
