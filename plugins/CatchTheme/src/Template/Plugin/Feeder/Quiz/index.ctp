<?php
/** @var \Feeder\Model\Entity\FeederQuiz $quiz */
$this->Html->css('Feeder.quiz' . STATIC_MIN, ['block' => true, 'media' => 'all']);

if (!empty($quiz->title_tag)) {
    $this->assign('title', $quiz->title_tag);
}
if(!empty($quiz->robot_tag)){
    $this->assign('robotTag', $quiz->robot_tag);
}
if(!empty($quiz->meta_description)){
    $this->assign('description', $quiz->meta_description);
}
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];
$urlComponents = parse_url($url);
$selectedResult = null;
if(isset($urlComponents['query'])){
    $resultId = str_replace('resid=', '', $urlComponents['query']);
    if(isset($results[$resultId])){
        $selectedResult = $results[$resultId];
    }
}

?>
<div id="quiz-container">
    <div class="mobile-background"></div>
    <div class="row">
        <div class="col-md-2 bigscreen"></div>
        <div class="headline-wrapper col-xl-4 col-lg-6 col-md-12">
            <div class="logo-wrapper">
                <div class="logo-top"></div>
                <div class="logo-bottom"></div>
            </div>
            <div class="description-container">
                <div class="description-wrapper">
                    <p class="description"><?= $quiz->description ?></p>
                </div>
            </div>
            <div class="mobile-button">
                <span>Start</span>
            </div>
        </div>
        <div id="questions-container" class="col-xl-4 col-lg-6 col-md-12" style="display: none;">
            <div id="question-rail">
                <?php foreach($quiz->question_config as $question): ?>
                    <div class="question-wrapper">
                        <div class="question">
                            <p class="question-text"><?= $question->question ?></p>
                            <div class="answer-container">
                                <?php foreach($question->answers as $answer): ?>
                                    <div data-result="<?= $answer->result ?>" class="answer-wrapper">
                                        <div
                                            <?php if($answer->image):?>
                                                class="answer-box image-answer"
                                                style="background: #fff url('<?= $answer->image ?>') center/cover no-repeat;"
                                            <?php else: ?>
                                                class="answer-box"
                                            <?php endif; ?>>
                                            <span class="answer"><?= $answer->answer ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="question-counter-container">
                <div class="counter-wrapper">
                    <div class="counter-background">
                        <span class="counter-label"></span>
                        <div class="counter">
                            <div class="left-side half-circle"></div>
                            <div class="right-side half-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="result-container" class="col-xl-4 col-lg-6 col-md-12" <?= $selectedResult ? '' : 'style="display: none;"' ?> >
            <?php if($selectedResult): ?>
            <div class="result-wrapper">
                <div class="headline-wrapper">
                    <p class="headline"><?= $selectedResult["headline"] ?></p>
                    <p class="description"><?= $selectedResult["explanation"] ?></p>
                </div>
                <div class="midsection">
                    <div class="image-wrapper">
                        <img src="<?= 'img/' . $selectedResult["image_src"] ?>">
                    </div>
                    <a class="result-button redesign-button" href="<?= $selectedResult["button_link"] ?>"><?= $selectedResult["button_text"] ?></a>
                </div>
                <div class="button-wrapper">
                    <div class="share-quiz" data-link="<?= $url ?>">
                        <div class="copy-message-wrapper" style="display: none;">
                            <div class="copy-message">Link copied!</div>
                            <div class="triangle"></div>
                        </div>
                    </div>
                    <a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>"></a>
                    <div class="play-again-button">Play again</div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-2 bigscreen"></div>
    </div>
    <script type="text/javascript">
        $(function() {
            const questionConfig = <?= json_encode($quiz->question_config) ?>,
                results = <?= json_encode($results) ?>,
                originalQuizDescription = '<?= $quiz->description ?>';

            let headlineWrapper = $('#quiz-container .headline-wrapper'),
                questionContainer = $('#questions-container'),
                questionRail = $('#question-rail'),
                questionWrappers = $('.question-wrapper'),
                resultContainer = $('#result-container'),
                counterLabel = $('.question-counter-container .counter-label'),
                counterStuff = $('.question-counter-container .counter'),
                leftSide = $('.question-counter-container .left-side'),
                rightSide = $('.question-counter-container .right-side'),
                mobileBackground = $('.mobile-background'),
                selectedResults = [],
                questionWidth = questionContainer.width(),
                answersLocked = false,
                oldWindowMode = undefined,
                windowMode = undefined,
                url = window.location.href,
                useIntervalAnimation = false,
                intervalSpeed = 1 / (500 / (1000 / 60)),
                currentTransform = 0,
                showQuestions = <?= $selectedResult ? 'false' : 'true' ?>;

            /** preparation of variables for calculations and stuff  */
            $(document).ready(function () {
                try {
                    questionRail[0].animate([
                        {transform: 'translate(0px)'},
                        {transform: 'translate(0px)'}
                    ], {
                        duration: 1,
                        iteration: 1
                    })
                } catch (e) {
                    console.log("animate is not supported");
                    useIntervalAnimation = true;
                }

                setWindowMode($(window).width());

                if(windowMode === "tablet" || windowMode === "mobile"){
                    mobileBackground.height(headlineWrapper.height() - 20);
                }
            });

            if(showQuestions){
                questionContainer.show();
                setQuestionWidth();
            }

            /** controls the percentage display of the counter and updates the progress */
            function handleCounter(count){
                let percentage = (count / questionConfig.length) * 100,
                    rotation = 180 - (3.6 * percentage);

                if(percentage < 50){
                    rightSide.css('transform', 'rotate(' + rotation + 'deg)')
                }else{
                    let prevPercentage = ((count - 1) / questionConfig.length) * 100,
                        lastRotation = 180 - (3.6 * prevPercentage),
                        distance = lastRotation - rotation,
                        timeout = (Math.abs(rotation) / distance) * 500;

                    rightSide.css('transform', 'rotate(' + rotation + 'deg)');
                    setTimeout(function () {
                        counterStuff.css('clip', 'auto');
                        leftSide.show();
                    }, timeout)
                }
                counterLabel.html(count + '/' + questionConfig.length);
            }
            handleCounter(1);

            /** animates the question slider and adds the selected result id to the collection array */
            let qCount = 0;
            $('.answer-wrapper').click(function () {
                if(!answersLocked){
                    qCount++;
                    selectedResults.push($(this).attr('data-result'));
                    if(qCount === questionConfig.length){
                        answersLocked = true;
                        showResult();
                    }else{
                        if(useIntervalAnimation){
                            let anim = setInterval(animation, 1000 / 60),
                                animationProgress = 0,
                                targetTransform = -((qCount) * questionWidth);

                            function animation(){
                                if(animationProgress >= 1){
                                    clearInterval(anim)
                                }else{
                                    let y = [0, 0, 1, 1],
                                        ampSpeed = Math.pow(1 - animationProgress, 3) * y[0] +
                                            3 * Math.pow(1 - animationProgress, 2) * animationProgress * y[1]
                                            + 3 * (1- animationProgress) * Math.pow(animationProgress, 2) * y[2]
                                            + Math.pow(animationProgress, 3) * y[3];

                                    currentTransform = targetTransform + questionWidth * (1 - ampSpeed);
                                    questionRail[0].style.transform = 'translateX('+ currentTransform +'px) rotate(' + (0.02 * animationProgress) + 'deg)';
                                    animationProgress += intervalSpeed;
                                }
                            }
                        }else{
                            let animation = questionRail[0].animate([
                                {transform: 'translateX('+ -((qCount - 1) * questionWidth) +'px) rotate(0deg)'},
                                {transform: 'translateX('+ -(qCount * questionWidth) +'px) rotate(0.02deg)'}
                            ],{
                                duration: 500,
                                iteration: 1,
                                easing: 'ease-in-out'
                            });
                            animation.onfinish = function(){
                                questionRail.css('transform', 'translateX('+ -(qCount * questionWidth) +'px) rotate(0.02deg)')
                            };
                        }
                        handleCounter(qCount +  1);
                    }
                }
            });

            /**
             * called if all questions have been answered. adds the result details to the page and
             * displays them instead of the questions
             */
            function showResult(){
                let resultId = getResultWithMostOccurrences(),
                    shareUrl = createShareLink(resultId),
                    html =
                    '<div class="result-wrapper">' +
                    '   <div class="headline-wrapper">' +
                    '       <p class="headline">' + results[resultId]["headline"] + '</p>' +
                    '       <p class="description">' + results[resultId]["explanation"] + '</p>' +
                    '   </div>' +
                    '   <div class="midsection">' +
                    '       <div class="image-wrapper">' +
                    '           <img src="' + buildSrc(results[resultId]['image_src']) + '">' +
                    '       </div>' +
                    '       <a class="result-button redesign-button" href="' + results[resultId]["button_link"] + '">' + results[resultId]["button_text"] + '</a>' +
                    '   </div>' +
                    '   <div class="button-wrapper">' +
                    '       <div class="share-quiz" data-link="' + shareUrl + '">' +
                    '           <div class="copy-message-wrapper" style="display: none;">' +
                    '               <div class="copy-message">Link copied!</div>' +
                    '               <div class="triangle"></div>' +
                    '           </div>' +
                    '       </div>' +
                    '       <a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' + shareUrl + '"></a>' +
                    '       <div class="play-again-button">Play again</div>' +
                    '   </div>' +
                    '</div>';

                resultContainer.append(html);
                questionContainer.fadeOut(500);
                setTimeout(function () {
                    resultContainer.fadeIn(500);
                }, 500);
                if(results[resultId]['quiz_description'] !== ''){
                    $('#quiz-container .headline-wrapper .description-container .description').html(results[resultId]['quiz_description']);
                }
                if(windowMode === "tablet" || windowMode === "mobile"){
                    mobileBackground.height(headlineWrapper.height() - 20);
                }
            }

            /** calculates the most clicked result id */
            function getResultWithMostOccurrences(){
                let counterArray = [],
                    resultId = undefined,
                    mostClickedCount = 0;
                for(let i = 0; i < selectedResults.length; i++){
                    if(counterArray[selectedResults[i]] === undefined){
                        counterArray[selectedResults[i]] = 1;
                    }else{
                        counterArray[selectedResults[i]]++;
                    }
                }
                for(let j = 0; j < counterArray.length; j++){
                    if(mostClickedCount < counterArray[j]){
                        mostClickedCount = counterArray[j];
                        resultId = j;
                    }
                }
                return resultId;
            }

            /** enables the user to play the quiz again. resets all the variables corresponding to the quiz progress */
            resultContainer.on('click', '.play-again-button', function () {
                selectedResults = [];
                qCount = 0;
                answersLocked = false;
                handleCounter(1);
                questionRail.css('transform', 'translateX(0px) rotate(0)');
                counterStuff.css('clip', 'rect(0, 15.5px, 31px, 0)');
                leftSide.hide();
                $('#quiz-container .headline-wrapper .description-container .description').html(originalQuizDescription);
                if(windowMode === "tablet" || windowMode === "mobile"){
                    mobileBackground.height(headlineWrapper.height() - 20);
                }
                resultContainer.fadeOut(500);
                setTimeout(function () {
                    resultContainer.empty();
                    questionContainer.fadeIn(500);
                    setQuestionWidth();
                }, 500);
            });

            /** adds img/ in front of the image url if it isn't a weblink */
            function buildSrc(url){
                try {
                    new URL(url);
                    return url;
                }catch(_){
                    return 'img/' + url;
                }
            }

            /** window resize listener for the quiz slider compatibility to different screen sizes */
            $(window).resize(function () {
                setWindowMode($(window).width());
                if(windowMode === 'tablet' || windowMode === 'mobile'){
                    setQuestionWidth();
                    oldWindowMode = windowMode;
                }else if(oldWindowMode !== windowMode){
                    oldWindowMode = windowMode;
                    setQuestionWidth();
                }
            });

            /** sets the window mode depending on the screen width */
            function setWindowMode(width){
                if(width > 1399){
                    windowMode = 'big-desktop';
                }else if(width > 1024 && width < 1400){
                    windowMode = 'small-desktop';
                } else if(width > 767 && width < 1024){
                    windowMode = 'tablet';
                } else {
                    windowMode = 'mobile';
                }
            }

            /** updates the width of the slider and the question wrapper, whenever the windowMode changes */
            function setQuestionWidth(){
                questionWidth = questionContainer.width();
                questionWrappers.width(questionWidth);
                questionRail.width(questionConfig.length * (questionWidth + 5));
            }

            $('.headline-wrapper .mobile-button').click(function () {
                if(questionContainer.is(':visible')){
                    $('html, body').animate({
                        scrollTop: (questionContainer.offset().top - 100)
                    }, 0);
                }else{
                    $('html, body').animate({
                        scrollTop: (resultContainer.offset().top - 100)
                    }, 0);
                }
            });

            resultContainer.on('click', '.share-quiz', function () {
                let dummy = document.createElement("textarea");
                document.body.appendChild(dummy);
                dummy.value = $(this).attr('data-link');
                dummy.select();
                document.execCommand("copy");
                document.body.removeChild(dummy);
                let copyMessage = $(this).find('.copy-message-wrapper');
                copyMessage.stop().fadeIn(200, function () {
                    clearTimeout();
                    setTimeout(function () {
                        copyMessage.fadeOut(600);
                    }, 1500)
                });
            });

            function createShareLink(id){
                return url.split('?')[0] + "?resid=" + id;
            }

            // tracking logik ahead
            var mobile_button = $('.headline-wrapper .mobile-button'),
                quiz_answers = $('#quiz-container .answer-container .answer-box'),
                result_button = $('#quiz-container .result-wrapper .result-button'),
                share_quiz = $('#quiz-container .result-wrapper .share-quiz'),
                share_on_fb = $('#quiz-container .result-wrapper .share-facebook'),
                play_again = $('#quiz-container .result-wrapper .play-again-button');

            mobile_button.click(function () {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'start'
                });
            });

            quiz_answers.on('click', function (e) {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'answer',
                    'quizLabel': qCount + 1
                });
            });

            result_button.on('click', function (e) {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'result',
                    'quizLabel': $(this).attr('href')
                });
            });

            share_quiz.on('click', function (e) {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'share',
                    'quizLabel': 'copylink'
                });
            });

            share_on_fb.on('click', function (e) {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'share',
                    'quizLabel': 'facebook'
                });
            });

            play_again.on('click', function (e) {
                push2dataLayer({
                    'event': 'quiz',
                    'quizAction': 'share',
                    'quizLabel': 'playagain'
                });
            });
        });
    </script>
</div>
