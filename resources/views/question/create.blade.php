@extends('layouts.demo')

@section('title', 'Create Question')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
    <div class="container-fluid">
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">Create Question</li>
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
                        <form action="{{ route('question.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
{{--
                                <div class="form-group col-5">
                                    <label for="subject_id">Subject</label>
                                    <select name="subject_id" class="form-control" id="subject_id">

                                        @foreach($subjectData as $key => $subject_value)

                                        <option value="{{ $subject_value->id }}">
                                            {{ $subject_value->name }}
                                        </option>

                                        @endforeach
                                    </select>
                                </div>  --}}

                                {{--  <div class="form-group col-md-5">
                                    <label for="mcqtype">MCQ Type</label>
                                    <select id="level" class="form-control" name="mcq_type_id">

                                    <!-- <option value="" name="mcq_type_id">Choose MCQ Type</option>

                                    @error('mcq_type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror -->

                                    @foreach($mcqtypeData as $key=> $mcqtype_value)
                                    <option value="{{ $mcqtype_value->id }}">{{ $mcqtype_value->name }}</option>
                                    @endforeach

                                    </select>
                                </div>  --}}

                                <div class="form-group col-xl-2 col-xs-12">
                                    <label for="is_mcq">Is Mcq</label>

                                    <select class="form-control" name="is_mcq" id="is_mcq">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>


                            <div>
                                <p class="text-center">
                                    <div class="alert alert-secondary">
                                        <strong style="font-size: 20px;">Question Type In English</strong>
                                    </div>
                                </p>
                                <textarea id="que" class="form-control" name="que">{{ old('que') }}
                                </textarea>



                            </div>


                            <!-- mcq answer -->
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="mcq_1">Answer 1</label>
                                    <textarea id="mcq_1" class="form-control" name="mcq_1">{{ old('mcq_1') }}</textarea>
                                </div>
                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                </div>

                                <div class="form-group col-6">
                                    <label for="mcq_2">Answer 2</label>
                                    <textarea id="mcq_2" class="form-control" name="mcq_2">{{ old('mcq_2') }}</textarea>
                                </div>
                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="2">
                                    <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                </div>
                            </div>
                            <div id="mcq_ans">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="mcq_3">Answer 3</label>
                                        <textarea id="mcq_3" class="form-control" name="mcq_3">{{ old('mcq_3') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="3">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="mcq_4">Answer 4</label>
                                        <textarea id="mcq_4" class="form-control" name="mcq_4">{{ old('mcq_4') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="wright_ans" value="4">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="explanation">Explanation</label>
                                    <textarea id="explanation" class="form-control" name="explanation">{{ old('explanation') }}</textarea>
                                </div>
                            </div>


                            <div>
                                <p class="text-center">
                                    <div class="alert alert-secondary">
                                        <strong style="font-size: 20px;">
                                            Question Type In Hindi
                                        </strong>

                                    </div>

                                </p>
                                <textarea id="hindique" class="form-control"
                                 name="hindique">{{ old('hindique') }}

                                </textarea>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="hindimcq">
                                        Answer 1
                                    </label>
                                    <textarea id="hindi_mcq1" class="form-control"
                                     name="hindi_mcq1">
                                        {{ old('hindi_mcq1') }}
                                    </textarea>

                                </div>

                                <div class="form-group center col-5 mt-4 ml-4"
                                style="padding-top: 30px;">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="1">
                                <label class="form-check-label" for="exampleCheck1">Right Answer</label>


                                </div>

                                <div class="form-group col-6">
                                    <label for="hindimcq2">Answer 2</label>
                                    <textarea id="hindi_mcq2" class="form-control" name="hindi_mcq2">{{ old('hindimcq_2') }}</textarea>
                                </div>
                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="2">
                                    <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                </div>

                            </div>

                            <div id="hindi_mcqs">

                                <div class="row">



                                     <div class="form-group col-6">
                                        <label for="hindimcq3">Answer 3</label>
                                        <textarea id="hindi_mcq3" class="form-control" name="hindi_mcq3">{{ old('hindimcq_2') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="3">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>

                                     <div class="form-group col-6">
                                        <label for="hindimcq4">Answer 4</label>
                                        <textarea id="hindi_mcq4" class="form-control" name="hindi_mcq4">{{ old('hindimcq_2') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="hindiwright_ans" value="4">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>

                                </div>


                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                    <label for="hindi_explanation">Explanation</label>
                                    <textarea id="hindi_explanation" class="form-control" name="hindi_explanation">
                                        {{ old('hindi_explanation') }}
                                </textarea>
                                </div>
                            </div>






                            <div>
                                <p class="text-center">
                                    <div class="alert alert-secondary">
                                        <strong style="font-size: 20px;">
                                            Question Type In Marathi
                                        </strong>

                                    </div>

                                </p>
                                <textarea id="marathique" class="form-control"
                                 name="marathique">{{ old('marathique') }}

                                </textarea>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="marathimcq">
                                        Answer 1
                                    </label>
                                    <textarea id="marathi_mcq1" class="form-control"
                                     name="marathi_mcq1">
                                        {{ old('marathi_mcq1') }}
                                    </textarea>

                                </div>

                                <div class="form-group center col-5 mt-4 ml-4"
                                style="padding-top: 30px;">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="1">
                                <label class="form-check-label" for="exampleCheck1">Right Answer</label>


                                </div>

                                <div class="form-group col-6">
                                    <label for="marathimcq2">Answer 2</label>
                                    <textarea id="marathi_mcq2" class="form-control" name="marathi_mcq2">{{ old('marathi_mcq2') }}</textarea>
                                </div>
                                <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="2">
                                    <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                </div>

                            </div>

                            <div id="marathi_mcqs">

                                <div class="row">



                                     <div class="form-group col-6">
                                        <label for="marathimcq3">Answer 3</label>
                                        <textarea id="marathi_mcq3" class="form-control" name="marathi_mcq3">{{ old('marathi_mcq3') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="3">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>

                                     <div class="form-group col-6">
                                        <label for="marathimcq4">Answer 4</label>
                                        <textarea id="marathi_mcq4" class="form-control" name="marathi_mcq4">{{ old('marathi_mcq4') }}</textarea>
                                    </div>
                                    <div class="form-group center col-5 mt-4 ml-4" style="padding-top: 30px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="marathiwright_ans" value="4">
                                        <label class="form-check-label" for="exampleCheck1">Right Answer</label>
                                    </div>

                                </div>


                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                <label for="marathi_explanation">Explanation</label>
                                    <textarea id="marathi_explanation" class="form-control" name="marathi_explanation">
                                        {{ old('marathi_explanation') }}
                                </textarea>
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
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>



        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
        <script src="{{ url('public/assets/js/slim.min.js') }}"></script>
        <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/assets/js/select2.min.js') }}"></script>
        <script src="{{ url('public/assets/js/ckeditor.js') }}"></script>


         <script type="text/javascript">

            $(document).ready(function() {
                $('#subject_id').select2();
                $('#level').select2();
                $('#is_mcq').select2();
            });

            ClassicEditor
                .create( document.querySelector( '#que' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_1' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_2' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_3' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#mcq_4' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#explanation' ),{
                    removePlugins : ['ImageUpload']
                } )
                .catch( error => {
                    console.error( error );
                } );



                // for hindi editor


              ClassicEditor
               .create(document.querySelector( '#hindique'),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );

               ClassicEditor
               .create(document.querySelector( '#hindi_mcq1'),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );

               ClassicEditor
               .create(document.querySelector( '#hindi_mcq2'),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );


               ClassicEditor
               .create(document.querySelector( '#hindi_mcq3'),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );


               ClassicEditor
               .create(document.querySelector( '#hindi_mcq4'),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );


               ClassicEditor
               .create(document.querySelector( '#hindi_explanation' ),{
                removePlugins : ['ImageUpload']
               } )
               .catch( error =>{
                console.error( error );
               } );


               // for marathi editor

               ClassicEditor
               .create(document.querySelector( '#marathique'),{
                removePlugins : ['ImageUpload']

               } )
               .catch( error => {
                console.error( error );
               } );

               ClassicEditor
              .create(document.querySelector( '#marathi_mcq1'),{
                removePlugins : ['ImageUpload']
              } )
              .catch( error => {
                console.error( error );
              } );


              ClassicEditor
              .create(document.querySelector( '#marathi_mcq2'),{
                removePlugins : ['ImageUpload']
              } )
              .catch( error => {
                console.error( error );
              } );


              ClassicEditor
              .create(document.querySelector( '#marathi_mcq3'),{
                removePlugins : ['ImageUpload']
              } )
              .catch( error => {
                console.error( error );
              } );


               ClassicEditor
              .create(document.querySelector( '#marathi_mcq4'),{
                removePlugins : ['ImageUpload']
              } )
              .catch( error => {
                console.error( error );
              } );

               ClassicEditor
              .create(document.querySelector( '#marathi_explanation'),{
                removePlugins : ['ImageUpload']
              } )
              .catch( error => {
                console.error( error );
              } );



            var mcq = document.getElementById('is_mcq');
            var mcq_ans = document.getElementById('mcq_ans');
            var hindi_mcqs = document.getElementById('hindi_mcqs');
            var marathi_mcqs = document.getElementById('marathi_mcqs');

            mcq.onchange = ()=> {
                if (mcq.value == 1) {

                    mcq_ans.style.display = "block";
                    hindi_mcqs.style.display = "block";
                    marathi_mcqs.style.display = "block";
                }

                if (mcq.value == 0) {

                    mcq_ans.style.display = "none";
                    hindi_mcqs.style.display = "none";
                    marathi_mcqs.style.display = "none";


                }
            }
</script>
    @endpush
@endonce
