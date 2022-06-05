$(function() {
	// Multiple values attributes
	$('a[id^="addMore"]').click(function() {
		var counter = $(this).data('counter');
	    counter += 1;

	    if($(this).data('attributeType') == 'image') {
	    	$($(this).data('appendClass')).append(
    	    	'<div class="form-group" id="position-' + counter + '">' +
    	    	    '<label class="col-sm-2 control-label"><label for="product-picture">New ' + $(this).data('attributeName') + '</label></label>' +
    	    	    '<div class="col-sm-3">' +
    	    	        '<div class="input text"><input type="text" placeholder="URL..." id="' + $(this).data('attributeId') + '-' + counter + '-value' + '" class="form-control" name="' + $(this).data('attributeCode') + '[' + counter + '][value]' + '"></div>' +
    	    	    '</div>' +
					'<div class="col-sm-3">' +
						'<input type="file" id="' + $(this).data('attributeId') + '-' + counter + '-file' + '" name="' + $(this).data('attributeCode') + '[' + counter + '][file]' + '">' +
					'</div>' +
            		'<label class="col-sm-1 control-label" style="text-align: right !important;"><i class="fa fa-sort"></i></label>' +
            		'<div class="col-sm-1">' +
            	        '<div class="input text"><input type="text" id="' + $(this).data('attributeId') + '-' + counter + '-sort-order' + '" class="form-control" name="' + $(this).data('attributeCode') + '[' + counter + '][sort_order]"></div>' +
            	    '</div>' +
                    '<div class="col-sm-1">' +
                    '</div>' +
                    '<div class="col-sm-1">' +
                        '<a href="#" id="remove-position-' + counter + '" position="' + counter +'" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>' +
                    '</div>' +
            	'</div>'
	    	);
	    } else {
	    	$($(this).data('appendClass')).append(
    	    	'<div class="form-group">' +
    	    	    '<label class="col-sm-2 control-label"><label for="test-attribute">New ' + $(this).data('attributeName') + '</label></label>' +
        	        '<div class="col-sm-10">' +
            		    '<div class="input text"><input type="text" id="' + $(this).data('attributeId') + '-' + counter + '" class="form-control" name="' + $(this).data('attributeCode') + '[' + counter + ']' + '"></div>' + 
            		'</div>' +                            		
            	'</div>'
	    	);
	    }
        $(this).data('counter', counter);
	});
});

$(function(){
    $('[id^=remove-position-]').click(function() {
        var position = $(this).attr('position');
        console.log(position);
        $("#position-" + position).remove();
    });
});
