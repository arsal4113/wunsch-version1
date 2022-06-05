$(function() {
	// Core Product ID
	var coreProductId = $('#coreProductId').val();	
	
	// Selected marketplace ID
	var selectedMarketplaceId = $('#marketplaceSelector option:selected').val();
	
	// Cross-Selling: selected products
	$.ajax({
		type: 'post',
		url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			$('#current-cs-products').html('');
		},
		success: function(res) {
			$('#current-cs-products').html(res);
		}
	});
	
	// Cross-Selling: table
	$.ajax({
		type: 'post',
		url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			$('#cs-linkable-products').html('');
		},
		success: function(res) {
			$('#cs-linkable-products').html(res);
		}
	});	
	
	// Cross-Selling: pagination
	$(document).on('click', '.cross-selling-paginator a, #cross-selling-paginator-sort a', function () {
		var thisHref = $(this).attr('href');
		if (!thisHref) {
			return false;
		}
		$('#cross-selling-pagination-container').fadeTo(300, 0);
		$('#cross-selling-pagination-container').load(thisHref, function() {
			$(this).fadeTo(200, 1);
		});
		return false;
	});	
	
	// Cross-Selling: SKU search
	$(document).on('click', '#cross-selling-ajax-search', function(e, sku) {
		e.preventDefault();
		
		var sku = '';
		if($('#cross-selling-search-value').val()) {
		    sku = $('#cross-selling-search-value').val();
		}	
		
		$.ajax({
			type: 'post',
			url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling/' + sku,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#cs-linkable-products').html('');
			},
			success: function(res) {
				$('#cs-linkable-products').html(res);
			}
		});
	});
	
	// Cross-Selling: Add new cs product	
	$(document).on('click', '#add-cross-selling-product', function(e) {
		e.preventDefault();
		
        $.blockUI({ 
        	message: 'Loading', 
        	css: { 
        		border: 'none', 
        		padding: '15px', 
        		backgroundColor: '#000', 
        		'-webkit-border-radius': '10px', 
        		'-moz-border-radius': '10px', 
        		opacity: .5, 
        		color: '#fff',
        		'z-index': 9999
        	},
	        overlayCSS: { 
	            'z-index': '9999' 
	        }        	
        });	
        
		var sku = '';
		if($('#cross-selling-search-value').val()) {
		    sku = $('#cross-selling-search-value').val();
		}		
		
		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-cs-products').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-cs-products').html('');
					},
					success: function(res) {
						$('#current-cs-products').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#cs-linkable-products').html('');
					},
					success: function(res) {
						$('#cs-linkable-products').html(res);
						$.unblockUI();
					}
				});
			}
		});		
	});
	
	// Cross-Selling: Remove linked product	
	$(document).on('click', '#remove-cross-selling-product', function(e) {
		e.preventDefault();
		
        $.blockUI({ 
        	message: 'Loading', 
        	css: { 
        		border: 'none', 
        		padding: '15px', 
        		backgroundColor: '#000', 
        		'-webkit-border-radius': '10px', 
        		'-moz-border-radius': '10px', 
        		opacity: .5, 
        		color: '#fff'
        	},
	        overlayCSS: { 
	            'z-index': '9999' 
	        }
        });			
		
		var sku = '';
		if($('#cross-selling-search-value').val()) {
		    sku = $('#cross-selling-search-value').val();
		}			
		
		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-cs-products').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-cs-products').html('');
					},
					success: function(res) {
						$('#current-cs-products').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/cross_selling/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#cs-linkable-products').html('');
					},
					success: function(res) {
						$('#cs-linkable-products').html(res);
						$.unblockUI();
					}
				});
			}
		});		
	});		
});