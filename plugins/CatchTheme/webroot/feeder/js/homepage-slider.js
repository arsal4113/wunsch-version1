(function ($) {
    $(function () {
        let animationRunning = false,
            bannerContainer = $('.banner-container'),
            bubbleJs = document.getElementsByClassName('fizzy-bubble-container'),
            bubbleImageJs = document.getElementsByClassName('bubble-image'),
            bannerContainerJS = document.getElementById('banner'),
            bubbleCount = bubbleJs.length,
            activeBubble = {'bubble': $('.bubble-2'), 'key': 2},
            bannerWidth = undefined,
            mode = undefined,
            windowWidth = $(window).width(),
            hoveringBubble = false,
            animationCollection = [],
            useIntervalAnimation = false;

        /** preparation of variables for calculations and stuff  */
        $(document).ready(function () {
            try{
                bubbleJs[0].animate([
                    {transform: 'translate(0px)'},
                    {transform: 'translate(0px)'}
                ],{
                    duration: 1,
                    iteration: 1
                })
            }catch(e){
                console.log("animate is not supported");
                useIntervalAnimation = true;
            }
            console.log("useIntervalAnimation: " + useIntervalAnimation);


            windowWidth = $(window).width();
            if(windowWidth > 1023){
                if(useIntervalAnimation){
                    checkAnimation();
                }else{
                    animateBubbles();
                }
                mode = 'fizzy';
            }else{
                if(windowWidth > 767){
                    mode = 'tablet';
                    bannerWidth = bubbleCount * 204;
                }else{
                    mode = 'mobile';
                    bannerWidth = (bubbleCount - 1) * 132 + 218;
                }
                maxLeft = windowWidth / 2 - activeBubble['bubble'].width() / 4;
                minLeft = windowWidth / 2 - bannerWidth;
                $('.banner-container').width(bannerWidth);
                centerSlider(activeBubble);
            }
            $(window).scroll(function () {
                if(mode === "fizzy"){
                    checkAnimation();
                }
            });
            $(window).resize(function () {
                windowWidth = $(window).width();
                if(windowWidth < 1024){
                    if(mode === 'fizzy'){
                        for(let i = 0; i < animationCollection.length; i++){
                            if(useIntervalAnimation){
                                clearInterval(animationCollection[i]);
                            }else{
                                animationCollection[i].cancel();
                            }
                        }
                        if(useIntervalAnimation){
                            $('.fizzy-bubble-container').stop().attr('style', '');
                        }
                        animationRunning = false;
                        centerSlider(activeBubble);
                    }
                    if(windowWidth > 767){
                        mode = 'tablet';
                        setActiveBubble();
                    }else{
                        mode = 'mobile';
                        $('.fizzy-bubble-container').attr('style', '');
                        $('.fizzy-bubble-container .bubble-image').attr('style', '');
                        bannerWidth = (bubbleCount - 1) * 132 + 218;
                        $('.banner-container').width(bannerWidth);
                        populateMobileFocusPoints();
                        bannerContainer.stop();
                        centerSlider(activeBubble);
                    }
                    maxLeft = windowWidth / 2 - activeBubble['bubble'].width() / 4;
                    minLeft = windowWidth / 2 - bannerWidth;
                }else if(windowWidth >= 1024 && (mode === 'mobile' || mode === 'tablet')){
                    mode = 'fizzy';
                    if(useIntervalAnimation){
                        checkAnimation()
                    }else{
                        animateBubbles()
                    }
                    bannerContainer.attr('style', '');
                    $('.fizzy-bubble-container').attr('style', '');
                    $('.fizzy-bubble-container .bubble-image').attr('style', '');
                }
            });
        });

        /** prevents the user from dragging the bubble images  */
        $('#bubble-banner .bubble-image').on('dragstart', function(event) { event.preventDefault(); });

        /**
         * enables the hover effect of the bubble in the desktop design. Is disabled when device
         * width is smaller than 1024px
         */
        $(".fizzy-bubble-container").hover(function(){
            if(mode === 'fizzy'){
                hoveringBubble = $(this);
                if(useIntervalAnimation){
                    clearInterval(animationCollection[hoveringBubble.attr('data-index')]);
                    animationCollection[hoveringBubble.attr('data-index')] = false;
                }else{
                    animationCollection[hoveringBubble.attr('data-index')].pause();
                }
                hoveringBubble.addClass('selected').find('.bubble-wrapper').addClass('hovering');
                $('#hover-background').stop().fadeIn(200);
            }
        }, function(){
            if(mode === 'fizzy'){
                endHover($(this));
            }
        });

        function endHover(bubble){
            hoveringBubble = false;
            bubble.find('.bubble-wrapper').removeClass('hovering');
            $('#hover-background').stop().fadeOut(200);
            setTimeout(function () {
                if(!bubble.find('.bubble-wrapper').hasClass('hovering')){
                    bubble.removeClass('selected');
                    if($(window).scrollTop() < 530){
                        if(useIntervalAnimation){
                            if(!animationCollection[bubble.attr('data-index')]){
                                let position = bubble.css('transform').split(',');
                                interpolateBubble(
                                    parseInt(position[4]),
                                    parseInt(position[5]),
                                    bubble.attr('data-index')
                                );
                            }
                        }else{
                            animationCollection[bubble.attr('data-index')].play();
                        }
                    }
                }
            }, 200);
        }

        /** disables the animation if the window is scrolled down so it wouldn't be visible anyways. Saves performance */
        function checkAnimation(){
            if($(window).scrollTop() > 530){
                if(animationRunning){
                    for(let i = 0; i < animationCollection.length; i++){
                        if(useIntervalAnimation){
                            clearInterval(animationCollection[i]);
                        }else{
                            animationCollection[i].pause();
                        }
                    }
                    animationRunning = false;
                }
            }else{
                if(!animationRunning){
                    if(useIntervalAnimation){
                        animateBubbles();
                    }else{
                        for(let i = 0; i < animationCollection.length; i++){
                            animationCollection[i].play();
                        }
                    }
                    animationRunning = true;
                }
            }
        }

        /** starts the bubble animation */
        function animateBubbles(){
            for(let i = 0; i < bubbleJs.length; i++){
                interpolateBubble(0, 0, i);
            }
        }

        /** animates the bubbles by interpolating between a random new position and their old one.
         * calls itself after the animation is finished -> endless
         */
        function interpolateBubble(lastX, lastY, index){
            let newX = Math.random() * 50 - 25,
                newY = Math.random() * 50 - 25,
                speed = Math.random() * 1000 + 3500;

            if(useIntervalAnimation){
                let currentX = undefined,
                    currentY = undefined,
                    interpolInterval = 1 / (speed / 17),
                    interpolValue = 0,
                    anim = setInterval(animation, 17);

                animationCollection[index] = anim;

                function animation(){
                    if(interpolValue >= 1){
                        clearInterval(animationCollection[index]);
                        interpolateBubble(currentX, currentY, index);
                    }else{
                        currentX = lastX + ((newX - lastX) * interpolValue);
                        currentY = lastY + ((newY - lastY) * interpolValue);
                        bubbleJs[index].style.transform = 'translate('+ currentX +'px, '+ currentY +'px) rotate(' + (0.02 * interpolValue) + 'deg)';
                        interpolValue += interpolInterval;
                    }
                }
            }else{
                animationCollection[index] = bubbleJs[index].animate([
                    {transform: 'translate('+ lastX +'px, '+ lastY +'px) rotate(0deg)'},
                    {transform: 'translate('+ newX +'px, '+ newY +'px) rotate(0.02deg)'}
                ],{
                    duration: speed,
                    iteration: 1
                });

                animationCollection[index].onfinish = function(){
                    animationCollection[index].cancel();
                    interpolateBubble(newX, newY, index);
                };
            }
        }

        let startX = undefined,
            currentLeft = 0,
            maxLeft = undefined,
            minLeft = undefined,
            mobileFocusPoints = [],
            mouseDown = false,
            body = $('body');

        /** adds the midpoints (value of left scroll on banner container, so that the active bubble
         * is precisely in the middle) of all bubbles to the mobileFocusPoints array
         */
        function populateMobileFocusPoints(){
            mobileFocusPoints = [];
            let startingPoint = windowWidth / 2 - 100.5;
            mobileFocusPoints.push(startingPoint);
            for(let i = 1; i <bubbleCount; i++){
                mobileFocusPoints.push(startingPoint - i * 134.703125);
            }
        }
        populateMobileFocusPoints();

        /** set the starting x-position of the touch event */
        bannerContainer.on('touchstart', function (e) {
            if(mode !== 'fizzy'){
                startX = e.touches[0]['clientX'];
            }
        });
        bannerContainer.on('mousedown', function(e){
            if(mode !== 'fizzy'){
                mouseDown = true;
                startX = e.originalEvent['clientX'];
            }
        });

        /** these events handlers handle a swipe or mousedrag, when the mouse is pressed */
        bannerContainer.on("touchmove", function (e) {
            if(mode !== 'fizzy'){
                e.preventDefault();
                scrollBannerContainer(e.touches[0]['clientX']);
            }
        });
        body.on("mousemove", function (e) {
            if(mode !== 'fizzy' && mouseDown){
                scrollBannerContainer(e.originalEvent['clientX']);
            }
        });

        /** scrolls the banner container left or right depending on the xPos parameter and min/max limits */
        function scrollBannerContainer(xPos){
            let distance = startX - xPos;
            currentLeft -= distance;
            if(currentLeft > maxLeft){
                currentLeft = maxLeft;
                return;
            }else if(currentLeft < minLeft){
                currentLeft = minLeft;
                return;
            }
            bannerContainer.css('left', currentLeft + "px");
            startX = xPos;
            if(mode === 'tablet'){
                setActiveBubble();
            }else{
                setMobileActiveBubble();
            }
        }

        /** these events mark the end of a scroll by the user */
        bannerContainer.on('touchend', function () {
            if(mode !== 'fizzy'){
                centerSlider(activeBubble);
            }else{
                if(hoveringBubble){
                    endHover(hoveringBubble);
                }
            }

        });
        body.on("mouseup", function () {
            if(mode !== 'fizzy' && mouseDown) {
                centerSlider(activeBubble);
                mouseDown = false;
            }
        });
        body.on("mouseleave", function () {
            if(mode !== "fizzy" && mouseDown){
                centerSlider(activeBubble);
                mouseDown = false;
            }
        });

        /** finds and sets the currently active bubble by its position in the viewport on tablet mode */
        function setActiveBubble(){
            let maxWidth = 316,
                maxScale = 2.55,
                bannerWidth = 0;

            $('.fizzy-bubble-container').each(function (index) {
                let bubble = $(this),
                    bubbleFitness = Math.abs(getBubbleCenterFitness(bubble, bubble.width())),
                    currentScale = maxScale - (((maxScale - 1) / (windowWidth / 2)) * bubbleFitness),
                    currentWidth = maxWidth - (((maxWidth - 136) / (windowWidth / 2)) * bubbleFitness);

                if(currentScale < 1){
                    currentScale = 1;
                }
                if(currentWidth < 122){
                    currentWidth = 122;
                    bannerWidth += currentWidth +25;
                    return;
                }

                if(bubbleFitness < 135.5 && activeBubble['key'] !== index){
                    activeBubble['bubble'].removeClass('active');
                    bubble.addClass('active');
                    activeBubble['bubble'] = bubble;
                    activeBubble['key'] = index;
                }
                bubbleImageJs[index].style.transform = "scale(" + currentScale + ")";
                bubbleJs[index].style.width = currentWidth + "px";
                bannerWidth += currentWidth + 20;
            });
            bannerContainerJS.style.width = bannerWidth + "px";
            minLeft = windowWidth / 2 - bannerWidth;
        }

        /** finds and sets the currently active bubble by its position in the viewport on mobile mode */
        function setMobileActiveBubble() {
            let smallestOffset = Number.MAX_VALUE,
                winningBubble = {'bubble': undefined, 'key': undefined};
            $('.fizzy-bubble-container').each(function (index) {
                let bubble = $(this);
                if(bubble.offset()['left'] < -100 || bubble.offset()['left'] > windowWidth){
                    return;
                }
                let fitness = Math.abs(getBubbleCenterFitness(bubble, 201));
                if(fitness < smallestOffset){
                    smallestOffset = fitness;
                    winningBubble['bubble'] = bubble;
                    winningBubble['key'] = index;
                }
            });
            if(winningBubble['bubble'][0] !== activeBubble['bubble'][0]){
                activeBubble['bubble'].removeClass('active');
                winningBubble['bubble'].addClass('active');
                activeBubble = winningBubble;
            }
        }

        /** centers the specified bubble in the middle of the banner container */
        function centerSlider(bubble){
            if(mode === "tablet"){
                let offset = getBubbleCenterFitness(activeBubble['bubble'], activeBubble['bubble'].width());
                currentLeft += offset / 2;
                bannerContainer.animate({left: currentLeft }, {
                    step: function () {
                        setActiveBubble();
                    },
                    duration: 200,
                    easing: 'swing'
                });
            }else{
                currentLeft = mobileFocusPoints[bubble['key']];
                bannerContainer.animate({
                    left: currentLeft
                }, 200, 'swing');
            }
        }

        /** calculates how far away from the middle a given bubble is in pixels and returns that value */
        function getBubbleCenterFitness(bubble, width) {
            return (windowWidth / 2) - (bubble.length ? bubble.offset()['left'] + width / 2 : 0);
        }
    });

})(jQuery);
