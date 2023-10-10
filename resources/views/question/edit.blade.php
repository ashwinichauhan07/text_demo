@extends('layouts.demo')

@section('title', 'Edit Question')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Edit Question <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('question.index') }}">Back</a> </li>
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

                                        <form action="{{ route('question.update',[$question->id]) }}" method="POST">
                                          {{ csrf_field() }}
                                          @method('PUT')


                                          <div class="row">




                                            <div class="form-group col-xl-2 col-xs-12">
                                                <label for="is_mcq">Is Mcq</label>
                                                <select class="form-control" name="is_mcq" id="is_mcq">
                                                    <option value="0" {{ ($question->is_mcq == 0) ? "selected" : "" }}>No</option>
                                                    <option value="1" {{ ($question->is_mcq == 1) ? "selected" : "" }}>Yes</option>
                                                </select>

                                              </div>


                                          {{--  </div>  --}}

                                          <div class="form-group col-12">
                                            <p class="text-center"><div class="alert alert-secondary"><strong style="font-size: 20px;">Edit Question In English</strong></div></p >
                                                <textarea id="que" class="form-control" name="que" value="ddd">{{ $question->que }}</textarea>
                                          {{--  </div>  --}}


                                          <!-- mcq answer -->

                                              <div class="row">

                                                <div class="form-group col-6">
                                                    <label for="mcq_1">Answer 1</label>
                                                    <textarea id="mcq_1" class="form-control" name="mcq_1">{{ $question->answer[0]->ans }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="1" {{ $question->answer[0]->id == $question->wright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>
<!--
                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="1">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->

                                                  <div class="form-group col-6">
                                                    <label for="mcq_1">Answer 2</label>
                                                    <textarea id="mcq_2" class="form-control" name="mcq_2">{{ (count($question->answer) > 1) ? $question->answer[1]->ans : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="2" {{ count($question->answer) > 1 && $question->answer[1]->id == $question->wright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>
                                              </div>
                                            <div id="mcq_ans">
                                                <div class="row">




                                                <!-- <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="2">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->

                                                <div class="form-group col-6">
                                                    <label for="mcq_1">Answer 3</label>
                                                    <textarea id="mcq_3" class="form-control" name="mcq_3">{{ (count($question->answer) > 2) ? $question->answer[2]->ans : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="3" {{ count($question->answer) > 2 && $question->answer[2]->id == $question->wright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>


                                                <!-- <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="3">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->

                                                <div class="form-group col-6">
                                                    <label for="mcq_1">Answer 4</label>
                                                    <textarea id="mcq_4" class="form-control" name="mcq_4">{{ (count($question->answer) > 2) ? $question->answer[3]->ans : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="4" {{ count($question->answer) > 2 && $question->answer[3]->id == $question->wright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>


                                                <!-- <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="4">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->

                                              </div>
                                          </div>


                                          <div class="row">

                                              <div class="form-group col-12">

                                                <label for="explanation">Explanation</label>
                                                <textarea id="explanation" class="form-control" name="explanation">{{ $question->explanation }}</textarea>

                                                </div>

                                          {{--  </div>  --}}




                                          <div class="form-group col-12">
                                            <p class="text-center"><div class="alert alert-secondary"><strong style="font-size: 20px;">Edit Question In Hindi</strong></div></p >
                                                <textarea id="hindique" class="form-control" name="quehindi" value="ddd">{{ $question->hindique }}</textarea>
                                        {{--  </div>  --}}

                                          <!-- mcq answer -->

                                              <div class="row">

                                                <div class="form-group col-6">
                                                <label for="mcq_1">Answer 1</label>
                                                    <textarea id="hindi_mcq1" class="form-control" name="hindi_mcq1">{{ $question->answer[0]->anshindi }}
                                                    </textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="1" {{ $question->answer[0]->id == $question->hindiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>
<!--
                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="1">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->



                                                <div class="form-group col-6">
                                                    <label for="hindi_mcq2">Answer 2</label>
                                                    <textarea id="hindi_mcq2" class="form-control" name="hindi_mcq2">{{ (count($question->answer) > 1) ? $question->answer[1]->anshindi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="2" {{ count($question->answer) > 1 && $question->answer[1]->id == $question->hindiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>
                                              </div>
                                            <div id="mcq_hindians">
                                                <div class="row">


                                                <div class="form-group col-6">
                                                    <label for="hindi_mcq3">Answer 3</label>
                                                    <textarea id="hindi_mcq3" class="form-control" name="hindi_mcq3">{{ (count($question->answer) > 2) ? $question->answer[2]->anshindi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="3" {{ count($question->answer) > 2 && $question->answer[2]->id == $question->hindiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>

                                                <div class="form-group col-6">
                                                    <label for="hindi_mcq4">Answer 4</label>
                                                    <textarea id="hindi_mcq4" class="form-control" name="hindi_mcq4">{{ (count($question->answer) > 2) ? $question->answer[3]->anshindi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="4" {{ count($question->answer) > 2 && $question->answer[3]->id == $question->hindiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>

                                              </div>
                                          </div>


                                          <div class="row">

                                              <div class="form-group col-12">

                                                <label for="explanation">Explanation</label>
                                                <textarea id="explanation_hindi" class="form-control" name="explanation_hindi">{{ $question->hindi_explanation }}</textarea>

                                                </div>

                                          {{--  </div>  --}}






                                            <div class="form-group col-12">
                                                <p class="text-center"><div class="alert alert-secondary"><strong style="font-size: 20px;">Edit Question In Marathi</strong></div></p >
                                                    <textarea id="marathique" class="form-control" name="quemarathi" value="ddd">{{ $question->marathique }}</textarea>
                                            {{--  </div>  --}}


                                          <!-- mcq answer -->

                                              <div class="row">

                                                <div class="form-group col-6">
                                                    <label for="marathi_mcq1">Answer 1</label>
                                                    <textarea id="marathi_mcq1" class="form-control" name="marathi_mcq1">{{ $question->answer[0]->ansmarathi }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="1" {{ $question->answer[0]->id == $question->marathiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>
<!--
                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="1">
                                                    <label class="form-check-label" for="exampleCheck1">Wright Answer</label>
                                                  </div> -->

                                                  <div class="form-group col-6">
                                                    <label for="marathi_mcq2">Answer 2</label>
                                                    <textarea id="marathi_mcq2" class="form-control" name="marathi_mcq2">{{ (count($question->answer) > 1) ? $question->answer[1]->ansmarathi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="2" {{ count($question->answer) > 1 && $question->answer[1]->id == $question->marathiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>

                                              </div>
                                            <div id="mcq_marathians">
                                                <div class="row">



                                                <div class="form-group col-6">
                                                    <label for="marathi_mcq3">Answer 3</label>
                                                    <textarea id="marathi_mcq3" class="form-control" name="marathi_mcq3">{{ (count($question->answer) > 2) ? $question->answer[2]->ansmarathi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="3" {{ count($question->answer) > 2 && $question->answer[2]->id == $question->marathiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>

                                                <div class="form-group col-6">
                                                    <label for="marathi_mcq4">Answer 4</label>
                                                    <textarea id="marathi_mcq4" class="form-control" name="marathi_mcq4">{{ (count($question->answer) > 2) ? $question->answer[3]->ansmarathi : "" }}</textarea>
                                                </div>

                                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="4" {{ count($question->answer) > 2 && $question->answer[3]->id == $question->marathiwright_ans ? "checked" : "" }}>
                                                    <label class="form-check-label" for="exampleCheck1">Write Answer</label>
                                                  </div>

                                              </div>
                                          {{--  </div>  --}}


                                          <div class="row">

                                              <div class="form-group col-12">

                                                <label for="explanation">Explanation</label>
                                                <textarea id="explanation_marathi" class="form-control" name="explanation_marathi">{{ $question->marathi_explanation }}</textarea>

                                                </div>

                                          </div>



                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">


                                    <button type="submit" class="btn btn-dark ml-2 mt-4">Submit</button>
                                    </div>

                                </form>
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



        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>


        <!-- html option box search -->

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#subject_id').select2();
                $('#mcq_type_id').select2();
                $('#is_mcq').select2();
            });

            ClassicEditor
                .create( document.querySelector( '#que' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->que }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#mcq_1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#mcq_2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->explanation }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


                // for hindi


              ClassicEditor
                .create( document.querySelector( '#hindique' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->hindique }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#hindi_mcq1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#hindi_mcq2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#hindi_mcq3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#hindi_mcq4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation_hindi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->explanation }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



                 ClassicEditor
                .create( document.querySelector( '#marathique' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->marathique }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#marathi_mcq1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#marathi_mcq2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#marathi_mcq3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#marathi_mcq4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($question->answer) > 1) ? $question->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation_marathi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $question->explanation }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );




                var mcq = document.getElementById('is_mcq');
                var mcq_ans = document.getElementById('mcq_ans');
                var mcq_marathians = document.getElementById('mcq_marathians');
                var mcq_hindians = document.getElementById('mcq_hindians');
                mcq.onchange = ()=> {
                    if (mcq.value == 1) {
                        mcq_ans.style.display = "block";
                        mcq_marathians.style.display = "block";
                        mcq_hindians.style.display = "block";
                    }

                    if (mcq.value == 0) {
                        mcq_ans.style.display = "none";
                        mcq_marathians.style.display = "none";
                        mcq_hindians.style.display = "none";
                    }
                }

                window.onload = ()=> {
                    if (mcq.value == 1) {
                        mcq_ans.style.display = "block";
                        mcq_marathians.style.display = "block";
                        mcq_hindians.style.display = "block";
                    }

                    if (mcq.value == 0) {
                        mcq_ans.style.display = "none";
                        mcq_marathians.style.display = "none";
                        mcq_hindians.style.display = "none";
                    }
                }
        </script>


    @endpush
@endonce
