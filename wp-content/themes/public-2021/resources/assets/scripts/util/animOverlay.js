import {gsap} from 'gsap';
import { CSSPlugin } from 'gsap/CSSPlugin.js';

class AnimOverlay {

  constructor() {
      gsap.registerPlugin(CSSPlugin);


      console.log('--------------------- AnimOverlay')


      let width = window.innerWidth;
      let height = window.innerHeight;

      let circleRadius = 37;

      console.log('circleRadius ', circleRadius)

      let viewBoxAttributes = '0 0 ' + width + ' ' + height;
      let overlay = '#anim-overlay';
      let shape = document.getElementById('anim-overlay-svg');
      shape.setAttribute('viewBox', viewBoxAttributes);

      gsap.set(overlay,{ autoAlpha: 0})

      gsap.set('#mask',{ attr:{width:width, height:height} })
      gsap.set('#mask-rect',{ attr:{width:width, height:height} })
      gsap.set('#rect',{ attr:{width:width, height:height} })
      gsap.set('#circle',{ attr:{r:circleRadius} })

      gsap.set('#circle',  { cx: 100, cy: 100});

    let xPosition = circleRadius+4;
    let yPosition = circleRadius+4;
    let xSpeed = 4;
    let ySpeed = 4;

    function update(){

      gsap.set('#circle',{ cx:xPosition, cy:yPosition })
    }

    function animateDot (){

      if(xPosition + circleRadius >= window.innerWidth || xPosition -circleRadius <= 0){
        xSpeed = -xSpeed;

      }
      if(yPosition + circleRadius >= window.innerHeight || yPosition -circleRadius  <= 0){
        ySpeed = -ySpeed;

      }

      xPosition += xSpeed;
      yPosition += ySpeed;

      update();

      requestAnimationFrame(animateDot);

    }

    animateDot();

    let timeout;

    document.onmousemove = function(){

      clearTimeout(timeout);
      gsap.to(overlay,{ autoAlpha: 0})
      timeout = setTimeout(function(){
        showOverlay()
        }, 10000);
    }

    function showOverlay() {
      gsap.to(overlay,{ autoAlpha: 1})
    }

  }
}

export default AnimOverlay
