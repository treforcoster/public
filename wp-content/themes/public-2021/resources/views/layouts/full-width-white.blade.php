<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')

    <div data-barba="wrapper">

      <div class="wrap loaded-content container-fluid page-white" role="document" data-barba="container">
            @yield('content')
      </div>

      @include('partials.footer')

    </div>

    @php do_action('get_footer') @endphp

    @php wp_footer() @endphp

  </body>
</html>
