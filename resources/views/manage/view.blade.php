<?php   use \App\Http\Controllers\ManageController; ?>
@extends('layouts.manage')
@section('content')


<!-- BEGIN: Top Bar -->
<div class="top-bar">
@foreach($sermons as $sermon)
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sermons</a>  <i data-feather="chevron-right" class="breadcrumb__icon"></i>{{ strip_tags(htmlspecialchars_decode(substr($sermon->topic, 0,70) ))}}... </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/profile-12.jpg') }}">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium"> {{ Auth::user()->name }}</div>
                                    <div class="text-xs text-theme-41"> {{ Auth::user()->role }}</div>
                                </div>
                                <div class="p-2">
                                    <a href="/manage/users/edit/{{Auth::user()->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                    <a href="add_user" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                    <a href="/manage/users/edit/{{Auth::user()->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                 </div>
                                <div class="p-2 border-t border-theme-40">
                                
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>    <!-- END: Notifications -->
                   
                </div>
                <!-- END: Top Bar -->




              
               

       

                <div class="intro-y news p-5 box mt-8">

                
                    <!-- BEGIN: Blog Layout -->
                    <h2 class="intro-y font-medium text-xl sm:text-2xl">
                    {{ ucfirst($sermon->topic) }}
                    </h2>
                    
                    <div class="intro-y text-gray-700 mt-3 text-xs sm:text-sm"> <a class="text-theme-1" href="">Date Posted</a> <span class="mx-1">•</span>  {{ $sermon->created_at }} <span class="mx-1">•</span> <a class="text-theme-1" href="">Author</a> <span class="mx-1">•</span> {{ $sermon->author }} <span class="mx-1">•</span> <a class="text-theme-1" href="">Posted by</a> <span class="mx-1">•</span> {{ ucwords($sermon->user_id) }}</div>

                    <br/>

                    <div class="intro-y text-justify leading-relaxed">
                   

                  <?php echo stripslashes($sermon->sermon); ?>
                              </div>
                    
                   
                    
                  
                    
                    <!-- END: Blog Layout -->
                    <!-- BEGIN: Comments -->
                   
                   
                  
                    <!-- END: Comments -->
                </div>
  @endforeach
               
@endsection