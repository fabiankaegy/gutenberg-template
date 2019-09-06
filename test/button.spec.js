import {
	createNewPost,
	insertBlock,
	getEditedPostContent,
	visitAdminPage
} from "@wordpress/e2e-test-utils";

describe("Button can be inserted", () => {
	beforeEach(async () => {
		await visitAdminPage("/wp-admin");
		await createNewPost();
	});

	test("Can be added", async () => {
		await insertBlock("Button");
		expect(await getEditedPostContent()).toMatchSnapshot();
	});

	test("Can be added", async () => {
		await insertBlock("Example");
		expect(await getEditedPostContent()).toMatchSnapshot();
	});
});
