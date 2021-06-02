{{--
  Template Name: About Template
--}}

@extends('layouts.full-width-white')



@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div id="page" class="about">

  @include('partials.page-header')
  @include('partials.content-page')

  </div>
  @endwhile
@endsection


