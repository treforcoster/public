import {gsap} from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger.js';

class LogoAnimation {

    constructor(){

       gsap.registerPlugin(ScrollTrigger)

      setTimeout(setLogoAnimation, 500)

      function setLogoAnimation() {

        //let text = $('.letter')

        let tl = gsap.timeline();

        let duration = 0.3;
        let stagger = '-=0.15';

        tl.to('.letter-c', {opacity: 0, duration: duration})
          .to('.letter-i', {opacity: 0, duration: duration}, stagger)
          .to('.letter-l', {opacity: 0, duration: duration}, stagger)
          .to('.letter-b', {opacity: 0, duration: duration}, stagger)
          .to('.letter-u', {opacity: 0, duration: duration}, stagger);



        tl.pause();

        ScrollTrigger.create({
          trigger: '#logo-trigger',
          start: 'top 40%',
          end: 'top 20px',
          //markers: true,
          onEnter: () => playAnim(),
          onLeave: () => console.log('onLeave'),
          onEnterBack: () => console.log('onEnterBack'),
          onLeaveBack: () => reverseAnim(),
        });

        function playAnim() {
          console.log('onEnter')
          tl.play();
        }

        function reverseAnim() {
          console.log('onLeaveBack')
          tl.reverse();
        }
      }

    }

}

export default LogoAnimation
