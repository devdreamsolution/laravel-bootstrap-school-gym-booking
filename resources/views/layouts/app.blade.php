<!doctype html>
<html lang="en">
   <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/plugins/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />     

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
   </head>
   <body>

        <nav class="navbar navbar-dark bg-dark navbar-expand-lg"> 
            <div class="container">
                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">Booking</a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">Home</a>
                @endguest
                
                <ul class="navbar-nav navbar-right ml-auto">    
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
                        <li class="nav-item pl-4 pl-1">
                            <span class="navbar-text text-white">Hi <span class="k">{{ Auth::user()->name }}</span>!</span>
                        </li>         
                        <li class="nav-item">                            
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                             </form>
                        </li>
                    @endguest    
                </ul> 
            </div>         
        </nav>        

        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div> 

        @include('parts.modals')

        <!-- JavaScript -->       
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/plugins/mask/jquery.mask.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        @yield('extra-js')

   </body>
</html>