@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Revenue </i>
                   <!--  <a href="" class="btn btn-dark float-right">Add Handicap</a> -->
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
                <div class="form-group col-md-4 " style="display: inline-block;">
                    <form>
                        <label for="name">Institute Name</label>

                        <select id="institute_id" class="form-control js-example-basic-single" name="name">
                            <option value="" name="name">Choose Institute Name...</option>

                            @foreach($instituteData as $key=> $institute_value)


                                <option value="{{ $institute_value->id }}">{{ $institute_value->name }}</option>


                            @endforeach
                        </select>


                </div>
                <div style="display: inline-block;">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>

                </form>
            <thead>
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Mobile No</th>
                <th>Email Id</th>
                <th>Active Subject</th>
{{--                <th>Dactive Subject</th>--}}
                <th>Session</th>
                <th>Year</th>
                <th>Admission Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($studentData as $key => $revenue_value)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $revenue_value->user->name }}</td>
                <td>{{ $revenue_value->student_mob }}</td>
                <td>{{ $revenue_value->user->email }}</td>
                <td>
                    @foreach($subject_payment as $key => $subvalue)
                        @if($revenue_value->id == $subvalue->student_id)

                        {{ $subvalue->subject->name }}
                        @endif
                    @endforeach

                </td>
{{--                <td>--}}
{{--                    @foreach($subject_payment as $key => $subvalue)--}}
{{--                        @if($revenue_value->id == $subvalue->student_id)--}}

{{--                            {{ $subvalue->subject->name }}--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

{{--                </td>--}}
                <td>{{ $revenue_value->isession->month->month_name }} to {{ $revenue_value->isession->monthname->month_name }}</td>
                <td>{{ $revenue_value->year }}</td>
                <td>{{ $revenue_value->doaddmission }}</td>

            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Mobile No</th>
                <th>Email Id</th>
                <th>Active Subject</th>
{{--                <th>Dactive Subject</th>--}}
                <th>Session</th>
                <th>Year</th>
                <th>Admission Date</th>
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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index){
                    item.onclick = ()=> {
                        if (confirm("Are you sure to delete it !")) {
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
