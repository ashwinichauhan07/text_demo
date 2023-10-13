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
            <li class="breadcrumb-item active">Student Details <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('students.index')}}">Back</a> </li>
             <a class="btn btn-dark" href="{{ route('pdf.form',$student->id)}}" style="margin-left: 1em;">Print</a>
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
                <div class="row">
                    <div class="form-group col-6">
                      <label for="studentName">Student Name :</label>
                        <p class="alert alert-success">
                            {{ $student->user->name }}  {{ $student->lastname }}
                        </p>
                </div>+
                    <div class="form-group col-6">
                      <label for="fatherName">Father Name :</label>
                        <p class="alert alert-success">
                            {{ $student->father_name }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="motherName">Mother Name :</label>
                        <p class="alert alert-success">
                            {{ $student->mother_name }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="phonenumber">Phone Number :</label>
                        <p class="alert alert-success">
                            {{ $student->student_mob }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="Email">Email :</label>
                        <p class="alert alert-success">
                            {{ $student->user->email }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="Gender">Gender :</label>
                        <p class="alert alert-success">
                            {{ (isset($student->gender) && $student->gender == 0) ? "Male" : "Female"}}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="Handicap">Handicap :</label>
                        <p class="alert alert-success">
                            {{ (isset($student->handicap->name) && $student->handicap->name == 0) ? $student->handicap->name : "" }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="Address">Address :</label>
                        <p class="alert alert-success">
                            {{ $student->address }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="School">School :</label>
                        <p class="alert alert-success">
                            {{ $student->school }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                        <label for="Education">Education :</label>
                        <p class="alert alert-success">
                            {{ $student->education }}
                        </p>
                    </div>
                    <div class="form-group col-6">
                      <label for="studentidentity">Student Identity :</label><p class="alert alert-success">
                        {{ $student->document->name }}
                    </p>
                </div>
                <div class="form-group col-6">
                  <label for="otheridentityname">Other Identity Name :</label><p class="alert alert-success">
                    {{ $student->otherdocument }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="studentidentitynumber">Student Identity Number :</label>
                <p class="alert alert-success">
                    {{ $student->identity_number }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="Studentdob">Student Date Of Birth :</label>
                <p class="alert alert-success">
                    {{ $student->dob }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="studentaddmissiondate">Student Addmission Date :</label>
                <p class="alert alert-success">
                    {{ $student->doaddmission }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="StudentCourse">Student Course :</label>
                <p class="alert alert-success">

                 @foreach ($student_course as $key => $course_value)
                      {{ $course_value->course->name }}&nbsp;,&nbsp;
                 @endforeach

            </div>
            <div class="form-group col-6">
                <label for="Studentsubject">Student Subject :</label>
                <p class="alert alert-success">
                 @foreach ($student_subject as $key => $subject_value)
                      {{ $subject_value->subject->name }}&nbsp;,&nbsp;
                 @endforeach
                </p>
            </div>
            <div class="form-group col-6">
                        <label for="student_type">Student Type :</label>
                        <p class="alert alert-success">
                        {{ $studentType_value->name }}
                        
                        </p>
                    </div>
            <div class="form-group col-6">
                <label for="StudentBatch">Student Batch :</label>
                <p class="alert alert-success">
                               @foreach ($itimingData as $data)
                               @php echo date('h:i A', strtotime($data->start_time)) @endphp&nbsp;to&nbsp;
                               @php echo date('h:i A', strtotime($data->end_time)) @endphp,
                               @endforeach
              </p>
            </div>
            <div class="form-group col-6">
                <label for="StudentFees">Student Fees :</label>
                <p class="alert alert-success">
                      {{ $student->coursefee_id }}

                      
                </p>
            </div>
            <div class="form-group col-6">
                <label for="Session">Session :</label>
                <p class="alert alert-success">
                    {{ $student->isession->month->month_name }}&nbsp;to&nbsp;
				    {{ $student->isession->monthname->month_name }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="StudentSessionYear">Student Session Year :</label>
                <p class="alert alert-success">
                    {{ $student->year }}
                </p>
            </div>
            <div class="form-group col-6">
                <label for="StudentPhoto">Student Photo :</label>
                <p class="alert alert-success">
                    <img src="{{asset('public/images')}}/{{ $student->student_img }}" id="previewImg" name="student_img" alt="" style="max-width:130px;margin-top: 20px;"/>
                </p>
            </div>
            <div class="form-group col-6">
                <label for="StudentIdentityPhoto">Student Identity Photo</label>
                <p class="alert alert-success">
                     <img src="{{asset('public/identitimages')}}/{{ $student->identity_img }}" id="previewImg" name="identity_img" alt="" style="max-width:130px;margin-top: 20px;"/>
                </p>
            </div>
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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
    @endpush
@endonce

