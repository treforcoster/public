import videojs from 'video.js/dist/video.js';

class PostsVideo {

    constructor(){

        console.log ('-----------posts video')

        //let player

        $('.post-video-wrapper').each(function (  ) {

          let $id = $('video', this).attr('id');

          console.log('id ---------- ', $id)
          //let options = {};

          // eslint-disable-next-line no-unused-vars
          let player = videojs($id, {
            autoplay: true,
            preload: 'auto',
          });

          player.ready(function() {

            player.play();

          });

          player.on('ended', function() {

            player.play();

          })

        });

    }
}

export default PostsVideo
