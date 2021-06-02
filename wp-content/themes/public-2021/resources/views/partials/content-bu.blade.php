<?php if ($positionCount == 0 && $loop === "first") {

  $imageSize = "blog-image-1";
  $postClass = "blog-post-1";

} ?>

<?php if ($positionCount == 1 && $loop === "first") {

  $imageSize = "blog-image-2";
  $postClass = "blog-post-2";

} ?>

<?php if ($positionCount == 2 && $loop === "first") {

  $imageSize = "blog-image-3";
  $postClass = "blog-post-3";

} ?>

<?php if ($positionCount == 3 && $loop === "first") {

  $imageSize = "blog-image-4";
  $postClass = "blog-post-4";

} ?>

<?php if ($positionCount == 0 && $loop === "second") {

  $imageSize = "blog-image-2";
  $postClass = "blog-post-2";

} ?>

<?php if ($positionCount == 1 && $loop === "second") {

  $imageSize = "blog-image-1";
  $postClass = "blog-post-1";

} ?>

<?php if ($positionCount == 2 && $loop === "second") {

  $imageSize = "blog-image-3";
  $postClass = "blog-post-3";

} ?>

<?php if ($positionCount == 3 && $loop === "second") {

  $imageSize = "blog-image-4";
  $postClass = "blog-post-4";

} ?>


<article class="blog-post <?php echo $postClass;?>">
  <header>

    <?php if (has_post_thumbnail() ):

    $img_id = get_post_thumbnail_id($post->ID);
    $image = wp_get_attachment_image_src($img_id, $imageSize);
    $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);

    ?>

    <img src="<?php echo $image[0]; ?>" alt="<?php echo $alt_text; ?>">

    <?php endif; ?>



    <h2 class="entry-title"><{!! get_the_title() !!}</h2>

  </header>

</article>
