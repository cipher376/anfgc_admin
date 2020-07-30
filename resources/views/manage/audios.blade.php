@extends('layouts.manage')
@section('content')


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Audios</a> </div>
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
                    </div>
                    <!-- END: Account Menu -->
                </div>

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
                <!-- END: Top Bar -->
                <h2 class="intro-y text-lg font-medium mt-10">
                 Playlists
                </h2>

                <div class="intro-y text-gray-700 mt-3 text-xs sm:text-sm"> <a class="text-theme-1" href="">Free</a> <span class="mx-1">•</span> <a class="text-theme-1" href="">Premium</a>  </div>

<br/><form method="POST" action="{{route('audios.multipledel')}}">
{{ csrf_field() }}
                <a href="add_audio" class="button text-white bg-theme-1 shadow-md mr-2">Add Audio </a>
                <button class="button w-24 mr-1 mb-2 border text-gray-700" name="action" value="deleteall">Delete</button> 
                <?php if($audios->count()<1){?>
                                <div class="rounded-md px-5 py-4 mb-2 bg-gray-200 text-gray-600" style="text-align:center">
                               --  Audio List is empty -- <br/> <br/>
                                 </div>
                                    <?php }?>
                <div class="grid grid-cols-12 gap-6 mt-5">

                <!-- BEGIN: Data List -->

              
                       
                  @foreach($audios as $audio)

                            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                    <div class="absolute left-0 top-0 mt-3 ml-3">
                                        <input name="audio[]" class="input border border-gray-500" type="checkbox"  value="{{$audio->id}}">
                                        
                                    </div>
                                   <a href="/manage/audio/listen/{{$audio->id}}">
                                   
                                    <img alt="" class="rounded-t-md" src="{{ URL::asset('photos') }}/{{$audio->imgname}}" >
                </a>
                                    
                                    <a href="" class="block font-medium mt-4 text-center truncate">{{ $audio->title}}</a> 
                                    <div class="text-gray-600 text-xs text-center">{{ ucwords($audio->artist)}}</div>
                                    <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                                            <div class="dropdown-box__content box p-2">
                                                 <a href="/manage/audio/delete/{{$audio->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4 mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Delete </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                
                            </div>
                            @endforeach
                   
                  
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
                </form>
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