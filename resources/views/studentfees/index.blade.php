@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                       <br><br>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Student Fee Details
                                <a href="{{ route('studentfees.create') }}" class="btn btn-primary float-right">Add Student Fee</a>
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
			<th>Name</th>
			<th>Amount</th>
			<th>Mode</th>
			<th>Pay Date</th>
			<th width="280px">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($studentfees as $studentfee)
		<tr>
			<td>{{ ++$i }}</td>
			<td>{{ $studentfee->name }}</td>
			<td>{{ $studentfee->amount }}</td>
			<td>{{ $studentfee->mode }}</td>
			<td>{{ $studentfee->payment_mode }}</td>
			<td>
				<form action="{{ route('studentfees.destroy',$studentfee->id) }}" method="POST">

					<a class="btn btn-primary" href="{{ route('studentfees.edit',$studentfee->id) }}"><i class="fa fa-print"> Print</i></a>

					@csrf
					@method('DELETE')

					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>
			</td>
		</tr>
	</tbody>
		@endforeach
		<tfoot>
			<tr>
			<th>No</th>
			<th>Name</th>
			<th>Amount</th>
			<th>Mode</th>
			<th>Pay Date</th>
			<th width="280px">Action</th>
		</tr>
		</tfoot>
	</table>

	{!! $studentfees->links() !!}                        </div>
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
    @endpush
@endonce
