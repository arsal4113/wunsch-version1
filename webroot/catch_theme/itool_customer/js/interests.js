(function ($) {
    $(function () {
        let subcategoryIds = [];
        $(window).on('scroll', function() {
            if ($('#footer').hasClass('shown')) {
                $('#button-container').addClass('footer-shown');
            } else {
                $('#button-container').removeClass('footer-shown');
            }
        });
        $(document).ready(function() {
            checkSelection();
        });
        $('.select-link').on('click', function (e) {
            e.preventDefault();
            var selectLink = $(this),
                box = selectLink.closest($('.box-content-container'));
            if (selectLink.hasClass('select-all')) {
                selectLink.removeClass('select-all');
                selectLink.html(window.unselectText);
                box.find($('.sub-category')).addClass('selected');
            } else {
                selectLink.addClass('select-all');
                selectLink.html(window.selectText);
                box.find($('.sub-category')).removeClass('selected');
            }
            checkSelection();
        });
        $('.sub-category').on('click', function () {
            var subCategory = $(this),
                subcategoryId = parseInt(subCategory.attr('data-catid'));

            if (subCategory.hasClass('selected')) {
                subcategoryIds.splice(subcategoryIds.indexOf(subcategoryId), 1);
                subCategory.removeClass('selected');
            } else {
                subcategoryIds.push(subcategoryId);
                subCategory.addClass('selected');
            }

            subcategoryIds.sort((a, b) => a - b);
            checkSelection();
        });
        function checkSelection() {
            if ($('.sub-category').hasClass('selected')) {
                $('.submit-button').removeClass('disabled');
            } else {
                $('.submit-button').addClass('disabled');
            }
        }
        $('form#interestForm').on('submit', function (e) {
            var selected = {},
                selectedItems = $('.selected');

            $.each(selectedItems, function (i, el) {
                if(selected[$(el).attr('data-catid')] === undefined){
                    selected[$(el).attr('data-catid')] = [$(el).parent().attr('data-parentid')];
                }else{
                    selected[$(el).attr('data-catid')].push($(el).parent().attr('data-parentid'));
                }
            });
            $('#subcategory_ids').val(JSON.stringify(selected));
            if (!selectedItems.length) {
                e.preventDefault();
            }
        });
        
        $('.interest-header .submit-button').click(function () {

            let browseRow = $('.browse-row'),
                elements = browseRow.find('.browse-col'),
                elements_amount = elements.length,
                randomArray = getRandomCounterArray(elements_amount);

            browseRow.fadeOut(200, function () {
                elements.each(function (index) {
                    $(this).before(elements[randomArray[index]]);
                });
            }).fadeIn(300);
            
            pushEcommerce('newSetOfProductsLoaded', elements_amount);
        });
        
        $('.button-wrapper #load-more-button').click(function () {
        	let browseRow = $('.browse-row'),
	            elements = browseRow.find('.browse-col'),
	            elements_amount = elements.length;
        	pushEcommerce('newSetOfProductsLoaded', elements_amount);
        });

        function getRandomCounterArray(length){
            let numberArray = [];
            for(let i = 0; i < length; i++){
                numberArray.push(i);
            }
            for(let j, x, i = length; i; j = parseInt(Math.random() * i), x = numberArray[--i], numberArray[i] = numberArray[j], numberArray[j] = x);

            return numberArray;
        }
    });
})(jQuery);
