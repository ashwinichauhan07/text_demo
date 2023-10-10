@extends('layouts.admin')

@section('title', 'Select Paper')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Select Paper</li>
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
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Total Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Total Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                         @foreach($paperData as $key => $paper_value)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="paper" value="{{ $paper_value->id }}">
                                                </td>
                                                <td>{{ $paper_value->id }}</td>
                                                <td>{{ $paper_value->questionPaperName }}</td>
                                                <td>{{ $paper_value->subject->name }}</td>
                                                <td>{{ $paper_value->total_writing_question + $paper_value->total_mcq_question }}</td>

                                                <td>
                                    <a href="{{ route('practise_mcqtestpaper.show',
                                            [$paper_value->id]) }}" target="_blank">
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
                            <div class="card-body">
                                <form method="POST" action="{{ route('practiseexam.select_student') }}">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-2">Selected Paper :</div>
                                        <div class="col-md-6">
                                            <input type="number" name="question_bank_no" class="form-control" id="question_bank_no">
                                        </div>
                                    </div>

                                      <input type="hidden" name="name" value="{{ $validator['name'] }}">

                                    <input type="hidden" name="code" value="{{ $validator['code'] }}">

                                    <input type="hidden" name="startExam" value="{{ $validator['startExam'] }}">

                                    <input type="hidden" name="endExam" value="{{ $validator['endExam'] }}">

                                    <input type="hidden" name="duration" value="{{ $validator['duration'] }}">

                                    <input type="hidden" name="instruction" value="{{ $validator['instruction'] }}">

                                    <input type="hidden" name="instruction_time" value="{{ $validator['instruction_time'] }}">

                                    <input type="hidden" name="pass_percentage" value="{{ $validator['pass_percentage'] }}">

                                    <input type="hidden" name="subject_id" value="{{ $validator['subject_id'] }}">

                                    <input type="hidden" name="result" value="{{ $validator['result'] }}">



                                    <div class="row mt-4">
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

        {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



    <script>

    var paper = document.querySelectorAll('input[type=checkbox]');
    var question_bank_no = document.getElementById("question_bank_no");
    console.log(paper);
    paper.forEach(function(item,index) {
        item.onclick = ()=> {

            question_bank_no.value = item.value;

        }
    });

    </script>


    @endpush
@endonce
