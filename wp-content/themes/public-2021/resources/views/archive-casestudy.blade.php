@extends('layouts.full-width')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif



  @while (have_posts()) @php the_post() @endphp



  <div class="row justify-content-end">

    <div class="col-lg-13">

    @include('partials.content-'.get_post_type())

    </div>

  </div>
  @endwhile


  {!! get_the_posts_navigation() !!}
@endsection

