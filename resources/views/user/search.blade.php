@extends('layouts.manage')
@section('content')


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sermons</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Search</div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        <form method="GET" action="/user/search">
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
               
            
           
                <div class="grid grid-cols-12 gap-6 mt-5">

               
                       
                   
                    <!-- BEGIN: Data List -->


                    
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                    
                        
               

                    <?php if($sermons->count()<1){?>

                        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> No records found </div>

                    <?php }else{?>
     
                        
                    @foreach ($sermons as $sermon)
               

                    <div class="intro-y">
                                    <a href="/user/sermons/view/{{ $sermon->id}}">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                       
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ strip_tags(htmlspecialchars_decode($sermon->topic ))}}</div>

                                           
                                            <div class="text-gray-600 text-xs">
                                                <br/>
                                            {{ strip_tags(htmlspecialchars_decode(substr($sermon->sermon, 0,400) ))}}...</div>
                                        <div class="flex text-gray-600 truncate text-xs mt-1"> 
                                            <a class="text-theme-1 inline-block truncate" href="">Posted</a> <span class="mx-1">•</span> 49 seconds ago  
                                            <a class="text-theme-1 inline-block truncate" href="" style="padding-left:10px">Author</a> <span class="mx-1">•</span> {{$sermon->author }}
                                        </div>
                               </div>     
                                       
                                     </div>
                                  </a>
                                </div>     
                                 
                            @endforeach
                    
                                    <?php }?>
                    
                   
                        
                   
                  


                    
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
                <div class="modal" id="delete-confirmation-modal">
                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->
            
@endsection