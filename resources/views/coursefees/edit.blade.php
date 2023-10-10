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
          <li class="breadcrumb-item active">Edit Course Fee Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('coursefees.index') }}">Back</a> </li>
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

      	<form action="{{ route('coursefees.update',$coursefee->id) }}" method="POST">
      		@csrf
      		@method('PUT')

      		<div class="row">
                  <div class="form-group col-md-6">
                        <label for="student_type">Student Type</label>
                            <select id="student_type" class="form-control" name="student_type">
                       <option selected>Choose...</option>
                       <option value="0" {{ ($coursefee->coursefee_type == 0) ? "selected" : "" }}>Regular</option>
                       <option value="1" {{ ($coursefee->student_type == 1) ? "selected" : "" }}>Repeat</option>
                       <option value="2" {{ ($coursefee->student_type == 2) ? "selected" : "" }}>Reappear</option>
                            </select>
                        </div>

                  <div class="form-group col-md-6">
                <label for="course_id">Course</label>
                         <select id="course_id" class="form-control" name="course_id" >
                          <!-- <option value="{{ $coursefee->course_id }}"></option> -->

                  @foreach(auth()->user()->institute->institutecourse as $key=> $course_value)


                  @if($coursefee->course_id == $course_value->course_id)

                  <option value="{{ $course_value->course->id }}" {{ ($coursefee->course_value == 0) ? "selected" : "" }}>{{ $course_value->course->name }}</option>

                  @else

                  <option value="{{ $course_value->course->id }}">{{ $course_value->course->name }}</option>

                  @endif

                  @endforeach

                        </select>
                 </div>
                  <div class="form-group col-md-6">
                    <label for="subject">Subject</label>
                         <select id="subject_id" class="form-control" name="subject_id">
                          <option selected value="{{ $coursefee->subject->id }}">{{ $coursefee->subject->name }}</option>


                        </select>
                  </div>
      			<div class="form-group col-md-6">
      		      <label for="fees">Fee</label>
      					<input type="text" name="fees" value="{{ $coursefee->fees }}" class="form-control" placeholder="Fee">
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

        <script type="text/javascript">
          window.onload = ()=> {
            var course_id = document.getElementById('course_id');
            var subject_id = document.getElementById('subject_id');
            //console.log(subject_id);
            // console.log(...formData);
            course_id.onchange = ()=> {
              var formData = new FormData();
              formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
              formData.append("course_id",course_id.value);
              //console.log(course_id.value);
              var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                //console.log(response.status);
                if (response.status) {
                  //console.log(response.data);
                  //console.log(subject_id.options.length=0);
                  subject_id.options.length=0;
                  for (var i = 0; i <= response.data.length; i++) {
                    //console.log(response.data[i].name);
                    //console.log(response.data.length);

                    var opt = document.createElement("option");
                    opt.innerText = response.data[i].name;
                    opt.value = response.data[i].id;
                    subject_id.append(opt);
                    console.log(opt);
                    //console.log(opt);
                  }
                }
              }
            };
            xhttp.open("POST", "{{ route('subfilter') }}", true);
            // xhttp.setRequestHeader("X-CSRF-Token",document.querySelector('meta[name="csrf-token"]').content);
            xhttp.send(formData);
            }
          }
        </script>
    @endpush
@endonce
