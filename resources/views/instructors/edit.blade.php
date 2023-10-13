@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">
		<ol class="breadcrumb mb-4 mt-4">
  		<!-- If want show all error in one place  -->
  			<li class="breadcrumb-item active">Edit Instructor Details
  				<a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('instructors.index') }}">Back</a> </li>
        </ol>
        <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">

			    @if ($errors->any())
					<div class="alert alert-danger">
						<strong>Whoops!</strong>There were some problem with your input. <br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

			<form action="{{ route('instructors.update',$instructor->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="row">
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Name:</strong>
							<input type="text" name="name" value="{{ $instructor->user->name }}" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Father Name:</strong>
							<input type="text" name="father_name" value="{{ $instructor->father_name }}" class="form-control" placeholder="Father Name">
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Mother Name:</strong>
							<input type="text" name="mother_name" value="{{ $instructor->mother_name }}" class="form-control" placeholder="Mother Name">
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Gender:</strong>
							<input type="text" name="gender" value="{{ $instructor->gender }}" class="form-control" placeholder="Gender">
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Phone Number:</strong>
							<input type="text" name="phone_no" value="{{ $instructor->phone_no }}" class="form-control" placeholder="Phone Number" disabled>
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Email:</strong>
							<input type="email" name="email" value="{{ $instructor->user->email }}" class="form-control" placeholder="Email" disabled>
						</div>
					</div>

					<div class="form-group col-md-12">
						<div class="form-group">
							<strong>Address:</strong>
							<input type="text" name="address" value="{{ $instructor->address }}" class="form-control" placeholder="Address">
						</div>
					</div>
					<div class="form-group col-md-12">
						<h3 class="text-center" style="background-color: grey; height: 30px;"><b> Educational Qualification Details</b></h3><br>
					</div>
					<div class="form-group col-md-6">
						<div class="form-group">
							<strong>Stream:</strong>
							<input type="text" name="stream" value="{{ $instructor->stream }}" class="form-control" placeholder="Education">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="university">University</label>
							<input type="text" name="university" value="{{ $instructor->university }}"class="form-control" placeholder="university">
					</div>
					<div class="form-group col-md-6">
						<label for="passingyear">Passing Year</label>
							<input type="text" name="passingyear" value="{{ $instructor->passingyear }}" class="form-control" placeholder="Passing Year">
					</div>
					<div class="form-group col-md-6">
						<label for="percent">Percent</label>
							<input type="text" name="percent" value="{{ $instructor->percent }}" class="form-control" placeholder="Percent">
					</div>

					<div class="form-group col-md-6">
						<label for="grade">Grade</label>
							<input type="text" name="grade" value="{{ $instructor->grade }}" class="form-control" placeholder="Grade">
					</div>

				    <div class="form-group col-md-6">
						<div class="form-group">
						   <label for="identity_img">Instructor Profile Photo</label>
						   <input type="file" name="identity_img" class="form-control" onchange="previewFile(this)" />
						   <img src="{{asset('public/images')}}/{{ $instructor->identity_img }}" id="previewImg" name="identity_img" alt="" style="max-width:130px;margin-top: 20px;"  />
						</div>
					</div>


				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-dark">Submit</button>
				</div>
				</div>
			</form>
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

         <script>
    	function previewFile(input)
    	{
    		var file = $("input[type=file]").get(0).files[0];
    		if (file)
    		 {
    		 	var reader = new FileReader();
    		 	reader.onload = function()
    		 	{
    		 		$('#previewImg').attr("src",reader.result);
    		 	}
    		 	  reader.readAsDataURL(file);
    		 }
    	}
    </script>
    @endpush
@endonce
