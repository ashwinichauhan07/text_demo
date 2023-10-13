<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Practisemcq;

class UploadController extends Controller
{
     public function create()
     {
        return view ('upload');
     }

    
    public function store(Request $request){

//     {
//         $fileNames = [];
//         if ($request->hasFile('file')) {
//             foreach ($request->file('file') as $image) {
//                 $imageName = $image->getClientOriginalName();
//                 $image->move(public_path().'/images/', $imageName);
//                 $fileNames[] = $imageName;
//             }

//             $images = json_encode($fileNames);
//             filename::create(['filename' => $images]);
          
//         return back();
        
        
//     }
// }

// //   $size =$request->file('file')->getSize();
//   $filename =$request->file('file')->getClientOriginalName();


//   $request->file('file')->store('public/images/');
//   $practisemcq=new Photo();
//   $practisemcq->filename=$filename;
// //   $photo->size=$size;
//   $practisemcq->save();
//   return redirect()->back();

dd($request->file());







}
}