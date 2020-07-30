@extends('layouts.userinter')
@section('title')
    <title> User | Sermons  </title>
@endsection
@section('content')


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sermons</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Search</div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        <form method="GET" action="user/search">
                            <input name="search-term" type="text" class="search__input input placeholder-theme-13" placeholder="Search...">
                           
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search search__icon"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> 
                       
</form> </div>
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
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->
                <br/>
               


@if($errors->any())
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
      <li>  {{$errors->first()}}</li>
        </Ol>
    </div>

@endif

                @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif
                <h2 class="intro-y text-lg font-medium mt-10">
                   Sermons
                </h2>
<br/>
<form method="POST" action="{{route('sermons.postallow')}}">
{{ csrf_field() }} 
                
                <div class="grid grid-cols-12 gap-6 mt-5">

               
                       
                   
                    <!-- BEGIN: Data List -->


                    
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                   
                        
                  
     
                    @foreach ($sermons as $sermon)
                   

                            <div class="intro-y">
                                    <a href="/user/sermons/view/{{ $sermon->id}}">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                       
                                        <div class="ml-4 mr-auto" style="font-size:14px">
                                            <div class="font-medium">{{ strip_tags(htmlspecialchars_decode($sermon->topic ))}}</div>

                                           
                                            <div class="text-gray-600 text-xs" style="font-size:14px">
                                                <br/>
                                            {{ strip_tags(htmlspecialchars_decode(substr($sermon->sermon, 0,400) ))}}...</div>
                                            <br/>
                                        <div class="flex text-gray-600 truncate text-xs mt-1"> 
                                            <a class="text-theme-1 inline-block truncate" href="">Posted</a> <span class="mx-1">•</span><b>{{ \Carbon\Carbon::parse($sermon->created_at)->diffForHumans() }} </b> 
                                            <a class="text-theme-1 inline-block truncate" href="" style="padding-left:10px">Author</a> <span class="mx-1">•</span><b> {{$sermon->author }}</b>
                                        </div>
                               </div>     
                                       
                                     </div>
                                  </a>
                                </div>


                            @endforeach
            
                   
                   
                        
                   
                   

                   
                    </form>
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                    {{ $sermons->links() }}
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->
            
@endsection

