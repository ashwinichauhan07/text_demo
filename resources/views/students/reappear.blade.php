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
      <li class="breadcrumb-item active">Reappear Student Admission</li>

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
         @if ($message = Session::get('error'))
            <div class="alert alert-danger">
              <p>{{ $message }}</p>
            </div>
          @endif

           @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif


          <form action="{{ route('students.reappear_update',$student_reappear->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-row">
              <div class="form-group col-md-6">
                    <label for="firstname">First Name :</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="{{ $student_reappear->user->name }}" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="lastname">Last Name :</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Name" value="{{ $student_reappear->lastname }}" disabled>
                </div>


              <div class="form-group col-md-6">
                <label for="doaddmission">Date Of Addmission :</label>
                <input type="date" name="doaddmission" class="form-control" placeholder="Student Addmission Date" value="{{ $student_reappear->doaddmission }}">

              </div>

                <div class="form-group col-md-6">
                    <label for="student_type">Student Type</label>
                      <select id="student_type" class="form-control" name="student_type">
                       <option value="" name="isession_id" >Choose Sesssion...</option>

                    @foreach($studentType as $key=> $studentType_value)

                    @if($student_reappear->student_type == $studentType_value->id)

                    <option value="{{ $studentType_value->id }}" selected>{{ $studentType_value->name }}</option>

                    @else

                   <option value="{{ $studentType_value->id }}" >{{ $studentType_value->name }}</option>

                  @endif

                  @endforeach
                    </select>
                        </div>

              <div class="form-group col-md-6">
              <div class="course">
                  <label for="sub30wpm">Select Course</label>
                  <select id="course_id" class="form-control course" name="course_id[]" multiple>
                  <option name="course_id" value="course_id" selected disabled>
                    @foreach($student_course as $key=> $student_value)

                    {{ $student_value->course->name }},

                    @endforeach

                    </option>
                  </select>
                </div>
            </div>

            <div class="form-group col-md-6">
            <div class="subject">
                  <label for="subject_id">Select Subject</label>
                    <select id="subject_id" class="form-control subject" name="subject_id[]" multiple>
                    <option name="subject_id" value="subject_id" selected disabled>
                    @foreach($student_subject as $key=> $student_value)

                    {{ $student_value->subject->name }},&nbsp;

                    @endforeach

                    </option>

                    </select>
                </div>
            </div>

                 <div class="form-group col-md-6">
              <div class="batch">
                  <label for="batch">Select Batch</label>
                    <select id="itiming_id" class="form-control" name="itiming_id[]" multiple>
                      <option name="subject_id" value="subject_id">


                    @foreach($itimings as $key=> $itiming_value)

                    @foreach ($student_reappear->student_batch as $key => $student_value)

                    @if($student_value->batch_id == $itiming_value->id)

                    <option name = itiming_id[] value="{{ $itiming_value->id }}" selected>{{ $itiming_value->start_time }}&nbsp;to&nbsp;{{ $itiming_value->end_time }}</option>

                    @else

                    <option name =itiming_id[] value="{{ $itiming_value->id }}">{{ $itiming_value->start_time }}&nbsp;to&nbsp;{{ $itiming_value->end_time }}</option>

                    @endif

                    @endforeach

                    @endforeach

                    </select>
                </div>
            </div>

              <div class="form-group col-md-6">
              <div class="fees">
                    <label for="sub40wpm">Select Fees</label>
                    <select id="coursefee_id" class="form-control" name="coursefee_id[]" placeholder="Select batch" multiple>

                    <option name="coursefee_id" value="coursefee_id" selected disabled>
                                   {{ $student_reappear->coursefee_id }}

                    </option>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-6">
                  <label for="session_id">Select Session :</label>
                <select id="isession_id" class="form-control" name="isession_id">
                      <option value="" name="isession_id" >Choose Sesssion...</option>

                    @foreach($isessions as $key=> $session_value)

                    @if($student_reappear->isession_id == $session_value->id)

                   <option value="{{ $session_value->id }}" selected>{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>

                    @else

                    <option value="{{ $session_value->id }}">{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>

                  @endif

                  @endforeach
                    </select>
              </div>

                <div class="form-group col-md-6">
                  <label for="sub40wpm">Enter Session Year :</label>
                     <input type="text" name="year" class="form-control" placeholder="Enter Session Year" value="{{ $student_reappear->year }}">
                    </select>

            </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark create">Create Student</button>

              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-dark" href="{{ route('studentreport.index')}}" style="margin-left: 62em;"> <i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i></a>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script> -->


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
 -->    <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
      $("#single").select2({
          placeholder: "Select Batch",
          allowClear: true
      });
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
          $(document).ready(function() {
                $('#student_type').select2();


            });

           $(document).ready(function() {
                $('#isession_id').select2();


            });
       </script>



    <script type="text/javascript">


     window.onload =()=> {
       var student = document.getElementById('student_type');
       var course_id = document.getElementById('course_id');



       student.onchange =()=>{
            // console.log(course_id);
            // console.log(student.value);
       var formData = new FormData
           formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
           formData.append("student_type", student.value);
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
                 course_id.options.length=0;
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

        console.log(course_id);
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
                 // console.log(course_id.options.length=0);
                 subject_id.options.length=0;
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
                 coursefee_id.options.length=0;
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


      var create = document.querySelectorAll(".create");
            create.forEach(function(item, index) {
              item.onclick = ()=> {
                if (confirm("Are you want to create student")) {
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
