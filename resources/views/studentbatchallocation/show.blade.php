@extends('layouts.demo')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

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
                    </div>

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
                        <label for="Address">Address :</label>
                        <p class="alert alert-success">
                            {{ $student->address }}
                        </p>
                    </div>

                    <div class="form-group col-6">
                        <label for="Education">Education :</label>
                        <p class="alert alert-success">
                            {{ $student->education }}
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
                <label for="StudentSessionYear">Student Session Year :</label>
                <p class="alert alert-success">
                    {{ $student->year }}
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
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
