{{--
  Template Name: About Template
--}}

@extends('layouts.full-width-white')



@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div id="page" class="about">

    @if(have_rows('content'))
      {{-- loop through the rows of data --}}
      @while (have_rows('content')) @php(the_row())

      @if(get_row_layout() == 'text')

        @include('components.section-text')

      @endif

      @if(get_row_layout() == 'logos_text')

        @include('components.section-logos-text')

      @endif

      @endwhile
    @else
      {{-- no layouts found --}}
    @endif

  </div>
  @endwhile
@endsection


