<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class apiController extends Controller
{
    //

    public function sermons() {
        // logic to get a student record goes here
        $sermons= DB::table('sermons')->get()->toJson(JSON_PRETTY_PRINT); 
       return response($sermons, 200);
      }


      public function getsermon($id) {
        // logic to get a getsermon record goes here 
        if (DB::table('sermons')->where('id',$id)->exists()) {
        $sermons= DB::table('sermons')->where('id', $id)->get()->toJson(JSON_PRETTY_PRINT); 
       return response($sermons, 200);
        }else{

            return response()->json([
                "message" => "Sermon not found"
              ], 404);

        }
      }


      public function audios() {
        // logic to get a student record goes here
        $audios= DB::table('audios')->get()->toJson(JSON_PRETTY_PRINT); 
       return response($audios, 200);
      }

      public function getaudio($id) {
        // logic to get a getsermon record goes here 
        if (DB::table('audios')->where('id',$id)->exists()) {
        $audios= DB::table('audios')->where('id', $id)->get()->toJson(JSON_PRETTY_PRINT); 
       return response($audios, 200);
        }else{

            return response()->json([
                "message" => "audio not found"
              ], 404);

        }
      }

      public function videos() {
        // logic to get a student record goes here
        $videos= DB::table('videos')->get()->toJson(JSON_PRETTY_PRINT); 
       return response($videos, 200);
      }

      public function getvideo($id) {
        // logic to get a getsermon record goes here 
        if (DB::table('videos')->where('id',$id)->exists()) {
        $audios= DB::table('videos')->where('id', $id)->get()->toJson(JSON_PRETTY_PRINT); 
       return response($audios, 200);
        }else{

            return response()->json([
                "message" => "video not found"
              ], 404);

        }
      }
}
