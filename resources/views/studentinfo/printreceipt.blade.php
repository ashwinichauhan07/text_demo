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
            <img src="{{asset('public/adminlogo')}}"
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

           <div>
            <label style="font-size: 15px; color: blue; padding-left: 0px;">
            {{ $data['add'] }}</label>&nbsp;
        </div>
    </div>
    <hr>
    <div class="form-group col-md-5">
        <label>Receipt No : {{ $data['receipt_no'] }}</label> &nbsp;
        <label style="padding-left: 19.4em;">Date : </label>


        <hr>
        {{--                <label style="padding-left: 70px;">&nbsp;</label><br><br>--}}

    </div>
    <br>
    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>Student Name:</label>
            <label><b></b></label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Total Fess: </label>
        </div>
    </div>

    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>Subject Name:</label>
            <label> </label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Total Paid Fess : </label>
        </div>
    </div>

    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>next installment date : </label>
            <label></label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Balance Fess : </label>
        </div>
    </div>
    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label></label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Paid Amount : </label>
        </div>
    </div>

    {{--        <div style="display: inline-block; padding-left: 346px;">--}}
    {{--            <label>Paid Amount : 200</label>--}}
    {{--        </div>--}}
    {{--        <br> <br> <br>--}}
    {{--        <div class="form-group col-md-5">--}}
    <br>
    <div style="display: inline-block;  padding-left: 500px;">
        <label>Receiver </label>
    </div>
    {{--        </div>--}}


</div>
</div>


<br> <br> <br> <br> <br> <br> <br>
{{--new page has been started --}}
<div id="rcorners2">
    <div style="display: inline-block; width: 5%; padding-top: 15px">
        <img src="{{asset('public/adminlogo')}}"
             style="width: 60px; height: 60px; padding:5px;">
    </div>


    <div style="display: inline-block ; font-size: 20px; margin-left:20% ;">
        {{--            <h2 style=" text-align: -moz-left; color: red; font-size: 15px; font-size: 20px; display: inline-block;">{{ auth()->user()->name }}</h2> </label>--}}

        @if(auth()->user()->userType == 2)
            <label style="color: red; font-weight: bold;">{{ auth()->user()->name }} </label>
        @elseif(auth()->user()->userType == 3)
            @php
                $institute_name = \App\Models\User::where('id',auth()->user()->instructor->institute_id)
                ->first();

            @endphp
            <label style="color: red; font-weight: bold;"></label>
        @endif
        <div>

            <label style="font-size: 15px; color: blue; padding-left: 0px;"></label>&nbsp;
        </div>
    </div>
    <hr>
    <div class="form-group col-md-5">
        <label>Receipt No : </label> &nbsp;
        <label style="padding-left: 19.4em;">Date : </label>
        <hr>
        {{--                <label style="padding-left: 70px;">&nbsp;</label><br><br>--}}

    </div>
    <br>
    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>Student Name:</label>
            <label><b></b></label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Total Fess: </label>
        </div>
    </div>

    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>Subject Name:</label>
            <label> </label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Total Paid Fess : </label>
        </div>
    </div>

    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            <label>next installment date : </label>
            <label></label>
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Balance Fess :</label>
        </div>
    </div>
    <div class="container">
        <div class="form-group col-md-5" style="width: 70%; display: inline-block;">
            {{-- <label>Amount :</label> --}}
        </div>
        <div class="form-group col-md-5" style="width: 30%; display: inline-block;">
            <label>Paid Amount : </label>
        </div>
    </div>

    {{--        <div style="display: inline-block; padding-left: 346px;">--}}
    {{--            <label>Paid Amount : 200</label>--}}
    {{--        </div>--}}
    {{--        <br> <br> <br>--}}
    {{--        <div class="form-group col-md-5">--}}
    {{--            <div style="display: inline-block;  padding-left: 520px;">--}}
    {{--                <label>Receiver  </label>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <br>
    <div style="display: inline-block;  padding-left: 500px;">
        <label>Receiver </label>
    </div>


</div>
</div>

</body>
</html>


{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--  <title>Student Installment Clip</title>--}}
{{--  <style>--}}
{{--     .border--}}
{{--     {--}}
{{--      outline-style: solid;--}}
{{--      outline-color: black;--}}
{{--      padding:18px;--}}
{{--      /*padding-left: 8em;*/--}}
{{--     }--}}

{{--  </style>--}}

{{--</head>--}}

{{--    <div class="border">--}}

{{--       <div style="display: inline-block; width: 30%; " >--}}
{{--          <img src="C:\xampp\htdocs\ESwiftProject\public\adminlogo/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px; padding:5px;">--}}
{{--            </div>--}}

{{--      <div style="display: inline-block ; width: 50%;">--}}
{{--      <h1 style="color: red; font-size: 25px; font-size: 35px;">{{ auth()->user()->name }}</h1>--}}
{{--     <h3 style="text-align: center;">Receipt</h3>--}}
{{--   </div>--}}

{{--    <div>--}}
{{--       <label style="font-size: 25px; color: blue;"></label>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <hr>--}}

{{--      <div class="form-group col-md-2">--}}
{{--        <label>Receipt No : </label>--}}
{{--       <label>&nbsp;&nbsp;&nbsp;</label>--}}
{{--       <label>Date : </label>--}}
{{--       <label>--}}
{{--       --}}
{{--      </label>--}}
{{--      </div>--}}
{{--   <hr>--}}

{{--    <div class="form-group col-md-2">--}}
{{--      </div>--}}
{{--      <div class="form-group col-md-5">--}}
{{--        <label>Student Name:</label>--}}
{{--        <label><b></b></label>--}}
{{--      </div>--}}
{{--     <hr>--}}

{{--     <div class="form-group col-md-5">--}}
{{--        <label>Course Name:</label>--}}
{{--         <label> </label>--}}
{{--       </div>--}}
{{--       <hr>--}}

{{--       <div class="form-group col-md-5">--}}
{{--        <label>Student Type:</label>--}}
{{--        <label> </label>--}}
{{--       </div>--}}
{{--       <hr>--}}

{{--       <label style="padding-left: 70px;">Amount</label><br>--}}
{{--       <hr>--}}
{{--       <label>Total Amount due : </label>--}}
{{--       <hr>--}}

{{--       <label>Amount Paid : </label>--}}
{{--        <hr>--}}
{{--        <label>Balance Amount : </label>--}}
{{--       <hr>--}}

{{--       <div class="vertical" style="border-left: 1px solid black;--}}
{{--        height: 148px;--}}
{{--        position: absolute;--}}
{{--        left: 50%;--}}
{{--        margin-left: -3px;--}}
{{--        top: 282;">--}}
{{--        <div>--}}
{{--   <label style="padding-left: 70px;">Payment Made By</label><br><br>--}}
{{--    <label style="padding-left: 30px;">--}}
{{--      @if( $data['mode'] == 1)--}}
{{--       CASH--}}
{{--      @elseif( $data['mode'] != 1)--}}
{{--       CHECQUE--}}
{{--      @endif--}}
{{--    </label></div>--}}
{{--  </label><br>--}}

{{--    </div>--}}
{{--</body>--}}

{{--</html>--}}
