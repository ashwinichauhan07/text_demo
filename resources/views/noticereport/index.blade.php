@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Notice Reports</li>
    </ol>
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body">  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Enter Student User Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Student User Name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="fromdate">Select From Date</label>
                            <input type="date" name="fromdate" class="form-control" placeholder="dd/mm/yyyy" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="todate">Select to Date</label>
                            <input type="date" name="todate" class="form-control" placeholder="dd/mm/yyyy" value="">
                        </div>
                        <div class="mt-2">
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-info">Show</button>
                            </div> 
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-info">Delete</button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
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
                        <th><input type="checkbox" id="upper_check" onclick="check()"></th>
                        <th>Date</th>
                        <th>Student Name</th>
                        <th>Notice</th>
                        <th>Profile Photo</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($students as $student) 
                    <tr>
                        <td><input type="checkbox" name="user_id" value="" class="check"></td>
                        <td width="150px"></td>
                        <td width="150px">{{ $result_name }}</td>
                        <td width="450px">{{ $result_data }}</td>
                        <td><img src="{{asset('images')}}/{{ $student->student_img }}" style="width: 60%;"></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th><input type="checkbox" class="check"></th>
                        <th>Date</th>
                        <th>Student Name</th>
                        <th>Notice</th>
                        <th>Profile Photo</th>
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
       
    @endpush
@endonce