@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <main>
            <div class="container-fluid">

                <ol class="breadcrumb mb-4 mt-4">
                    <li class="breadcrumb-item active">Total Student </li>
                </ol>
                <div class="card mb-4">

                    <div class="col-xl-12">
                        <div class="card-body">

                            <form>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="session_id">Student Session</label>
                                        <select id="isession_id" class="form-control" name="isession_id">
                                            <option value="" name="isession_id" >Choose Sesssion...</option>

                                            @foreach($isessions as $key=> $session_value)

                                                <option value="{{ $session_value->id }}">{{ $session_value->month->month_name }}&nbsp;to&nbsp;{{ $session_value->monthname->month_name }}</option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="firstname">Enter Year</label>
                                        <input type="text" class="form-control" name="year" placeholder="Enter Year" value="">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-dark">Show Student</button>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="width: 150px;">Addmission Date </th>
                                <th>Student Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <!-- <th style="width: 150px;">Subjects</th> -->
                                <!-- <th>Profile Photo</th> -->
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->doaddmission }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ $student->lastname }}</td>

                                    </td>

                                    <td>

                                        <a href="{{ route('students.repeat',$student->id) }}" class="btn btn-dark">Repeat</a>
                                        <a href="{{ route('students.reappear',$student->id) }}" class="btn btn-dark">Reappear</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <th>Addmission Date </th>
                            <th>Student Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <!--  <th>Subjects </th> -->
                            <!-- <th>Profile Photo</th> -->
                            <th>Action</th>
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
                <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
 <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
                <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script> -
                <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                <script src="{{ url('public/chartJs/admin/datatables-demo.js') }}"></script>
                </script>

    @endpush
    @endonce
