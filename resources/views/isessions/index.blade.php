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
                <i class="fas fa-table mr-1"> Session </i>
                    <a href="{{ route('isessions.create') }}" class="btn btn-dark float-right">Add Session</a>
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
						<th>Start Session</th>
						<th>End Session</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
						@foreach ($isessions as $isession)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $isession->month->month_name }}</td>
						<td>{{ $isession->monthname->month_name }}</td>
						<td>{{ $isession->created_at }}</td>
						<td>
							<form action="{{ route('isessions.destroy',$isession->id) }}" method="POST">

								@csrf
								@method('DELETE')

								<a href="{{ route('isessions.edit',[ $isession->id ]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

								<button type="submit" class="btn btn-secondary delete" value="reset">Reset</button>
                            </form>
                            <br>
                            <form action="{{ route('isessions.active',$isession->id) }}" method="POST">
                                @csrf
                                @method('POST')

                            @if($isession->active == 0)
                                    <input type="submit" name="active" value="Active" class="btn btn-success">
                                    @endif
                                @if($isession->active == 1)
                                    <input type="submit" name="dactive" value="Dactive" class="btn btn-danger">
                                @endif
                            </form>
						</td>
					</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<th>No</th>
						<th>Start Session</th>
						<th>End Session</th>
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
            // window.onload = ()=> {
            // 	var del = document.querySelectorAll(".delete");
            // 	del.forEach(function(item, index){
            // 		item.onclick = ()=> {
            // 			if (confirm("Are you sure you want to delete !")) {
            // 				return true;
            // 			} else {
            // 				return false;
            // 			}
            // 		}
            // 	});
            // }
        </script>


    @endpush
@endonce
