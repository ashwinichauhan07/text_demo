@extends('layouts.demo')

@section('title', 'Create Automatic Question Paper')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Create Automatic Question Paper</li>
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

                        <div class="row mt-4">

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">

                                        <form action="{{ route('question_bank.automatic_create_show') }}" method="POST" id="question_form">
                                          {{ csrf_field() }}


                                          <div class="form-group col-md-6">
                                            <label for="subject">Question Paper Name</label>
                                            <input type="text" name="questionPaperName" class="form-control" value="{{ old('questionPaperName') }}">
                                          </div>



                                          {{--  <div class="form-group col-md-6">

                                              <label for="subject">Subject</label>
                                              <select name="subject_id" class="form-control" id="subject">
                                                        <option>Select subject</option>
                                                  @foreach($subjectData as $key => $subject_value)
                                                      <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>
                                                  @endforeach
                                              </select>

                                          </div>  --}}

                                         <!--  <input type="hidden" name="subject_id" id="subject_id"> -->



                                          {{--  <div class="form-group col-md-6">

                                              <label for="level">Subject Level</label>
                                              <select name="mcq_type_id" class="form-control" id="level">
                                                  @foreach($subjectLevelData as $key => $level_value)
                                                  <option value="{{ $level_value->id }}">{{ $level_value->name }}</option>
                                                  @endforeach
                                              </select>

                                          </div>  --}}

                                          {{--  <div class="form-row align-items-center">

                                            <div class="form-group col-md-6">

                                              <label for="numberQuestion">Total Writing Question </label>
                                              <input type="number" class="form-control ml-3" id="numberQuestion" name="total_writing_question" value="{{ old('total_writing_question') }}" required>

                                            </div>

                                            <div class="form-group col-md-4">
                                              <p class="text-center text-danger mt-4" id="total_question"></p>
                                            </div>

                                          </div>  --}}



                                          <div class="form-row align-items-center">

                                            <div class="form-group col-md-6">

                                              <label for="numberQuestionMcq">Total Mcq Question </label>
                                              <input type="number" class="form-control ml-3" id="numberQuestionMcq" name="total_mcq_question" value="{{ old('total_mcq_question') }}" required>

                                            </div>

                                            <div class="form-group col-md-4">
                                              <p class="text-center text-danger mt-4" id="mcq_question"></p>
                                            </div>

                                          </div>



                                          <div class="form-group col-md-6">

                                            <label for="markQuestionMcq">Mark For Each Mcq Question</label>
                                            <input type="number" class="form-control" id="markQuestionMcq" name="each_mcq_mark" value="{{ old('each_mcq_mark') }}" required>

                                          </div>



                                          <div class="form-group col-md-6">

                                            <label for="markQuestionNegativeMcq">Negative Marking for each Mcq Question</label>
                                            <input type="number" class="form-control" id="markQuestionNegativeMcq"  name="each_negative_mcq_mark" value="{{ old('each_negative_mcq_mark') }}" required>

                                          </div>

                                          <div class="form-group col-md-6" style="display: none;">

                                            <label for="paterTime">Required Time</label>
                                            <input type="number" class="form-control" id="paterTime" name="required_time" step="any" value="1" required>

                                          </div>



                                          <button type="submit" class="btn btn-dark ml-2 mt-4">Submit</button>

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
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('public/js/scripts.js') }}"></script> -->

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
         -->


        <script type="text/javascript">
          $(document).ready(function() {
                // $('#subject_id').select2();
                //$('#level').select2();
            });

          window.onload = ()=> {

            var subject = document.getElementById("subject");

            subject.addEventListener("change", function () {

              getQuestionData();

            });

            var level = document.getElementById("level");
            level.addEventListener("change", function () {

              getQuestionData();

            });


            var numberQuestion = document.getElementById("numberQuestion");
              var negWrite = document.getElementById("negWrite");
              var markWrite = document.getElementById("markWrite");
              markWrite.style.display = "none"
              negWrite.style.display = "none";
              numberQuestion.onkeyup = ()=> {
                  if (numberQuestion.value > 0) {
                      negWrite.style.display = "block";
                      markWrite.style.display = "block";
                  } else {
                      negWrite.style.display = "none";
                      markWrite.style.display = "none";
                  }


              }



          };



          function getQuestionData() {

          // ajax request for question details
              var xhttp = new XMLHttpRequest();
              var form = document.getElementById('question_form');
              var forData = new FormData(form);
              xhttp.onreadystatechange = function () {
                 var myObj = JSON.parse(this.responseText);

                 var total_question = document.getElementById('total_question');
                 total_question.innerHTML = "Total Writing Question is "+myObj.data.general;

                 var total_mcq_question = document.getElementById('mcq_question');
                 total_mcq_question.innerHTML = "Total Mcq Question is "+myObj.data.mcq;

                 var subject_id = document.getElementById("subject_id");
                 subject_id.value = myObj.data.subject_id;

              };
              xhttp.open("POST","{{ route('question_bank.get_question_details') }}",true);
              xhttp.setRequestHeader("X-CSRF-Token",document.querySelector('meta[name="csrf-token"]').content);
              xhttp.send(forData);

          }


        </script>
    @endpush
@endonce
