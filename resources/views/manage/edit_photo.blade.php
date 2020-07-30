@extends('layouts.manage')
@section('content')


<!-- BEGIN: Top Bar -->
@foreach($churches as $church)
<div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="/manage/churches/view/{{ $church->id }}" class="breadcrumb--active">{{ $church->name }}</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Edit Photo</div>
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
                    <!-- END: Notifications -->
                   
                </div>
                <!-- END: Top Bar -->




                
                <div class="flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Edit Photo
                    </h2>

                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        
                    </div> 
                    
             
                </div>



               

         <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                           
                            <div class="p-5">

                            <form method="POST" action="" enctype="multipart/form-data">
                            {{ method_field("PUT")}}
               
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

@foreach($photos as $photo)

                                <div class="grid grid-cols-12 gap-5">
                                {{ csrf_field() }} 
                                    <div class="col-span-12 xl:col-span-4">
                                        <div class="border border-gray-200 rounded-md p-5">
                                            <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img id="blah" alt="" class="rounded-md" src="{{ URL::asset('churchPhoto') }}/{{$photo->filename}}">
                           
                                                                                          </div>
                                            <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                                <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                                                <input name="file" type="file" onchange="readURL(this);" class="w-full h-full top-0 left-0 absolute opacity-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-8">
                                        <div>
                                            <label>Title</label>
                                            <input name="title" type="text" class="input w-full border bg-gray-100 mt-2" placeholder="Input text" value="{{$photo->title}}">
                                        </div>
                                       
                                       
                                        <div class="mt-3">
                                            <label>Caption</label>
                                            <textarea name="caption" class="input w-full border mt-2" placeholder="Adress" rows="10">{{ strip_tags(htmlspecialchars_decode($photo->caption)) }}</textarea>
                                        </div>
                                        <button class="button w-40 shadow-md mr-1 mb-2 bg-theme-9 text-white">Save </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                                                
                        </div></form>
                        <!-- END: Display Information -->
                        
                    </div>       


@endforeach
                

               
@endsection

<script type="text/javascript">
	function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	

</script>