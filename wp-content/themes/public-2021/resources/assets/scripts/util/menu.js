import { gsap } from 'gsap';

class Menu {

    constructor(){

        console.log('menu')

        let self = this;

        self.$menuToggle = $('#show-menu');
        self.menuVisible = false;
        self.$menuWrapper = $('.menu-wrapper');
        self.$logo = $('#logo');
        self.$nav = $('#nav');

        self.circle = {};
        self.circle.radius = 0;
        self.circle.x = 0;
        self.circle.y = 0;
        self.circle.duration = 0.9;
        self.targetRadius = 0;

        self.mainCanvas = document.getElementById('circle-canvas');
        self.mainContext = self.mainCanvas.getContext('2d');

        self.getWindowSize();
        self.setMainCanvas();
        self.setTargetRadius();
        self.setCircleCanvas()
        self.setCircle(self.targetRadius);

        self.hideOverlay();

        self.$menuToggle.click(function () {

            console.log('toggle clicked');

            if (!self.menuVisible) {
                self.animateShowMenu();
            } else {
                self.animateCloseMenu();
            }

        });

      $(window).resize(function () {

        self.getWindowSize();
        self.setMainCanvas();
        self.setTargetRadius();
        self.setCircleCanvas()
        self.setCircle(self.targetRadius);

        if (self.menuVisible == false) {
            self.setOverlayHidden();
        }

      });

    }

    animateShowMenu() {

        let self = this;

        console.log('animateShowMenu')

        self.menuVisible = true;

        self.$nav.addClass('open')

        console.log('menuVisible', self.menuVisible)

        self.showOverlay()
    }

    animateCloseMenu() {

        let self = this;

        console.log('animateCloseMenu')

        self.menuVisible =! self.menuVisible

        console.log('menuVisible', self.menuVisible)

        self.hideOverlay()
    }

    showOverlay() {

        console.log('showOverlay')
        let self = this;

        self.animateCircle(self.targetRadius);
    }

    getWindowSize(){

        let self = this;

        self.width = isNaN(window.innerWidth) ? window.clientWidth : window.innerWidth;
        self.height = isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;

    }

    setMainCanvas(){

        let self = this;

        self.mainCanvas.width = self.width;
        self.mainCanvas.height =  self.height;

    }

    setTargetRadius(){

        let self = this;

        self.targetRadius = Math.sqrt((self.width* self.width) + (self.height * self.height));
    }

    setCircleCanvas() {

        let self = this;

        let pos = $('#show-menu').position();
        //let oTop = $('#show-menu').offset().top;
        let oLeft = $('#show-menu').offset().left;

        console.log('pos.left ', pos.left)
        console.log('oLeft ', oLeft)

        self.circle.x = self.width - (37 +50);
        self.circle.y = 37 + 40;

    }

    setCircle(r){

        let self = this;

        this.circle.radius = r;

        self.drawCircleCanvas();

        if (this.circle.radius === 0) {
            gsap.set('#circle-canvas', {display:'none'});
        } else {
            gsap.set('#circle-canvas', {display:'block'});
        }

    }

    drawCircleCanvas() {

        let self = this;

        let circle = self.circle;

        self.mainContext.clearRect(0, 0,  self.mainCanvas.width, self.mainCanvas.height);
        self.mainContext.beginPath();
        self.mainContext.arc(circle.x, circle.y, circle.radius, 0, Math.PI * 2, false);
        self.mainContext.fillStyle ='#000';
        self.mainContext.fill();
        self.mainContext.closePath();

    }

    animateCircle(r){

        console.log('animate circle')

        let self = this;

        let circle = self.circle;

        function animateComplete()
        {

            gsap.ticker.remove(gsapTickAnimate);
            //gsap.set(self.$menuWrapper, {display:'block'});
           // gsap.to(self.$menuWrapper, {opacity: 1});

            if (circle.radius === 0) {
                gsap.set('#circle-canvas', {display:'none'});
            }

        }

        function gsapTickAnimate()
        {
            console.log('gsapTickAnimate')

            self.drawCircleCanvas();
        }


        gsap.set('#circle-canvas', {display:'block'});

        gsap.to(circle, {radius:r, duration: self.circle.duration,  ease: 'circ.out', onComplete:animateComplete});

        gsap.set(self.$menuWrapper, {display:'block', opacity: 0});
        gsap.to(self.$menuWrapper, {opacity: 1, delay: 0.3});

        gsap.ticker.add(gsapTickAnimate);


    }

    hideOverlay(){

        let self = this;

        function animateComplete()
        {
            gsap.set(self.$menuWrapper, {display:'none'});
            self.hideCircle(0);
        }

        gsap.set(self.$menuWrapper, {display:'block'});
        gsap.to(self.$menuWrapper, {opacity: 0, onComplete:animateComplete});

        self.$nav.removeClass('open')

    }

    hideCircle(r){

        let self = this;

        function animateComplete()
        {

            gsap.ticker.remove(gsapTickAnimate);

            if (self.circle.radius === 0) {
                gsap.set('#circle-canvas', {display:'none'});
            }

            self.menuVisible = false;

        }

        function gsapTickAnimate()
        {

            self.drawCircleCanvas();
        }


        gsap.set('#circle-canvas', {display:'block'});

        gsap.to(self.circle, {radius:r,duration: self.circle.duration, ease: 'circ.out', onComplete:animateComplete});

        gsap.ticker.add(gsapTickAnimate);


    }

    setOverlayHidden(){

        let self = this;

        gsap.set(self.circle, {radius:0});
        gsap.set('#circle-canvas', {display:'none'});

    }

}

export default Menu
