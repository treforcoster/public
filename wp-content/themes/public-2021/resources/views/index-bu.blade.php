@extends('layouts.full-width-blog')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  <?php $postCount = 0 ?>
  <?php $positionCount = 0 ?>
  <?php $loop = "second" ?>

  <div class="row">

  @while (have_posts()) @php the_post() @endphp

    <?php if ($postCount % 4 == 0) { ?>

    <?php $positionCount = 0 ?>

    <?php $loop = "second" ?>

    <?php } ?>

    <?php if ($postCount % 8 == 0) { ?>

    <?php $loop = "first" ?>

    <?php }  ?>

    <?php //echo $loop ?>
    <?php //echo $positionCount ?>

    <?php if ($positionCount == 0 && $loop === "first") {?>

      <div class="col-lg-6 offset-lg-3">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 1 && $loop === "first") {?>

      <div class="col-lg-6 offset-lg-1">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>


    <?php if ($positionCount == 2 && $loop === "first") {?>

      <div class="col-lg-12">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 3 && $loop === "first") {?>

      <div class="col-lg-9 offset-4">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 0 && $loop === "second") {?>

      <div class="col-lg-6">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 1 && $loop === "second") {?>

      <div class="col-lg-6 offset-lg-1">

      @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 2 && $loop === "second") {?>

      <div class="col-lg-12 offset-lg-4">

        @include('partials.content-'.get_post_type())

      </div>

    <?php } ?>

    <?php if ($positionCount == 3 && $loop === "second") {?>

    <div class="col-lg-9 offset-lg-3">

      @include('partials.content-'.get_post_type())

    </div>

    <?php } ?>


    <?php $postCount ++ ?>
    <?php $positionCount ++ ?>
  @endwhile

  </div>

  {!! get_the_posts_navigation() !!}
@endsection

<!--<div class="container-fluid">
  <div class="row no-gutters">
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>

    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>
    <div class="col-1"><div class="col-inner">Col</div></div>

  </div>
</div>-->
