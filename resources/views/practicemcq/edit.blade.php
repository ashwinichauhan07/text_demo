@extends('layouts.admin')

@section('title', 'Edit Question')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Edit Question <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('practicemcq.index') }}">Back</a> </li>
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

                                        <form action="{{ route('practicemcq.update',[$practisemcq->id]) }}" method="POST">
                                          {{ csrf_field() }}
                                          @method('PATCH')

                                          <div class="row">
                                            <div class="form-group col-5">

                                                <label for="subject_id">Subject</label>
                                                <select name="subject_id" class="form-control" id="subject_id">
                                                    @foreach($subjectData as $key => $subject_value)

                                                    @if($practisemcq->subject_id == $subject_value->id)

                                                    <option value="{{ $subject_value->id }}" selected>{{ $subject_value->name }}</option>

                                                    @else

                                                    <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>

                                                    @endif

                                                    @endforeach
                                                </select>
                                              </div>

                                              <div class="form-group col-md-5">
                                                <label for="mcqtype">MCQ Type</label>
                                                <select id="mcqtype" class="form-control" name="mcq_type_id">

                                                @foreach($mcqtypeData as $key=> $mcqtype_value)

                                                @if($practisemcq->mcq_type_id == $mcqtype_value->id)

                                                <option value="{{ $mcqtype_value->id }}">{{ $mcqtype_value->name }}</option>

                                                @else

                                                <option value="{{ $mcqtype_value->id }}">{{ $mcqtype_value->name }}</option>

                                                @endif
                                                @endforeach

                                                </select>
                                            </div>

                                              <div class="form-group col-2">
                                                <label for="is_mcq">Is Mcq</label>
                                                <select class="form-control" name="is_mcq" id="is_mcq">
                                                    <option value="0" {{ ($practisemcq->is_mcq == 0) ? "selected" : "" }}>No</option>
                                                    <option value="1" {{ ($practisemcq->is_mcq == 1) ? "selected" : "" }}>Yes</option>
                                                </select>
                                              </div>


                                          </div>
                                          <div class="form-group col-12">
                                            
                                <p class="text-center">
                                    <div class="alert alert-secondary"><strong style="font-size: 20px;">Edit Question In English</strong></div>
                                </p>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="csv_file">CSV File</label>
                                    <input type="file" id="csv_file" name="csv_file" accept=".csv">
                                </div>
                            </div>

                            @if ($practisemcq->csv_data)
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Current CSV Data</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Answer 1</th>
                                                    <th>Answer 2</th>
                                                    <!-- Add more columns as per your CSV structure -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($practisemcq->csv_data as $row)
                                                    <tr>
                                                        <td>{{ $row['question'] }}</td>
                                                        <td>{{ $row['answer_1'] }}</td>
                                                        <td>{{ $row['answer_2'] }}</td>
                                                        <!-- Display more columns as per your CSV structure -->
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
     
                                          </div>



                                           
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>



        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                    {{--editor.setData( "{{ $practisemcq->que }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#mcq_1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#mcq_2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->explanation }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

                //for marathi

            ClassicEditor
                .create( document.querySelector( '#quemarathi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->que }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#marathimcq_1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#marathimcq_2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#marathimcq_3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#marathimcq_4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation_marathi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->explanation }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            //for hindi

            ClassicEditor
                .create( document.querySelector( '#quehindi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->que }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );


            ClassicEditor
                .create( document.querySelector( '#hindimcq_1' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->answer[0]->ans }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );



            ClassicEditor
                .create( document.querySelector( '#hindimcq_2' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[1]->ans : "" }}" );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#hindimcq_3' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[2]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#hindimcq_4' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ (count($practisemcq->answer) > 1) ? $practisemcq->answer[3]->ans : "" }}"  );--}}
                })
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation_hindi' ) )
                .then ( editor => {
                    {{--editor.setData( "{{ $practisemcq->explanation }}" );--}}
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
