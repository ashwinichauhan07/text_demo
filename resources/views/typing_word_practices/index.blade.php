@extends('layouts.admin')

@section('title', 'Question')

@section('sidebar')

    @parent

@endsection

@section('content')

<main>
    <div class="container-fluid"><br><br>
        <!-- Show Message -->
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row mt-4"></div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> MCQ Question List </i>
                <a href="{{ route('typing_word_practices.create') }}" class="btn btn-dark float-right">Add Typing Word Practices </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Created By</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typing_data as $key => $typing_value)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>{{ $typing_value->user->name }}</td>
                                <td>{{ $typing_value->created_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('typing_word_practices.destroy',[$typing_value->id]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                                        &nbsp; &nbsp;<br><br>
                                    </form>
                                    <a href="{{ route('typing_word_practices.edit',[$typing_value->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    </a>  &nbsp; &nbsp;<br><br>
                                    <a href="{{ route('typing_word_practices.show',[$typing_value->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <br><br>
                                    </a>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        
                      
                       <tfoot>
                          <tr>
                                <th>Sr.No</th>
                                <th>Created By</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                       </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@once
    @push('scripts')
    	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- -<script src="{{ url('chartJs/chart-area-demo.js') }}"></script> -->
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
       
        

        <!-- <script type="text/javascript">
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
        </script> -->
        <script type="text/javascript">
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index) {
                    item.onclick = ()=> {
                        if (confirm("Are you sure to delete it!")) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });
            }
        </script>
    @endpush
@endonce