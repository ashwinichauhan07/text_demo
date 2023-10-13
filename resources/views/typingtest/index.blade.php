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
                <i class="fas fa-table mr-1"> Typing Test Record </i>
                <a href="{{ route('typingtest.create') }}" class="btn btn-dark float-right">Add Typing Test</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Subject</th>
                                <th>Practise Type</th>
                                <th>created_at</th>
                                <th>File Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($typingtestData as $key => $typingPractise_value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $typingPractise_value->subject->name }}</td>
                                <td>{{ $typingPractise_value->practise->name }}</td>
                                <td>{{ $typingPractise_value->created_at }}</td>
                                <td>{{ $typingPractise_value->typingdata }}</td>
                                <td>
                                    <form method="POST" action="{{ route('typingPractise.destroy',[ $typingPractise_value->id ]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <span class="glyphicon glyphicon-trash"></span>
                                        <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                         <tfoot>
                            <tr>
                                <th>Sr.no</th>
                                <th>Subject</th>
                                <th>Practise Type</th>
                                <th>created_at</th>
                                <th>File Name</th>
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
    	{{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>
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
