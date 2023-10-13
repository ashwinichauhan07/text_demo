@extends('layouts.admin')

@section('title', 'Page language')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Language  </i>
                    <a href="{{ route('language.create') }}" class="btn btn-dark float-right">Add Language</a>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Language Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($languageData as $key => $language_value)
                        <tr>

                         <td>{{ $key++ }}</td>
                         <td>{{ $language_value->name}}</td>
                         <td>{{ $language_value->created_at}}</td>
                         <td>
                             <form method="POST" action="{{ route('language.destroy',[ $language_value->id ]) }}">
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
                        <th>Sr.No</th>
                        <th>Language Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index) {
                    item.onclick = ()=> {
                        if (comfirm("Are you sure you want to delete it!")) {
                            return true;
                        }else {
                            return false;
                        }
                    }
                });
            }
        </script>
        
    @endpush
@endonce