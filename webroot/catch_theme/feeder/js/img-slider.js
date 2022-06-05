/* Swipe event listener */
    
(function ($) {
    $(function () {

    // thumbnail image slider
    var currentSlide = 0,
        maxSlides = $('.image-list-row .mini-image-col').length,
        pressPrev = true,
        pressNext = true;
    if ($(window).width() > 991) {
    // click next button
        $("#thumb-next").on("click", function () {
            console.log('maxSlides = ' + maxSlides);
            if (currentSlide === 0) { // check if first slide
                currentSlide++;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 5 + ')');
                pressNext = true;
                pressPrev = false;
            } else if (currentSlide === maxSlides && pressPrev === true) {
            // if last slide and previous button was clicked before
                currentSlide = 0;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 5 + ')');
                pressNext = true;
                pressPrev = false;
            } else if (currentSlide < maxSlides && currentSlide > 0) {
            // for any slide other than first or last
                if (pressNext === true) {
                // check if previous button was not clicked before:
                    currentSlide++;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 5 + ')');
                    pressNext = true;
                    pressPrev = false;
                } else {
                // if previous button was clicked before:
                    currentSlide += 2;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 5 + ')');
                    pressNext = true;
                    pressPrev = false;
                }
            } else if (currentSlide === maxSlides) {
                // check if last slide
                currentSlide = 0;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 5 + ')');
                pressNext = true;
                pressPrev = false;
            }
        });
        // click previous button
        $("#thumb-prev").on("click", function () {
            if (currentSlide === 0) {
                // check if first slide
                currentSlide = maxSlides;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 5 + ')');
                pressPrev = true;
                pressNext = false;
            } else if (currentSlide <= maxSlides && currentSlide > 0) {
            // for any slide other than first or last
                if (pressPrev === true || currentSlide === 1) {
                    // check if next button was not clicked before:
                    currentSlide--;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 5 + ')');
                    pressPrev = true;
                    pressNext = false;
                } else {
                    // if next button was clicked before:
                    currentSlide -= 2;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 5 + ')');
                    pressPrev = true;
                    pressNext = false;
                }
            } else {
                // if last slide
                currentSlide = maxSlides;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 5 + ')');
                currentSlide--;
                pressPrev = true;
            }
        });

        // on tablet
    } else if ($(window).width() < 992 && $(window).width() >= 768) {
        // click next button
        $("#thumb-next").on("click", function () {
            if (currentSlide === 0) { // check if first slide
                currentSlide++;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                pressNext = true;
                pressPrev = false;
            } else if (currentSlide === maxSlides && pressPrev === true) {
                // if last slide and previous button was clicked before
                currentSlide = 0;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                pressNext = true;
                pressPrev = false;
            } else if (currentSlide < maxSlides && currentSlide > 0) {
                // for any slide other than first or last
                if (pressNext === true || currentSlide === (maxSlides - 1)) {
                    // check if previous button was not clicked before:
                    currentSlide++;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                    pressNext = true;
                    pressPrev = false;
                } else {
                    // if previous button was clicked before:
                    currentSlide += 2;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 45px) * ' + currentSlide * 4 + ')');
                    pressNext = true;
                    pressPrev = false;
                }
            } else if (currentSlide === maxSlides) {
                // check if last slide
                currentSlide = 0;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                pressNext = true;
                pressPrev = false;
            } else {
                currentSlide = 0;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                pressNext = true;
                pressPrev = false;
            }
        });
        // click previous button
        $("#thumb-prev").on("click", function () {
            if (currentSlide === 0) {
                // check if first slide
                currentSlide = maxSlides;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                pressPrev = true;
                pressNext = false;
            } else if (currentSlide <= maxSlides && currentSlide > 0) {
            // for any slide other than first or last
                if (pressPrev === true || currentSlide === 1) {
                    // check if next button was not clicked before:
                    currentSlide--;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                    pressPrev = true;
                    pressNext = false;
                } else {
                    // if next button was clicked before:
                    currentSlide -= 2;
                    $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                    pressPrev = true;
                    pressNext = false;
                }
            } else {
                // if last slide
                currentSlide = maxSlides;
                $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                currentSlide--;
                pressPrev = true;
            }
        });
    } else if ($(window).width() < 768) {
        // on Smartphone
        $("#thumb-next").css('display', 'none');
        $("#thumb-prev").css('display', 'none');
        $("#ctrl-next").css('display', 'none');
        $("#ctrl-prev").css('display', 'none');
    }
    /** end of thumbnail slider **/
        
        $("document").ready(function() { 
            if ($(window).width() <= 991) {
              if (maxSlides > 4) {
                  maxSlides = Math.ceil(maxSlides / 4) - 1;
              } else {
                  $("#thumb-next").css('display', 'none');
                  $("#thumb-prev").css('display', 'none');
              }
            } else {
              if (maxSlides > 5) {
                  maxSlides = Math.ceil(maxSlides / 5) - 1;
              } else {
                  $("#thumb-next").css('display', 'none');
                  $("#thumb-prev").css('display', 'none');
              }
            }
            $(".image-list-row").swipeListener().on("swipeLeft.sd swipeRight.sd swipeUp.sd swipeDown.sd", function(event) {
              if (event.type === "swipeLeft") {
                event.preventDefault();
                if ($(window).width() <= 1024) {
                // on tablet and mobile
                    console.log('maxSlides = ' + maxSlides);
                    console.log('currentSlide = ' + currentSlide);
                  if (currentSlide === 0) { // check if first slide
                        currentSlide++;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                        pressNext = true;
                        pressPrev = false;
                    } else if (currentSlide === maxSlides && pressPrev === true) {
                        // if last slide and previous button was clicked before
                        currentSlide = 0;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                        pressNext = true;
                        pressPrev = false;
                    } else if (currentSlide < maxSlides && currentSlide > 0) {
                        // for any slide other than first or last
                        if (pressNext === true || currentSlide === (maxSlides - 1)) {
                            // check if previous button was not clicked before:
                            currentSlide++;
                            $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide * 4 + ')');
                            pressNext = true;
                            pressPrev = false;
                        } else {
                            // if previous button was clicked before:
                            currentSlide += 2;
                            $('.mini-image-container').css('transform', 'translateX(calc((-100% - 45px) * ' + currentSlide * 4 + ')');
                            pressNext = true;
                            pressPrev = false;
                        }
                    } else if (currentSlide === maxSlides) {
                        // check if last slide
                        currentSlide = 0;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + 0 + ')');
                        pressNext = true;
                        pressPrev = false;
                    } else {
                        currentSlide = 0;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + 0 + ')');
                        pressNext = true;
                        pressPrev = false;
                    }
                  }
              } else if (event.type === "swipeRight") {
                event.preventDefault();
                if ($(window).width() <= 1024) {
                // on tablet and mobile  
                  if (currentSlide === 0) {
                        // check if first slide
                        currentSlide = maxSlides;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                        pressPrev = true;
                        pressNext = false;
                    } else if (currentSlide <= maxSlides && currentSlide > 0) {
                    // for any slide other than first or last
                        if (pressPrev === true || currentSlide === 1) {
                            // check if next button was not clicked before:
                            currentSlide--;
                            $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                            pressPrev = true;
                            pressNext = false;
                        } else {
                            // if next button was clicked before:
                            currentSlide -= 2;
                            $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                            pressPrev = true;
                            pressNext = false;
                        }
                    } else {
                        // if last slide
                        currentSlide = maxSlides;
                        $('.mini-image-container').css('transform', 'translateX(calc((-100% - 15px) * ' + currentSlide  * 4 + ')');
                        currentSlide--;
                        pressPrev = true;
                    }
                }
              } else if (event.type === "swipeUp") {
                console.log("Swipe Up");
              } else if (event.type === "swipeDown") {
                console.log("Swipe Down");
              }
            });
        });
    });
})(jQuery);
    
