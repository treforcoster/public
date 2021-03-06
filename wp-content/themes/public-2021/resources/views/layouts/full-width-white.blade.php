<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')

    <div data-barba="wrapper">

      <div class="wrap" role="document" data-barba="container">

        <div class="loaded-content container-fluid page-white">

          @yield('content')

        </div>

        @include('partials.footer')

      </div>



    </div>

    @php do_action('get_footer') @endphp

    @php wp_footer() @endphp

    @include('components.loading-animation')

    @include('components.anim-overlay')

  </body>
</html>
