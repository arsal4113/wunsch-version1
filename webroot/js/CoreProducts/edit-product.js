$(function() {
	// Core Product ID
	var coreProductId = $('#coreProductId').val();	
	
	// Change marketplace
	$('#marketplaceSelector').change(function() {
		window.location = '/core_products/edit/' + coreProductId + '/' + $(':selected',this).val()
	});
	
	// Selected marketplace ID
	var selectedMarketplaceId = $('#marketplaceSelector option:selected').val();
});