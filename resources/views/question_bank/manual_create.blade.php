@extends('layouts.demo')

@section('title', 'Question Bank Paper')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">



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

                                <div class="alert alert-success">
                                    <p>Basic Details For Generate Question Paper</p>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">

                                        <!-- form start -->
                                        <form action="{{ route('question_bank.questionmanaual') }}" method="POST" id="question_form">
                                          {{ csrf_field() }}


                                          <div class="form-group col-md-6">
                                            <label for="subject">Question Paper Name</label>
                                            <input type="text" name="questionPaperName" class="form-control">
                                          </div>







                                          {{-- <div class="form-group col-md-6">

                                            <label for="markQuestion">Mark For Each Writing Question</label>
                                            <input type="number" class="form-control" id="markQuestion" name="each_writing_mark" required>

                                          </div> --}}


                                          <div class="form-group col-md-6">

                                            <label for="markQuestionMcq">Mark For Each Mcq Question</label>
                                            <input type="number" class="form-control" id="markQuestionMcq" name="each_mcq_mark" required>

                                          </div>


                                          {{-- <div class="form-group col-md-6">

                                            <label for="markQuestionNegative">Negative Marking for each Writing Question</label>
                                            <input type="number" class="form-control" id="markQuestionNegative" name="each_negative_writing_mark" required>

                                          </div> --}}


                                          <div class="form-group col-md-6">

                                            <label for="markQuestionNegativeMcq">Negative Marking for each Mcq Question</label>
                                            <input type="number" class="form-control" id="markQuestionNegativeMcq"  name="each_negative_mcq_mark" required>

                                          </div>

                                          <div class="form-group col-md-6" style="display: none;">

                                            <label for="paterTime">Required Time</label>
                                            <input type="number" class="form-control" id="paterTime" name="required_time" step="any" value="1">

                                          </div>






                                          <button type="submit" class="btn btn-dark ml-2 mt-4">Submit</button>

                                        </form>

                                        <!-- form end -->


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

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script type="text/javascript">
          $(document).ready(function() {
                $('#subject_id').select2();

            });

          $(document).ready(function() {
            $('#dataTable').DataTable( {
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
        </script>
    @endpush
@endonce
