@extends('layouts.demo')

@section('title', 'upload typing practises')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">Create Typing Exam</li>
                <a class="btn btn-dark" href="{{ route('typing_exam.index') }}" style="margin-left: 61em;">Back</a>
            </ol>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif


                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif
                        <!-- If want show all error in one place  -->

                            <form method="POST" action="{{ route('typing_exam.store') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-row">

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
                                            <select id="batch_name" class="form-control" name="batch_name">
                                                <option value="" name="batch_name" selected >Choose Batch...</option>

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
                                        <label for="inputEmail4">Select Typing Practise Type</label>

                                        <!-- if want show error in single  -->
                                        <select id="practise_type" class="form-control" name="practise_type">
                                            <option value="" name="practise_type" >Choose Typing Practise Type...</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Enter Time in Miniute</label>
                                        <input type="number" class="form-control" name="exam_time" placeholder="Enter Exam Time" value="{{ old('name') }}">

                                      </div>

                                      <div class="form-group col-md-6">
                                        <label for="inputEmail4">Enter Marks</label>
                                        <input type="number" class="form-control" name="exam_mark" placeholder="Enter Exam Time" value="{{ old('name') }}">

                                      </div>

                                    <div class="form-group col-md-6">
                                        <label for="document_img">Upload Typing Data</label>

                                        <div class="input-group hdtuto control-group lst increment"  style="margin-top:5px;">
                                            <input type="file" name="typingdata[]" multiple class="myfrm form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-dark">Submit</button>
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
        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="{{ url('public/assets/js/select2.min.js') }}"></script>


        <script type="text/javascript">


                var batch_name = document.getElementById('batch_name');
            var subject_id = document.getElementById('subject_id');
            var practise_type = document.getElementById('practise_type');

            var exam_name = document.getElementById('exam_name');

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

            // console.log(...formData);
            batch_name.onchange = ()=> {

                {{-- console.log(batch_name); --}}
                var formData = new FormData();
                formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
                formData.append("batch_name",batch_name.value);

                var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        var response = JSON.parse(this.responseText);
                        {{-- console.log(response.status); --}}
                        if (response.status) {
                            {{-- console.log(response.data.practise_type); --}}
                            //console.log(subject_id.options.length=0);
                            subject_id.options.length=0;
                                //console.log(response.data.length);

                                var opt = document.createElement("option");
                                opt.innerText = response.data.subject.subject.name;
                                opt.value = response.data.subject.subject.id;
                                subject_id.append(opt);

                                console.log(response.data.practise_type.length);

                            practise_type.options.length=0;
                                for (var i = 0; i <= response.data.practise_type.length; i++) {

                                    var opt1 = document.createElement("option");

                                    console.log(opt1);

                                    opt1.innerText = response.data.practise_type[i].name;

                                    {{-- console.log(response.data[i].practise_type.name); --}}

                                    opt1.value = response.data.practise_type[i].id;
                                    practise_type.append(opt1);
                                }
                        }
                    }
                  };
                  xhttp.open("POST", "{{ route('batchwisesubject') }}", true);
                  xhttp.send(formData);



                }

        </script>

        <script type="text/javascript">
            $(document).ready(function() {
               $('#subject_id').select2();
           });

           $(document).ready(function() {
               $('#practise_type').select2();
           });

           $(document).ready(function() {
            $('#batch_name').select2();
        });

        $(document).ready(function() {
            $('#exam_name').select2();
        });

           $(document).ready(function() {
               $("#upload").click(function(){
                   var lsthmtl = $("#cloneid").html();
                   $(".increment").after(lsthmtl);
               });

               $("body").on("click","#button_hide",function(){
                   $(this).parents('#hideinput').remove();
               });

           });
       </script>

    @endpush
@endonce
