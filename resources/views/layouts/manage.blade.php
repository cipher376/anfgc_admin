

<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ app()->getLocale() }}">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Manage') }}</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                        <a href="/manage" class="menu menu--active">
                            <div class="menu__icon"> <i data-feather="archive"></i> </div>
                            <div class="menu__title"> Dashboard </div>
                        </a>
                    </li>
                   
               
               
                <li>
                        <a href="/manage/sermons" class="menu">
                            <div class="menu__icon"> <i data-feather="file"></i> </div>
                            <div class="menu__title"> Sermons </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-file-manager.html" class="menu">
                            <div class="menu__icon"> <i data-feather="video"></i> </div>
                            <div class="menu__title"> Videos </div>
                        </a>
                    </li>
                    <li>
                        <a href="/manage/audios" class="menu">
                            <div class="menu__icon"> <i data-feather="music"></i> </div>
                            <div class="menu__title"> Audios</div>
                        </a>
                    </li>
                    <li>
                        <a href="/manage/churches" class="menu">
                            <div class="menu__icon"> <i data-feather="home"></i> </div>
                            <div class="menu__title"> Branches </div>
                        </a>
                    </li>
                   
                   
                    <li>
                        <a href="/manage/users" class="menu">
                            <div class="menu__icon"> <i data-feather="users"></i> </div>
                            <div class="menu__title"> Users  </div>
                        </a>
                        
                    </li>
               
        
            
             
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src=" {{ asset('dist/images/logo.svg') }} ">
                    <span class="hidden xl:block text-white text-lg ml-3"> Mid<span class="font-medium">one</span> </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="/manage" class="side-menu side-menu--active">
                            <div class="side-menu__icon"> <i data-feather="archive"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                   
                    <li>
                        <a href="/manage/sermons" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="file"></i> </div>
                            <div class="side-menu__title"> Sermons </div>
                        </a>
                    </li> 
                    <li>
                        <a href="/manage/churches" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Branches </div>
                        </a>
                    </li>
                    <li>
                        <a href="/manage/video_list" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="video"></i> </div>
                            <div class="side-menu__title"> Videos </div>
                        </a>
                    </li>
                    <li>
                        <a href="/manage/audios" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="music"></i> </div>
                            <div class="side-menu__title"> Audios</div>
                        </a>
                    </li>
                   <?php if(Auth::user()->role=="manage"){ ?>
                    <li>
                        <a href="/manage/users" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Users  </div>
                        </a>
                        
                    </li>
                   <?php }?>
                    <li class="side-nav__devider my-6"></li>
                   
                   
                   
                   
                   
                   
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
            @yield('content')
</div>
            <!-- END: Content -->
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
</html>