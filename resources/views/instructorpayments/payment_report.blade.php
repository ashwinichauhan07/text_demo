@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid">

    	 <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Instructor Payment Details</li>

                         </ol>
        <div class="card mb-4">

            <div class="col-xl-12">
                <div class="card-body">

                  <form>

                   	 <div class="form-row">

                   <div class="form-group col-md-6 ">
                <label for="name">Instructor Name</label>
                    <select id="instructor_id" class="form-control" name="name">
                    <option value="" name="name">Choose Instructor Name...</option>

                    @foreach($instructorData as $key=> $instructor_value)
                    @if($instructor_value->institute_id == auth()->id())

                    <option value="{{ $instructor_value->user->id }}">{{ $instructor_value->user->name }}</option>

                    @endif
                    @endforeach
                    </select>
               <!--  -->
              </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">Show Payment Details</button>
              </div>
                </div>
                </div>
                </form>
            </div>


            <div>


              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Mobile No</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $page =0; @endphp
          @foreach ($instructor as $instructor_value)
          <tr>
            <td>{{ $page += 1 }}</td>
            <td>{{ $instructor_value->user->name }}</td>
            <td>{{ $instructor_value->user->email }}</td>
            <td>{{ $instructor_value->phone_no }}</td>
            <td><a href="{{ route('instructorpayments.show', $instructor_value->id ) }}" class="btn btn-info"><i class="fa fa-info"></i></i></a>
                         &nbsp;&nbsp;<br><br></td>
          </tr>

          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Mobile No</th>
            <th>Action</th>
          </tr>
          </tfoot>
        </table>
      </div>
              <button onclick="goBack()"><i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i>






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
        <script src="{{ url('public/chartJs/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
         <script>
        function goBack() {
          window.history.back();
        }
        </script>

    @endpush
@endonce
