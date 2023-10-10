@extends('layouts.admin')

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

                                <form method="POST" action="{{ route('practiseexam.select_paper') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Name <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Code <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Start Date and Time <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="startExam" id="input" class="form-control" required>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-danger">* Select 24H Time Only.</p>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            End Date and Time <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="name" name="endExam" id="input1" class="form-control" required>
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


                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            Subject <i class="text-danger">*</i>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control" name="subject_id">
                                                @foreach($subjectData as $key => $subject_value)

                                                <option value="{{ $subject_value->id }}">{{ $subject_value->name }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


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
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <button class="btn btn-success float-right">CONTINUE</button>
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

    {{--  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->  --}}

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />



    <script>
        $('#input').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });

        $('#input1').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });

        // CKEDITOR.replace( 'instruction' );
        ClassicEditor
            .create( document.querySelector( '#instruction' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>


    @endpush
@endonce
