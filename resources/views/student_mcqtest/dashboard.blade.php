 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="alert alert-success m-4 text-center">
           <B style="background-color:rgb(3, 17, 3),padding:0.5em; font-size:22px;"> {{ session('status') }} </B>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success m-4 text-center">
            <B style="background-color:rgb(3, 17, 3),padding:0.5em; font-size:22px;"> {{ session('success') }} </B>
        </div>
    @endif

    <div class="container-fluid">
        <p class="text-center mt-4" id="showTime"></p>
        <div class="row">

            @if(count($examData) == 0)
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-body">
                            <p class="text-center alert alert-danger">No Exam is Assign To You. For More Details Please Contac With Your Exam Adminstrator.</p>
                        </div>
                    </div>
                </div>
        @endif

        @if(count($examData) > 0)
            <!-- show exam list javascript -->
                <div class="col-md-12" id="upcoming_exam">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="text-center">
                                <strong>Upcoming Exam List</strong>
                            </h5>
                            @foreach($examData as $key => $exam_value)
                                <div class="row mt-4">
                                    <div class="col-md-3 text-center">
                                        <strong>Batch Name :</strong>
                                        <p>{{ $exam_value->exam_batche->batch_number }}</p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <strong>Subject Name :</strong>
                                        <p>{{ $exam_value->subject->name }}</p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <strong>Start Date & Time :</strong>
                                        <p id="startExam">{{ $exam_value->startExam }}</p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <strong>End Date & Time :</strong>
                                        <p id="endExam">{{ $exam_value->endExam }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        @endif

        <!-- show when exam is started javascript -->
            <div class="col-12" id="current_exam" style="display: none;">
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="row m-4">
                            <div class="col-md-2">
                                <div class="card">
                                    <div class="card-body mb-2 mt-1">
                                        <img src="{{asset('public/adminlogo')}}/{{ $inst_logo->inst_logo }}"style="width: 50%; height: 50%; padding:5px; margin: auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="text-center">

                                            <strong></strong>
                                        </h1>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="text-center">
                                                    <b>Exam Batch  : </b>{{ count($examData) > 0 ? $examData[0]->exam_batche->batch_number : "" }}

                                                </p>
                                            </div>

                                            <div class="col-md-4">
                                                <p class="text-center">
                                                   <b> Subject </b> : {{ count($examData) > 0 ? $examData[0]->subject->name : "" }}
                                                </p>
                                            </div>

                                            <div class="col-md-4">
                                                <p class="text-center">
                                                    @if(count($examData) > 0)
                                                        Duration : @php
                                                            $time1 = new DateTime($examData[0]->startExam);
                                                            $time2 = new DateTime($examData[0]->endExam);
                                                            $timediff = $time1->diff($time2);

                                                            echo $timediff->format('%h hour %i minute %s second')."<br/>";
                                                        @endphp
                                                    @endif
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-0">
                                <div class="card">
                                    <div class="card-body mb-2 mt-1">
                                        <img src="{{asset('public/adminlogo')}}/{{ $inst_logo->inst_logo }}" style="width: 50%; height: 50%; padding:5px; margin: auto">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card m-4">
                            <div class="card-body">
                                <h5 class="text-center">
                                    <strong>Please Read Instructions Below</strong>
                                </h5>
                                <div class="text-center mt-4">
                                    {!! count($examData) > 0 ? $examData[0]->instruction : "" !!}
                                </div>
                                <p class="text-center">

                                <form method="POST" action="{{ route('student_mcqtest.index') }}">
                                    @csrf

                                    @if(count($examData) > 0)
                                        <input type="hidden" name="exam_id" value="{{ $examData[0]->id }}">
                                    @endif
                                    <div class="text-center">
                                        <button class="btn btn-dark" id="examStartBtn">START EXAM</button>
                                    </div>
                                </form>

                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>
</x-app-layout>
<script src="{{ url('public/js/a.js') }}"></script>

<script type="text/javascript">

    window.onload = ()=>{

        setInterval(function(){

            var dateAndTime = new Date();
            var showTime = document.getElementById("showTime");
            showTime.innerHTML = dateAndTime;

            startExam();



        }, 1000);

        function startExam() {



            var startExam = document.getElementById("startExam");

            console.log(startExam);

            var examTime = startExam.innerHTML.split(" ");
            var examYear = examTime[0].split("-");
            var examTime = examTime[1].split(":");



            var dateAndTime = new Date();
            var dateTime = dateAndTime.toLocaleString(undefined,{hour12: false,timeZone: 'Asia/Kolkata'}).split("T");
            var nowDate_time = dateTime[0].split(" ");
            var nowDate = nowDate_time[0].split("/");

            var notTime = nowDate_time[1].split(":");

            var current_exam = document.getElementById("current_exam");
            var upcoming_exam = document.getElementById("upcoming_exam");

            if (examYear[0] == parseInt(nowDate[2])) {
                if (examYear[1] == parseInt(nowDate[0])) {

                    if (examYear[2] == parseInt(nowDate[1])) {

                    console.log(examYear[1]);


                        // check for start exam
                        if (examTime[0] < notTime[0]) {

                            current_exam.style.display = "block";
                            upcoming_exam.style.display = "none";


                        } else if (examTime[0] == notTime[0]) {

                            if (examTime[1] <= notTime[1]) {

                                current_exam.style.display = "block";
                                upcoming_exam.style.display = "none";
                            }
                        }

                        var endExam = document.getElementById("endExam");
                        var endExamDateAndTime = endExam.innerHTML.split(" ");
                        var endTime = endExamDateAndTime[1].split(":");

                        //    check for end exam
                        if (notTime[0] > endTime[0]) {

                            current_exam.style.display = "none";
                            upcoming_exam.style.display = "block";

                        } else if (notTime[0] == endTime[0]){

                            if (notTime[1] >= endTime[1]) {
                                current_exam.style.display = "none";
                                upcoming_exam.style.display = "block";
                            }
                        }
                    }
                }
            }
        }

    }


</script>
