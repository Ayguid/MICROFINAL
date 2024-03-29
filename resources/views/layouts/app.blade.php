<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-LJ40THSHVV"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LJ40THSHVV');
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="base-url" content="{{ url('') }}" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
window.Laravel = {!! json_encode([
  'csrfToken' => csrf_token(),
  'apiToken' => $currentUser->api_token ?? null,
  'user' =>  Auth::user(),
  ]) !!};
  </script>
  <title>{{ config('app.name', 'MICRO') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Fonts -->
  {{-- <script src="https://kit.fontawesome.com/6a953b9625.js"></script> --}}
  <script src="{{ asset('js/kit-fontAwesome.js') }}"></script>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="https://ar.microautomacion.com/wp-content/themes/micro-theme/dist/img/favicon/favicon-32x32.png" type="image/x-icon">
  <link rel="icon" href="https://ar.microautomacion.com/wp-content/themes/micro-theme/dist/img/favicon/favicon-32x32.png" type="image/x-icon">

</head>
<body>
  @php
  $sub = '';
  $text = '';
  switch (config('app.locale')) {
    case 'es':
    $sub = 'inicio';
    $text = 'Web corporativa';
    break;
    case 'pt':
    $sub = 'inicial';
    $text = 'Web corporativa';
    break;
    case 'en':
    $sub = 'home';
    $text = 'Corporate web';
    break;
    default:
    break;
  }
  $dir = 'https://'.session('country')->country_shortcode.'.microautomacion.com/'.config('app.locale').'/'.$sub.'/';
  @endphp

  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">

        <a class="navbar-brand" href="{{ route('countryLanding')}}">
          {{-- {{ config('app.name', 'Laravel') }} --}}

          <img width="130"  class="d-inline-block align-center" src="{{asset('images/logos/logo-micro-'.config('app.locale').'.jpg')}}" alt="">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ config('app.locale')}}
                {{-- {{LaravelLocalization::getCurrentLocale()}} --}}
                {{-- {{Lang::get('messages.language')}} --}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                  </a>&nbsp;
                @endforeach
              </div>
            </li>



            <li class="nav-item dropdown">
              @if (session('country'))

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{session('country')->country_desc}}
                </a>
              @endif
              <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <a class="dropdown-item" href="{{route('landing')}}">{{ Lang::get('messages.change_country')}}</a>
                {{-- {{ Lang::get('messages.change_country')}} --}}

              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{$dir}}" target="_blank">{{$text}}</a>
            </li>

          </ul>

          <!-- Right Side Of Navbar -->

          {{--visible en vista con nav completo--}}
          {{-- <search-component class="d-none d-md-block " :consulturl='{{json_encode(route('findProduct'))}}'></search-component> --}}

          <div class="">
            <form id="searchForm" action="{{route("findProduct")}}" method="get" class="form-inline my-2 my-lg-0">
              {{-- @csrf --}}
              <input class="form-control mr-sm-2" type="search" placeholder="0.000.000.000" aria-label="search" name="query">
              <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">{{__('Search')}}</button>
            </form>

          </div>

          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
              @endif
            @else

              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                  <a href="{{route('home')}}" class="dropdown-item">Home</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest

        </ul>
        {{--visible en menu desplegable --}}
        {{-- <search-component class="d-md-none" :consulturl='{{json_encode(route('userFindProduct', session('country')->country_shortcode))}}'></search-component> --}}
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
    {{-- {{Auth::user()}} --}}
  </main>
  {{-- @php
  $country = App\Models440\Country::find(session('country')->id);
@endphp
<a href="https://wa.me/{{$country->telephone}}" class="wassapfloat wassap-hide" target="_blank">
<i class="fab fa-whatsapp my-wassapfloat"></i>
</a> --}}





{{-- <footer class="footer">
  <div class="container">
    <span class="text-muted"> <a href="{{$dir}}" target="_blank">BACK</a> </span>
  </div>
</footer> --}}

</div>

</body>
</html>
