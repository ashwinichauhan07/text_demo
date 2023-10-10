<?php

namespace App\Http\Controllers;


use App\Models\TypingPractise;
use App\Models\Upload_typingpractise;
use App\Models\User;
use Illuminate\Http\Request;

class StudenttypingController extends Controller
{
    public function exe(Request $request)
    {
        $data = [];
        // dd($request->all());

//        $user = User::where('id',$request->user_id)->first();

//        dd($user);

//       $data =  $user->update(['typing_id' => $request->typing_id]);

        return response()->json([
            'status' => true,
            'message' => 'Student credentials',
//            'data' => $user
        ]);


    }
}




