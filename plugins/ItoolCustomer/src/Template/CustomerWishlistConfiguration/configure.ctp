<?php
/** @var \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration $customerWishlistConfiguration */

echo $this->Html->css('Feeder.heroItemConf.css');

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Wishlist Hero Item Configuration') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($customerWishlistConfiguration, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('randomize')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('randomize', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('Quantity') ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('banner_products_factor', [
                                'type' => 'select',
                                'label' => false,
                                'class' => 'form-control',
                                'options' => [60 => 60, 120 => 120, 180 => 180]
                            ]) ?>
                        </div>
                    </div>
                    <div class="form-group widget-replaced">
                        <label class="col-sm-2 control-label"><?= __('Banner Small Positions') ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('banner_small_positions', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group widget-replaced">
                        <label class="col-sm-2 control-label"><?= __('Banner Large Positions') ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('banner_large_positions', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('Hero Item Positions') ?></label>
                        <div class="col-sm-10 hero-config-wrapper">
                            <div class="row">
                                <div class="col-md-12 user-tools">
                                    <select title="design-variants" id="design-variants">
                                        <option value="0">Desktop</option>
                                        <option value="1">Desktop-Small</option>
                                        <option value="2">Tablet-Large</option>
                                        <option value="3">Tablet</option>
                                        <option value="4">Mobile</option>
                                    </select>
                                    <div class="hero-type-select blue-hero selected-input"></div>
                                    <div class="hero-type-select yellow-hero unselected-input"></div>
                                </div>
                                <div class="small-triangle"></div>
                            </div>
                            <div class="row position-preview">
                                <div class="col-lg-5 col-md-6 col-sm-8 col-12 preview-wrapper">
                                    <div class="user-input desktop-layout"></div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper xl-preview">
                                    <div class="preview-description preview01-title">Desktop-Small</div>
                                    <div id="preview01" class="preview desktop-sm-layout"></div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper lg-preview">
                                    <div class="preview-description preview02-title">Tablet-Large</div>
                                    <div id="preview02" class="preview tablet-lg-layout"></div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper md-preview">
                                    <div class="preview-description preview03-title">Tablet</div>
                                    <div id="preview03" class="preview tablet-layout"></div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 preview-wrapper sm-preview">
                                    <div class="preview-description preview04-title">Mobile</div>
                                    <div id="preview04" class="preview mobile-layout"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script') ?>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            var smallHeroIdInput = $('#banner-small-positions'),
                largeHeroIdInput = $('#banner-large-positions'),
                largeSelector = $('.yellow-hero'),
                smallSelector = $('.blue-hero'),
                designSelector = $('#design-variants'),
                userInput = $('.user-input'),
                productFactorInput = $('#banner-products-factor'),
                layouts = ['desktop-layout', 'desktop-sm-layout', 'tablet-lg-layout', 'tablet-layout', 'mobile-layout'],
                positionPreview = $('.position-preview');

            /**
             * enables the hiding of the hero item position section
             */
            $('.small-triangle').click(function () {
                if(positionPreview.is(':visible')){
                    positionPreview.slideUp(500);
                    $(this).addClass('rotated');
                }else{
                    positionPreview.slideDown(500);
                    $(this).removeClass('rotated')
                }
            });

            /**
             * changes the appearance of the user input and the previews according to the selected layout
             */
            designSelector.change(function () {
                userInput.removeClass(layouts[activeLayout]);
                activeLayout = parseInt($(this).val());
                userInput.addClass(layouts[activeLayout]);
                var count = 1,
                    titleString;
                for(var i = 0; i < 5; i++){
                    if(i !== activeLayout){
                        $('#preview0' + count).attr('class', 'preview ' + layouts[i]);
                        switch(i){
                            case 0:
                                titleString = 'Desktop';
                                break;
                            case 1:
                                titleString = 'Desktop-Small';
                                break;
                            case 2:
                                titleString = 'Tablet-Large';
                                break;
                            case 3:
                                titleString = 'Tablet';
                                break;
                            case 4:
                                titleString = 'Mobile';
                                break;
                        }
                        $('.preview0' + count + '-title').html(titleString);
                        count++;
                    }
                }
            });

            /**
             * repopulates the inputs and previews if the user changes the product Factor
             */
            productFactorInput.change(function () {
                productFactor = parseInt(productFactorInput.val());
                removeArrayValues([smallHeroPositions, largeHeroPositions]);
                populateUserInput();
                populatePreview();
                updatePositionInputs();
            });

            /** how many selectable fields should be rendered */
            var productFactor;
            var databaseProductFactor = <?= json_encode($customerWishlistConfiguration->banner_products_factor) ?>;
            if(databaseProductFactor !== null){
                productFactor = databaseProductFactor;
            }else{
                productFactor = <?= json_encode($defaultProductsFactor) ?>;
            }
            /** 0 = single banner (blue) mode, 1 = double banner (yellow) mode */
            var heroMode = 0;
            /** the active layout for the user input that the user has selected */
            var activeLayout = 0;
            /** the arrays that hold the positional information for the hero banners */
            var smallHeroPositions;
            var largeHeroPositions;
            var databaseSmallPositions = <?= json_encode($customerWishlistConfiguration->banner_small_positions) ?>;
            var databaseLargePositions = <?= json_encode($customerWishlistConfiguration->banner_large_positions) ?>;

            if(databaseSmallPositions === null && databaseLargePositions === null){
                smallHeroPositions = JSON.parse("[" + <?= json_encode($defaultSmallBannerPos) ?> + "]");
                largeHeroPositions = JSON.parse("[" + <?= json_encode($defaultLargeBannerPos) ?> + "]");
            }else{
                smallHeroPositions = JSON.parse("[" + databaseSmallPositions + "]");
                largeHeroPositions = JSON.parse("[" + databaseLargePositions + "]");
            }

            /** manage the user input concerning the hero mode */
            smallSelector.click(function () {
                if(!$(this).hasClass('selected-input')){
                    $(this).addClass('selected-input').removeClass('unselected-input');
                    largeSelector.removeClass('selected-input').addClass('unselected-input');
                    heroMode = 0;
                    checkSelectable()
                }
            });
            largeSelector.click(function () {
                if(!$(this).hasClass('selected-input')){
                    $(this).addClass('selected-input').removeClass('unselected-input');
                    smallSelector.removeClass('selected-input').addClass('unselected-input');
                    heroMode = 1;
                    checkSelectable()
                }
            });

            /**
             * populates the user input section with divs the user can click on
             */
            function populateUserInput(){
                userInput.html('');
                for(var i = 0; i < productFactor; i++){
                    if(smallHeroPositions.indexOf(i) > -1){
                        userInput.append('<div id="sel-' + i + '" class="selector blue-selected">' + (i + 1) + '</div>');
                    }else if(largeHeroPositions.indexOf(i) > -1){
                        userInput.append('<div id="sel-' + i + '" class="selector yellow-selected">' + (i + 1) + '</div>');
                        i++;
                        userInput.append('<div id="sel-' + i + '" class="selector yellow-selected yellow-follow">' + (i + 1) + '</div>');
                    }else{
                        userInput.append('<div id="sel-' + i + '" class="selector">' + (i + 1) + '</div>')
                    }
                }
                checkSelectable();
            }

            /**
             * populates the smaller preview containers next to the user input
             */
            function populatePreview(){
                $.each([$('#preview01'), $('#preview02'), $('#preview03'), $('#preview04')], function (key, val) {
                    $(val).html('');
                });
                var previewContainer;
                for(var i = 1; i <= 4; i++){
                    previewContainer = $('#preview0' + i);
                    for(var j = 0; j < productFactor; j++){
                        if(smallHeroPositions.indexOf(j) > -1){
                            previewContainer.append('<div class="preview-selector blue-selected">' + (j + 1) + '</div>');
                        }else if(largeHeroPositions.indexOf(j) > -1){
                            previewContainer.append('<div class="preview-selector yellow-selected">' + (j + 1) + '</div>');
                            j++;
                            previewContainer.append('<div class="preview-selector yellow-selected">' + (j + 1) + '</div>');
                        }else{
                            previewContainer.append('<div class="preview-selector">' + (j + 1) + '</div>')
                        }
                    }
                }
            }

            populateUserInput();
            populatePreview();

            /**
             * checks if a field is selectable as hero field, depending on heroMode.
             */
            function checkSelectable(){
                if(heroMode === 1){
                    $('.selector').each(function (index) {
                        $(this).removeClass('selectable');
                        index++;
                        if(index % 2 !== 0 && index % 3 !== 0 && index % 4 !== 0 && index % 5 !== 0 && index % 6 !== 0 && index !== productFactor){
                            $(this).addClass("selectable");
                        }
                    })
                }else{
                    $('.selector').each(function () {
                        $(this).addClass('selectable');
                    })
                }
            }

            /**
             * enables selection of selectable elements by clicking on them.
             */
            userInput.on('click', '.selector', function () {
                var id = parseInt($(this).attr('id').replace('sel-', ''));
                clickAssignSelectorClass(this, id);
                updatePreview();
            });

            /**
             * updated the preview displays when the banner selection is updated by the user
             */
            function updatePreview(){
                var previews = $('.preview');
                $.each(previews, function(index, previewItem){
                    var preview = $(previewItem);
                    $.each(preview.children(), function (index, selectorItem) {
                        var selector = $(selectorItem);
                        selector.removeClass('blue-selected yellow-selected');
                        if(smallHeroPositions.indexOf(index) > -1){
                            selector.addClass('blue-selected');
                        }else if(largeHeroPositions.indexOf(index) > -1 || largeHeroPositions.indexOf(index - 1) > -1){
                            selector.addClass('yellow-selected');
                        }
                    })
                });
            }

            /**
             * assigns and removes the correct css-classes if the user clicks on a selector
             * @param selector
             * @param id
             */
            function clickAssignSelectorClass(selector, id){
                if($(selector).hasClass('selectable')){
                    if(heroMode === 0){
                        if($(selector).hasClass('yellow-selected')){
                            $(selector).removeClass('yellow-selected');
                            if($(selector).hasClass('yellow-follow')){
                                $(selector).removeClass('yellow-follow');
                                $('#sel-' + (id - 1)).removeClass('yellow-selected');
                                manageHeroArrays(false, id - 1, true);
                            }else{
                                $('#sel-' + (id + 1)).removeClass('yellow-selected yellow-follow');
                                manageHeroArrays(false, id, true);
                            }
                        }
                        if($(selector).hasClass('blue-selected')){
                            $(selector).removeClass('blue-selected');
                            manageHeroArrays(true, id, true);
                        }else{
                            $(selector).addClass('blue-selected');
                            manageHeroArrays(true, id, false);
                        }
                    }else{
                        if($(selector).hasClass('yellow-selected')){
                            $(selector).removeClass('yellow-selected');
                            if($(selector).hasClass('yellow-follow')){
                                $(selector).removeClass('yellow-follow');
                                $('#sel-' + (id - 1)).removeClass('yellow-selected');
                                manageHeroArrays(true, id - 1, true);
                            }else{
                                $('#sel-' + (id + 1)).removeClass('yellow-selected yellow-follow');
                                manageHeroArrays(false, id, true);
                            }
                        }else{
                            if($(selector).hasClass('blue-selected')){
                                $(selector).removeClass('blue-selected');
                                manageHeroArrays(true, id, true);
                            }
                            $(selector).addClass('yellow-selected');
                            $('#sel-' + (id + 1)).addClass('yellow-selected yellow-follow');
                            manageHeroArrays(false, id, false);

                            if($('#sel-' + (id + 1)).hasClass('blue-selected')){
                                $('#sel-' + (id + 1)).removeClass('blue-selected');
                                manageHeroArrays(true, id + 1, true);
                            }
                        }
                    }
                }
            }

            /**
             * adds and removes ids from the hero Arrays and updates the values of the database input fields.
             * @param smallArray
             * @param id
             * @param remove
             */
            function manageHeroArrays(smallArray, id, remove){
                var array = smallArray ? smallHeroPositions : largeHeroPositions;
                if(remove){
                    array.splice(array.indexOf(id), 1);
                }else{
                    array.push(id);
                    array.sort(function(a,b){return a-b});
                }
                updatePositionInputs();
            }

            /**
             * removes values from the position arrays if they are bigger than the product Factor.
             */
            function removeArrayValues(arrays){
                for(var h = 0; h < 2; h++){
                    var array = arrays[h];
                    for(var i = 0; i < array.length; i++){
                        if(array[i] >= productFactor){
                            array.splice(i, 1);
                        }
                    }
                }
            }

            /**
             * updates the form inputs for the hero banner positions if they are changed
             */
            function updatePositionInputs(){
                smallHeroIdInput.val(smallHeroPositions.toString());
                largeHeroIdInput.val(largeHeroPositions.toString());
            }
        });
    </script>
<?php $this->end() ?>
