import metadata from "./block.json";
import edit from "./edit";
import save from "./save";
import deprecated from "./deprecated";

export default registerBlockType("fabiankaegy/example", {
	title: metadata.name,
	category: metadata.category,
	keywords: metadata.keywords,
	edit,
	save,
	deprecated
});
