import Swiper from '../autoload/_swiper';
import VideoJS from 'video.js/dist/video.js';

class CasestudyGallery {

    constructor(){

        //console.log('GalleryCarousel')


        let VIDEO_PLAYING_STATE = {
          'PLAYING': 'PLAYING',
          'PAUSE': 'PAUSE',
        }
      // eslint-disable-next-line no-unused-vars
        let videoPlayStatus = VIDEO_PLAYING_STATE.PAUSE
      // eslint-disable-next-line no-unused-vars
        var timeout = null;


      var swiperContainer = '.casestudy-gallery';

      $(swiperContainer).each(function ( index ) {

        console.log('casestudy-gallery GalleryCarousel')

          let player

          $('video', this).each(function (  ) {

            let $id = $(this).attr('id')
            let options = {};

            player = VideoJS($id, options);
            //player.on('ended', function () {
            //  next()
            //})
            player.pause();
          });



            let swiperID = 'gallery-' + index;
            let swiperIDHash = '#gallery-' + index;

        $('.gallery-swiper',this).attr('id', swiperID);

          //let postSwiper = new Swiper(swiperIDHash, {

            let caseStudySwiper = new Swiper(swiperIDHash, {
                speed: 500,
                loop: true,
                //autoplay: {
                   // delay: 5000,
                    //disableOnInteraction: false,
                //},
                    on: {
                        init() {
                            setTimeout(() => {
                                window.dispatchEvent(new Event('resize'))
                            }, 200)
                        },
                    },

                });

          $('.next', this).click(function() {
            caseStudySwiper.slideNext();
          });

          $('.prev', this).click(function() {
            caseStudySwiper.slidePrev();
          });

          caseStudySwiper.on('slideChangeTransitionEnd', function () {

            var index = caseStudySwiper.activeIndex
            var currentSlide =   $(caseStudySwiper.slides[index])
            var currentSlideType = currentSlide.data('slide-type')

            // incase user click next before video ended
            if (videoPlayStatus === VIDEO_PLAYING_STATE.PLAYING) {
              player.pause()
            }

            clearTimeout(timeout)

            switch (currentSlideType) {
              case 'image':
                //runNext()
                break;
              case 'video':
                //player.currentTime(0)
                player.play()
                videoPlayStatus = VIDEO_PLAYING_STATE.PLAYING
                break;
              default:
                throw new Error('invalid slide type');
            }

            });

            });

        }
    }

    export default CasestudyGallery
