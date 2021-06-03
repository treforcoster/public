<article class="blog-post <?php echo $postClass;?> medium">
<?php

  $postID = get_sub_field($postFormat);
  $post = get_post($postID);
  $content = get_field('content', $postID);
  $meta = get_field('meta', $postID);?>

  <?php if ($meta['meta']['link']){?>

  <a href="<?php echo $meta['meta']['link'];?>" target="_blank">

  <?php }?>

  <?php if ($content['content_type'] === "Image") {
  $image = $content['image'];

    if ($image) :
      // Image variables.
      $url = $image['url'];
      $title = $image['title'];
      $alt = $image['alt'];

      // Thumbnail size attributes.
      $size = $imageSize;
      $thumb = $image['sizes'][ $size ];

      ?>

        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />

    <?php endif;

  } else if ($content['content_type'] === "Embed") {?>

  <div class="post-embed-wrapper">
    <?php echo $content['embed'] ?>
  </div>

 <?php } else if ($content['content_type'] === "Carousel") {?>

  <div class="carousel">

    <?php $images = $content['carousel'];
    if( $images ): ?>
      <div class="swiper-container posts-swiper">
        <div class="swiper-wrapper">
      <?php foreach( $images as $image ): ?>

        <div class="swiper-slide">

          <img src="<?php echo esc_url($image['sizes'][$imageSize]); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

        </div>
      <?php endforeach; ?>
        </div>

      </div>
    <?php endif; ?>

      <div class="prev"></div>
      <div class="next"></div>

  </div>

  <?php } else if ($content['content_type'] === "Video") {?>

  <?php $id =  uniqid() ?>

  <div class="post-video-wrapper">

    <video
      id="video-<?php echo $id;?>"
      class="video-js"
      muted
      playsinline
    >
      <source src="<?php echo $content['video'] ?>" type="video/mp4"></source>

    </video>

  </div>

  <?php } ?>

  <div class="title">

    <h3><?php echo $meta['meta']['text']?></h3>

  </div>

    <?php if ($meta['meta']['link']){?>

    </a>

  <?php }?>

</article>
