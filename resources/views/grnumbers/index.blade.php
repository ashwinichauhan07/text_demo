@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> GR Number Details </i>
                    <a href="{{ route('grnumbers.create') }}" class="btn btn-dark float-right">Add GR Number</a>
            </div>
			<div class="col-xl-12">
                <div class="card-body">
				  	@if (session('status'))
				        <div class="alert alert-success">
				            {{ session('status') }}
				        </div>
				    @endif

			        @if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif

					 <div class="table-responsive">
				         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				        <thead>
						<tr>
							<th>No</th>
							<th>GR Number</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($grnumbers as $grnumber)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $grnumber->grnumber }}</td>
							<td>{{ $grnumber->created_at }}</td>
							<td>
								<form action="{{ route('grnumbers.destroy',$grnumber->id) }}" method="POST">

									@csrf
									@method('DELETE')

									<button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
								</form>
							</td>
						</tr>
					</tbody>
						@endforeach
						<tfoot>
							<tr>
							<th>No</th>
							<th>GR Number</th>
							<th>Created At</th>
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
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
