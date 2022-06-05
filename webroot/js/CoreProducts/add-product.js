$(function() {
	$('#marketplaceSelector').change(function() {
		window.location = '/core_products/add/' + $(':selected',this).val()
	});

	var selectedMarketplaceId = $('#marketplaceSelector option:selected').val();

	$('#configurable-attributes').hide();
	$('#productTypeSelector').change(function() {
		if($(':selected',this).val() == 2) {
			$('#parent-sku').hide();
			$('#configurable-attributes').show();

			if($('#attribute-set-selector option:selected').val()) {
			    $.getJSON("/core_products/getConfigurableAttributes/" + selectedMarketplaceId + "/" + $('#attribute-set-selector option:selected').val(), function(result) {
			    	$('#core-configurable-attributes-ids').empty();
			    	$.each(result, function(key, value) {
			    	    $('#core-configurable-attributes-ids').append($("<option />").val(key).text(value));
			    	});
				});
			} else {
				$('#core-configurable-attributes-ids').empty();
			}		
		} else {
			$('#parent-sku').show();
			$('#configurable-attributes').hide();
			$('#core-configurable-attributes-ids').empty();
		}
	});

	$('#attribute-set-selector').change(function() {
		if($(':selected',this).val()) {
		    $.getJSON("/core_products/getConfigurableAttributes/" + selectedMarketplaceId + "/" + $(':selected',this).val(), function(result) {
		    	$('#core-configurable-attributes-ids').empty();
		    	$.each(result, function(key, value) {
		    	    $('#core-configurable-attributes-ids').append($("<option />").val(key).text(value));
		    	});
			});
		} else {
			$('#core-configurable-attributes-ids').empty();
		}
	});
});