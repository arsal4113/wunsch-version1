<?php

use Feeder\Model\Table\FeederPillarPagesTable;

?>
<?= $this->Html->css('Feeder.pillarPages.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Pillar Page') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Pillar Pages'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($feederPillarPage, ['class' => 'form-horizontal style-form', 'id' => 'pillar-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_tag', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url_path')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url_path', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('meta_description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('meta_tag', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('guide_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('guide_image', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('guide_headline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('guide_headline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('robots_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('robots_tag', [
                                'label' => false,
                                'class' => 'form-control',
                                'options' => [
                                    'index, follow' => 'index, follow',
                                    'noindex, follow' => 'noindex, follow',
                                    'noindex, nofollow' => 'noindex, nofollow',
                                    'noindex' => 'noindex'
                                ],
                                'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="submenu">
                        <div class="submenu-content">
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 col-sm-2 control-label"><?= __('Facebook Og Url') ?></label>
                                        <div class="col-md-8 col-sm-10">
                                            <?= $this->Form->input('facebook_og_url', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= __('Facebook Og Image') ?></label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('facebook_og_image', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 col-sm-2 control-label"><?= __('Facebook Og Title') ?></label>
                                        <div class="col-md-8 col-sm-10">
                                            <?= $this->Form->input('facebook_og_title', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= __('Facebook Og Description') ?></label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('facebook_og_description', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('block_configuration')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('block_configuration', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2" id="block-overview"></div>
                    </div>
                    <div class="form-group select-wrapper">
                        <label class="col-sm-2 block-title control-label">Design</label>
                        <div class="col-sm-10">
                            <select id="design-select" class="form-control">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2a">2a</option>
                                <option value="2b">2b</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <!--<option value="4b">4b</option>-->
                                <option value="5">5</option>
                                <!--<option value="5b">5b</option>-->
                                <!--<option value="5c">5c</option>-->
                                <option value="6a">6a</option>
                                <option value="6b">6b</option>
                                <!--<option value="7a">7a</option>-->
                                <!--<option value="7b">7b</option>-->
                                <!--<option value="8">8</option>-->
                                <!--<option value="9">9</option>-->
                                <!--<option value="10a">10a</option>-->
                                <!--<option value="10b">10b</option>-->
                                <!--<option value="11a">11a</option>-->
                                <!--<option value="11b">11b</option>-->
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                            </select>
                        </div>
                    </div>
                    <div id="input-wrapper"></div>
                    <div style="display: none;" class="form-group second-select-wrapper">
                        <label class="col-sm-2 block-title control-label">Second Block Design</label>
                        <div class="col-sm-10">
                            <select id="second-design-select" class="form-control">
                                <option value=""></option>
                                <option value="2a">2a</option>
                                <option value="2b">2b</option>
                                <option value="6a">6a</option>
                                <option value="6b">6b</option>
                                <!--<option value="7a">7a</option>-->
                                <!--<option value="7b">7b</option>-->
                                <!--<option value="10a">10a</option>-->
                                <!--<option value="10b">10b</option>-->
                                <!--<option value="11a">11a</option>-->
                                <!--<option value="11b">11b</option>-->
                            </select>
                        </div>
                    </div>
                    <div id="second-input-wrapper"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2 add-block-button-wrapper">
                            <div style="display: none;" id="loader"></div>
                            <div id="add-block" class="disabled"><?= __('Add Block') ?></div>
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
            radioClass: 'iradio_square-green'
        });

        const design1 = [titleInput, textInput, colorInput, buttonTextInput, buttonLinkInput, firstImageInput],
            design2a = [categoryIdInput],
            design2b = [titleInput, textInput],
            design3 = [backgroundImageInput, backgroundColorInput, firstChildInput, "addChildButtonFlag"],
            design4 = [titleInput, subtitleInput, textInput, buttonTextInput, buttonLinkInput, firstImageInput],
            design4b = [titleInput, subtitleInput, textInput, secondTextInput, buttonTextInput, buttonLinkInput],
            design5 = [titleInput, textInput, subtitleInput, itemInput],
            design5b = [titleInput, itemInput],
            design5c = [titleInput, itemInput],
            design6a = [itemInput],
            design6b = [titleInput, textInput],
            design7a = [titleInput, textInput, listElementsInput],
            design7b = [firstImageInput, colorInput, hashtagInput],
            design8 = [titleInput, itemInput],
            design9 = [titleInput, textInput, firstImageInput, firstChildInput, "addChildButtonFlag"],
            design10a = [titleInput, textInput, colorInput, itemInput],
            design10b = [titleInput, textInput],
            design11a = [],             // TODO
            design11b = [],             // TODO
            design12 = [titleInput, videoInput],
            design13 = [titleInput, titleSecondRowInput, colorInput, textBackgroundColorInput, buttonTextInput,  buttonTextColorInput, buttonBackgroundColorInput, buttonLinkInput, firstImageInput],
            design14 = [titleInput, subtitleInput, textInput, buttonTextInput, buttonLinkInput],
            siblingDesigns = ['2a', '2b', '6a', '6b', '7a', '7b', '10a', '10b', '11a', '11b'];

        let blockCount = 0,
            firstChildCount = 1,
            secondChildCount = 1,
            designConfig = [],
            loader = $('#loader'),
            addBlockButton = $('#add-block'),
            selectedBlock = undefined,
            unsavedChanges = false,
            imageUploadUrl = "<?= $this->Url->build([
                'controller' => 'FeederPillarPages',
                'action' => 'uploadImage',
                'plugin' => 'Feeder'
            ]) ?>";

        if($('#block-configuration').val() !== ""){
            designConfig = JSON.parse($('#block-configuration').val());
            renderBlock();
        }

        $('#design-select, #second-design-select').change(function () {
            handleDesignChange($(this));
        });

        function handleDesignChange(selector){
            let inputWrapper,
                design = getDesign(selector.val());

            if(selector.attr('id') === 'design-select' || selectedBlock){
                inputWrapper = $('#input-wrapper');
                firstChildCount = 1;

                if(siblingDesigns.includes(selector.val()) && !selectedBlock){
                    $('.second-select-wrapper').show();
                }else{
                    $('.second-select-wrapper').hide();
                    $('#second-design-select').val("");
                    $('#second-input-wrapper').empty();
                }
            }else{
                inputWrapper = $('#second-input-wrapper');
            }

            if(selector.val() !== ""){
                selector.parent().find('.error').remove();
                if(siblingDesigns.includes(selector.val()) && !selectedBlock){
                    if($('#design-select').val() !== "" && $('#second-design-select').val() !== ""){
                        addBlockButton.removeClass("disabled");
                    }else{
                        addBlockButton.addClass("disabled");
                    }
                }else{
                    addBlockButton.removeClass("disabled");
                }
            }else{
                addBlockButton.addClass("disabled");
            }

            buildInputs(design, inputWrapper);
        }

        addBlockButton.click(function () {
            if($(this).hasClass('disabled')){
                if($('#design-select').val() === ""){
                    handleError({'type': 404, 'message': 'Please select a design!', 'input': $('#design-select')});
                }else{
                    handleError({'type': 404, 'message': 'Please select a design!', 'input': $('#second-design-select')});
                }
            }else {
                unsavedChanges = false;
                blockCount++;
                let firstInputs = $('#input-wrapper').find('input.single-input, textarea.single-input, select.single-input'),
                    designId = $('#design-select').val(),
                    designObject = {},
                    self = $(this),
                    imageInput = undefined;

                /** handle sibling designs */
                if(siblingDesigns.includes(designId)){
                    if($('#second-design-select').val() === "" && selectedBlock === undefined){
                        handleError({'type': 404, 'message': 'Please select a sibling design!', 'input': $('#second-design-select')});
                        return;
                    }else{
                        blockCount++;
                        if(selectedBlock !== undefined){
                            designObject['hasSibling'] = designConfig[selectedBlock.attr('data-id')]['hasSibling'];
                        }else{
                            designObject['hasSibling'] = 'next';
                        }
                    }
                }else{
                    designObject['hasSibling'] = false;
                }

                /** add design info to design object */
                designObject['designId'] = designId;
                firstInputs.each(function () {
                    if($(this).hasClass('image-input')){
                        if($(this).val() === "" && $(this).hasClass('not-mandatory')){
                            return
                        }
                        imageInput = $(this);
                        return;
                    }
                    let inputVal = $(this).val();
                    if (!inputVal) {
                        return;
                    }
                    if($(this).hasClass('color-input')){
                        if(inputVal.indexOf('#') === -1){
                            inputVal = '#' + inputVal;
                        }
                    }else if($(this).hasClass('category-ids')){
                        inputVal = inputVal.toString();
                    }else if($(this).hasClass('top-seller-ids')){
                        inputVal = inputVal.join(';');
                    }
                    designObject[$(this).attr('data-input')] = inputVal;
                });

                /** handle designs with possible children (3 & 9) */
                if(designId === "3" || designId === "9"){
                    let childArray = [],
                        childWrappers = $('#input-wrapper').find('.child-wrapper');

                    childWrappers.each(function () {
                        let childInputs = $(this).find('input.multi-input, textarea.multi-input'),
                            childObject = {};
                        childInputs.each(function () {
                            childObject[$(this).attr('data-input')] = $(this).val();
                        });
                        childArray.push(childObject);
                    });
                    designObject['children'] = childArray;
                }
                /** upload images, add the final designObject to design collection and update the presentation of them */
                if(imageInput){
                    if(selectedBlock && imageInput.val() === ""){
                        if(self.hasClass('update')){
                            designObject['imageUrl'] = designConfig[selectedBlock.attr('data-id')]['imageUrl'];
                            designConfig[selectedBlock.attr('data-id')] = designObject;
                            renderBlock();
                            updateFeedback(self);
                        }else{
                            handleError({'type': 404, 'message': 'Please select an Image!', 'input': imageInput});
                        }
                    }else{
                        loader.show();
                        addBlockButton.hide();
                        uploadImage(imageInput[0])
                            .then(function(data){
                                designObject['imageUrl'] = data;
                                let key = undefined,
                                    update = false;
                                if(self.hasClass('update')){
                                    designConfig[selectedBlock.attr('data-id')] = designObject;
                                    update = true;
                                }else{
                                    key = designConfig.push(designObject) - 1;
                                }
                                if(designObject['hasSibling'] && !update){
                                    handleSecondBlock(key);
                                }else{
                                    loader.hide();
                                    addBlockButton.show();
                                    renderBlock();
                                    updateFeedback(self);
                                }
                            })
                            .catch(function (data) {
                                handleError(data);
                                loader.hide();
                                addBlockButton.show();
                            });
                    }
                }else{
                    if(self.hasClass('update')){
                        designConfig[selectedBlock.attr('data-id')] = designObject;
                    }else{
                        designConfig.push(designObject);
                    }
                    updateFeedback(self);
                    if(designObject['hasSibling'] && !self.hasClass('update')){
                        handleSecondBlock();
                    }else{
                        renderBlock();
                    }
                }
            }
        });

        function updateFeedback(button){
            if(button.html() === "Update Block"){
                button.html("Updated!");
            }else{
                button.html("Added!");
            }
            setTimeout(function(){
                if(button.html() === "Updated!" || button.html() === "Update Block"){
                    button.html("Update Block");
                }else{
                    button.html("Add Block");
                }
            }, 2000);
        }

        function handleSecondBlock(siblingKey){
            let secondDesignObject = {},
                secondInputs = $('#second-input-wrapper').find('input.single-input, textarea.single-input, select.single-input'),
                secondDesignId = $('#second-design-select').val(),
                imageInput = undefined;

            secondDesignObject['hasSibling'] = 'previous';
            secondDesignObject['designId'] = secondDesignId;
            secondInputs.each(function () {
                if($(this).hasClass('image-input')){
                    imageInput = $(this);
                    return;
                }
                let inputVal = $(this).val();
                if (!inputVal) {
                    return;
                }
                if($(this).hasClass('color-input')){
                    if(inputVal.indexOf('#') === -1){
                        inputVal = '#' + inputVal;
                    }
                }else if($(this).hasClass('category-ids')){
                    inputVal = inputVal.toString();
                }else if($(this).hasClass('top-seller-ids')){
                    inputVal = inputVal.join(';');
                }
                secondDesignObject[$(this).attr('data-input')] = inputVal;
            });
            if(imageInput){
                loader.show();
                addBlockButton.hide();
                uploadImage(imageInput[0])
                    .then(function(data){
                        secondDesignObject['imageUrl'] = data;
                        designConfig.push(secondDesignObject);
                        loader.hide();
                        addBlockButton.show();
                        renderBlock();
                    })
                    .catch(function (data) {
                        handleError(data);
                        designConfig.splice(siblingKey, 1);
                        loader.hide();
                        addBlockButton.show();
                    });
            }else{
                designConfig.push(secondDesignObject);
                loader.hide();
                addBlockButton.show();
                renderBlock();
            }
        }

        function handleError(error){
            console.log(error);
            if(error.type === 404){
                if(error.input.parent().find('.error').length === 0) {
                    error.input.parent().append('<div class="error">' + error.message + '</div>');
                }
            }
        }

        $('#input-wrapper').on('click', '#add-child-button', function () {
            firstChildCount++;
            $('<div class="form-group child-wrapper">' +
                '<label class="col-sm-2 control-label">Child '+ firstChildCount + '</label>' +
                '<div class="col-sm-5">' +
                '<span>Title</span><input data-input="childTitle" type="text" class="multi-input form-control child-title-input">' +
                '</div>' +
                '<div class="col-sm-5">' +
                '<span>Text</span><textarea data-input="childText" type="text" class="multi-input form-control child-text-input"></textarea>' +
                '</div>' +
                '</div>').insertBefore('#input-wrapper .add-button-wrapper');
        });

        $('#input-wrapper').on('input', 'input, textarea, select', function () {
            unsavedChanges = true;
        });

        $('#second-input-wrapper').on('click', '#add-child-button', function () {
            secondChildCount++;
            $('<div class="form-group child-wrapper">' +
                '<label class="col-sm-2 control-label">Child '+ secondChildCount + '</label>' +
                '<div class="col-sm-5">' +
                '<span>Title</span><input data-input="childTitle" type="text" class="multi-input form-control child-title-input">' +
                '</div>' +
                '<div class="col-sm-5">' +
                '<span>Text</span><textarea data-input="childText" type="text" class="multi-input form-control child-text-input"></textarea>' +
                '</div>' +
                '</div>').insertBefore('#second-input-wrapper .add-button-wrapper');
        });

        $('#block-overview').on('click', '.remove-block', function () {
            if(confirm("Do you want to delete this block?" + ($(this).parent().hasClass('small-block') ? " This will delete its sibling block as well!" : ""))){
                removeBlock($(this).parent());
            }
        });

        $('#block-overview').on('click', '.block-wrapper', function () {
            if(unsavedChanges){
                if(confirm("Are you sure you want to leave this page without saving the changes?")){
                    unsavedChanges = false;
                }else{
                    return;
                }
            }
            let block = $(this);
            if(block.hasClass('selected')){
                addBlockButton.removeClass("update").html("Add Block");
                block.removeClass('selected');
                selectedBlock = undefined;
                $('#design-select').val("");
                handleDesignChange($('#design-select'), true);
                $('#design-select option').each(function () {
                    $(this).prop('disabled', false);
                });
            }else {
                addBlockButton.addClass("update").html("Update Block");
                if(selectedBlock){
                    selectedBlock.removeClass('selected');
                }
                block.addClass('selected');
                selectedBlock = block;
                let blockData = designConfig[block.attr('data-id')];

                /**
                 * disable the sibling designs in the design selector if the selected block is a non sibling block
                 * and vise versa
                 */
                if(blockData['hasSibling']){
                    $('#design-select option').each(function () {
                        if(!siblingDesigns.includes($(this).val())){
                            $(this).prop('disabled', 'disabled');
                        }else{
                            $(this).prop('disabled', false);
                        }
                    });
                }else{
                    $('#design-select option').each(function () {
                        if(siblingDesigns.includes($(this).val())){
                            $(this).prop('disabled', 'disabled');
                        }else{
                            $(this).prop('disabled', false);
                        }
                    });
                }

                $('#design-select').val(blockData['designId']);
                handleDesignChange($('#design-select'), true);

                for (let key in blockData) {
                    if(key === "children"){
                        let childCount = 0;
                        for (let i in blockData["children"]){
                            childCount++;
                            if(childCount === 1){
                                $('#input-wrapper').find('.child-title-input').val(blockData["children"][i]['childTitle']);
                                $('#input-wrapper').find('.child-text-input').val(blockData["children"][i]['childText']);
                            }else{
                                let childHtml = $(
                                    '<div class="form-group child-wrapper">' +
                                    '<label class="col-sm-2 control-label">Child '+ childCount + '</label>' +
                                    '<div class="col-sm-5">' +
                                    '<span>Title</span><input data-input="childTitle" type="text" class="multi-input form-control child-title-input">' +
                                    '</div>' +
                                    '<div class="col-sm-5">' +
                                    '<span>Text</span><textarea data-input="childText" type="text" class="multi-input form-control child-text-input"></textarea>' +
                                    '</div>' +
                                    '</div>'
                                );
                                childHtml.find('.child-title-input').val(blockData["children"][i]['childTitle']);
                                childHtml.find('.child-text-input').val(blockData["children"][i]['childText']);
                                childHtml.insertBefore('#input-wrapper .add-button-wrapper');
                            }
                        }
                    }else if(key === "imageUrl"){
                        let imageUrl = blockData[key];
                        if(!imageUrl.includes("https://")){
                            imageUrl = "/img/" + imageUrl;
                        }
                        $('#input-wrapper').find(".image-preview").attr('src', imageUrl);
                    }else if(key === "categoryIds") {
                        $.each(blockData[key].split(","), function (i, e) {
                            $("#input-wrapper #feeder-categories-ids option[value='" + e + "']").prop("selected", true);
                        });
                    }else if(key === "itemsTopSellerCategories"){
                        $.each(blockData[key].split(";"), function(i,e){
                            $("#input-wrapper #top-seller-ids option[value='" + e + "']").prop("selected", true);
                        });
                    }else{
                        $('#input-wrapper').find("[data-input='" + key + "']").val(blockData[key]);
                        if (key === 'itemSource') {
                            $("#item-source").trigger('change');
                        }
                    }
                }
            }
        });

        function renderBlock(){
            let overview = $('#block-overview'),
                selectedBlockId = selectedBlock ? parseInt(selectedBlock.attr('data-id')) : -1,
                block = "";

            overview.empty();
            for (let i = 0; i < designConfig.length; i++){
                if(designConfig[i]['hasSibling']){
                    block =
                        $('<div data-id="' + i + '" class="block-wrapper small-block ' + (selectedBlockId === i ? "selected" : "") + '">' +
                            '<div class="remove-block">x</div>' +
                            '<span>' + designConfig[i]['designId'] + '</span>' +
                            '</div>');
                    overview.append(block);
                    if(i === selectedBlockId){
                        selectedBlock = block;
                    }
                    i++;
                    block =
                        $('<div data-id="' + i + '" class="block-wrapper small-block ' + (selectedBlockId === i ? "selected" : "") + '">' +
                            '<div class="remove-block">x</div>' +
                            '<span>' + designConfig[i]['designId'] + '</span>' +
                            '</div>');
                    overview.append(block);
                    if(i === selectedBlockId){
                        selectedBlock = block;
                    }
                }else{
                    block =
                        $('<div data-id="' + i + '" class="block-wrapper ' + (selectedBlockId === i ? "selected" : "") + '">' +
                            '<div class="remove-block">x</div>' +
                            '<span>' + designConfig[i]['designId'] + '</span>' +
                            '</div>');
                    overview.append(block);
                    if(i === selectedBlockId){
                        selectedBlock = block;
                    }
                }
            }
            $('#block-configuration').val(JSON.stringify(designConfig));
        }

        function removeBlock(block){
            let blockId = block.attr('data-id');
            if(designConfig[blockId]['hasSibling']){
                if(designConfig[blockId]['hasSibling'] === 'next'){
                    designConfig.splice(blockId, 2);
                }else{
                    designConfig.splice(blockId - 1, 2);
                }
            }else{
                designConfig.splice(blockId, 1);
            }
            renderBlock();
        }

        let uploadImage = function (imageInput) {
            return new Promise(function (resolve, reject) {
                let imageData = new FormData();
                if(imageInput.files[0]){
                    imageData.append("image", imageInput.files[0]);
                    $.ajax(
                        {
                            url: imageUploadUrl,
                            data: imageData,
                            processData: false,
                            contentType: false,
                            method: 'POST',
                            success: function (data) {
                                resolve(data);
                            },
                            error: function (data) {
                                reject(data);
                            }
                        }
                    )
                }else{
                    reject({'type': 404, 'message': 'Please select an image!', 'input': $(imageInput)})
                }
            })
        };

        function buildInputs(design, inputWrapper) {
            inputWrapper.empty();
            for(let element in design){
                if(design[element] === "addChildButtonFlag"){
                    inputWrapper.append(
                        '<div class="form-group add-button-wrapper">' +
                        '<div class="col-sm-10 col-sm-offset-2">' +
                        '<div title="Add Child" type="text" id="add-child-button">+</div>' +
                        '</div>' +
                        '</div>'
                    );
                }else{
                    inputWrapper.append(design[element]);
                }
            }
        }

        function getDesign(designID) {
            switch(designID){
                case "":
                    return undefined;
                case "1":
                    return design1;
                case "2a":
                    return design2a;
                case "2b":
                    return design2b;
                case "3":
                    return design3;
                case "4":
                    return design4;
                /*case "4a":
                    return design4a;*/
                case "4b":
                    return design4b;
                case "5":
                    return design5;
                case "5b":
                    return design5b;
                case "5c":
                    return design5c;
                case "6a":
                    return design6a;
                case "6b":
                    return design6b;
                case "7a":
                    return design7a;
                case "7b":
                    return design7b;
                case "8":
                    return design8;
                case "9":
                    return design9;
                case "10a":
                    return design10a;
                case "10b":
                    return design10b;
                case "11a":
                    return design11a;
                case "11b":
                    return design11b;
                case "12":
                    return design12;
                case "13":
                    return design13;
                case "14":
                    return design14;
            }
        }

        let _URL = window.URL || window.webkitURL;

        $(document).on('change', '.image-input', function () {
            showImagePreview(this);
            $(this).parent().find('.error').remove();
        });

        $('#guide-image, #first-block-image, #second-block-image, #third-block-image, .image-input').change(function () {
            showImagePreview(this)
        });

        function showImagePreview(inputElement){
            let file = inputElement.files[0];
            let input = $(inputElement);
            if(file.type.indexOf("image") !== -1){
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    input.parent().parent().find('img').attr('src', img.src).show();
                };
            }else{
                unsetFileinput(input);
            }
            input.next('.alert').remove();
            if (file.size > 150 * 1024) {
                input.after('<div class="alert alert-danger"><?= __('Hinweis: Upload größer als 150 kb!')?></div>');
            }
        }

        /**
         * called if the uploaded image doesn't fit the criteria. Removes the uploaded image from the input.
         * @param input - the input whose value should be deleted
         */
        function unsetFileinput(input){
            input.wrap('<form>').closest('form').get(0).reset();
            input.unwrap();
            $("#img-" + input[0].id).attr('src', '#').hide();
        }


    });
    const titleInput =
        '<div class="form-group">' +
        '<label title="Add with HTML Tag (h1, h2, h3, h4, h5)" class="col-sm-2 control-label">Headline*</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="headline" type="text" class="single-input form-control headline-input">' +
        '</div>' +
        '</div>';
    const titleSecondRowInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Headline Second Row</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="headlineSecondRow" type="text" class="single-input form-control headline-input">' +
        '</div>' +
        '</div>';
    const subtitleInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Subtitle</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="subtitle" type="text" class="single-input form-control subtitle-input">' +
        '</div>' +
        '</div>';
    const videoInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Video Embed Code</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="video" type="text" class="single-input form-control video-input">' +
        '</div>' +
        '</div>';
    const textInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Text</label>' +
        '<div class="col-sm-10">' +
        '<textarea data-input="text" type="text" class="single-input form-control text-input"></textarea>' +
        '</div>' +
        '</div>';
    const colorInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Color</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="color" type="text" class="single-input form-control color-input">' +
        '</div>' +
        '</div>';
    const buttonTextColorInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Button Text Color</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="buttonTextColor" type="text" class="single-input form-control color-input">' +
        '</div>' +
        '</div>';
    const buttonBackgroundColorInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Button Background Color</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="buttonBackgroundColor" type="text" class="single-input form-control color-input">' +
        '</div>' +
        '</div>';
    const textBackgroundColorInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Text Background Color</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="textBackgroundColor" type="text" class="single-input form-control color-input">' +
        '</div>' +
        '</div>';
    const firstChildInput =
        '<div class="form-group child-wrapper">' +
        '<label class="col-sm-2 control-label">Child 1</label>' +
        '<div class="col-sm-5">' +
        '<span>Title</span><input data-input="childTitle" type="text" class="multi-input form-control child-title-input">' +
        '</div>' +
        '<div class="col-sm-5">' +
        '<span>Text</span><textarea data-input="childText" type="text" class="multi-input form-control child-text-input"></textarea>' +
        '</div>' +
        '</div>';
    const hashtagInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Hashtag</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="hashtag" type="text" class="single-input form-control hashtag-input">' +
        '</div>' +
        '</div>';
    const secondTextInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Second Text</label>' +
        '<div class="col-sm-10">' +
        '<textarea data-input="secondText" type="text" class="single-input form-control second-text-input"></textarea>' +
        '</div>' +
        '</div>';
    const listElementsInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">List Elements</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="listElements" type="text" class="single-input form-control list-elements-input">' +
        '</div>' +
        '</div>';
    const buttonTextInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Button Text</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="buttonText" type="text" class="single-input form-control button-text">' +
        '</div>' +
        '</div>';
    const buttonLinkInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Button Link</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="buttonLink" type="text" class="single-input form-control button-link">' +
        '</div>' +
        '</div>';
    const itemIdInput=
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Item IDs</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="itemIds" type="text" class="single-input form-control item-ids">' +
        '</div>' +
        '</div>';
    const itemFromCategoryInput =
        '<div class="form-group" style="display:none">' +
        '<label class="col-sm-2 control-label">Items From Category</label>' +
        '<div class="col-sm-10">' +
        '<?= $this->Form->input('items_from_category',
            [
                "options" => $feederCategories,
                "empty" => false,
                "label" => false,
                'multiple' => false,
                "class" => "form-control single-input category-ids",
                "data-input" => "itemsCategory",
            ]) ?>' +
        '</div>' +
        '</div>';
    const itemFromTopSellersInput =
        '<div class="form-group" style="display:none">' +
        '<label class="col-sm-2 control-label">Items From Top Sellers</label>' +
        '<div class="col-sm-10">' +
        '<?= $this->Form->input('top_seller_ids',
            [
                'multiple' => true,
                'options' => array_combine($soldItemCategories, $soldItemCategories),
                'label' => false,
                'class' => "form-control single-input top-seller-ids",
                "data-input" => "itemsTopSellerCategories",
            ]) ?>' +
        '</div>' +
        '</div>';
    const itemInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Item Source</label>' +
        '<div class="col-sm-10">' +
        '<?= $this->Form->input('item_source',
            [
                "options" => [
                    FeederPillarPagesTable::ITEMS_SOURCE_IDS => 'Item Ids',
                    FeederPillarPagesTable::ITEMS_SOURCE_TOP_SELLERS => 'Top Sellers',
                    FeederPillarPagesTable::ITEMS_SOURCE_FROM_CATEGORY => 'From Catch Category'
                ],
                "empty" => false,
                "label" => false,
                "class" => "form-control single-input",
                "onchange" =>
                    'let inputWrapper = $(this).parent().parent().parent().parent();' .
                    'let itemIdInput = inputWrapper.find("[data-input=itemIds]").parent().parent();' .
                    'let itemFromCategoryInput = inputWrapper.find("[data-input=itemsCategory]").parent().parent().parent();' .
                    'let itemFromTopSellersInput = inputWrapper.find("[data-input=itemsTopSellerCategories]").parent().parent().parent();' .
                    'itemIdInput.hide(); itemFromTopSellersInput.hide(); itemFromCategoryInput.hide();' .
                    '$(this).val() == "' . FeederPillarPagesTable::ITEMS_SOURCE_IDS . '" && itemIdInput.show();' .
                    '$(this).val() == "' . FeederPillarPagesTable::ITEMS_SOURCE_TOP_SELLERS . '" && itemFromTopSellersInput.show();' .
                    '$(this).val() == "' . FeederPillarPagesTable::ITEMS_SOURCE_FROM_CATEGORY . '" && itemFromCategoryInput.show();',
                "data-input" => "itemSource"
            ]) ?>' +
        '</div>' +
        '</div>' +
        itemIdInput +
        itemFromTopSellersInput +
        itemFromCategoryInput;
    const firstImageInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">First Image</label>' +
        '<div class="col-sm-10">' +
        '<form class="image-form">' +
        '<input data-input="firstImage" type="file" class="single-input form-control image-input">' +
        '</form>' +
        '<div class="image-preview-wrapper">' +
        '<img src="" class="image-preview">' +
        '</div>' +
        '</div>' +
        '</div>';
    const backgroundImageInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Background Image</label>' +
        '<div class="col-sm-10">' +
        '<form class="image-form">' +
        '<input data-input="backgroundImage" type="file" class="single-input form-control image-input not-mandatory">' +
        '</form>' +
        '<div class="image-preview-wrapper">' +
        '<img src="" class="image-preview">' +
        '</div>' +
        '</div>' +
        '</div>';
    const backgroundColorInput =
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Background Color</label>' +
        '<div class="col-sm-10">' +
        '<input data-input="backgroundColor" type="text" class="single-input form-control color-input">' +
        '</div>' +
        '</div>';
    const categoryIdInput=
        '<div class="form-group">' +
        '<label class="col-sm-2 control-label">Category IDs</label>' +
        '<div class="col-sm-10">' +
        '<?= $this->Form->input('feeder_categories._ids',
            [
                "options" => $feederCategories,
                "empty" => true,
                "label" => false,
                "class" => "form-control single-input category-ids",
                "data-input" => "categoryIds"
            ]) ?>' +
        '</div>' +
        '</div>';
</script>
<?php $this->end() ?>
