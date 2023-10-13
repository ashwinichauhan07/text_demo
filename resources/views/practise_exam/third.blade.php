@extends('layouts.admin')

@section('title', 'Select Student')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Select Student</li>
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

                                                <td>{{ $paper_value->user->name }}</td>

                                                <td>
                                                            <a href="{{ route('students.show',[$paper_value->user_id]) }}" target="_blank">
                                                              <i class="fas fa-eye" style="font-size:24px;color:green;"></i>
                                                            </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">Selected Student</div>
                            <div class="card-body">
                                <ul id="studentname">

                                </ul>

                                <form method="POST" action="{{ route('practise_exam.createxam') }}">
                                    @csrf
                                    @method('POST')


                                    <input type="hidden" name="name" value="{{ $validator['name'] }}">

{{--                                    <input type="hidden" name="code" value="{{ $validator['code'] }}">--}}

{{--                                    <input type="hidden" name="instruction" value="{{ $validator['instruction'] }}">--}}

{{--                                    <input type="hidden" name="startExam" value="{{ $validator['startExam'] }}">--}}

{{--                                    <input type="hidden" name="endExam" value="{{ $validator['endExam'] }}">--}}

{{--                                    <input type="hidden" name="duration" value="{{ $validator['duration'] }}">--}}

{{--                                    <input type="hidden" name="instruction_time" value="{{ $validator['instruction_time'] }}">--}}

{{--                                    <input type="hidden" name="pass_percentage" value="{{ $validator['pass_percentage'] }}">--}}

                                    <input type="hidden" name="subject_id" value="{{ $validator['subject_id'] }}">

                                    <input type="hidden" name="result" value="{{ $validator['result'] }}">

                                    <input type="hidden" name="question_bank_no" value="{{ $validator['question_bank_no'] }}">

                                    <select name="student[]" id="student" class="form-control" multiple="multiple">



                                    </select>
                                    <br>
                                    <br>

                                    <div class="row">
                                        <div class="col">
                                            <p class="text-center">
                                                <button class="btn btn-success">
                                                    CONTINUE
                                                </button>
                                            </p>
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


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    <script>

    var student = document.getElementById('student');
    var checkbox = document.querySelectorAll('input[type=checkbox]');
    var studentname = document.getElementById('studentname');



    checkbox.forEach(function (item,index) {
        item.onclick = ()=> {

            if (item.checked) {

                var opt = document.createElement('option');
                    opt.value = item.value;
                    opt.id = item.value;
                    opt.innerHTML = item.name;
                    opt.selected = true;
                    student.appendChild(opt);



            } else {

                    student.remove(index);

            }


        }
    });



    </script>

    <script type="text/javascript">

      $("#student").select2({
          // placeholder: "Select Student",
          // allowClear: true
      });
    </script>


    @endpush
@endonce
