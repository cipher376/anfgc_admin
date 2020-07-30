@extends('layouts.userinter')
@section('title')
    <title>  Now Playing...  </title>
@endsection
@section('content')

                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Audio</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Now Playing </div>
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
                                    <div class="text-xs text-theme-41"> <?php if(Auth::user()->role=="manage"){ echo"Super Admin"; }else if(Auth::user()->role=="manage-sub"){ echo"Admin";} ?></div>
                                </div>
                                <?php if(Auth::user()->role=="manage"){ ?>
                                <div class="p-2">
                                    <a href="/manage/users/edit/{{Auth::user()->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                    <a href="add_user" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                    <a href="/manage/users/edit/{{Auth::user()->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                 </div>
                                <?php }?>
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
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <!-- BEGIN: General Report -->
                     
                            
                        @foreach($lists as $list)
                            <div class="col-span-12 xl:col-span-8 mt-6">

                            <h2 class="text-lg font-medium truncate mr-5">
                                    {{  ucwords($list->artist)}} || {{  ucwords($list->title)}}
                                </h2>
                                
                            
                            <div class="intro-y box p-5 mt-12 sm:mt-5">
                                

                                <img style="max-width: 100%;max-height: 100%; display: block;" alt="" class="rounded-t-md" src="{{ URL::asset('photos') }}/{{$list->imgname}}" style="height:200px" >

                                

                               
                               
                               
                           

                                <audio controls style="width:100%">
  
  <source src="{{ URL::asset('audios') }}/{{$list->audioname}}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
                            </div>
                        </div>
                        @endforeach 
                        <div class="col-span-12 xl:col-span-4 mt-6">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Playlists
                                </h2>
                            </div>
                            <div class="mt-5">

                            <?php if($audios->count()<1){ ?>
                                <div class="rounded-md px-5 py-4 mb-2 bg-gray-200 text-gray-600" style="text-align:center">
                               --  Playlist is empty -- <br/> <br/>
                                <?php }?>
                            @foreach($audios as $audio)
                                <div class="intro-y">
                                    <a href="/user/audio/listen/{{$audio->id}}">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                        
                                            <img src="{{ URL::asset('photos') }}/{{$audio->imgname}}"  >
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{substr($audio->title, 0,25) }}...</div>
                                            <div class="text-gray-600 text-xs">{{$audio->artist}}</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">Play</div>
                                    </div>
                                </a>
                                </div>
                                @endforeach
                               
                               
                               
                                <a href="/user/audios" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 text-theme-16">View More</a> 
                            </div>
                        </div>
                               
                            
                        </div>
                        <!-- END: General Report -->
                        <!-- BEGIN: Sales Report -->
                        
                        
                        <!-- END: Weekly Top Seller -->
                        <!-- BEGIN: Sales Report -->
                        
                        <!-- END: Sales Report -->
                        <!-- BEGIN: Official Store -->
                        
                        <!-- END: Official Store -->
                        <!-- BEGIN: Weekly Best Sellers -->
            
                        <!-- END: Weekly Best Sellers -->
                        <!-- BEGIN: General Report -->
                      
                        <!-- END: General Report -->
                        <!-- BEGIN: Weekly Top Seller -->
                      
                        <!-- END: Weekly Top Seller -->
                    </div>
                    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                           
                          
                            <!-- END: Important Notes -->
                            <!-- BEGIN: Schedules -->
                   
                            <!-- END: Schedules -->
                        </div>
                    </div>
                </div>
          
@endsection