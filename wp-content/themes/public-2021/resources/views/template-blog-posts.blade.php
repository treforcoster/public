{{--
  Template Name: Blog Posts Template
--}}

@extends('layouts.full-width-black')

@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div id="page" class="blog">

  <?php

    $count =0;

  // Check rows exists.
  if (have_rows('post_group')) :
    // Loop through rows.
    while (have_rows('post_group')) : the_row();?>

     <?php if (!$count % 2 == 0) { ?>

        <div class="row align-items-end">

          <div class="col-lg-6">

            <?php
            $postFormat = 'b';
            $imageSize = 'blog-image-2';
            $postClass = "blog-post-2 loop-2";
            ?>

            @include('partials.post')

          </div>

          <div class="col-lg-6 offset-lg-1">

            <?php
            $postFormat = 'a';
            $imageSize = 'blog-image-1';
            $postClass = "blog-post-1 loop-2";
            ?>

            @include('partials.post')

          </div>

        </div>

        <div class="row">

          <div class="col-lg-12 offset-lg-4">

            <?php
            $postFormat = 'c';
            $imageSize = 'blog-image-3';
            $postClass = "blog-post-3 loop-2";
            ?>

            @include('partials.post')

          </div>

          <div class="col-lg-9 offset-lg-3">

            <?php
            $postFormat = 'd';
            $imageSize = 'blog-image-4';
            $postClass = "blog-post-4 loop-2";
            ?>

            @include('partials.post')

           </div>

        </div>


     <?php } else { ?>

    <div class="row align-items-end">

        <div class="col-lg-6 offset-lg-3">

          <?php
          $postFormat = 'a';
          $imageSize = 'blog-image-1';
          $postClass = "blog-post-1 loop-1";
          ?>

          @include('partials.post')

        </div>

        <div class="col-lg-6 offset-lg-1">

          <?php
          $postFormat = 'b';
          $imageSize = 'blog-image-2';
          $postClass = "blog-post-2 loop-1";
          ?>

          @include('partials.post')

        </div>

        <div class="col-lg-12">

          <?php
          $postFormat = 'c';
          $imageSize = 'blog-image-3';
          $postClass = "blog-post-3 loop-1";
          ?>

          @include('partials.post')

        </div>

        <div class="col-lg-9 offset-4">

          <?php
          $postFormat = 'd';
          $imageSize = 'blog-image-4';
          $postClass = "blog-post-4 loop-1";
          ?>

          @include('partials.post')

        </div>

    </div>


     <?php } ?>

  <?php $count ++; ?>


  <?php  endwhile;

// No value.
  else :
    // Do something...
  endif;?>


  </div>

  @endwhile
@endsection


