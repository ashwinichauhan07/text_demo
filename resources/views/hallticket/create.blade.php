@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">Generate Hall Ticket</li>
                <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('hallticket.index')}}">Back</a> </li>
            </ol>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong>There were some problems with your input. <br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('hallticket.store') }}" method="POST">
                                @csrf
                                @method('PUT')


                                <div class="row">
                                <!-- <div class="form-group col-md-4">
						      <label for="receipt_no">Receipt Number</label>
							      <input type="text" name="receipt_no" class="form-control" value="{{ old('receipt_no') }}">
						    </div>
						    <div class="form-group col-md-4">
						      <label for="date">Date</label>
							      <input type="date" name="date" class="form-control">
						    </div>
						    <div class="form-group col-md-4">
						      <label for="date">Student Type</label>
							    <select id="student" class="form-control" name="sub30wpm">
					              <option selected>Choose...</option>
					              <option value="regular">Regular</option>
					              <option value="repeater">Repeater</option>
					              <option value="reappear">Reappear</option>
					            </select>
						    </div> -->
                                    <div class="form-group col-md-6">
                                        <label for="student_id">Enter Student Name</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Enter Student Name" id="student_name" autocomplete="off">

                                        <input type="hidden" name="user_id" id="user_id">

                                        <div id="resultData" class="card" style="display: none;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="" style="border-radius: 50%;" width="30" class="m-2"
                                                         id="resultImage">
                                                </div>
                                                <p class="mt-2" id="resultName"></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mt-8">
                                        <button type="search" class="btn btn-dark">Search</button>
                                    </div>
                                </div>
                                <br>
                                <h3 class="text-center" style="background-color: grey; height: 30px;"><b> Student
                                        Details </b></h3><br>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="login_id">Student Login Id</label>
                                        <input type="text" name="login_id" id="login_id" class="form-control" value=""
                                               disabled>
                                        <input type="hidden" name="login_id" value=""/>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="center_name">Institute Center Name</label>
                                        <input type="text" class="form-control" name=""
                                               value=" {{ auth()->user()->name }}" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="subject_id">Student Subject</label>
                                        <select id="subject_id" class="form-control subject" name="subject_id">
                                            <option name="subject_id">Choose subject...</option>
                                            <!--  <input type="text" name="subject_id" id="subject_id" class="form-control" value="" disabled> -->


                                        </select>
                                        <!-- <input type="text" name="subject_id" id="subject_id" class="form-control" value="" > -->
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="batch">Available Batches</label>
                                        <select id="batch_id" name="batch" class="form-control">
                                            <option selected="">Select Batch</option>
                                            @foreach($ExamBatcheData as $key => $ExamBatche_value)

                                                <option value="{{ $ExamBatche_value->batch_number }}">{{ $ExamBatche_value->batch_number }}</option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exam_date">Exam Date</label>
                                        <input type="text" id="exam_date" name="exam_date" class="form-control"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exam_time">Start Exam</label>
                                        <!-- <select name="exam_time" class="form-control"> -->
                                        <input type="time" id="start_time" name="start_time" class="form-control"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exam_time">End Exam</label>
                                        <!-- <select name="exam_time" class="form-control"> -->
                                        <input type="time" id="end_time" name="end_time" class="form-control"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="day">Exam Day</label>
                                        <input type="text" id="day" name="day" class="form-control"/>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-dark">Generate Hall Ticket</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

@once
@push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script src="{{ url('public/js/scripts.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    
    <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">

        var student_name = document.getElementById("student_name");
        student_name.onkeyup = () =>
        {

            var formData = new FormData();
            formData.append('name', student_name.value);

            var resultData = document.getElementById("resultData");
            var response = "";

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    response = JSON.parse(this.responseText);
                    if (response.status) {
                        // console.log(response);

                        resultData.style.display = "block";
                        var resultName = document.getElementById("resultName");
                        resultName.innerHTML = response.data.name;
                        var resultImage = document.getElementById("resultImage");
                        resultImage.src = "{{asset('public/images')}}/" + response.data.student.student_img;

                        // console.log(resultImage);

                    }

                }
            }
            xhttp.open("POST", "{{ route('student.search') }}", true);
            xhttp.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').content);
            xhttp.send(formData);

            resultData.onclick = () =>
            {

                var login_id = document.getElementById("login_id");
                login_id.value = response.data.email;

                var user_id = document.getElementById("user_id");
                user_id.value = response.data.id;

                student_name.value = response.data.name + ' ' + response.data.student.father_name + ' ' + response.data.student.lastname;


                var subject_id = document.getElementById("subject_id");
                // subject_id.value = response.data.subject_data

                subject_id.options.length = 0;
                for (var i = 0; i <= response.data.subject_data.length; i++) {
                    // console.log(response.data.subject_data[i].id);
                    //console.log(response.data.length);

                    var opt = document.createElement("option");
                    opt.innerText = response.data.subject_data[i].name;

                    opt.value = response.data.subject_data[i].id;
                    subject_id.append(opt);
                    // console.log(response.data.subject_data);
                }

                resultData.style.display = "none";


            }

        }

        var batch = document.getElementById("batch_id");

        batch.onclick = () =>
        {

            console.log(batch.value);

            var formData = new FormData
            formData.append("_token", document.querySelector('meta[name="csrf-token"]').content);
            formData.append("batch_id", batch.value);
            // console.log(student_type.value);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    var response = JSON.parse(this.responseText);
                    // console.log(response.status);
                    if (response.status) {
                        // console.log(response.data);
                        // console.log(course_id.options.length=0);
                        var exam_date = document.getElementById("exam_date");
                        exam_date.value = response.data.exam_date;

                        var start_time = document.getElementById("start_time");
                        start_time.value = response.data.start_time;

                        var end_time = document.getElementById("end_time");
                        end_time.value = response.data.end_time;

                        var day = document.getElementById("day");
                        day.value = response.data.day;

                    }
                }
            };

            xhttp.open("POST", "{{ route('batchfilter') }}", true);
            xhttp.send(formData);
        }


    </script>


@endpush
@endonce
