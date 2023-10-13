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
                <i class="fas fa-table mr-1"> Show All Notices </i>
                 <a class="btn btn-dark" href="{{ url()->previous() }}" style="margin-left: 62em;"> <i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i></a>

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

						<th>Name</th>
						<th>Send By</th>
						<th>Date</th>
						<th>Subject</th>
						<th>Message</th>
					</tr>
				</thead>
				<tbody>
					@foreach($custemNotification as $custem_value)
					 <tr>
					 	<td>{{ auth()->user()->name }}</td>
					 	<td>
					 		{{-- @php
                            $notice = json_decode($custem_value->data);
                            echo $notice->sender;
					 	    @endphp --}}
							 Principle
					 	</td>
					 	<td>{{ $custem_value->created_at }}</td>
					 	<td>
					 		@php
                            $notice = json_decode($custem_value->data);
                            echo $notice->subject;
					 	    @endphp
					 	</td>
					 	<td>@php
                            $notice = json_decode($custem_value->data);
                            echo $notice->message;
					 	    @endphp
					 	</td>

					 </tr>
                      @endforeach
					 </tbody>
					  <tfoot>
					  	<tr>
						<th>Name</th>
						<th>Send By</th>
						<th>Date</th>
						<th>Subject</th>
						<th>Message</th>
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

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
      <script src="{{ url('public/js/a.js') }}"></script>

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
