$(function() {
	// Core Product ID
	var coreProductId = $('#coreProductId').val();	
	
	// Selected marketplace ID
	var selectedMarketplaceId = $('#marketplaceSelector option:selected').val();
	
	// Up-Selling: selected products
	$.ajax({
		type: 'post',
		url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			$('#current-us-products').html('');
		},
		success: function(res) {
			$('#current-us-products').html(res);
		}
	});
	
	// Up-Selling: table
	$.ajax({
		type: 'post',
		url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			$('#us-linkable-products').html('');
		},
		success: function(res) {
			$('#us-linkable-products').html(res);
		}
	});	
	
	// Up-Selling: pagination
	$(document).on('click', '.up-selling-paginator a, #up-selling-paginator-sort a', function () {
		var thisHref = $(this).attr('href');
		if (!thisHref) {
			return false;
		}
		$('#up-selling-pagination-container').fadeTo(300, 0);
		$('#up-selling-pagination-container').load(thisHref, function() {
			$(this).fadeTo(200, 1);
		});
		return false;
	});	
	
	// Up-Selling: SKU search
	$(document).on('click', '#up-selling-ajax-search', function(e, sku) {
		e.preventDefault();
		
		var sku = '';
		if($('#up-selling-search-value').val()) {
		    sku = $('#up-selling-search-value').val();
		}	
		
		$.ajax({
			type: 'post',
			url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling/' + sku,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#us-linkable-products').html('');
			},
			success: function(res) {
				$('#us-linkable-products').html(res);
			}
		});
	});
	
	// Up-Selling: Add new us product	
	$(document).on('click', '#add-up-selling-product', function(e) {
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
		if($('#up-selling-search-value').val()) {
		    sku = $('#up-selling-search-value').val();
		}		
		
		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-us-products').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-us-products').html('');
					},
					success: function(res) {
						$('#current-us-products').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#us-linkable-products').html('');
					},
					success: function(res) {
						$('#us-linkable-products').html(res);
						$.unblockUI();
					}
				});
			}
		});		
	});
	
	// Up-Selling: Remove linked product	
	$(document).on('click', '#remove-up-selling-product', function(e) {
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
		if($('#up-selling-search-value').val()) {
		    sku = $('#up-selling-search-value').val();
		}			
		
		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-us-products').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_product_links/getLinkedProducts/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-us-products').html('');
					},
					success: function(res) {
						$('#current-us-products').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_product_links/ajaxLinkedProductsIndex/' + coreProductId + '/' + selectedMarketplaceId + '/up_selling/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#us-linkable-products').html('');
					},
					success: function(res) {
						$('#us-linkable-products').html(res);
						$.unblockUI();
					}
				});
			}
		});		
	});		
});