import {gsap} from 'gsap';
import { CSSPlugin } from 'gsap/CSSPlugin.js';

class AnimOverlay {

  constructor() {
      gsap.registerPlugin(CSSPlugin);


      console.log('--------------------- AnimOverlay')

      let width, height, viewBoxAttributes
      let circleRadius = 37
      let overlay = '#anim-overlay';
      let shape = document.getElementById('anim-overlay-svg');

      function setSizes() {

        let showWidth = $('#show-menu').width()

        circleRadius = showWidth/2;

        console.log('--------------------- showWidth' , showWidth)

        width = window.innerWidth;
        height = window.innerHeight;
        viewBoxAttributes = '0 0 ' + width + ' ' + height;

        shape.setAttribute('viewBox', viewBoxAttributes);

        gsap.set(overlay, {autoAlpha: 0})
        gsap.set('#mask', {attr: {width: width, height: height}})
        gsap.set('#mask-rect', {attr: {width: width, height: height}})
        gsap.set('#rect', {attr: {width: width, height: height}})
        gsap.set('#circle', {attr: {r: circleRadius}})
        gsap.set('#circle', {cx: 100, cy: 100});

        //animateDot();

      }

      setTimeout(setSizes, 500);

      $( window ).resize(function() {
        setSizes();
      });

    let xPosition = circleRadius+4;
    let yPosition = circleRadius+4;
    let xSpeed = 4;
    let ySpeed = 4;

    function update(){

      gsap.set('#circle',{ cx:xPosition, cy:yPosition })
    }

    function animateDot (){

      if(xPosition + circleRadius >= width || xPosition -circleRadius <= 0){
        xSpeed = -xSpeed;

      }
      if(yPosition + circleRadius >= height || yPosition -circleRadius  <= 0){
        ySpeed = -ySpeed;

      }

      xPosition += xSpeed;
      yPosition += ySpeed;

      update();

      requestAnimationFrame(animateDot);

    }

    animateDot()

    let timeout;

    document.onmousemove = function(){

      clearTimeout(timeout);
      gsap.to(overlay,{ autoAlpha: 0})
      timeout = setTimeout(function(){
        showOverlay()
        }, 15000);
    }

    function showOverlay() {

      if (width > 991) {
        gsap.to(overlay, {autoAlpha: 1})
      }
    }

  }
}

export default AnimOverlay
