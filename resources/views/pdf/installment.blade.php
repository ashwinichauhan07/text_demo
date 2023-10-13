<!DOCTYPE html>
<html>
<head>
    <style>
        #rcorners2 {
            border-radius: 45px;
            border: 3px solid #73AD21;
            border: #1b1e21;
            padding: 10px;
            width: 600px;
            height: 400px;
        }
    </style>
</head>
<body>
<div id="rcorners2">
    <div class="container">
        <div style="display: inline-block; width: 5%; padding-top: 15px">
            <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}"
                 style="width: 60px; height: 60px; padding:5px;">
        </div>
        <div style="display: inline-block ; font-size: 20px; margin-left:20% ;">
            {{--            <h2 style=" text-align: -moz-left; color: red; font-size: 15px; font-size: 20px; display: inline-block;">{{ auth()->user()->name }}</h2> </label>--}}

            @if(auth()->user()->userType == 2)
                <label style="color: red; font-weight: bold; ">{{ auth()->user()->name }} </label>
            @elseif(auth()->user()->userType == 3)
                @php
                    $institute_name = \App\Models\User::where('id',auth()->user()->instructor->institute_id)
                    ->first();

                @endphp
                <label style="color: red; font-weight: bold;">{{ $institute_name->name }} </label>
            @endif
    </div>