export default props => {
	const {
		classname,
		attributes: {}
	} = props;
	return <p className={classname}>Hello World!</p>;
};
