@extends('layouts.manage')
@section('content')
<?php $churchid=""; ?>


<!-- BEGIN: Top Bar -->
<div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    @foreach($churches as $church)
                   <?php  $churchid.=$church->id ?>
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">{{ $church->name}}</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Photos </div>
                    @endforeach
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
                    </div>        <!-- END: Notifications -->
                   
                </div>
                <!-- END: Top Bar -->

 @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
  </div>
@endif

                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
               
                    <h2 class="text-lg font-medium mr-auto">
                        Church Photos
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="/manage/churches/photo/{{ $churchid }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New Photo</a>
                       
                    </div>
                </div>
                <div class="intro-y grid grid-cols-12 gap-6 mt-5">
                    <!-- BEGIN: Blog Layout -->
                   
                   

                    

                    @foreach($photos as $photo)
 <div class="intro-y blog col-span-12 md:col-span-6 box">
                        <div class="blog__preview image-fit">
                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-t-md" src="{{ asset('dist/images/preview-12.jpg') }}">
                            <img alt="" class="rounded-t-md" src="{{ URL::asset('churchPhoto') }}/{{$photo->filename}}">
                            
                            <div class="absolute w-full flex items-center px-5 pt-6 z-10">
                                <div class="w-10 h-10 flex-none image-fit">
                                    <img alt="" class="rounded-full" src="{{ URL::asset('churchPhoto') }}/{{$photo->filename}}">
                                </div>
                                <div class="ml-3 text-white mr-auto">
                                    <a href="" class="font-medium">Post date</a> 
                                    <div class="text-xs">{{ $photo->created_at}}</div>
                                </div>
                                <div class="dropdown relative ml-3">
                                    <a href="javascript:;" class="blog__action dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full"> <i data-feather="more-vertical" class="w-4 h-4 text-white"></i> </a>
                                    <div class="dropdown-box mt-8 absolute w-40 top-0 right-0 z-20">
                                        <div class="dropdown-box__content box p-2">
                                            <a href="/manage/churches/{{ $photo->church_id}}/photo/edit/{{ $photo->id}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit Post </a>
                                            <a  id="deleteUser{{ $photo->id}}" data-userid="{{$photo->id}}" href="javascript:void(0)" onclick="showAlert({{ $photo->id}});" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"  data-toggle="modal" > <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete Post </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10">  <a href="" class="block font-medium text-xl mt-3">{{ $photo->title}}</a> </div>
                        </div>

                       
                        <div class="p-5 text-gray-700">{{ strip_tags(htmlspecialchars_decode(substr($photo->caption, 0,70) ))}}... </div></div>
                        
                       
                       
                  
                        
                        @endforeach
                       
                       
               
                    
                  
                    <!-- END: Blog Layout -->
                    <!-- BEGIN: Pagiantion -->
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
                       
                    </div>
                    <!-- END: Pagiantion -->
                    {{ $photos->links() }}
                </div>

                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>
                </form>


                <script>


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}

function senddel(){
    
    window.location="/manage/photo/delete/"+$('#app_id').val();
   
}
</script>

@endsection