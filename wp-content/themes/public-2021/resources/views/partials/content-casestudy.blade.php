<article class="casestudy medium">

    <div class="row">

      <div class="col">

        <div class="casestudy-gallery">

        <?php

        // Check rows exists.
        if( have_rows('gallery', $post->ID) ): ?>

                  <div class="swiper-container gallery-swiper">
                    <div class="swiper-wrapper">

          <?php   while( have_rows('gallery', $post->ID) ) : the_row(); ?>

                      <?php $type = get_sub_field('slide_type'); ?>



                      <?php if ($type === 'image'){ ?>

                        <div class="swiper-slide" data-slide-type="image">

                          <?php $image = get_sub_field('image');?>
                          <img src="<?php echo esc_url($image['sizes']['gallery-image']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                        </div>

                          <?php }else if ($type === 'gif'){ ?>

                          <div class="swiper-slide" data-slide-type="gif">

                            <?php $image = get_sub_field('gif');?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                          </div>

                      <?php } else if ($type === 'embed'){?>

                        <div class="swiper-slide" data-slide-type="embed">

                          <div class="videoWrapper">
                            <?php the_sub_field('embed'); ?>
                          </div>

                        </div>

                      <?php } else if ($type === 'video'){?>

                      <?php $id =  uniqid() ?>

                      <div class="swiper-slide" data-slide-type="video" data-id="video-<?php echo $id;?>">

                        <video
                          id="video-<?php echo $id;?>"
                          class="video-js"
                          preload="auto"
                          poster="<?php the_sub_field('poster'); ?>"
                          data-setup='{}'>
                          <source src="<?php the_sub_field('video'); ?>" type="video/mp4"></source>
                          <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">
                              supports HTML5 video
                            </a>
                          </p>
                        </video>

                      </div>


                      <?php }?>


           <?php endwhile; ?>
                    </div>
                  </div>

        <?php else :
            // Do something...
        endif; ?>


          <div class="prev"></div>
          <div class="next"></div>


        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-lg-16">

        <div class="casestudy-title">

          <div class="row justify-content-between">
            <div class="col-lg-10 col-lg-11 col-xxl-11">
              <div class="vertical-spacing-mobile-bottom vertical-spacing-mobile-top vertical-spacing-desktop-bottom vertical-spacing-desktop-top">
              <h2>{!! the_field('title', $post->ID) !!}</h2>
              </div>
            </div>

            <div class="col-lg-5 col-xl-4 col-xxl-4">
              <div class="vertical-spacing-mobile-bottom vertical-spacing-desktop-bottom vertical-spacing-desktop-top">
              <div class="h2 more-info ">More information +</div>
              </div>
            </div>

          </div>

        </div>

        <div class="content">

          <div class="row justify-content-between">
            <div class="col-lg-9">
              {!! the_field('content', $post->ID) !!}
            </div>

            <div class="col-lg-5 col-xl-4 col-xxl-4">

              <ul class="categories">
               <?php $post_categories = wp_get_post_categories($post->ID);
                $cats = array();
                foreach ($post_categories as $c) {
                $cat = get_category($c); ?>

                <li><?php echo $cat->name; ?></li>
               <?php } ?>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

</article>
