function deleteProduct(element) {
    if (confirm('Are you sure you want to delete this product?')) {
        element.parent().submit();
    }
}