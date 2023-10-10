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
  			<li class="breadcrumb-item active">Edit Student Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('students.index') }}">Back</a> </li>
        </ol>
        <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">

				    @if (session('status'))
					    <div class="alert alert-success">
					        {{ session('status') }}
					    </div>
					@endif

					<!-- If want show all error in one place  -->
					@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
					@endif

					<form action="{{ route('students.update',$student->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-row">

							<div class="form-group col-md-6">
								<label for="name">First Name</label>
								<input type="text" class="form-control" name="name" placeholder="Name" value="{{ $student->user->name }}">
							</div>

							<div class="form-group col-md-6">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" name="lastname" placeholder="Name" value="{{ $student->lastname }}">
							</div>

							<div class="form-group col-md-6">
								<label for="father_name">Father/Husband Name</label>
								<input type="text" name="father_name" class="form-control" placeholder="Father Name" value="{{ $student->father_name }}">
							</div>

							<div class="form-group col-md-6">
								<label for="mother_name">Mother Name</label>
								<input type="text" name="mother_name" class="form-control" placeholder="Mother Name" value="{{ $student->mother_name }}">
							</div>

							<div class="form-group col-md-6">
								<label for="student_mob">Phone Number</label>
								<input type="text" name="student_mob" class="form-control" placeholder="Phone Number"  value="{{ $student->student_mob }}" disabled>
							</div>

							<div class="form-group col-md-6">
						      	<label for="email">Email</label>
						      	<input type="email" class="form-control" name="email" placeholder="Email" value="{{ $student->user->email }}" disabled>
						    </div>

							<div class="form-group col-md-6">
						      <label for="gender">Gender</label>
							    <select id="student" class="form-control" name="gender">
							        <option selected >Choose...</option>
							        <option value="0" {{ ($student->gender == 0) ? "selected" : "" }}>Male</option>
							        <option value="1" {{ ($student->gender == 1) ? "selected" : "" }}>Female</option>
							        <option value="2" {{ ($student->gender == 2) ? "selected" : "" }}>Transgender</option>
							    </select>
						    </div>

						    <div class="form-group col-md-6">
						      <label for="handicap">Handicap</label>
							    <select id="handicap_id" class="form-control" name="handicap_id">
							    <option value="0" selected>Choose handicap</option>

								      @foreach($handicapData as $key=> $handicap_value)

				            	@if($student->handicap_id == $handicap_value->id)

				            	<option value="{{ $handicap_value->id }}" selected>{{ $handicap_value->name }}</option>

				            	@else

				            	<option value="{{ $handicap_value->id }}">{{ $handicap_value->name }}</option>

				            	@endif

				            	@endforeach

							    </select>
						    </div>

							<div class="form-group col-md-6">
						      	<label for="address">Permanent Address</label>
								<input type="text" name="address" class="form-control" placeholder="Address" value="{{ $student->address }}">
							</div>

							<div class="form-group col-md-6">
						      <label for="school">School/College Name</label>
								<input type="text" name="school" class="form-control" placeholder="School" value="{{ $student->school }}">
							</div>

							<div class="form-group col-md-6">
						      	<label for="student">Educational Qualification</label>
								<input type="text" name="education" class="form-control" placeholder="Education" value="{{ $student->education }}">
							</div>

							  <div class="form-group col-md-6">
						    <label for="student_identity">Student Identity</label>
								<select id="student" class="form-control" name="document_id">
							    <option selected>Choose Document</option>
							    @foreach($documentData as $key=> $document_value)
							    @if($student->document_id == $document_value->id)
							    <option value="{{ $document_value->id }}" selected>{{ $document_value->name }}</option>
							    @else
							    <option value="{{ $document_value->id }}">{{ $document_value->name }}</option>
							    @endif
							    @endforeach
							    </select>
							</div>
							<div class="form-group col-md-6">
						        <label for="student">Other Identity Name</label>
						        <input type="text" name="otherdocument" class="form-control" placeholder="Other Identity Name" value="{{ $student->otherdocument }}">
						    </div>

							<div class="form-group col-md-6">
						      	<label for="identity_number">Student Identity Number</label>
								<input type="text" name="identity_number" class="form-control" placeholder="Student Identity Number" value="{{ $student->identity_number }}">
							</div>

							<div class="form-group col-md-6">
						      	<label for="dob">Student Date Of Birth</label>
								<input type="date" name="dob" class="form-control" placeholder="Date Of Birth" value="{{ $student->dob }}">
							</div>

							<div class="form-group col-md-6">
						      	<label for="doaddmission">Student Addmission Date</label>
								<input type="date" name="doaddmission" class="form-control" placeholder="Student Addmission Date" value="{{ $student->doaddmission }}">
							</div>

              <div class="form-group col-md-6">
                    <label for="student_type">Student Type</label>
                      <select id="student_type" class="form-control" name="student_type">
                        <option value="" name="student_type" > Choose Student Type...</option>

                   @foreach($studentType as $key => $studentType_value)

                         <option value=" $studentType_value->id ">
                           {{ $studentType_value->name }}
                        </option>

                @endforeach


                      </select>
                  </div>
                        <div class="form-group col-md-6">
                <!-- <div class="course"> -->
                <label for="course_id">Select Course :</label>
                  <select id="course_id" class="form-control course" name="course_id[]" multiple>
                    <option name="course_id" value="course_id">Choose course...</option>
                    @foreach($courseData as $key=> $course_value)

                    <option value="{{ $course_value->id }}">{{ $course_value->name }}</option>

                      @endforeach
                    </select>
                <!-- </div> -->
              </div>

					    <div class="form-group col-md-6" style="display: inline-block;">
                  <label for="subject_id" name="subject_id">Select Subject</label><br>

                  <select id="subject_id" class="form-control subject" name="subject_id" multiple>
                      <option  name="subject_id" >Select subject...</option>
                    @foreach($subjectData as $key => $subject_value)
                  <!-- <input type="checkbox" name="subject_id[]" value ="{{ $subject_value->id }}" 
                  style="margin:12px;" />&nbsp;&nbsp;<label value="{{ $subject_value->id }}">{{ $subject_value->name }} -->
                  <option  value=" $subject_value->id ">
                           {{ $subject_value->name }}
                        </option>
                     </label><br>
                    @endforeach
                    </select>
                </div> 

				    <div class="form-group col-md-6">
				    	<div class="batch">
				          <label for="batch">Select Batch</label>
				            <select id="itiming_id" class="form-control" name="itiming_id[]" multiple>
{{--                                  @foreach ($student->student_batch as $key => $student_value)--}}
{{--                                      {{ $student_value->itiming->start_time }}&nbsp;to  {{ $student_value->itiming->end_time }}&nbsp;,&nbsp;--}}
{{--                                @endforeach--}}
				            @foreach($itimings as $key=> $itiming_value)
				            @foreach ($student->student_batch as $key => $student_value)
				            @if($student_value->batch_id == $itiming_value->id)
				            <option name = itiming_id[] value="{{ $itiming_value->id }}" selected>
                            {{--  {{ $itiming_value->start_time }}&nbsp;to&nbsp;{{ $itiming_value->end_time }}  --}}
                            @php echo date('h:i A', strtotime($itiming_value->start_time)) @endphp&nbsp;to&nbsp;
                            @php echo date('h:i A', strtotime($itiming_value->end_time)) @endphp</option>

                            @endif
                            @endforeach
                            <option name =itiming_id[] value="{{ $itiming_value->id }}">
                                @php echo date('h:i A', strtotime($itiming_value->start_time)) @endphp&nbsp;to&nbsp;
                                @php echo date('h:i A', strtotime($itiming_value->end_time)) @endphp
                            </option>
				            @endforeach
				            </select>
				        </div>
				    </div>
            <div class="form-group col-md-6">
                   <!-- <div class="fees"> -->
                  <label for="coursefee_id">Subject Fees :</label>

                    <select id="coursefee_id" class="form-control" name="coursefee_id[]" placeholder="Select Fees" multiple>
                    <option name="coursefee_id" >Choose Fees...</option>
                    @foreach ($coursefees as $key => $coursefee_value)
                    <option value=" $coursefee_value->id ">
                           {{ $coursefee_value->fees }}
                        </option>

                    @endforeach

                    </select>

                     <!-- </div> -->
                </div>
				    <div class="form-group col-md-4">
				    	<label for="session_id">Student Session</label>
				    	<select id="isession_id" class="form-control" name="isession_id">
                            @foreach($isessions as $key=> $session_value)
				            @if($student->isession_id == $session_value->id)
				            <option value="{{ $session_value->id }}" selected>{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>
				            @else
				            <option value="{{ $session_value->id }}">{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>
				            @endif
				            @endforeach
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="sub40wpm">Enter Student Session Year</label>
				        <input type="text" name="year" class="form-control" placeholder="Enter Session Year" value="{{ $student->year }}">
				    </div>

				    <div class="form-group col-md-6">
				    	<label for="student_img">Student Photo</label>
				    	<input type="file" name="student_img" class="form-control" onchange="previewFile(this)" value="{{ $student->student_img }}" value="{{asset('public/images')}}/{{ $student->student_img }}" />
				    	<img src="{{asset('public/images')}}/{{ $student->student_img }}" id="previewImg" name="student_img" alt="" style="max-width:130px;margin-top: 20px;" />
				    </div>

				    <div class="form-group col-md-6">
				    	<label for="identity_img">Student Identity Photo</label>
				    	<input type="file" name="identity_img" class="form-control"
				    	onchange="previewFileimg(this)" />
				    	<img src="{{asset('public/identitimages')}}/{{ $student->identity_img }}" id="previewImage" name="identity_img" alt="" style="max-width:130px;margin-top: 20px;"  />
				    </div>

				    <div class="form-group col-md-6">
				    	<label for="inputEmail4">Password</label>
				       <input type="password" class="form-control" name="password" placeholder="Password" id="myInput" value="{{ $student->user->show_password }}"/>
                    </div>

			        <div class="form-group col-md-6">
			        	<label for="inputEmail4">Confirm Password</label>
			                {{--  <input type="password" class="form-control" name="password" placeholder="Password" id="myInput1">  --}}
                            <input type="password" class="form-control" name="password_confirmation"  value="{{ $student->user->show_password }}"  id="myInput1" min="8">
                        </div>
                        <div class="form-group col-md-6">
                        <input type="checkbox" onclick="myFunction()">Show Password
                        </div>
			    </div>
			    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			    	<button type="submit" class="btn btn-dark">Submit</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('/js/scripts.js') }}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="{{ url('public/assets/js/select2.min.js') }}"></script>
    <script src="{{ url('public/assets/js/slim.min.js') }}"></script>
    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script>
      $("#single").select2({
          placeholder: "Select Course",
          allowClear: true
      });
      $("#course_id").select2({
          placeholder: "Select Course",
          allowClear: true
      });
    </script>

    <script>
      $("#single").select2({
          placeholder: "Select subject",
          allowClear: true
      });
      $("#subject_id").select2({
          placeholder: "Select subject",
          allowClear: true
      });
    </script>

    <script>

      $("#itiming_id").select2({
          placeholder: "Select Batch",
          allowClear: true
      });

    </script>

     <script>
      $("#single").select2({
          placeholder: "Select Fees",
          allowClear: true
      });
      $("#coursefee_id").select2({
          placeholder: "Select Fees",
          allowClear: true
      });
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

      <script>
      function previewFileimg(input)
      {
        var file = $("input[type=file]").get(1).files[0];
        if (file)
         {
          var reader = new FileReader();
          reader.onload = function()
          {
            $('#previewImage').attr("src",reader.result);
          }
            reader.readAsDataURL(file);
         }
      }

    </script>

    <script type="text/javascript">

        function myFunction() {
            var x = document.getElementById("myInput");
            var y = document.getElementById("myInput1");

            // console.log(x.type);

            if (x.type === "password" && y.type === "0.") {
              x.type = "text";
              y.type = "text";
            } else {
              x.type = "password";
              y.type = "password";
            }
          }

     window.onload =()=> {
       var student = document.getElementById('student_type');
       var course_id = document.getElementById('course_id');
       // console.log(student_type);
       student.onchange =()=>{
            // console.log(course_id);
       var formData = new FormData
           formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
           formData.append("student_type", student_type.value);
           // console.log(student_type.value);
           var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                  if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                  // console.log(response.status);
                if (response.status) {
                 // console.log(response.data);
                 // console.log(course_id.options.length=0);
                //  course_id.options.length=0;
                 for (var i = 0; i <= response.data.length; i++) {
                   // console.log(response.data[i].course_id);
                   //console.log(response.data.length);
                   var opt = document.createElement("option");
                   opt.innerText = response.data[i].course.name;
                   opt.value = response.data[i].course.id;
                   course_id.append(opt);
                   // console.log(opt);
                 }
                }
              }
            };

              xhttp.open("POST","{{ route('coursefilter') }}", true);
              xhttp.send(formData);
       }

         var course = document.getElementById('course_id')
         var subject_id = document.getElementById('subject_id');
         var student_type = document.getElementById('student_type');
        course.onchange =()=>{
        var course_id = [];
          $.each($(".course option:selected"), function(){
            course_id.push($(this).val());
        });

        // console.log(course_id);
          // console.log(course);
         var formData = new FormData
           formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
           formData.append("course", course_id);
           formData.append("student_type", student_type.value);
           // console.log(course.value);
           var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                  if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                  // console.log(response.status);
                if (response.status) {
                 // console.log(response.data);
                //  // console.log(course_id.options.length=0);
                //  subject_id.options.length=0;
                 for (var i = 0; i <= response.data.length; i++) {
                   // console.log(response.data[i].subject_id);
                   //console.log(response.data.length);

                   var opt = document.createElement("option");
                   opt.innerText = response.data[i].subject.name;
                   opt.value = response.data[i].subject_id;
                   subject_id.append(opt);
                   // console.log(opt);
                 }
                }
              }
            };

              xhttp.open("POST","{{ route('subjectfilter') }}", true);
              xhttp.send(formData);
         }

         var coursefee_id = document.getElementById('coursefee_id');
         var subject = document.getElementById('subject_id');
         var student_type = document.getElementById('student_type');
         var course_data = document.getElementById('course_id');

         subject.onchange =()=>{

          // console.log(subject);
        var subject_id = [];
          $.each($(".subject option:selected"), function(){
            subject_id.push($(this).val());
        });
           var formData = new FormData
           formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
           formData.append("subject", subject_id);
           formData.append("student_type", student_type.value);

           // formData.append("course_data", course_data.value);
           // formData.append("student_type", student_type.value);
           console.log(subject.value);
           var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                  if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                  // console.log(response.status);
                if (response.status) {
                 // console.log(response.data);
                 // console.log(course_id.options.length=0);
                //  coursefee_id.options.length=0;
                 for (var i = 0; i <= response.data.length; i++) {
                   // console.log(response.data[i].subject_id);
                   //console.log(response.data.length);
                   var opt = document.createElement("option");
                   opt.innerText = response.data[i].fees;
                   opt.value = response.data[i].fees;
                   coursefee_id.append(opt);
                   console.log(opt);
                 }
                }
              }
            };
              xhttp.open("POST","{{ route('feesfilter') }}", true);
              xhttp.send(formData);
     }
   }

</script>

@endpush
@endonce
