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
  			<li class="breadcrumb-item active">Create Instructor</li>
       	</ol>
        <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
			    @if ($errors->any())
					<div class="alert alert-danger">
						<strong>Whoops!</strong>There were some problems with your input. <br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

			<form action="{{ route('instructors.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<input type="hidden" name="userType" value="3">
					<div class="form-group col-md-6">
						<label for="name">Instructor Name :</label>
							<input type="text" name="name" class="form-control" placeholder="Name">
					</div>
					<div class="form-group col-md-6">
						<label for="father_name">Father / Husband Name :</label>
							<input type="text" name="father_name" class="form-control" placeholder="Father Name">
					</div>
					<div class="form-group col-md-4">
						<label for="mother_name">Mother Name :</label>
							<input type="text" name="mother_name" class="form-control" placeholder="Mother Name">
					</div>
					<div class="form-group col-md-4">
						<label for="phone_no">Contact Number :</label>
							<input type="text" name="phone_no" class="form-control" placeholder="Phone Number">
					</div>
					<div class="form-group col-md-4">
						<label for="email">E-Mail ID :</label>
							<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group col-md-4">
				      <label for="gender">Gender :</label>
					      <select id="instructor" class="form-control" name="gender">
					        <option selected>Choose...</option>
					        <option value="male">Male</option>
					        <option value="female">Female</option>
					        <option value="transgender">Transgender</option>
					      </select>
				    </div>

					<div class="form-group col-md-8">
						<label for="address">Permanent Address :</label>
							<input type="text" name="address" class="form-control" placeholder="Address">
					</div><br>
					<div class="form-group col-md-12">
						<h3 class="text-center" style="background-color: grey; height: 30px; text-align: justify;"><b> Educational Qualification Details</b></h3>
					</div>

					<div class="form-group col-md-6">
						<label for="stream">Education Stream :</label>
							<input type="text" name="stream" class="form-control" placeholder="Education">
					</div>
					<div class="form-group col-md-6">
						<label for="university">University :</label>
							<input type="text" name="university" class="form-control" placeholder="university">
					</div>
					<div class="form-group col-md-4">
						<label for="passingyear">Passing Year :</label>
							<input type="text" name="passingyear" class="form-control" placeholder="Passing Year">
					</div>
					<div class="form-group col-md-4">
						<label for="percent">Percent :</label>
							<input type="text" name="percent" class="form-control" placeholder="Percent">
					</div>

					<div class="form-group col-md-4">
						<label for="grade">Grade :</label>
							<input type="text" name="grade" class="form-control" placeholder="Grade">
					</div>
						<div class="form-group col-md-4">
				          <label for="password">Login Password :</label>
				           <input type="password" class="form-control" placeholder="Password" name="password" min="8">
				        </div>
				        <div class="form-group col-md-4">
				          <label for="password">Confirm Login Password :</label>
				          <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password"  min="8">
				        </div>
				        <div class="form-group col-md-4">
					      <label for="identity_img">Instructor Profile Photo :</label>
						  <input type="file" name="identity_img" class="form-control" onchange="previewFile(this)" />
						 <img id="previewImg" name="identity_img" alt="" style="max-width:130px;margin-top: 20px;"  />
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<button type="submit" class="btn btn-dark">Create Instructor</button>
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
       </script>
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
