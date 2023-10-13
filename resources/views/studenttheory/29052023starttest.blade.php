<x-app-layout>
<!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exam') }}
    </h2>
</x-slot> -->

    <div class="container-fluid">
       <br>
        <a class="btn btn-dark" href="{{ route('studenttheory.index') }}" style="margin-left: 61em;">Back</a>
        <div class="row">
        <div class="form-group col-md-6" style="padding-left: 3em;">
            <label for="inputEmail4">Select Language</label>

            <!-- if want show error in single  -->
            <select id="lang" class="form-control" name="subject_id">
                {{-- <option value="" name="subject_id">ENG</option> --}}

                <option value="0" selected>English</option>
                <option value="1">Marathi</option>
                <option value="2">Hindi</option>

            </select>
        </div>
        </div>


        <div class="row m-4">

            <div class="container-fluid mb-1">

                <div class="row">

                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-body">


                                @php
                                    $id =  1;
                                @endphp
                                @foreach($questionData as $key => $que_value)
                                    @if($key == $page)
                                        <div style="max-height: 200px; overflow: auto;" id="eng">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->que !!}
                                                </strong>
                                            </h3>
                                        </div>

                                        <div style="max-height: 200px; overflow: auto;" id="mar">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->quemarathi !!}
                                                </strong>
                                            </h3>
                                        </div>

                                        <div style="max-height: 200px; overflow: auto;" id="hin">
                                            <h3>
                                                <strong>
                                                    {!! $que_value->quehindi !!}
                                                </strong>
                                            </h3>
                                        </div>
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        <hr>


                                        <form method="POST" action="{{ route('studenttheory.starttest') }}">

                                            <!-- for get previous question -->
                                            <input type="hidden" name="exam_id" value="{{ $data->mcq_type_id }}">

                                            @csrf

                                            {{-- @if($que_value->is_mcq == 1) --}}


                                                <div id="engoption">
                                                @foreach($que_value->answer as $key1 => $ans_value)


                                                    <div style="width: 50%; float: right;" id="">

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


                                                <div id="maroption">
                                                    @foreach($que_value->answer as $key1 => $ans_value)


                                                        <div style="width: 50%; float: right;" id="">

                                                            <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                            @if($que_value->paper_ans != null && $ans_value->id == $que_value->paper_ans->answer_id)

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}" checked>

                                                            @else

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}">

                                                            @endif

                                                            <h6>
                                                                <div id="">

                                                                    {!! $ans_value->ansmarathi !!}

                                                                </div>
                                                            </h6>

                                                        </div>

                                                    @endforeach
                                                </div>


                                                <div id="hinoption">
                                                    @foreach($que_value->answer as $key1 => $ans_value)


                                                        <div style="width: 50%; float: right;" id="">

                                                            <input type="hidden" name="que" value="{{ $que_value->id }}">

                                                            @if($que_value->paper_ans != null && $ans_value->id == $que_value->paper_ans->answer_id)

                                                                <input type="radio" name="ans" value="{{ $ans_value->id }}">

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
                                                <div>





                                            {{-- @else
                                                <input type="hidden" name="que" value="{{ $que_value->id }}">



                                                <div class="mb-3">
                                                <textarea name="ans" class="form-control" placeholder="Enter Your answer. . .">
                                                    @if($que_value->paper_ans != null)

                                                        {{ $que_value->paper_ans->ans }}

                                                    @endif
                                                </textarea>
                                                </div> --}}

{{--                                                <input type="submit" name="submit" value="" class="btn btn-success">--}}



                                            {{-- @endif --}}



                                            <div class="text-center">

                                                <input type="hidden" name="page" value="{{ $key + 1 }}">

                                                <input type="submit" name="previous" value="PREVIOUS" class="btn btn-danger">

                                                <input type="hidden" name="lan" id="lan" value="0">

                                                <input type="submit" name="next" value="NEXT" id="sub" class="btn btn-primary">

                                                <input type="submit" name="submit" value="SUBMIT" id="subans" class="btn btn-success">



                                            </div>

                                        </form>
{{--                                    {{  $answer_id }}      {{  $wrightans->practisemcq_id }}--}}
                                        <br>
                                      
                                        @if ($test_data == "SUBMIT")
                                        @if ($lan == 0)
{{-- <div id="engans"> --}}

                                       @if($wrightans != null)
                                           @if($answer_id == $wrightans->id)
                                            <div class="alert alert-success">
                                                <strong>WRIGHT ANSWER {!! $wrightans->ans !!}</strong>
                                                <strong>{!! $wrightans->practisemcq->explanation !!}</strong>

                                            </div>
        @elseif($answer_id != $wrightans->id)

                                            <div class="alert alert-danger">
                                                    <strong>WRONG ANSWER, RIGHT ANSWER IS {!! $wrightans->ans !!}</strong>
                                                    <strong>{!! $wrightans->practisemcq->explanation !!}</strong>

                                            </div>
        @endif
                                        @endif

                                    

                                    @elseif($lan == 1)

                                    @if($wrightans != null)
                                           @if($answer_id == $wrightans->id)
                                            <div class="alert alert-success">
                                                <strong>WRIGHT ANSWER {!! $wrightans->ans !!}</strong>
                                                <strong>{!! $wrightans->practisemcq->explanation_marathi !!}</strong>

                                            </div>
        @elseif($answer_id != $wrightans->id)

                                            <div class="alert alert-danger">
                                                    <strong>WRONG ANSWER, RIGHT ANSWER IS {!! $wrightans->ans !!}</strong>
                                                    <strong>{!! $wrightans->practisemcq->explanation_marathi !!}</strong>
                                            </div>
        
                                        @endif

                                    @endif

                                    @elseif($lan == 2)

                                    @if($wrightans != null)
                                           @if($answer_id == $wrightans->id)
                                            <div class="alert alert-success">
                                                <strong>WRIGHT ANSWER {!! $wrightans->ans !!}</strong>
                                                <strong>{!! $wrightans->practisemcq->explanation_hindi !!}</strong>

                                            </div>
        @elseif($answer_id != $wrightans->id)

                                            <div class="alert alert-danger">
                                                    <strong>WRONG ANSWER, RIGHT ANSWER IS {!! $wrightans->ans !!}</strong>
                                                    <strong>{!! $wrightans->practisemcq->explanation_hindi !!}</strong>

                                            </div>
        @endif
                                        @endif

                                    @endif
                                    @endif

                            </div>

                           


                            @endif

                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-1">
                            <div class="card-header">User Details</div>
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
                                    {{-- <th>Subject</th> --}}
                                    {{-- <td> --}}

                                        {{-- {{ $data->question_bank->subject->name }} --}}
{{--                                        @foreach(auth()->user()->student->student_subject as $key => $subject_value)--}}
{{--                                        {{ $subject_value->subject->name }},--}}
{{--                                        @endforeach--}}
                                    {{-- </td> --}}
                                <tr>
                                    {{-- @if() --}}
                                    <th>Practise Type</th>
                                    <td>{{ $data->mcqtypes->name }}</td>
                                </tr>
                                </tr>
                            </table>

                        </div>


{{--                        <div class="card">--}}
{{--                            <div class="card-header">User Details</div>--}}
{{--                            <div class="card-body">--}}
{{--                                <!-- user details -->--}}
{{--                                <table class="table table-bordered">--}}
{{--                                    <tr>--}}
{{--                                        <th>Name</th>--}}
{{--                                        <td>{{ auth()->user()->name }}</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th>Email Id</th>--}}
{{--                                        <td>{{ auth()->user()->email }}</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th>Gender</th>--}}
{{--                                        <td>{{ auth()->user()->student->gender }}</td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}

{{--                            </div>--}}
{{--                        </div>--}}

                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
{{--                        Question Navigation <a href="" id="end_exam" style="float: right;">End Exam</a>--}}
                    </div>
                    <div class="card-body">
                        @php
                            $id =  1;
                        @endphp
                        @foreach($questionData as $key => $q_value)

                            <form method="POST" action="{{ route('studenttheory.starttest') }}">
                                @csrf

                                <input type="hidden" id="exam_id" name="exam_id" value="{{ $q_value->mcq_type_id }}">

                                <input type="hidden" id="que" name="que" value="{{ $q_value->id }}">

                                <input type="hidden" id="page" name="page" value="{{ $id }}">

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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/timecircles/1.5.3/TimeCircles.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">
            
        </script>
       

<script src="{{ url('public/js/a.js') }}"></script>

<script type="text/javascript">

    window.onload = () => {
        var lang = document.getElementById('lang');
        var eng = document.getElementById('eng');
        var mar = document.getElementById('mar');
        var hin = document.getElementById('hin');
        var engoption = document.getElementById('engoption');
        var maroption = document.getElementById('maroption');
        var hinoption = document.getElementById('hinoption');
          var lan = document.getElementById('lan');
        // var engans = document.getElementById('engans');
        // var marans = document.getElementById('marans');
        // var subans = document.getElementById('subans');



       // I var sub = document.getElementById('sub');

        mar.style.display = "none";
        hin.style.display = "none";

        maroption.style.display = "none";
        hinoption.style.display = "none";


        
        // onfocus="this.selectedIndex = -1


        lang.onchange = () => {
            if(lang.value == 0){
                mar.style.display = "none";
                hin.style.display = "none";
                eng.style.display = "block";

                engoption.style.display = "block";
                maroption.style.display = "none";
                hinoption.style.display = "none";

                lan.value = lang.value;

                // engans.style.display = "block";
                // marans.style.display = "none";



            }

            if(lang.value == 1){
                mar.style.display = "block";
                hin.style.display = "none";
                eng.style.display = "none";

                maroption.style.display = "block";
                engoption.style.display = "none";
                hinoption.style.display = "none";

                // engans.style.display = "none";
                // marans.style.display = "block";
                lan.value = lang.value;



            }

            if(lang.value == 2){
                mar.style.display = "none";
                hin.style.display = "block";
                eng.style.display = "none";

                maroption.style.display = "none";
                hinoption.style.display = "block";
                engoption.style.display = "none";

                lan.value = lang.value;

                console.log(lan.value);
            }
    

            // console.log(lang.value);
        }

        // sub.onclick = () =>{
        //
        //     engans.style.display = "block";
        //     console.log('ll');
        // }

    }



</script>
