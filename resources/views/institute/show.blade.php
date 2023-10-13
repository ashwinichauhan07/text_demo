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
            <li class="breadcrumb-item active">View Institute <a class="btn btn-dark" style="margin-left: 52em;" href="{{ route('institute.index') }}">Back</a> </li>
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
                    <div class="form-row">
                        <input type="hidden" name="userType" value="2">
                    <div class="form-group col-6">
                        <label for="instituteName">Institute Name</label>
                        <p class="alert alert-success">{{ $institute->user->name }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="instituteEmail">Institute Login ID</label>
                        <p class="alert alert-success">{{ $institute->user->email }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="PrincipleName">Principle Name</label>
                        <p class="alert alert-success">{{ $institute->principle_name }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="PrincipleMob">Principle Mobile</label>
                        <p class="alert alert-success">{{ $institute->principle_mob }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="PrincipleEmail">Principle Email</label>
                        <p class="alert alert-success">{{ $institute->principle_email }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="instituteaddress">Institute Address</label>
                        <p class="alert alert-success">{{ $institute->address }}</p>
                    </div>
                     <div class="form-group col-6">
                        <label for="StudentCourse">Institute Select Course :</label>
                        <p class="alert alert-success">
                            @foreach ($courseData as $data)
                                  {{ $data->name }} ,&nbsp;

                                 @endforeach

                         </p>
                  </div>
                    <div class="form-group col-6">
                        <label for="instituteaddress">Institute Start Time</label>
                        <p class="alert alert-success">{{ $institute->start_time }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="instituteaddress">Institute End Time</label>
                        <p class="alert alert-success">{{ $institute->end_time }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="instituteaddress">Total No Of PC In Institute</label>
                        <p class="alert alert-success">{{ $institute->pc }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="InstituteCode">Institute Code</label>
                        <p class="alert alert-success">{{ $institute->institute_code }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label for="InstituteLogo">Institute Logo</label>
                        <p class="alert alert-success">
                            <img src="{{asset('public/adminlogo')}}/{{ $institute->inst_logo }}" id="previewImg" name="inst_logo" alt="" style="max-width:130px;margin-top: 20px;"  />
                        </p>
                    </div>
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
