@extends('layouts.demo')

@section('title', 'Question Bank Gate')

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


                         @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="row mt-4">

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">


                                        <div class="row">

                                            <!-- Card for Automatic Question Bank Generate -->
                                            <div class="col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">Automatic Generate</div>
                                                    <div class="card-body">

                                                        <p class="text-center mt-4 mb-4">

                                                            <a class="btn btn-success btn-lg" href="{{ route('question_bank.automatic_create') }}">continue</a>

                                                        </p>



                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card for  Automatic Question Bank Generate -->
                                            <div class="col-xl-6 mt-xs-2">
                                                <div class="card">
                                                    <div class="card-header">Manual Generate</div>
                                                    <div class="card-body">

                                                        <p class="text-center mt-4 mb-4">

                                                            <a class="btn btn-success btn-lg" href="{{ route('question_bank.manual_create') }}">continue</a>

                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">

                                        <!-- Question Bank Table -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{--  <th>Subject</th>  --}}
                                                        <th>Question Paper Name</th>
                                                        <th>Total Question</th>
                                                        <th>Created By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        {{--  <th>Subject</th>  --}}
                                                        <th>Question Paper Name</th>
                                                        <th>Total Question</th>
                                                        <th>Created By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                  @foreach($questionBankData as $key => $bank_value)
                                                    <tr>
                                                        <td>{{ $bank_value->id }}</td>
                                                        {{--  <td>{{ $bank_value->subject->name }}</td>  --}}
                                                        <td>{{ $bank_value->questionPaperName }}</td>
                                                        <td>{{ $bank_value->total_writing_question + $bank_value->total_mcq_question }}</td>
                                                        <td>{{ $bank_value->user->name }}</td>
                                                        <td>
                                                             <form method="POST"
                                                action="{{ route('question_bank.destroy',[$bank_value->id]) }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class=""><i class="fas fa-trash" style="font-size:24px;color:red;"></i></button>
                                                        </form>

                                                          <!--   <a href="{{ route('question.edit',[$bank_value->id]) }}">
                                                              <i class="fas fa-eye-dropper" style="font-size:24px;color:SteelBlue;"></i>
                                                            </a> -->


                                                            <a href="{{ route('question_bank.show',[$bank_value->id]) }}">
                                                              <i class="fas fa-eye" style="font-size:24px;color:green;"></i>
                                                            </a>


                                                        </td>
                                                    </tr>
                                            @endforeach
                                                </tbody>
                                            </table>
                                        </div>

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
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


        <script type="text/javascript">
          $(document).ready(function() {
            $('#dataTable').DataTable( {
                initComplete: function () {
                    this.api().columns([1,2,3]).every( function () {
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
