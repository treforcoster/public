<!--<header class="banner">
  <div class="container-fluid">
    <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>-->

<nav id="nav">

  <div id="menu-bar">

    <canvas id="circle-canvas"></canvas>

    <div class="menu-wrapper">

      <h3>Menu</h3>

      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'container' => '']);
      endif;
      ?>

    </div>

    <div id="logo">
      <a href="<?= esc_url(home_url('/')); ?>">

        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 244.2 79.7" style="enable-background:new 0 0 244.2 79.7;" xml:space="preserve">
        <style type="text/css">

        </style>
          <g>
            <rect y="78.7" class="logo-fill" width="29.1" height="1"/>
            <path class="logo-fill" d="M29.2,29.6h12c4.6,0,7.2-0.4,9.2-1.3c2.9-1.4,4.7-4.7,4.7-8.5c0-3.7-1.8-7-4.7-8.4c-1.9-0.9-4.5-1.3-9.2-1.3
            h-12V29.6z M17.6,0h21.9c8.1,0,15.7,0.4,21,4.9c4,3.5,6.5,8.9,6.5,14.9c0,6.2-2.4,11.8-6.5,15.2c-5.3,4.5-12.9,4.9-21,4.9H29.2
            v25.5H17.6V0z"/>
            <path class="logo-fill" d="M71.2,19.7h11v24.4c0,3.3,0.1,6.5,1.2,8.9c1.1,2.4,3.2,4,7,4c6.8,0,9.8-5.3,9.8-12.7V19.7h11v45.9h-11v-5.9
            c-2.2,3.9-7.1,7-13.7,7c-4.6,0-8.6-1.4-11.3-4.4c-2.9-3.3-4-6.5-4-16.6V19.7z"/>
            <path class="logo-fill" d="M140.1,57.2c7,0,11.7-5.5,11.7-14.6c0-9.3-4.6-14.7-11.7-14.7c-6.9,0-11.7,5.8-11.7,14.7
            C128.5,51.5,133.2,57.2,140.1,57.2 M128.9,60.7v4.8h-11V1.4h11v23.3c2.5-3.3,7.5-6.2,13.5-6.2c12.4,0,20.3,10,20.3,24.3
            c0,13.8-8.1,23.9-20.3,23.9C136.3,66.7,131.8,64.3,128.9,60.7"/>
            <rect x="167" y="1.4" class="logo-fill" width="11" height="64.2"/>
            <path class="logo-fill" d="M195.7,65.5h-11V19.7h11V65.5z M195.7,12.6h-11V1.4h11V12.6z"/>
            <path class="logo-fill" d="M235.1,36.3c-1.6-4.9-5.1-8.3-10.7-8.3c-7.3,0-12,5.4-12,14.6s4.7,14.6,12,14.6c6.3,0,9.4-3.7,11-7.8l8.9,4.7
            c-2.1,4.9-8.4,12.6-20.1,12.6c-13.3,0-22.6-8.5-22.6-23.9c0-15.4,9.9-24.2,22.6-24.2c10.7,0,17.4,5.7,20.1,12.9L235.1,36.3z"/>
          </g>
        </svg>

      </a>
    </div>

    <div id="show-menu">
      <!--<span>Menu</span>-->
      <!--<span class="line"></span>
      <span class="line"></span>-->

      <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <title>menu-icon</title>
        <!--<path class="fill" d="M25,5A20,20,0,1,0,45,25,20,20,0,0,0,25,5ZM35,30.93H15v-2H35Zm0-10H15v-2H35Z"/>-->
        <circle class="fill" cx="25" cy="25" r="25"/>
      </svg>
    </div>


  <!-- <nav class="nav-primary">
      <?php
  //  if (has_nav_menu('primary_navigation')) :
  //  wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
  //  endif;
  ?>
    </nav> -->

  </div>

</nav>
