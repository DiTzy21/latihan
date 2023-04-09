<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>chic.co</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container mx-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('images/logo.png')}}" width="200" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    
                    </ul>
                    <ul class="navbar-nav mx-auto">
                    <li class="nav-item ms-5">
                            <a class="nav-link text-white"   href="{{url('home')}}">Home</a>
                        </li>
                        <li class="nav-item ms-5 " >
                            <a class="nav-link text-white" href="{{url('product')}}">Product</a>
                        </li>
                        <li class="nav-item ms-5 " >
                            <a class="nav-link text-white" href="{{ url('history') }}">History</a>
                        </li>


                        
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <?php

                            use Illuminate\Support\Facades\Auth;

                            $pesanan_utama = \App\Models\Pesanan::where('user_id', Auth::user()->id ?? "")->where('status', 0)->first();
                            if(!empty($pesanan_utama))
                            {
                            $notif = 0; // set default value
                            if ($pesanan_utama) { // check if $pesanan_utama is not null
                                $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count();
                            }}
                            ?>


                            <a class="nav-link" href="{{ url('check-out') }}">
                                <i class="fa fa-shopping-cart"></i>
                                @if(!empty($notif))
                                <span class="badge bg-danger">{{$notif}}</span>
                                @endif
                            </a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @include('sweetalert::alert')
        </main>
    </div>
</body>

</html>