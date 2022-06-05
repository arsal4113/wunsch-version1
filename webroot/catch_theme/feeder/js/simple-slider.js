(function($) {
    $.widget('iways.simple_slider', {
        options: {
            sliderRail: undefined,
            sliderCart: undefined,
        },
        sliderCartJS: undefined,
        startX: undefined,
        sliderPressed: false,
        mouseDown: false,
        currentLeft: 0,
        minLeft: undefined,
        scrolled: false,
        body: $('body'),
        animationLeft: 0,
        animated: false,
        lastX: undefined,
        finalDistance: undefined,
        animationTime: undefined,
        speed: undefined,
        lastMoved: undefined,
        timingThreshold: undefined,
        windowWidth: $(window).width(),
        posX: 0,
        _create: function () {
            this.errorContainer = this.element.find(this.options.errorContainer);
            this.sliderCart = $(this.options.sliderCart);
            this.sliderRail = $(this.options.sliderRail);
            this.sliderCartJS = this.sliderCart[0];
            this.minLeft = -this.sliderCart.width() + this.sliderRail.width();
            if (this.minLeft > 0) {
                this.minLeft = 0;
            }
            let self = this;
            $(window).resize(function () {
                if(self.windowWidth !== $(window).width()){
                    self.windowWidth = $(window).width();
                    self.minLeft = -self.sliderCart.width() + self.sliderRail.width();
                    if(self.minLeft > 0){
                        self.minLeft = 0;
                    }
                    self.currentLeft = 0;
                    self.scrollRail(0);
                }
            });
            self.sliderRail.on("wheel", (e) => {
                if(Math.abs(e.originalEvent.deltaX) > Math.abs(e.originalEvent.deltaY)){
                    e.preventDefault();
                    self.sliderRail.stop();
                    if(!e.ctrlKey){
                        self.posX -= e.originalEvent.deltaX;
                    }
                    if(self.posX < self.minLeft){
                        self.posX = self.minLeft;
                    }
                    if(self.posX > 0){
                        self.posX = 0;
                    }
                    self.sliderCartJS.style.transform = 'translate(' + self.posX + 'px, 0px)';
                    self.currentLeft = self.posX;
                }
            });
            self.sliderRail.on('touchstart', function(e){
                self.timingThreshold = 50;
                self.animationTime = new Date();
                self.sliderCart.stop();
                if(self.animated){
                    self.currentLeft = self.animationLeft;
                }
                self.lastX = undefined;
                self.startX = e.touches[0]['clientX'];
            });
            self.sliderRail.on('mousedown', function(e){
                self.timingThreshold = 20;
                self.animationTime = new Date();
                self.sliderCart.stop();
                if(self.animated){
                    self.currentLeft = self.animationLeft;
                    self.animated = false;
                }
                self.mouseDown = true;
                self.sliderPressed = true;
                self.lastX = undefined;
                self.startX = e.originalEvent['clientX'];
            });
            self.sliderRail.on("touchmove", function (e) {
                e.preventDefault();
                self.scrollRail(e.touches[0]['clientX']);
                self.scrolled = true;
                self.lastMoved = new Date();
            });
            self.body.on("mousemove", function (e) {
                if(self.mouseDown){
                    self.scrollRail(e.originalEvent['clientX']);
                    self.scrolled = true;
                    self.lastMoved = new Date();
                }
            });
            self.sliderRail.on("touchend", function () {
                self.animateRail();
            });
            self.body.on("mouseup mouseleave", function () {
                self.mouseDown = false;
                if(self.sliderPressed){
                    self.sliderCart.stop();
                    self.sliderPressed = false;
                    self.animateRail();
                }
            });
        },
        setMinLeft: function(newLeft) {
            this.minLeft = newLeft;
        },
        scrollRail: function(xPos) {
            if(this.lastX === undefined){
                this.lastX = this.startX;
            }
            this.currentLeft -= this.lastX - xPos;
            this.lastX = xPos;
            if(this.currentLeft < this.minLeft){
                this.currentLeft = this.minLeft;
            }
            if(this.currentLeft > 0){
                this.currentLeft = 0;
            }
            this.sliderCartJS.style.transform = 'translate(' + this.currentLeft + 'px, 0px)';
        },
        animateRail: function() {
            let endTime = new Date();
            if(endTime - this.lastMoved > this.timingThreshold ){
                return;
            }
            this.animationTime = endTime - this.animationTime;
            this.mouseDown = false;
            this.finalDistance = this.lastX - this.startX;
            this.speed = Math.abs(this.finalDistance / this.animationTime);
            let self = this;
            if(this.speed > 0){
                $('.bubble-link').click(function (e) {
                    if(self.scrolled){
                        e.preventDefault();
                        self.scrolled = false;
                    }
                });
                this.sliderCartJS.style.borderSpacing = "0px";
                this.animated = true;
                this.sliderCart.animate({borderSpacing: 1}, {
                    step: function (now) {
                        self.animationLeft = self.currentLeft + (self.finalDistance * self.speed) * now;
                        if(self.animationLeft < self.minLeft){
                            self.sliderCartJS.style.transform = 'translate(' + self.minLeft + 'px, 0px)';
                        }else if(self.animationLeft > 0){
                            self.sliderCartJS.style.transform = 'translate(' + 0 + 'px, 0px)';
                        }else{
                            self.sliderCartJS.style.transform = 'translate(' + self.animationLeft + 'px, 0px)';
                        }
                    },
                    duration: 1000,
                    easing: 'easeOutCubic',
                    complete: function () {
                        self.animated = false;
                        self.currentLeft = self.animationLeft;
                        self.scrolled = false;
                    }
                });
            }
        }
    });

})(jQuery);
