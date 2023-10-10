@extends('layouts.demo')

@section('title', 'Create Exam')

@section('sidebar')

    @parent

@endsection

@section('content')


 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Create Exam</li>
                        </ol>

                        <!-- Show Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Show Message -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">

                                <form method="POST" action="{{ route('exam.select_paper') }}">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="batch">Select Exam Name</label>

                                            <select id="exam_name" class="form-control" name="exam_name" id="exam_name">
                                                <option value="" name="exam_name">Select Exam Name...</option>
                                                @foreach($ExamName as $key => $exam_value)

                                                    <option value="{{ $exam_value->id }}">{{ $exam_value->name }}</option>

                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="batch">Select Batches</label>
                                                <select id="batch_name" class="form-control" name="batch_name">
                                                    <option value="" name="batch_name" selected >Choose Batch...</option>
                                                {{--  @foreach($ExamBatcheData as $key => $ExamBatche_value)

                                                    <option value="{{ $ExamBatche_value->id }}">{{ $ExamBatche_value->batch_number }}</option>

                                                @endforeach  --}}
                                            </select>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Select Subject</label>

                                            <!-- if want show error in single  -->
                                            <select id="subject_id" class="form-control" name="subject_id">
                                                <option value="" name="subject_id" selected >Choose Subject...</option>
    {{--
                                                @foreach($subjectData as $key => $subject_value)

                                                    <option value="{{ $subject_value->id }}">
                                                        {{ $subject_value->name }}
                                                    </option>

                                                @endforeach --}}

                                            </select>
                                        </div>

                                          <div class="form-group col-md-6">
                                            <label for="inputEmail4">Enter Mcq exam time in miniute</label>

                                            <i class="text-danger">*</i>

                                            <input type="number" name="mcqtime" id="mcqtime" class="form-control" max="60" min="0" required>
                                        </div>



                                        {{--  <div class="form-group col-md-6">
                                            Name <i class="text-danger">*</i>

                                            <input type="name" name="name" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            Code <i class="text-danger">*</i>
                                            <input type="name" name="code" class="form-control" required>
                                        </div>  --}}
                                    </div>

                                    <div class="row mb-3" style="display: none;">
                                        <div class="col-md-3">
                                            Start Date and Time <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="startExam" id="input" class="form-control" value="" required>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-danger">* Select 24H Time Only.</p>
                                        </div>
                                    </div>


                                    <div class="row mb-3" style="display: none;">
                                        <div class="col-md-3">
                                            End Date and Time <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="endExam" id="input1" class="form-control" value="" required>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-danger">* Select 24H Time Only.</p>
                                        </div>
                                    </div>

                                     <div class="row mb-3" style="display: none;">
                                        <div class="col-md-3">
                                            End Date and Time <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="endExam" id="input2" class="form-control" value="" required>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-danger">* Select 24H Time Only.</p>
                                        </div>
                                    </div>


                                    <div class="row mb-3" style="display: none;">
                                        <div class="col-md-3">
                                            Duration (Houres)<i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="time" name="duration" id="input1" class="form-control" max="24:00" value="01:00" required>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-danger">* AM or PM is not considered.</p>
                                        </div>
                                    </div>


                                    <div class="row mb-3" style="display: none;">
                                        <div class="col-md-3">
                                            Instruction Time (Minute)<i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="time" name="instruction_time" id="input1" class="form-control" value="01:00" required>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-danger">* AM or PM is not considered.</p>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Instruction <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea id="instruction" name="instruction"></textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Pass Percentage <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" name="pass_percentage" id="input3" class="form-control" required>
                                        </div>
                                    </div>

{{--
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Show Result After Exam <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control" name="result">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>  --}}

                                    <div class="row mt-4">
                                        <div class="col">
                                            <button class="btn btn-dark float-right">CONTINUE</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </main>

@endsection

@once
    @push('scripts')

    {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> --}}

    <script src="{{ url('public/assets/js/slim.min.js') }}"></script>
    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/js/ckeditor.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ url('public/assets/js/gijgo.min.js') }}"></script>
    <script src="{{ url('public/assets/js/select2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('public/css/gijgo.min.css') }}">


    <link href="{{ url('public/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>

        // CKEDITOR.replace( 'instruction' );



    </script>

    <script>


        var exam_name = document.getElementById('exam_name');
        var subject_id = document.getElementById('subject_id');

        var batch_name = document.getElementById('batch_name');

        var input = document.getElementById('input');
        var input1 = document.getElementById('input1');
        var input2 = document.getElementById('input2');

        // console.log(...formData);
        exam_name.onchange = ()=> {

            var formData = new FormData();
            formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
            formData.append("exam_name",exam_name.value);

            var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    var response = JSON.parse(this.responseText);
                    //console.log(response.status);
                    if (response.status) {
                        //console.log(response.data);
                        //console.log(subject_id.options.length=0);
                        batch_name.options.length=1;
                        //console.log(response.data.length);
                        for (var i = 0; i <= response.data.length; i++) {
                        var opt = document.createElement("option");
                        opt.innerText = response.data[i].batch_number;
                        opt.value = response.data[i].id;
                        batch_name.append(opt);

                        }

                    }
                }
              };
              xhttp.open("POST", "{{ route('examwise_batchname') }}", true);
              xhttp.send(formData);
        }

        batch_name.onchange = ()=> {
            var formData = new FormData();
            formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
            formData.append("batch_name",batch_name.value);
            var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    //console.log(response.status);
                    if (response.status) {
                        //console.log(response.data);
                        //console.log(subject_id.options.length=0);
                        subject_id.options.length=0;
                        //console.log(response.data.length);
                        var opt = document.createElement("option");
                        opt.innerText = response.data.subject.subject.name;
                        opt.value = response.data.subject.subject.id;
                        subject_id.append(opt);
                    }

                    input.value = response.data.subject.exam_date +" "+response.data.subject.start_time

                    input1.value = response.data.subject.exam_date +" "+response.data.subject.end_time

                    input2.value = response.data.subject.exam_date +" "+response.data.subject.start_time


                }
              };
              xhttp.open("POST", "{{ route('batchwisesubject') }}", true);
              xhttp.send(formData);
        }

        var mcqtime = document.getElementById('mcqtime');




            mcqtime.addEventListener('keyup', function () {

                var examTime = input.value.split(" ");
                var examYear = examTime[0].split("-");
                var examTime = examTime[1].split(":");
                var mcqt   = parseInt(mcqtime.value);

                var no = examTime[1];
                var number = parseInt(no);
                var date = examYear.join('-');



                for(var i = 0; i<=60; i++){
                   if(i == no){

                    var newi = 60 - i;

                    if(mcqt >= newi){
                        var no = examTime[0];
                        var number = parseInt(no);
                        var hours = number / 60;
                        var date = examYear.join('-');
                        var mcqexamtime = 1 + number;

                        var et = parseInt(examTime[1]) + mcqt
                        var l = et - 60;
                        var examdate = date + " "+mcqexamtime+":"+ l;

                        input2.value = examdate;
                    }

                    else{
                        var no = examTime[1];
                        var number = parseInt(no);
                        var date = examYear.join('-');
                        var mcqexamtime = number + mcqt;

                        var examdate = date + " "+examTime[0]+":"+ mcqexamtime;

                            input2.value = examdate;

                       {{--  console.log(newi);  --}}
                   }
                }
            }



            });


    </script>

<script>

$(document).ready(function() {
    $('#subject_id').select2();

});

$(document).ready(function() {
    $('#batch_name').select2();

});

  $(document).ready(function() {
        $('#exam_name').select2();

    });

{{--  $('#input').datetimepicker({
    uiLibrary: 'bootstrap4',
    modal: true,
    footer: true
});

$('#input1').datetimepicker({
    uiLibrary: 'bootstrap4',
    modal: true,
    footer: true
});  --}}

ClassicEditor
.create( document.querySelector( '#instruction' ) )
.catch( error => {
    console.error( error );
} );

</script>


    @endpush
@endonce
