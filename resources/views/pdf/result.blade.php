<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>

    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">

{{--    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">--}}

</head>

<style>
    * {

    }
</style>

<body>

<div style="width: 100%;">
    <div style="width: 20%; float: right;">
        <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 60px; height: 60px; padding:5px;">
    </div>
    <div style="width: 60%; float: right;" class="text-center">
        <strong class="text-capitalize">{{ $examData->name }}</strong>
        <p> Subject :-
            {{ $examData->subject->name }}
        </p>
        <p style="font-size: smaller;"> Student Name :-
            {{ auth()->user()->name }}
            &ensp;&ensp;
            Mark :-
            {{ $data['mark_obtained'] }}/{{ $data['total_mark'] }}
        </p>
    </div>
    <div style="width: 20%; float: right;">
        <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 60px; height: 60px; padding:5px; margin-left: 3em;">
    </div>



    <div class="container" style="width: 100%; margin: 10%;">
        @foreach($answerSheetData as $key => $sheet_value)
            <div style="width: 100%; padding: 10px;">
                <i><strong>Q. :-</strong> {!! $sheet_value->question->que !!}</i>

                <i><strong>Ans :-</strong> {!! $sheet_value->answer->ans !!}</i>

                @if($sheet_value->question->ans_right->id == $sheet_value->answer_id)
                    <i style="color: #00e676">Right</i>
                @else
                    <i style="color: #c82333">Wrong</i>
                @endif

            </div>
        @endforeach

    </div>
</div>




</body>
</html>
