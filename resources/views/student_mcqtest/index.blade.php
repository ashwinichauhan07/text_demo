<x-app-layout>
<!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exam') }}
    </h2>
</x-slot> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>


    <div class="container-fluid">
        <div class="container-fluid">
                    <br>
            <a href="" class="btn btn-success" id="end_exam" style="float: right;">End Exam</a>

            {{--            <a class="btn btn-dark" href="{{ route('studenttheory.index') }}" style="margin-left: 61em;">Back</a>--}}
            <div class="row">
                <div class="form-group col-md-6" id="lan" style="padding-left: 3em;">
                    <label for="inputEmail4">Select Language</label>

                    <!-- if want show error in single  -->
                    <select id="lang" class="form-control" name="subject_id">
                        <option value="" name="subject_id" >Choose Language...</option>

                        <option value="0">English</option>
                        <option value="1">Marathi</option>
                        <option value="2">Hindi</option>

                    </select>
                </div>
            </div>


            <div id="msg" class="card-header text-center">
                <strong class="text-danger" style="font-size: 25px; font-weight: 600">To submit your exam click on end exam</strong>
            </div>

        <div class="row m-4">

            <div class="container-fluid mb-1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card" id="end">
                            <div class="card-body">

                                @php
                                    $id =  1;
                                @endphp
                                @foreach($questionData as $key => $que_value)
                                    @if($key == $page)
                                        <div style="max-height: 200px; overflow: auto;"  id="eng">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->que !!}
                                                </strong>
                                            </h3>
                                        </div>

                                        <div style="max-height: 200px; overflow: auto;"  id="hin">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->hindique!!}
                                                </strong>
                                            </h3>
                                        </div>

                                        <div style="max-height: 200px; overflow: auto;"  id="mar">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->marathique !!}
                                                </strong>
                                            </h3>
                                        </div>
                                        <hr>

                                        <form method="POST" action="{{ route('student_mcqtest.index') }}">

                                            <!-- for get previous question -->
                                            <input type="hidden" name="exam_id" value="{{ $data->id }}">

                                            @csrf

                                            {{--  @if($que_value->is_mcq == 1)  --}}
                                                <div id="engoption">
                                                @foreach($que_value->answer as $key1 => $ans_value)

                                                    <div style="width: 50%; float: right;">

                                                        <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                        @if($que_value->paper_ans != null && $ans_value->id == $que_value->paper_ans->answer_id)

                                                            <input type="radio" name="ans" value="{{ $ans_value->id }}" checked>

                                                        @else

                                                            <input type="radio" name="ans" value="{{ $ans_value->id }}">

                                                        @endif

                                                        <h6>
                                                            <strong>
                                                                {!! $ans_value->ans !!}
                                                            </strong>
                                                        </h6>

                                                    </div>
                                                @endforeach
                                                </div>

                                                <div id="hinoption">
                                                    @foreach($que_value->answer as $key1 => $ans_value)

                                                        <div style="width: 50%; float: right;">

                                                            <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                            @if($que_value->paper_ans != null && $ans_value->id == $que_value->paper_ans->answer_id)

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}" checked>

                                                            @else

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}">

                                                            @endif

                                                            <h6>
                                                                <strong>
                                                                    {!! $ans_value->anshindi !!}
                                                                </strong>
                                                            </h6>

                                                        </div>
                                                    @endforeach
                                                </div>


                                                <div id="maroption">
                                                    @foreach($que_value->answer as $key1 => $ans_value)

                                                        <div style="width: 50%; float: right;">

                                                            <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                            @if($que_value->paper_ans != null && $ans_value->id == $que_value->paper_ans->answer_id)

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}" checked>

                                                            @else

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}">

                                                            @endif

                                                            <h6>
                                                                <strong>
                                                                    {!! $ans_value->ansmarathi !!}
                                                                </strong>
                                                            </h6>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            {{--  @else
                                                <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                <div class="mb-3">
                                                <textarea name="ans" class="form-control" placeholder="Enter Your answer. . .">
                                                    @if($que_value->paper_ans != null)

                                                        {{ $que_value->paper_ans->ans }}

                                                    @endif
                                                </textarea>
                                                </div>

                                            @endif  --}}

                                            <div class="text-center">

                                                <input type="hidden" name="page" value="{{ $key + 1 }}">

                                                <input type="submit" name="previous" value="PREVIOUS" class="btn btn-danger">
                                                <input type="submit" name="next" value="NEXT" class="btn btn-primary">
                                            </div>

                                        </form>

                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-1">
                            <div class="card-header">Timer Remain</div>
                            <div class="card-body">
                                <!-- code for timer -->
                                <div class="demo" data-date="{{ $data->endExam }}" style="height: 100px;">

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">User Details</div>
                            <div class="card-body">
                                <!-- user details -->
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ auth()->user()->name }} {{ auth()->user()->student->father_name }} {{ auth()->user()->student->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Id</th>
                                        <td>{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batch</th>
                                        <td>{{ $data->exam_batche->batch_number }}</td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card" id="nav">
                    <div class="card-header">
                        Question Navigation
                    </div>
                    <div class="card-body">
                        @php
                            $id =  1;
                        @endphp
                        @foreach($questionData as $key => $q_value)

                            <form method="POST" action="{{ route('student_mcqtest.index') }}">
                                @csrf

                                <input type="hidden" name="exam_id" value="{{ $data->id }}">

                                <input type="hidden" name="que" value="{{ $q_value->id }}">

                                <input type="hidden" name="page" value="{{ $id }}">



                                @if($key == $page)
                                    <button class="btn btn-primary m-1" style="float: left;">{{ $id++ }}</button>
                                @else
                                    @if($q_value->paper_ans != null)
                                        <button class="btn btn-success m-1" style="float: left;">{{ $id++ }}</button>

                                    @else
                                        <button class="btn btn-danger m-1" style="float: left;">{{ $id++ }}</button>
                                    @endif
                                @endif
                            </form>

                        @endforeach


                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>

<!-- code for javascript -->
<script src="{{ url('public/js/a.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ url('public/assets/js/TimeCircles.js') }}"></script>
<script type="text/javascript">

    window.onload = ()=> {

        var end_exam = document.getElementById("end_exam");
        end_exam.onclick = (e)=> {
            e.preventDefault();

            if (confirm("Do You Really Want to End Exam")) {

                console.log({{ $data->result }});

                if ('{{ $data->result }}' == 1) {
                    window.location.replace("{{ route('student_mcqtest.resultgeneratepreview') }}?exam="+"{{ $data->id }}");

                    {{--  window.location.replace("{{ url('student/mcqdashboard') }}");  --}}

                } else {

                    window.location.replace("{{ route('student_mcqtest.end_exam_notify') }}?exam="+"{{ $data->id }}");

                }
            }
        }

        //      code for detect device
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            if (confirm("Continue with Android app")) {
                window.location.replace = "https://duckduckgo.com/";
            }
        }


    }
    var lang = document.getElementById('lang');
    var eng = document.getElementById('eng');
    var mar = document.getElementById('mar');
    var hin = document.getElementById('hin');
    var engoption = document.getElementById('engoption');
    var engoption = document.getElementById('engoption');
    var maroption = document.getElementById('maroption');
    var hinoption = document.getElementById('hinoption');
    var msg = document.getElementById('msg');
    var btn = document.getElementById('btn');
    var end = document.getElementById('end');
    var lan = document.getElementById('lan');
    var nav = document.getElementById('nav');

    mar.style.display = "none";
    msg.style.display = "none";
    hin.style.display = "none";
    maroption.style.display = "none";
    hinoption.style.display = "none";
    lang.onchange = () => {
        // console.log(lang);


        if(lang.value == 0){
            mar.style.display = "none";
            hin.style.display = "none";
            eng.style.display = "block";

            engoption.style.display = "block";
            maroption.style.display = "none";
            hinoption.style.display = "none";

        }

        else if(lang.value == 1){
            mar.style.display = "block";
            hin.style.display = "none";
            eng.style.display = "none";

            maroption.style.display = "block";
            engoption.style.display = "none";
            hinoption.style.display = "none";
        }

        else if(lang.value == 2){
            mar.style.display = "none";
            hin.style.display = "block";
            eng.style.display = "none";

            maroption.style.display = "none";
            hinoption.style.display = "block";
            engoption.style.display = "none";
        }




    }

    $(".demo").TimeCircles({ time: {
            Days: {
                show: false,
            },
        } }).addListener( function (unit, value, total) {

        // var compareTime = new Date();


        if(total <= 0) {

            {{-- console.log(total); --}}

            lan.style.display = "none";
            nav.style.display = "none";
                msg.style.display = "block";
                end.style.display = "none";

            window.location.href("{{ route('student_mcqtest.resultgeneratepreview') }}?exam="+"{{ $data->id }}");

        }
    });





</script>
