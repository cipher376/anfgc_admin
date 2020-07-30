@extends('layouts.manage')
@section('content')


<!-- BEGIN: Top Bar -->
@foreach($churches as $church)
<div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="/manage/churches/view/{{ $church->id }}" class="breadcrumb--active">{{ $church->name }}</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Photo</div>
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
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
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
                    <!-- END: Notifications -->
                   
                </div>
                <!-- END: Top Bar -->




                
                <div class="flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Add Photo
                    </h2>

                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        
                    </div> 
                    
             
                </div>



                <div class="intro-y box py-10 sm:py-8 mt-5">
             
             <div class="px-5 sm:px-20 mt-10 pt-3 border-gray-200" >
                 <form method="POST" action="" enctype="multipart/form-data">
               
                 @if ($errors->any())

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </Ol>
    </div>
@endif


@if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif


                 <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                 {{ csrf_field() }} 
                 <div class="intro-y col-span-12 sm:col-span-12">
                         <div class="mb-2">Title</div>
                         <input name="title" type="text" class="input w-full border flex-1" placeholder="Title of photo" value="{{ old('title') }}">
                         <input name="church" type="hidden" class="input w-full border flex-1" value="{{ $church->id }}">
                        
                        
                        </div>


                   
                     
                     <div class="intro-y col-span-12 sm:col-span-12">
                     <div class="mb-2">Caption</div>
                    <textarea data-feature="basic" class="summernote" name="caption">{{ old('caption') }}</textarea>

                     </div>

                     <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-6">Upload Photograph</div>
                            
                        <input name="file" type="file"   /> </div>
                    
                     <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        
                         <button class="button w-40 shadow-md mr-1 mb-2 bg-theme-9 text-white">Save </button>
                     </div>
                 </div>
             </div>
</form>
         </div>


         


@endforeach
                

               
@endsection