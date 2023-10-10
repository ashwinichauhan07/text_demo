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
                <i class="fas fa-table mr-1"> Instructor List </i>
                    <a href="{{ route('instructors.create') }}" class="btn btn-dark float-right">Add Instructor</a>
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
						<th>Profile Image</th>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Education</th>
						<th>University</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($instructors as $instructor)
					<tr>
						<td><img src="{{asset('public/images')}}/{{ $instructor->identity_img }}" class="w-100" /></td>
						<td>{{ $instructor->user->name }}</td>
						<td>{{ $instructor->phone_no }}</td>
						<td>{{ $instructor->user->email }}</td>
						<td>{{ $instructor->gender }}</td>
						<td>{{ $instructor->address }}</td>
						<td>{{ $instructor->stream }}</td>
						<td>{{ $instructor->university }}</td>
						<td> @if(Cache::has('online_user'.$instructor->user_id))
	                       <button type="submit" class="btn btn-success" style="border-radius: 50px;">Active</button>
	                     	@else
	                       <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Deactive</button>
	                    	@endif
	                   </td>
						<td>
							<form action="{{ route('instructors.destroy',$instructor->id) }}" method="POST">

								<a class="btn btn-info" href="{{ route('instructors.show',$instructor->id) }}"><i class="fas fa-eye"></i></a></a>
			                    <br><br>
								<a class="btn btn-primary" href="{{ route('instructors.edit',$instructor->id) }}"><i class="fas fa-edit"></i></a></a>
			                     <br><br>
								@csrf
								@method('DELETE')

								<button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
							</form>
						</td>
					</tr>
					@endforeach
					 </tbody>
					  <tfoot>
					  	<tr>
						<th>Profile Image</th>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Education</th>
						<th>University</th>
						<th>Status</th>
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
   		<script src="{{ url('public/assets/js/Chart.min.js') }}"></script>

   		 <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>


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
