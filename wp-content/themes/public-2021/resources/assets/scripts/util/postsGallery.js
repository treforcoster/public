import Swiper from '../autoload/_swiper';

class PostsGallery {

    constructor(){

        console.log('PostsGallery')

        var swiperContainer = '.carousel';

        $(swiperContainer).each(function ( index ) {

            console.log('PostsGallery GalleryCarousel')

            let swiperID = 'gallery-' + index;
            let swiperIDHash = '#gallery-' + index;

            $('.posts-swiper',this).attr('id', swiperID);

            let postSwiper = new Swiper(swiperIDHash, {
                speed: 500,
                loop: true,

                    on: {
                        init() {
                            setTimeout(() => {
                                window.dispatchEvent(new Event('resize'))
                            }, 200)
                        },
                    },

                });

                console.log('new navigation');

                $('.next', this).click(function() {
                  postSwiper.slideNext();
                });

                $('.prev', this).click(function() {
                  postSwiper.slidePrev();
                });

                postSwiper.on('transitionStart', function () {

                      //console.log('transitionStart');

                  });

            });

        }
    }

    export default PostsGallery
