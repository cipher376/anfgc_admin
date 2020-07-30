<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SermonsTable;
use DB;


class ManageController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function index()
    {
        
        $sermons= DB::table('sermons')->get(); 
        $churches = DB::table('churches')->get();
        $users = DB::table('users')->get();
       
        return view('manage.index',['sermons'=>$sermons],['churches'=>$churches],['users'=>$users]);
    }


    public function add_photo($id)
    {
        $churches = DB::select('select * from churches where id='.$id);
        return view('manage.add_photo',['churches'=>$churches]);
    }

    public function add_premium()
    {
        
        return view('manage.add_premium_video');
    }

    public function video()
    {
        
        return view('manage.add_video');
    }

    public function allvideo()
    {
        
        $videos = DB::select('select * from videos');
        return view('manage.video_list',['videos'=>$videos]);
    }

    public function premiumvideo(){

        $videos = DB::select('select * from videos');
        return view('manage.premium_videos',['videos'=>$videos]);

    }

    public function sermons()
    {

    $sermons = DB::select('select * from sermons order by id DESC');
     
    return view('manage.sermons',['sermons'=>$sermons]);

    }


    public function listen_audio($id)
    {
       
        $audios= DB::table('audios')->where('id','!=', $id)->get(); 
        $lists = DB::select('select * from audios where id='.$id);
        return view('manage.listen_audio',['lists'=>$lists],['audios'=>$audios]);
    }

    public function gallery($id)
    {
    $churches = DB::select('select * from churches where id='.$id);
    //$photos = DB::select('select * from church_photos where church_id='.$id.' order by id DESC');
    $photos= DB::table('church_photos')->where('church_id', $id)->paginate(6);
     
    return view('manage.photo_list',['photos'=>$photos],['churches'=>$churches]);

    }


    public function edit_photo($church_id,$photo_id)
    {
    $photos= DB::table('church_photos')->where('id', $photo_id)->get();  
    $churches= DB::table('churches')->where('id', $church_id)->get(); 
    return view('manage.edit_photo',['churches'=>$churches],['photos'=>$photos]);

    }

    public function update_photo($church_id,$photo_id)
    {
        $validator=$this->validate(request(),[
            'title'=>'required|string',
            'caption'=>'required|string',
           // 'file' => 'required|mimes:jpeg,JPEG,png',
            ],
            [
                'title.required'=>'Enter a title for the photo you want to upload ',
                'caption.required'=>'Enter a caption for your photo  ',
               // 'file.required'=>'Please Upload a photo ',
                
                
                ]);

                if(count(request()->all()) > 0){

                    $file = request()->file('file');
                    $title = request()->input('title');
                    $caption= request()->input('caption');
                   


                    if(empty($file)){

                        DB::table('church_photos')->where('id', $photo_id)->update(['title' => $title, 'caption' => $caption]);
                    

                        return redirect()->back()->withSuccess('Update succesful.');
                    
                    }
                    else{ 
                        
                        ///// remove the existing file from folder /////////

                    $existFile=""; 
                    
                    $photos = DB::select('select * from church_photos where id='.$photo_id);
                    foreach($photos as $photo){
            
                        $existFile.=$photo->filename;
            
                    }

                    if(file_exists(public_path('churchPhoto/'.$existFile))){

                        unlink(public_path('churchPhoto/'.$existFile));
                  
                      }
                   
                  
                    //////// move file to upload folder ////////////////

            $original_name = strtolower(trim($file->getClientOriginalName()));
            $fileName =  time().rand(100,999).$original_name;
            $filePath = 'churchPhoto';
            $file->move($filePath,$fileName);
                

            //////////////// update database with new information ///////

            DB::table('church_photos')->where('id', $photo_id)
            ->update(['title' => $title, 'caption' => $caption,'filename' => $fileName]);
                     

           return redirect()->back()->withSuccess('Update succesful.');






                    }



                }





    }




    public function add_sermons()
    {
        return view('manage.add_sermon');
    }



    public function store_photo($id)
    {

        $validator=$this->validate(request(),[
            'title'=>'required|string',
            'caption'=>'required|string',
            'file' => 'required|mimes:jpeg,JPEG,png',
            ],
            [
                'title.required'=>'Enter a title for the photo you want to upload ',
                'caption.required'=>'Enter a caption for your photo  ',
                'file.required'=>'Please Upload a photo ',
                
                
                ]);


                if(count(request()->all()) > 0){

                    ////// move file to upload folder ////////////////

                    $file = request()->file('file');
                    $original_name = strtolower(trim($file->getClientOriginalName()));
                    $fileName =  time().rand(100,999).$original_name;
                    $filePath = 'churchPhoto';
                    $file->move($filePath,$fileName);
        
                    //////////// create data //////////////////////
        
                    $title = request()->input('title');
                    $caption = request()->input('caption');
                    $church = request()->input('church');
                    $files =  $fileName;
                    $created= date('Y-m-d H:i:s');
                    $data=array('title'=>$title,"caption"=>$caption,"filename"=>$files,"church_id"=>$church,'created_at'=>$created);
                    DB::table('church_photos')->insert($data);
        
        
                   ////////// redirect to url //////////////////////////
        
                   return redirect()->back()->withSuccess('Photo uploaded succesfully');
                        
                    }else{
        
        
                         return redirect()->back()->withErrors($validator)->withInput();
        
                    }


       
    }



    public function store_sermons()
    {
        //1.validate data
        
        $validator=$this->validate(request(),[
        'topic'=>'required|string',
        'author'=>'required|string',
        'sermon'=>'required|string',
        'file' => 'required|mimes:pdf,docx,doc',
        ],
        [
            'topic.required'=>'Type in Topic of the Sermon you want to Upload ',
            'author.required'=>'Type in Author of Sermon ',
            'sermon.required'=>'Enter Sermon ',
            'file.required'=>'Please Upload a PDF file ',
            
            
            ]);

            if(count(request()->all()) > 0){

            ////// move file to upload folder ////////////////

            $file = request()->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'upload';
            $file->move($filePath,$fileName);
            $user = auth()->user()->id;

            //////////// create data //////////////////////

            $topic = request()->input('topic');
            $author = request()->input('author');
            $sermon = request()->input('sermon');
            $files =  $fileName;
            $userid =  $user;
            $status =  0;
            $created= date('Y-m-d H:i:s');
            $data=array('topic'=>$topic,"author"=>$author,"sermon"=>$sermon,"filename"=>$files,"user_id"=>auth()->user()->name,"status"=>$status,'created_at'=>$created);
            DB::table('sermons')->insert($data);


           ////////// redirect to url //////////////////////////

           return redirect()->back()->withSuccess('Sermon uploaded succesfully !');
                
            }else{


                 return redirect()->back()->withErrors($validator)->withInput();

            }
                ///// move uploaded file to folder


           

            
        //2. create data

        //3. redirect url

            
    }



    public function store_churches()
    {
        //1.validate data
        
        $validator=$this->validate(request(),[
        'name'=>'required|string',
        'est_date'=>'required|string',
        'country'=>'required|string',
        'location'=>'required|string',
        'pastor'=>'required|string',
        'phone'=>'required|string',
        'email'=>'required|string',
        'note'=>'required|string',
        
        ],
        [
            'name.required'=>'Type in the name of church you want to upload information for ',
            'est_date.required'=>'Enter the date of establishment ',
            'country.required'=>'Select country ',
            'location.required'=>'Enter the location of church',
            'pastor.required'=>'Enter name of pastor incharge ',
            'phone.required'=>'Enter branch phone number ',
            'email.required'=>'Enter email ',
            'note.required'=>'Type a brief description  or any other information you want to add in the Note field ',
            
            
            ]);

            if(count(request()->all()) > 0){

            $user = auth()->user()->id;

            //////////// create data //////////////////////

            $name = request()->input('name');
            $est_date= request()->input('est_date');
            $country = request()->input('country');
            $location = request()->input('location');
            $pastor = request()->input('pastor');
            $phone = request()->input('phone');
            $email = request()->input('email');
            $note = request()->input('note');
            $userid =  $user;
            $status =  0;
            $created= date('Y-m-d H:i:s');
            
            $data=array('name'=>$name,"est_date"=>$est_date,"country"=>$country,"location"=>$location,"pastor"=>$pastor,"phone"=>$phone ,"email"=>$email,"note"=>$note,"user_id"=>$userid,"status"=>$status,'created_at'=>$created);
            DB::table('churches')->insert($data);


           ////////// redirect to url //////////////////////////

           return redirect()->back()->withSuccess('Church uploaded succesfully !');
                
            }else{


                 return redirect()->back()->withErrors($validator)->withInput();

            }
              

            
    }






    public function store_users()
    {
        //1.validate data
        
        $validator=$this->validate(request(),[
        'name'=>'required|string',
        'email' =>'required|string|email|max:255|unique:users',
        'password'=>'required|string',
        'role'=>'required|string',
        
        ],
        [
            'name.required'=>'Type in the name of user you are creating account for ',
            'password.required'=>'Enter Password',
            'role.required'=>'Choose a role for user ',
            
            
            ]);

            if(count(request()->all()) > 0){

            $user = auth()->user()->id;

            //////////// create data //////////////////////

            $name = request()->input('name');
            $email= request()->input('email');
            $password = bcrypt(request()->input('password'));
            $role = request()->input('role');
            $created= date('Y-m-d H:i:s');
            
            
            $data=array('name'=>$name,"email"=>$email,"password"=>$password,"role"=>$role,"created_at"=>$created);
            DB::table('users')->insert($data);


           ////////// redirect to url //////////////////////////

           return redirect()->back()->withSuccess('User account created succesfuly !');
                
            }else{


                 return redirect()->back()->withErrors($validator)->withInput();

            }
              

            
    }






    public function churches()
    {

        $churches = DB::select('select * from churches order by id DESC');
        return view('manage.churches',['churches'=>$churches]);

    }

    public function add_church()
    {
        return view('manage.add_church');
    }



    public function users()
    {
        $users = DB::select('select * from users order by id DESC');
        return view('manage.users',['users'=>$users]);
    }


    public function edit_users($id)
    {

   

        $users = DB::select('select * from users where id='.$id);
        return view('manage.edit_user',['users'=>$users]);
        
                
    }




    public function add_user()
    {
        return view('manage.add_user');
    }




    public function audios()
    {
       // $audios = DB::select('select * from audios ');
        $audios= DB::table('audios')->get();
        return view('manage.audios',['audios'=>$audios]);
    }

    public function add_audio()
    {
        return view('manage.add_audio');
    }


    public function show($id)
    
    {
        $sermons = DB::select('select * from sermons where id='.$id);
     
    return view('manage.view',['sermons'=>$sermons]);
       
    }

    public static function showUsername($id){
        $fullname="";
        $names = DB::select('select * from users where id='.$id);
        foreach($names as $name){

        $fullname.=ucwords($name->name);

        }
       return $fullname;

    }




    public function showChurch($id)
    
    {
        $churches = DB::select('select * from churches where id='.$id);
        $photos= DB::table('church_photos')->where('church_id', $id)->get();  
       
        
        
    return view('manage.view_church',['churches'=>$churches],['photos'=>$photos]);
       
    }


    public static function showServices($id){

    $services= DB::table('church_services')->where('church_id', $id)->get(); 
    return $services;

    }




    public function edit($id)
    
    {
        $sermons = DB::select('select * from sermons where id='.$id);
     
    return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function churchEdit($id)
    
    {
        $churches = DB::select('select * from churches where id='.$id);
     
    return view('manage.edit_church',['churches'=>$churches]);
       
    }


    public function destroy($id)
    
    {
        $sermons = DB::delete('delete from sermons where id='.$id);
        return redirect()->back()->withSuccess('one record deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function destroyChurch($id)
    
    {
        $sermons = DB::delete('delete from churches where id='.$id);
        return redirect()->back()->withSuccess('one record deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function delete_photo($id)
    
    {
        $existFile="";
        $photos= DB::table('church_photos')->where('id', $id)->get(); 
        foreach($photos as $photo){


        $existFile.=$photo->filename;
            
                    }

                    if(file_exists(public_path('churchPhoto/'.$existFile))){

                        unlink(public_path('churchPhoto/'.$existFile));
                  
                      }

        DB::table('church_photos')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('one photo deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function delete_users($id)
    
    {
        

        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('one user deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function delete_audio($id)
    
    {
        
       


        $imgFile="";
        $audioFile=""; 
            
        $audios = DB::select('select * from audios where id='.$id);
        foreach($audios as $audio){

            $imgFile.=$audio->imgname;
            $audioFile.=$audio->audioname;

        }

        if(file_exists(public_path('photos/'.$imgFile))){

            unlink(public_path('photos/'.$imgFile));
      
          }


          if(file_exists(public_path('audios/'.$audioFile))){

            unlink(public_path('audios/'.$audioFile));
      
          }

          DB::table('audios')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('one audio deleted succesfuly.');
       
    }

    public function delete_service($id)
    
    {
        

        DB::table('church_services')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('service deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }



    public function delete_video($id)
    
    {
        

        DB::table('videos')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('video deleted succesfuly.');
   // return view('manage.edit_sermon',['sermons'=>$sermons]);
       
    }


    public function update($id)
    
    {
        $validator=$this->validate(request(),[
            'topic'=>'required|string',
            'author'=>'required|string',
            'sermon'=>'required|string',
            //'file' => 'required|mimes:pdf,docx,doc',
            ],
            [
                'topic.required'=>'Type in Topic of the Sermon you want to Upload ',
                'author.required'=>'Type in Author of Sermon ',
                'sermon.required'=>'Enter Sermon ',
               // 'file.required'=>'Please Upload a PDF file ',
                
                
                ]);

                if(count(request()->all()) > 0){

                    $file = request()->file('file');
                    $topic = request()->input('topic');
                    $author= request()->input('author');
                    $sermon= request()->input('sermon');


                    if(empty($file)){

                        DB::table('sermons')->where('id', $id)->update(['topic' => $topic, 'author' => $author,'sermon' => $sermon]);
                        
                        $sermons = DB::select('select * from sermons where id='.$id);
     
                        //return view('manage.edit_sermon',['sermons'=>$sermons]);

                        return redirect()->back()->withSuccess('Update succesful.');
                    
                    }
                    else{ 
                        
                        ///// remove the existing file from folder /////////

                    $existFile=""; 
                    
                    $sermons = DB::select('select * from sermons where id='.$id);
                    foreach($sermons as $sermon){
            
                        $existFile.=$sermon->filename;
            
                    }

                    if(file_exists(public_path('upload/'.$existFile))){

                        unlink(public_path('upload/'.$existFile));
                  
                      }
                   
                  
                    //////// move file to upload folder ////////////////

            $original_name = strtolower(trim($file->getClientOriginalName()));
            $fileName =  time().rand(100,999).$original_name;
            $filePath = 'upload';
            $file->move($filePath,$fileName);
                

            //////////////// update database with new information ///////

            DB::table('sermons')->where('id', $id)
            ->update(['topic' => $topic, 'author' => $author,'sermon' => 'good','filename' => $fileName]);
                     
            $sermons = DB::select('select * from sermons where id='.$id);
     
           // return view('manage.edit_sermon',['sermons'=>$sermons]);

           return redirect()->back()->withSuccess('Update succesful.');






                    }



                }
       
    }



function addService($id){

   
                    $title= request()->input('title');
                    $month= request()->input('month');
                    $time= request()->input('time');
                    $created= date('Y-m-d H:i:s');

                    $data=array('title'=>$title,"month"=>$month,"time"=>$time,"church_id"=>$id,"created_at"=>$created);
                    DB::table('church_services')->insert($data);
                    return redirect()->back()->withSuccess('Update succesful.');


                      

}


    public function churchUpdate($id)
    
    {
        $validator=$this->validate(request(),[
            'name'=>'required|string',
            'est_date'=>'required|string',
            'country'=>'required|string',
            'location'=>'required|string',
            'pastor'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string',
            'note'=>'required|string',
            
            ],
            [
                'name.required'=>'Type in the name of church you want to upload information for ',
                'est_date.required'=>'Enter the date of establishment ',
                'country.required'=>'Select country',
                'location.required'=>'Enter the location of church',
                'pastor.required'=>'Enter name of pastor in-charge',
                'phone.required'=>'Enter phone number ',
                'email.required'=>'Enter email',
                'note.required'=>'Type a brief description  or any other information you want to add in the Note field ',
                
                
                ]);

                if(count(request()->all()) > 0){

                   
                    $name = request()->input('name');
                    $est_date= request()->input('est_date');
                    $country = request()->input('country');
                    $location= request()->input('location');
                    $pastor = request()->input('pastor');
                    $phone = request()->input('phone');
                    $email = request()->input('email');
                    $note= request()->input('note');


                        DB::table('churches')->where('id', $id)->update(['name' => $name, 'est_date' => $est_date,'country' => $country,'location' => $location, 'pastor' => $pastor, 'phone' => $phone, 'email' => $email,'note' => $note]);
                        
                        $churches = DB::select('select * from churches where id='.$id);
     

                        return redirect()->back()->withSuccess('Update succesful.');
                    
                  
                   



                }
       
    }


    public function store_audio()    
    {
        $validator=$this->validate(request(),[
            'title'=>'required|string',
            'artist'=>'required|string',
            'note'=>'required|string',
            'imgfile'=>'required|mimes:jpeg,JPEG,png',
            'audiofile'=>'required|file:mp3,wav,MP3',
           
            
            
            ],
            [
                'title.required'=>'Enter audio title ',
                'artist.required'=>'Enter artist name ',
                'note.required'=>'Enter a note for audio ',
                'imgfile.required'=>'Upload photo for audio',
                'audiofile.required'=>'Upload an audio',
                
                
                ]);

                if(count(request()->all()) > 0){

                   
                    $title = request()->input('title');
                    $artist = request()->input('artist');
                    $note= request()->input('note');
                    $imgfile= request()->file('imgfile');
                    $audiofile= request()->file('audiofile');
                    $created= date('Y-m-d H:i:s');

                      //////// move imgfile to photos folder ////////////////

            $original_filename = strtolower(trim($imgfile->getClientOriginalName()));
            $fileName =  time().rand(100,999).$original_filename;
            $filePath = 'photos';
            $imgfile->move($filePath,$fileName);

             //////// move audiofile to audios folder ////////////////

             $original_audioname = strtolower(trim($audiofile->getClientOriginalName()));
             $fileName2 =  time().rand(100,999).$original_audioname;
             $filePath2 = 'audios';
             $audiofile->move($filePath2,$fileName2);


             $data=array('title'=>$title,'artist'=>$artist,"note"=>$note,"imgname"=>$fileName,"audioname"=>$fileName2,"status"=>'0',"uploadby"=>auth()->user()->name,"created_at"=>$created);
             DB::table('audios')->insert($data);
     

                return redirect()->back()->withSuccess('Update succesful.');
                    
                  
                   



                }
       
    }


    public function postallow(Request $request){
    switch ($request->input('action')) {
        case 'activate':
            

            if(isset($_POST['sermon'])){
                if (is_array($_POST['sermon'])) {
                     foreach($_POST['sermon'] as $value){
                        DB::table('sermons')->where('id', $value)->update(['status' => '1']);
                     }

                     return redirect()->back()->withSuccess('Sermon set to active mode sucessfuly.');

                  } else {
                    $value = $_POST['sermon'];
                    DB::table('sermons')->where('id', $value)->update(['status' => '1']);
                    return redirect()->back()->withSuccess('Sermon set to active mode sucessfuly.');
               }
           }else{


            return redirect()->back()->withErrors('Please check atleast one sermon to activate');
           }

                   


            break;

        case 'deactivate':
            
            if(isset($_POST['sermon'])){
                if (is_array($_POST['sermon'])) {
                     foreach($_POST['sermon'] as $value){
                        DB::table('sermons')->where('id', $value)->update(['status' => '0']);
                     }

                     return redirect()->back()->withSuccess('Sermon set to inactive mode sucessfuly.');

                  } else {
                    $value = $_POST['sermon'];
                    DB::table('sermons')->where('id', $value)->update(['status' => '0']);
                    return redirect()->back()->withSuccess('Sermon set to inactive mode sucessfuly.');
               }
           }else{


            return redirect()->back()->withErrors('Please check atleast one sermon to deactivate');
           }


            break;

        
    }
}


public function audioMultipleDelete(Request $request){

    switch ($request->input('action')) {
        case 'deleteall':

    if(isset($_POST['audio'])){



        if (is_array($_POST['audio'])) {
             foreach($_POST['audio'] as $value){

                $imgFile="";
                $audioFile=""; 
                    
                $audios = DB::select('select * from audios where id='.$value);
                foreach($audios as $audio){
        
                    $imgFile.=$audio->imgname;
                    $audioFile.=$audio->audioname;
        
                }

                if(file_exists(public_path('photos/'.$imgFile))){

                    unlink(public_path('photos/'.$imgFile));
              
                  }


                  if(file_exists(public_path('audios/'.$audioFile))){

                    unlink(public_path('audios/'.$audioFile));
              
                  }


                $audios = DB::delete('delete from audios where id='.$value);
             }

             return redirect()->back()->withSuccess('Audio deleted sucessfuly.');

          } else {
            $value = $_POST['audio'];
            $audios = DB::delete('delete from audios where id='.$value);
            return redirect()->back()->withSuccess('Audio deleted sucessfuly.');
       }
   }else{


    return redirect()->back()->withErrors('Please check atleast one audio to delete');
   }

break;
    }
}
     //1.validate data
        
    public function searchquery(Request $request){
        $searchterm = $request->input('search-term');
        
        $searchresults = DB::table('sermons')->where('topic', 'like', $searchterm.'%')->get();

        return view('manage.search',['sermons'=>$searchresults]);



    }

  public static function showtopics(){
    $messages = DB::select('select * from sermons ');
    
    return $messages;

  } 
  
  
  public function add_video()
  {

      $validator=$this->validate(request(),[
          'title'=>'required|string',
          'artist'=>'required|string',
          'note' => 'required|string',
          'id' => 'required|string',
          ],
          [
              'title.required'=>'Enter a title for video ',
              'artist.required'=>'Enter name for authur  ',
              'note.required'=>'Enter name for note  ',
              'id.required'=>'enter video ID ',
              
              
              ]);


              if(count(request()->all()) > 0){

                $title = request()->input('title');
                $artist = request()->input('artist');
                $note= request()->input('note');
                $vid= request()->input('id');
                $created= date('Y-m-d H:i:s');

                $data=array('title'=>$title,'artist'=>$artist,"note"=>$note,"vid"=>$vid,"uploadby"=>auth()->user()->name,"status"=>'0',"created_at"=>$created);
                DB::table('videos')->insert($data);
                return redirect()->back()->withSuccess('Upload sucessful.');

              }}

 public static function allVideos(){

                
                $videos= DB::table('videos')->get(); 
    
                return $videos;

              }


public static function allAudios(){

    $audios= DB::table('audios')->get(); 
    
    return $audios;
    
           

              }


              public static function showCountries(){

                $countries= DB::table('countries')->get(); 
                
                return $countries;
                
                       
            
                          }
    
}
