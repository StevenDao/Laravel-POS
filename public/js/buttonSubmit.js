function buttonSubmit(element, action) {
	if (confirm('Are you sure you want to ' + action + ' this product?')) {
		element.closest('form').submit();
	}
}