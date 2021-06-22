import {gsap} from 'gsap';

import 'imagesloaded/imagesloaded.pkgd.js'

class LoadingAnimation {

  constructor() {

    console.log('-------------- LoadingAnimation')

    $('body').imagesLoaded()
      .always( function(  ) {
        console.log('all images loaded');
      })
      .done( function(  ) {
        console.log('all images successfully loaded');
        //ScrollTrigger.refresh()

        playAnim()

        //gsap.to('#loading-animation', {autoAlpha:0, delay: 2, duration: 1})
      })
      .fail( function() {
        console.log('all images loaded, at least one is broken');
      })
      .progress( function( instance, image ) {
        var result = image.isLoaded ? 'loaded' : 'broken';
        console.log( 'image is ' + result + ' for ' + image.img.src );
      });


    gsap.set('.loading-dash', {opacity:1})
    gsap.set('.loading-p', {opacity:0})
    gsap.set('.loading-u', {opacity:0})
    gsap.set('.loading-b', {opacity:0})
    gsap.set('.loading-l', {opacity:0})
    gsap.set('.loading-i', {opacity:0})
    gsap.set('.loading-c', {opacity:0})

    let p = gsap.timeline({repeat:-1});

    gsap.to('.loading-p', {opacity:1,  duration: 0.5})

    p.to('.loading-dash', {opacity:1, duration: 0.1})
      .to('.loading-dash', {opacity:0, duration: 0.1}, '+=0.15')
      .to('.loading-dash', {opacity:1, duration: 0.1}, '+=0.15')
      .to('.loading-dash', {opacity:0, duration: 0.1}, '+=0.15')
      .to('.loading-dash', {opacity:1, duration: 0.1}, '+=0.15')
      .to('.loading-dash', {opacity:0, duration: 0.1}, '+=0.15')
      .to('.loading-dash', {opacity:1, duration: 0.1}, '+=0.15');


    let show = gsap.timeline({paused:true, onComplete: hideLoader});

    show
      .to('.loading-u', {opacity:1, duration: 0.1},'+=1')
      .to('.loading-b', {opacity:1, duration: 0.1}, '+=0.04')
      .to('.loading-l', {opacity:1, duration: 0.1}, '+=0.04')
      .to('.loading-i', {opacity:1, duration: 0.1}, '+=0.04')
      .to('.loading-c', {opacity:1, duration: 0.1}, '+=0.04')
      .addPause('+=2')
    //gsap.to('.loading-dash', {delay:0.5, duration: 0.1, opacity: 1, repeat: -1, yoyo: true});
    
    function hideLoader() {

      gsap.to('#loading-animation', {autoAlpha:0})
    }


    function playAnim(){

        show.play();
    }

  }
}

export default LoadingAnimation
