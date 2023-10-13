@extends('layouts.demo')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4 mt-4">
                <!-- If want show all error in one place  -->
                <li class="breadcrumb-item active">Student Batch Allocation</li>
            </ol>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                <form action="{{ route('studentbatchallocation.select_student') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="form-group col-md-12">
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

                                            <select id="batch_name" class="form-control" name="batch_name" id="batch_name">
                                                <option value="" name="batch_name">Select Batch...</option>
                                                {{--  @foreach($ExamBatcheData as $key => $ExamBatche_value)

                                                    <option value="{{ $ExamBatche_value->id }}">{{ $ExamBatche_value->batch_number }}</option>

                                                @endforeach  --}}
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="name">Select Subject</label>
                                                <select class="form-control" name="subject_id" id="subject_id">
                                                    <option value="" name="subject_id">Select Subject...</option>
                                                    {{--  @foreach($subjectData as $key => $subject_value)

                                                    <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>

                                                    @endforeach  --}}
                                                </select>
                                        </div>
                                    </div>



                                            <div class="col">
                                                <p class="text-center">
                                                    <button class="btn btn-dark">
                                                        CONTINUE
                                                    </button>
                                                </p>
                                            </div>


                                    </form>
                        {{--  </div>

                                <div class="card">
                                    <div class="card-body">

                                        <table class="table table-bordered" width="100%" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th>Name</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>

                                                    <th>Name</th>

                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach($studnetData as $key => $paper_value)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="{{ $paper_value->user->name }}" value="{{ $paper_value->user_id }}">
                                                        </td>

                                                        <td>{{ $paper_value->user->name }} {{ $paper_value->father_name }} {{ $paper_value->lastname }}</td>

                                                        <td>
                                        <a href="{{ route('practiseexam.show_info', $paper_value->id) }}" target="_blank">
                                                                      <i class="fas fa-eye" style="font-size:24px;color:green;"></i>
                                                                    </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>



                                <div class="card mt-4">
                                    <div class="card-header">Selected Student</div>
                                    <div class="card-body">
                                        <ul id="studentname">

                                        </ul>

                                        <form method="POST" action="{{ route('practiseexam.store_exam') }}">

                                            @csrf



                                            <select name="student[]" id="student" class="form-control" multiple="multiple">



                                            </select>
                                            <br>
                                            <br>

                                            <div class="row">
                                                <div class="col">
                                                    <p class="text-center">
                                                        <button class="btn btn-dark">
                                                            Submit
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>  --}}

                        </div>
            </div>
        </div>
    </main>

@endsection

@once
    @push('scripts')
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script src="{{ url('public/assets/js/select2.min.js') }}"></script>

        <script>

            var exam_name = document.getElementById('exam_name');
            var subject_id = document.getElementById('subject_id');

            var batch_name = document.getElementById('batch_name');
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
                    }
                  };
                  xhttp.open("POST", "{{ route('batchwisesubject') }}", true);
                  xhttp.send(formData);
            }



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



</script>

<script>


</script>



    @endpush
@endonce
