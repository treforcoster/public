import Swiper from '../autoload/_swiper';
import VideoJS from 'video.js/dist/video.js';

class CasestudyGalleryMobile {

    constructor(){



          let swiperContainer = '.casestudy-mobile-gallery';

          $(swiperContainer).each(function ( index ) {

              let VIDEO_PLAYING_STATE = {
                'PLAYING': 'PLAYING',
                'PAUSE': 'PAUSE',
              }
              // eslint-disable-next-line no-unused-vars
              let videoPlayStatus = VIDEO_PLAYING_STATE.PAUSE
              // eslint-disable-next-line no-unused-vars
              let timeout = null;

              console.log('casestudy-gallery GalleryCarousel')

              let player

              $('video', this).each(function (  ) {

                let $id = $(this).attr('id')
                let options = {};

                console.log('video set up', $id)

                player = VideoJS($id, options);
                //player.on('ended', function () {
                //  next()
                //})
                player.pause();

                player.on('play', function() {
                  console.log('playing', this.id);
                });

                console.log('----------- video set up pause')
              });

              let swiperID = 'gallery-mobile-' + index;
              let swiperIDHash = '#gallery-mobile-' + index;

               $('.gallery-mobile-swiper',this).attr('id', swiperID);

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

                          checkSlideType(this);
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

                //console.log('caseStudySwiper slideChangeTransitionEnd')

                let index = caseStudySwiper.activeIndex
                let currentSlide =   $(caseStudySwiper.slides[index])
                let currentSlideType = currentSlide.data('slide-type')

                // incase user click next before video ended
                if (videoPlayStatus === VIDEO_PLAYING_STATE.PLAYING) {
                  player.pause()
                }

                clearTimeout(timeout)

                switch (currentSlideType) {
                  case 'image':
                    //runNext()
                    break;
                  case 'gif':
                    //runNext()
                    break;
                  case 'video':
                    player.currentTime(0)
                    player.play()
                    videoPlayStatus = VIDEO_PLAYING_STATE.PLAYING
                    break;
                  default:
                    throw new Error('invalid slide type');
                }

            });

            function checkSlideType(s){

              console.log('caseStudySwiper init')

              // eslint-disable-next-line no-unused-vars
              let index = s.activeIndex

              console.log('index ', index)
              let currentSlide =   $(s.slides[index])
              let currentSlideType = currentSlide.data('slide-type')

              if (currentSlideType === 'video'){
                console.log('first slide is video')

                console.log('currentSlide', currentSlide.parent().parent().attr('id'))

                let videoPlayer = $('video', currentSlide)

                //VideoJS($(videoPlayer)[0]).play();

                //setTimeout(playVideo, 500)

                setTimeout(function() {
                  playVideo(videoPlayer);
                }, 500)

                //$('video', currentSlide).ready(function(){
                   // var myPlayer = this;

                    // EXAMPLE: Start playing the video.
                   // myPlayer.play();

                 // });

                //let myPlayer = VideoJS(id);

                //myPlayer.ready(function(){
                   //let myPlayer = this;

                  // EXAMPLE: Start playing the video.
                 ///  myPlayer.play();
                  //console.log('--------------- video play', myPlayer)
                //});

                //console.log('player id', id)

                //myPlayer.currentTime(0)
                //myPlayer.play()
                videoPlayStatus = VIDEO_PLAYING_STATE.PLAYING
              } else if (currentSlideType === 'image'){
                console.log('first slide is image')
              }  else if (currentSlideType === 'gif'){
                console.log('first slide is gif')
              }

            }

            function playVideo(v) {
              console.log('------------------ playVideo')
              //VideoJS($(v)[0]).play();

              VideoJS($(v)[0]).ready(function(){
                  var myPlayer = this;

                  // EXAMPLE: Start playing the video.
                   myPlayer.play();

                  });

            }

          });
        }
    }

    export default CasestudyGalleryMobile
