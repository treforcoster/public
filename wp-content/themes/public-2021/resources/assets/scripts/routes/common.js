import LogoAnimation from "../util/logoAnimation";
import PostsGallery from "../util/postsGallery";
import PostsVideo from "../util/postsVideo";
import CasestudyGallery from "../util/casestudyGallery";
import CasestudyGalleryMobile from "../util/casestudyGalleryMobile";
import CasestudyCollapse from "../util/casestudyCollapse";
import barba from '@barba/core';
import gsap from 'gsap';
import Menu from "../util/menu";

export default {

    init() {
        // JavaScript to be fired on all pages

        const menu = new Menu();

        barba.init({
            preventRunning: true,
                prevent: ({ el }) => el.classList && el.classList.contains('ab-item'),
                transitions: [
                {
                    name: 'basic',
                    leave: function (data) {

                        if (!menu.menuVisible) {
                            gsap.to(data.current.container, 1, {opacity: 0, onComplete: this.async(),});
                        } else {
                            gsap.to(data.current.container, 0.25, {opacity: 0, onComplete: this.async(),});
                            //this.async()
                        }
                    },
                    enter: function (data) {
                      // Remove the old container
                        data.current.container.parentNode.removeChild(data.current.container);
                        if (!menu.menuVisible) {
                            gsap.from(data.next.container, 1, {opacity: 0, onComplete: this.async(),});



                        } else {
                            gsap.to(data.current.container, 0.25, {opacity: 0, onComplete: this.async(),})
                            menu.hideOverlay();
                        }

                        checkPageColour()

                        checkPageContent()
                    },
            },
            ],
          });

        checkPageColour()

        function checkPageColour(){
          let $nav = $( '#nav' );

          if ($( '.loaded-content' ).hasClass( 'page-black' )){

            $nav.addClass('nav-white');
            $nav.removeClass('nav-black');

          } else {

            $nav.removeClass('nav-white');
            $nav.addClass('nav-black');
          }
        }

        function checkPageContent(){

          console.log('checkPageContent')

          let $page = $( '#page' );

            if ($page.hasClass( 'about' )){

             // alert('about')

            } else if ($page.hasClass( 'blog' )){

             // alert('blog')
              const postsGallery = new PostsGallery();

            } else if ($page.hasClass( 'casestudies' )){

              //alert('casestudies')
              const casestudyGallery = new CasestudyGallery();
              const casestudyGalleryMobile = new CasestudyGalleryMobile();
              const casestudyCollapse = new CasestudyCollapse();

            }
          }
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        const logoAnimation = new LogoAnimation();
        const postsVideo = new PostsVideo();
        const postsGallery = new PostsGallery();
        const casestudyGallery = new CasestudyGallery();
        const casestudyGalleryMobile = new CasestudyGalleryMobile();
        const casestudyCollapse = new CasestudyCollapse();

    },
};
