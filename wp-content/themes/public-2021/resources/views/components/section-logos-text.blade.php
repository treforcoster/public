<section class="section section-logos-text medium">
    <div class="row align-items-center justify-content-between">
      <div class="col-lg-6 order-lg-2">
        <div class="text-row">

          {!! get_sub_field('text') !!}

        </div>

      </div>

      <div class="col-lg-16 order-lg-1">

        <div class="logo-row">

        <div class="row align-items-center">
        <?php
        $rows = get_sub_field('logos');
        if( $rows ) {

            foreach( $rows as $row ) {
                $image = $row['logo'];
                $size = $row['size'];

                if ($size === "small"){

                  $imageColClass = "col-8 col-md-1";
                  $imageClass = "small";

                } else {

                  $imageColClass = "col-8 col-md-2";
                  $imageClass = "large";

                }?>

              <div class="<?php echo $imageColClass?>">
                <img class="<?php echo $imageClass?>" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              </div>
            <?php }

        }?>
        </div>
        </div>
      </div>
    </div>
</section>
