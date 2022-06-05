$(function() {
	// Core Product ID
	var coreProductId = $('#coreProductId').val();

	// Selected marketplace ID
	var selectedMarketplaceId = $('#marketplaceSelector option:selected').val();

	// Variation: selected variations
	$.ajax({
		type: 'post',
		url: '/core_products/getCurrentVariations/' + coreProductId + '/' + selectedMarketplaceId,
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			$.blockUI({
				message: 'Loading current variations',
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

			$('#current-variations').html('');
		},
		success: function(res) {
			$('#current-variations').html(res);
			$.unblockUI();
		}
	});

	// Variation: selected variations pagination
	$(document).on('click', '.selected-variations-paginator a', function () {
		var thisHref = $(this).attr('href');
		if (!thisHref) {
			return false;
		}
		$('#selected-variations-pagination-container').fadeTo(300, 0);
		$('#selected-variations-pagination-container').load(thisHref, function() {
			$(this).fadeTo(200, 1);
		});
		return false;
	});

	// Variation: selected variations SKU search
	$(document).on('click', '#selectedVariationsAjaxSearch', function(e, sku) {
		e.preventDefault();

		var sku = '';
		if($('#selectedVariationsSearchValue').val()) {
			sku = $('#selectedVariationsSearchValue').val();
		}

		$.ajax({
			type: 'post',
			url: '/core_products/getCurrentVariations/' + coreProductId + '/' + selectedMarketplaceId + '/' + sku,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-variations').html('');
			},
			success: function(res) {
				$('#current-variations').html(res);
			}
		});
	});

	// Variation: table
	$.ajax({
		type: 'post',
		url: '/core_products/ajaxVariationIndex/' + coreProductId + '/' + selectedMarketplaceId,
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			$.blockUI({
				message: 'Loading possible variations',
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

			$('#available-products').html('');
		},
		success: function(res) {
			$('#available-products').html(res);
			$.unblockUI();
		}
	});

	// Variation: pagination
	$(document).on('click', '.paginator a, #paginator-sort a', function () {
		var thisHref = $(this).attr('href');
		if (!thisHref) {
			return false;
		}
		$('#pagination-container').fadeTo(300, 0);
		$('#pagination-container').load(thisHref, function() {
			$(this).fadeTo(200, 1);
		});
		return false;
	});

	// Variation: SKU search
	$(document).on('click', '#ajaxSearch', function(e, sku) {
		e.preventDefault();

		var sku = '';
		if($('#searchValue').val()) {
			sku = $('#searchValue').val();
		}

		$.ajax({
			type: 'post',
			url: '/core_products/ajaxVariationIndex/' + coreProductId + '/' + selectedMarketplaceId + '/' + sku,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#available-products').html('');
			},
			success: function(res) {
				$('#available-products').html(res);
			}
		});
	});

	// Variation: Add new variation
	$(document).on('click', '#addVariation', function(e) {
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
		if($('#searchValue').val()) {
			sku = $('#searchValue').val();
		}

		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-variations').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_products/getCurrentVariations/' + coreProductId + '/' + selectedMarketplaceId,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-variations').html('');
					},
					success: function(res) {
						$('#current-variations').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_products/ajaxVariationIndex/' + coreProductId + '/' + selectedMarketplaceId + '/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#available-products').html('');
					},
					success: function(res) {
						$('#available-products').html(res);
						$.unblockUI();
					}
				});
			}
		});
	});

	// Variation: Remove variation
	$(document).on('click', '#removeVariation', function(e) {
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
		if($('#searchValue').val()) {
			sku = $('#searchValue').val();
		}

		$.ajax({
			type: 'post',
			url: this.href,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				$('#current-variations').html('');
			},
			success: function(res) {
				$.ajax({
					type: 'post',
					url: '/core_products/getCurrentVariations/' + coreProductId + '/' + selectedMarketplaceId,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#current-variations').html('');
					},
					success: function(res) {
						$('#current-variations').html(res);
					}
				});

				$.ajax({
					type: 'post',
					url: '/core_products/ajaxVariationIndex/' + coreProductId + '/' + selectedMarketplaceId + '/' + sku,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						$('#available-products').html('');
					},
					success: function(res) {
						$('#available-products').html(res);
						$.unblockUI();
					}
				});
			}
		});
	});
});