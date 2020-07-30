<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$sermons = DB::select('select * from sermons where status=1 order by id DESC');
       $sermons= DB::table('sermons')->where('status','1')->paginate(10);
        return view('user.index',['sermons'=>$sermons]);
    }

    public function searchquery(Request $request){
        $searchterm = $request->input('search-term');
        
        $searchresults = DB::table('sermons')->where('topic', 'like', $searchterm.'%')->get();

        return view('user.search',['sermons'=>$searchresults]);



    }

    public function show_sermon($id)
    
    {
        $sermons = DB::select('select * from sermons where id='.$id);
     
    return view('user.read_sermon',['sermons'=>$sermons]);
       
    }

    public function audios()
    {
       // $audios = DB::select('select * from audios ');
        $audios= DB::table('audios')->get();
        return view('user.audio',['audios'=>$audios]);
    }

    public function listen_audio($id)
    {
       
        $audios= DB::table('audios')->where('id','!=', $id)->paginate(5); 
        $lists = DB::select('select * from audios where id='.$id);
        return view('user.listen_audio',['lists'=>$lists],['audios'=>$audios]);
    }

}
