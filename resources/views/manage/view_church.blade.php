<?php   use \App\Http\Controllers\ManageController; ?>
@extends('layouts.manage')
@section('content')


<!-- BEGIN: Top Bar -->
<div class="top-bar">
@foreach($churches as $church)
<?php $services=ManageController::showServices($church->id) ?>
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Administration</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="/manage/churches" class="breadcrumb--active">Branch</a>  <i data-feather="chevron-right" class="breadcrumb__icon"></i>{{ strip_tags(htmlspecialchars_decode(substr($church->name, 0,70) ))}} </div>
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
                    </div><!-- END: Notifications -->
                   
                </div>
                <!-- END: Top Bar -->
                @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif




              
               
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto" style="font-size:25px">
                    {{ ucfirst($church->name) }}
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       <a href="/manage/churches/gallery/2">
                            <button class="button text-white bg-theme-1 shadow-md mr-2">Photo Archive</button>
</a>
                        <div class="dropdown relative ml-auto sm:ml-0">
                            <button class="dropdown-toggle button px-2 box text-gray-700">
                                <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
                            </button>
                            <div class="dropdown-box mt-10 absolute w-40 top-0 right-0 z-20">
                                <div class="dropdown-box__content box p-2">
                                    <a href="/manage/churches/photo/{{ $church->id }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="image" class="breadcrumb__icon"></i>  New Photo</a>
                                    <a href="/manage/churches/gallery/{{ $church->id }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="breadcrumb__icon"></i>  Church Photos </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="list" class="breadcrumb__icon"></i>  Add Services </a>
                               
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       

                <div class="intro-y news p-5 box mt-8">

                
                    <!-- BEGIN: Blog Layout -->
                   
                    
                   
                    <div class="intro-y text-gray-700 mt-3 text-xs sm:text-sm">
                         <a class="text-theme-1" href="">Date Posted</a> <span class="mx-1">•</span>  {{ $church->created_at }} 
                        
                        
                        </div>

<br/>
                    <div class="intro-y text-justify leading-relaxed">

                    
                   

                   {{ strip_tags(htmlspecialchars_decode($church->note)) }}
                              </div>



                              <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

          <br/>       
<div class="font-extrabold">Country</div>
                             </div>
          </div>

          <div class="intro-y text-justify leading-relaxed">

                   
                  

{{ strip_tags(htmlspecialchars_decode($church->country)) }}
          </div>




                              <div class="intro-y text-justify leading-relaxed">

                    
                   
 <div class="intro-y text-justify leading-relaxed">

           <br/>       
 <div class="font-extrabold">Branch Location </div>
                              </div>
           </div>

           <div class="intro-y text-justify leading-relaxed">

                    
                   

{{ strip_tags(htmlspecialchars_decode($church->location)) }}
           </div>

           <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

          <br/>       
<div class="font-extrabold">Pastor In-charge </div>
                             </div>
          </div>

          <div class="intro-y text-justify leading-relaxed">

                   
                  

{{ strip_tags(htmlspecialchars_decode($church->pastor)) }}
          </div>
          <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

          <br/>       
<div class="font-extrabold">Phone </div>
                             </div>
          </div>

          <div class="intro-y text-justify leading-relaxed">

                   
                  

{{ strip_tags(htmlspecialchars_decode($church->phone)) }}
          </div>


          <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

          <br/>       
<div class="font-extrabold">Email </div>
                             </div>
          </div>

          <div class="intro-y text-justify leading-relaxed">

                   
                  

{{ strip_tags(htmlspecialchars_decode($church->email)) }}
          </div>


           <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

          <br/>       
<div class="font-extrabold">Extablished Date </div>
                             </div>
          </div>

          <div class="intro-y text-justify leading-relaxed">

                   
                  

{{ strip_tags(htmlspecialchars_decode($church->est_date)) }}
          </div>

          
                    
          <br/>       
   
          <div class="intro-y text-justify leading-relaxed">

                    
                   
<div class="intro-y text-justify leading-relaxed">

 
                             </div>
          </div>
          
          
                    <!-- END: Blog Layout -->
                    <!-- BEGIN: Comments -->
                   
                   
                  
                    <!-- END: Comments -->
                </div>


                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <!-- BEGIN: Single Item -->
                        
                        <!-- END: Single Item -->



                        <div class="intro-y box mt-5">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Branch Services
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                               

                                    <div class="mr-3"><a  href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button w-30 shadow-md mr-1 mb-2 bg-gray-200 text-gray-600">Add Service</a></div>
                              
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                            
                            <div class="overflow-x-auto" style="width:100%">
     <table class="table " >
         <thead>
             <tr>
                
                 <th class="border-b-2 whitespace-no-wrap">Time</th>
                 <th class="border-b-2 whitespace-no-wrap">Programe</th>
                 <th class="border-b-2 whitespace-no-wrap">Duration</th>
                 <th class="border-b-2 whitespace-no-wrap"></th>
             </tr>
         </thead>
         <tbody>
<?php 
             foreach($services as $service){?>
             <tr>
             
                 <td class="border-b"><?php echo $service->month; ?></td>
                 <td class="border-b"><?php echo $service->title; ?></td>
                 <td class="border-b"><?php echo $service->time; ?></td>
                 <td class="border-b"><a href="/manage/services/delete/{{ $service->id}}"><button class="button px-2 mr-1 mb-2 bg-theme-6 text-white"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="trash" class="w-4 h-4"></i> </span> </button></a></td>
             </tr>
                                <?php }?>
            
         </tbody>
     </table>
    
 </div>
                               
                            </div>
                          
                        </div>



                        <!-- BEGIN: Multiple Item -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Photos
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                <?php if($photos->count() >0){?>

                                    <div class="mr-3"><a href="/manage/churches/gallery/{{ $church->id }}" class="button w-30 shadow-md mr-1 mb-2 bg-gray-200 text-gray-600">See All</a></div>
                                <?php }?>
                                </div>
                            </div>
                            <div class="p-5" id="multiple-item-slider">
                                <div class="preview">
                                    <?php if($photos->count()<1){?>
                                <div class="rounded-md px-5 py-4 mb-2 bg-gray-200 text-gray-600" style="text-align:center">
                                   No photo uploaded for Branch <br/> <br/>
                                    <a href="/manage/churches/photo/{{ $church->id }}" class="button text-white bg-theme-1 shadow-md mr-2"> Add Photo</a>
                                </div>
                                    <?php }?>
                                    <div class="slider mx-6 multiple-items">
                                        @foreach($photos as $photo)
                                        <div class="h-32 px-2">
                                            <div class="h-full bg-gray-200 rounded-md">
                                            <img alt="" class="rounded-t-md" src="{{ URL::asset('churchPhoto') }}/{{$photo->filename}}">
                          
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    
                                       
                                    </div>
                                </div>
                               


                                <div class="modal" id="header-footer-modal-preview">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">Service</h2> 
             
         </div>
         <form  action="/manage/church/services/{{ $church->id }}" method="post">
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"> <label>Program Title</label> <input name="title" type="text" class="input w-full border mt-2 flex-1" placeholder="title"> </div>
             <div class="col-span-12 sm:col-span-6"> <label>Day/Month</label> <input name="month" type="text" class="input w-full border mt-2 flex-1" placeholder=""> </div>
             <div class="col-span-12 sm:col-span-6"> <label>Time</label> <input type="text" name="time" class="input w-full border mt-2 flex-1" placeholder=""> </div>
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Send</button> </div>
    </form>  </div>
 </div>

                            </div>
                        </div>
                        <!-- END: Multiple Item -->
                        <!-- BEGIN: Responsive Display -->
                        
                        <!-- END: Responsive Display -->
                    </div>
                   
                </div>

                
  @endforeach
               
@endsection