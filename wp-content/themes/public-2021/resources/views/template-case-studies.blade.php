{{--
  Template Name: Case Studies Template
--}}

@extends('layouts.full-width-white')



@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div id="page" class="casestudies">
  <?php
  $featured_posts = get_field('casestudies');
  if ($featured_posts) : ?>

    <?php foreach ($featured_posts as $post) :
    // Setup this post for WP functions (variable must be named $post).
    setup_postdata($post); ?>

  <div class="row justify-content-end">

    <div class="col-lg-15 col-xl-14 col-xxl-13">

      @include('partials.content-casestudy')

    </div>

  </div>

    <?php endforeach; ?>

  <?php
  // Reset the global post object so that the rest of the page works correctly.
  wp_reset_postdata(); ?>
  <?php endif; ?>

  </div>

  @endwhile
@endsection


