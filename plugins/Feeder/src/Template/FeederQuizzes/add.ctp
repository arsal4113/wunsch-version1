<?php

use Feeder\Model\Table\FeederQuizzesTable;

?>
<?= $this->Html->css('Feeder.pillarPages.css'); ?>
<div id="mouse-dummy" class="quiz-style"></div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Quiz') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Quizzes'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederQuiz, ['class' => 'form-horizontal style-form', 'id' => 'quiz-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
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
                            <?= $this->Form->input('meta_description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_tag', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('robot_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('robot_tag', [
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('question_config')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('question_config', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2" id="block-overview"></div>
                    </div>
                    <div class="form-group">
                        <div class="question-wrapper">
                            <label class="col-sm-2 control-label">Question</label>
                            <div class="col-sm-10">
                                <input type="text" id="question-input" class="form-control" />
                            </div>
                        </div>
                        <div id="answer-container"></div>
                        <div class="add-answer-wrapper">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div style="display: none;" id="loader"></div>
                                <div id="add-answer" class="quiz-button">Add Answer</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2 add-question-button-wrapper">
                            <div id="add-question" class=""><?= __('Add a new Question') ?></div>
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

        const resultSelect = '<?= $this->Form->input('',
            [
                "options" => $feederQuizResults,
                "empty" => false,
                "label" => false,
                'multiple' => false,
                "class" => "form-control result-select"
            ]) ?>',
            imageUploadUrl = '<?= $this->Url->build([
                'controller' => 'FeederQuizzes',
                'action' => 'uploadImage',
                'plugin' => 'Feeder'
            ]) ?>',
            defaultResultValue = $(resultSelect).find("option:first-child").val();

        let questionConfigInput = $('#question-config'),
            questionOverview = $('#block-overview'),
            questionInput = $('#question-input'),
            addQuestionButton = $('#add-question'),
            questionConfig = [{
                question: '',
                answers: [
                    {
                        answer: '',
                        image: '',
                        result: defaultResultValue
                    },
                    {
                        answer: '',
                        image: '',
                        result: defaultResultValue
                    }
                ]
            }],
            answerContainer = $('#answer-container'),
            addAnswerButton = $('#add-answer'),
            loader = $('<div id="loader"></div>'),
            selectedQuestionId = 0,
            selectedQuestionBlock = undefined,
            draggedBlock = undefined,
            currentQuestion = questionConfig[selectedQuestionId];

        renderBlocks();
        renderAnswers();

        /**
         * ---------------------------------------EVENT LISTENERS START-------------------------------------------------
         * event listeners for answer handling
         *
         * adds a new empty answer to the question
         */
        addAnswerButton.click(function () {
            if(currentQuestion.answers.length < 4){
                currentQuestion.answers.push(
                    {
                        answer: '',
                        image: '',
                        result: defaultResultValue
                    }
                );
                renderAnswers();
                if(currentQuestion.answers.length === 4){
                    $('.add-answer-wrapper').hide();
                }
            }
        });
        /** removes the answer associated with the button */
        answerContainer.on('click', '.remove-answer', function () {
            $('.add-answer-wrapper').show();
            if(currentQuestion.answers.length > 2){
                currentQuestion.answers.splice($(this).attr('data-id'), 1);
                renderAnswers();
            }
        });
        /** updates the answer state on user input */
        answerContainer.on('input', '.answer-input', function () {
            currentQuestion.answers[$(this).attr('data-id')].answer = $(this).val();
        });
        /** updates the result state on user input */
        answerContainer.on('input', '.result-select', function () {
            currentQuestion.answers[$(this).attr('data-id')].result = $(this).val();
        });
        /** uploads an image and updates the image state on user input */
        answerContainer.on('change', '.quiz-image-input', function () {
            let id = $(this).attr('data-id'),
                fileType = this.files[0]['type'],
                imageWrapper = $(this).parent().parent().find('.image-preview-wrapper');

            if(fileType.split('/')[0] !== 'image'){
                $(this).wrap('<form>').closest('form').get(0).reset();
                $(this).unwrap();
                currentQuestion.answers[id].image = '';
                imageWrapper.find('img').attr('src', '');
                imageWrapper.append('<span class="error">The selected file is not an image!</span>');
                return;
            }
            imageWrapper.find('.error').remove();
            imageWrapper.append(loader);
            uploadImage(this)
                .then(function(data){
                    if(!data.includes("https://")){
                        data = "/img/" + data;
                    }
                    currentQuestion.answers[id].image = data;
                    renderAnswers();
                })
                .catch(function (error) {
                    loader.remove();
                    imageWrapper.append('<span class="error">Image Upload failed, please try again.</span>');
                    console.log(error);
                })
        });
        /** updates the question state on user input */
        questionInput.on('input', function () {
            currentQuestion.question = $(this).val();
            renderBlocks();
        });

        /** adds the currentQuestion list to the list of questions and resets the user input */
        addQuestionButton.click(function () {
            if(selectedQuestionBlock){
                unselectBlock();
            }
            questionConfig.push(currentQuestion);
            selectedQuestionId = questionConfig.length - 1;
            selectedQuestionBlock = questionOverview.find("[data-id='" + selectedQuestionId + "']");
            selectedQuestionBlock.addClass('selected');
            renderBlocks();
        });

        /** enables selecting and deselecting of blocks */
        questionOverview.on('click', '.block-wrapper', function () {
            let questionBlock = $(this);
            if(questionBlock.hasClass('selected')){
                unselectBlock()
            }else{
                if(selectedQuestionBlock){
                    selectedQuestionBlock.removeClass('selected');
                }
                questionBlock.addClass('selected');
                selectedQuestionBlock = questionBlock;
                selectedQuestionId = parseInt(questionBlock.attr('data-id'));
                currentQuestion = questionConfig[selectedQuestionId];
                renderAnswers();
            }
        });
        /** deletes the question associated with the button from the list of questions*/
        questionOverview.on('click', '.remove-block', function () {
            if(confirm("Do you want to delete this question?")){
                questionConfig.splice($(this).parent().attr('data-id'), 1);
                questionConfigInput.val(JSON.stringify(questionConfig));
                renderBlocks();
            }
        });

        $('#quiz-form').submit(function () {
            questionConfigInput.val(JSON.stringify(questionConfig));
            return true;
        });
        /** ----------------------------------------EVENT LISTENERS END-----------------------------------------------*/

        /** -----------------------------------------HELPER FUNCTIONS-------------------------------------------------*/
        /** renders te visual representation of the question config */
        function renderBlocks(){
            questionOverview.empty();
            let block = '';
            for (let i = 0; i < questionConfig.length; i++){
                let dZone = $('<div class="drop-zone" data-position="' + i + '"><div class="indicator"></div></div>');
                questionOverview.append(dZone);
                block =
                    $('<div title="' + questionConfig[i].question + '" data-id="' + i + '" class="block-wrapper quiz-style ' + (selectedQuestionId === i ? "selected" : "") + '">' +
                        '<div class="remove-block">x</div>' +
                        '<div class="text-wrapper">' +
                            '<span>' + questionConfig[i].question + '</span>' +
                        '</div>' +
                        '</div>');
                if(i === selectedQuestionId){
                    selectedQuestionBlock = block;
                }
                questionOverview.append(block);
            }
        }
        /** renders the user inputs for a question */
        function renderAnswers(){
            answerContainer.empty();
            questionInput.val(currentQuestion.question);
            if(currentQuestion.answers.length > 3){
                $('.add-answer-wrapper').hide();
            }else{
                $('.add-answer-wrapper').show();
            }
            $.each(currentQuestion.answers, function (index, answerInfo) {
                answerContainer.append(addAnswer(answerInfo.answer, answerInfo.image, answerInfo.result, index));
            });
        }
        /** adds an Answer to the list of answers */
        function addAnswer(answer, image, result, index){
            let answerHTML = $('<div data-id="' + index + '" class="answer">' +
                '    <div class="col-sm-2"></div>' +
                '    <div class="col-sm-6 answer-wrapper">' +
                '        <label for="answer-input">Answer ' + (index + 1) + '</label>' +
                '        <input value="' + answer + '" data-id="' + index + '" type="text" class="answer-input form-control"/>' +
                '        <label class="quiz-button add-image">Add Image<input data-id="' + index + '" class="quiz-image-input" type="file" accept="image/*"></label>' +
                '        <div class="image-preview-wrapper">' +
                '           <img src="' + image + '" class="image-preview">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-sm-4 result-wrapper">' +
                '        <label for="result-select">Result</label>' +
                            resultSelect +
                '        <div data-id="' + index + '" class="quiz-button remove-answer ' + (currentQuestion.answers.length < 3 ? "hidden" : "") + '">Remove</div>' +
                '    </div>' +
                '</div>');
            $(answerHTML).find('select').attr('data-id', index);
            if(result !== ""){
                $(answerHTML).find('select').val(result);
            }
            return (answerHTML);
        }
        /** uploads an image */
        let uploadImage = function (imageInputs) {
            return new Promise(function (resolve, reject) {
                let imageData = new FormData();
                if(imageInputs.files[0]){
                    imageData.append("image", imageInputs.files[0]);
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
                }
            })
        };
        /** deselects the currently selected block */
        function unselectBlock() {
            selectedQuestionBlock.removeClass('selected');
            selectedQuestionBlock = undefined;
            selectedQuestionId = undefined;
            currentQuestion =
                {
                    question: '',
                    answers: [
                        {
                            answer: '',
                            image: '',
                            result: defaultResultValue
                        },
                        {
                            answer: '',
                            image: '',
                            result: defaultResultValue
                        }
                    ]
                };
            renderAnswers();
        }
        /** ----------------------------------------HELPER FUNCTIONS END----------------------------------------------*/

        /**-------------------------------------------BLOCK REORDERING------------------------------------------------*/
        let dummy = document.getElementById('mouse-dummy'),
            sidebarWidth = 0,
            startX = undefined,
            startY = undefined;

        /** setting the block the user hovers over as the dragging target if he presses the left mousebutton */
        questionOverview.on('mousedown', '.block-wrapper', function (e) {
            if(e.which === 1){
                draggedBlock = $(this);
                sidebarWidth = $('#side-menu').width() - 7;
                dummy.style.top =  e.pageY + "px";
                dummy.style.left =  (e.pageX - sidebarWidth) + "px";
                dummy.innerHTML = draggedBlock.find('span').html();
                startX = e.pageX;
                startY = e.pageY;
            }
        });
        /** displays a block-dummy at the mouse position, if a block is dragged around */
        $(window).mousemove(function (e) {
            if(draggedBlock && Math.abs((startX + startY) - (e.pageX + e.pageY)) > 5){
                draggedBlock.addClass('dragging');
                $('.drop-zone').addClass('active');
                if(dummy.style.display !== 'block'){
                    dummy.style.display = 'block';
                }
                dummy.style.top =  e.pageY + "px";
                dummy.style.left =  (e.pageX - sidebarWidth) + "px";

                if(selectedQuestionBlock){
                    unselectBlock();
                }
            }
        });
        /** on mouse release, sets the new position of the dragging target */
        $(window).on('mouseup', function () {
            if(draggedBlock){
                dummy.style.display = 'none';
                let newPosition = parseInt($('.drop-zone.selected').attr('data-position'));
                if(!isNaN(newPosition)){
                    changeQuestionOrder(draggedBlock.attr('data-id'), newPosition);
                }
                draggedBlock.removeClass('dragging');
                draggedBlock = undefined;
                $('.drop-zone').removeClass('active selected');
            }
        });
        /** shows the selector the user is hovering over, if he is dragging a block */
        questionOverview.on('mouseover', '.drop-zone', function () {
            if(draggedBlock){
                $(this).addClass('selected')
            }
        });
        /** hides the selector the user is exiting, if he is dragging a block */
        questionOverview.on('mouseout', '.drop-zone', function () {
            if(draggedBlock){
                $(this).removeClass('selected')
            }
        });
        /** removes an element from the questionConfig and places it at a new index */
        function changeQuestionOrder(oldIndex, newIndex) {
            if(newIndex > oldIndex){
                newIndex--;
                if(newIndex === oldIndex){
                    return;
                }
            }
            questionConfig.splice(newIndex, 0, questionConfig.splice(oldIndex, 1)[0]);
            renderBlocks();
        }
        /**------------------------------------BLOCK REORDERING END--------------------------------------------- */
    });
</script>
<?php $this->end() ?>
