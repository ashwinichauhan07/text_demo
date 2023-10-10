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
                <i class="fas fa-table mr-1">Institute Time Details </i>
                    <a href="{{ route('itimings.create') }}" class="btn btn-dark float-right">Add Batch Time</a>
           	</div>
			<div class="col-xl-12">
            	<div class="card-body">
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
							<th>Start Time</th>
							<th>End Time</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($itimings as $itiming)
						<tr>
							<td>{{ ++$i }}</td>
							<td><input type="time" value="{{ $itiming->start_time }}" disabled></td>
							<td><input type="time" value="{{ $itiming->end_time }}" disabled></td>
							<td>{{ $itiming->created_at }}</td>
							<td>
								<form action="{{ route('itimings.destroy',$itiming->id) }}" method="POST">

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
							<th>Start Time</th>
							<th>End Time</th>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    	<script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

    	</script>

        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
        	window.onload = ()=> {
        		var del = document.querySelectorAll(".delete");
        		del.forEach(function(item, index){
        			item.onclick = ()=> {
        				if (confirm("Are you sure you want to delete !")) {
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
