<?php

namespace App\Http\Controllers;

use App\Models\TypingWordPractices;
use Illuminate\Http\Request;

class TypingWordPracticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

        $typing_data = TypingWordPractices::where('institute_id',$auth_id)->get();

        // dd($typing_data);
       return view('typing_word_practices.index',compact('typing_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('typing_word_practices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

         $data = request()->validate([
            
            'wordpractice'  => 'required',
           
        ]);

         if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

         $typing_data = auth()->user()->typing_word_practices()->create([
            'institute_id'  => $auth_id,
            'wordpractice'  => $data['wordpractice'],
            
        ]);


         // dd($data);

       return redirect()->route('typing_word_practices.index')->with('status','Typingtest is Created.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypingWordPractices  $typingWordPractices
     * @return \Illuminate\Http\Response
     */
    public function show(TypingWordPractices $typingWordPractices)
    {

        return view('typing_word_practices.show',compact('typingWordPractices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypingWordPractices  $typingWordPractices
     * @return \Illuminate\Http\Response
     */
    public function edit(TypingWordPractices $typingWordPractices)
    {

        return view('typing_word_practices.edit',compact('typingWordPractices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypingWordPractices  $typingWordPractices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypingWordPractices $typingWordPractices)
    {
        $data = request()->validate([
            
            'wordpractice'  => 'required',
           
        ]);

        

         $typingWordPractices->update($request->all());


         // dd($data);

       return redirect()->route('typing_word_practices.index')->with('status','Typingtest is Created.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypingWordPractices  $typingWordPractices
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypingWordPractices $typingWordPractices)
    {

        $typingWordPractices->delete();

        return back()->with('status','Question Deleted Successfully.');
        
    }
}
