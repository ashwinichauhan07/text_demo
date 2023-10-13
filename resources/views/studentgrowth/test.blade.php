@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

@parent

@endsection

@section('content')
<main>
        <div class="container-fluid"><br><br>



              <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" style="font-weight: bold;">  {{$studdid->user->name}}   {{$studdid->father_name}} {{$studdid->lastname}}
                <a class="btn btn-dark" style="margin-left: 50em;"
                   href="{{ route('studentgrowth.index')}}">Back</a>
                </li>
            </ol>

                <div class="card mb-4">
                    <div class="card-header">
                    <i class="fas fa-table mr-1"> {{ $practise_name->name }} Result<br>

                      <br>



                    </i>

                    </div>

            <div class="col-xl-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Keyboard Practice Name</th>
                        <th>Accuracy</th>

                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($viewResult as  $key => $view_value)

                        <tr>

                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $view_value->created_at }}</td>
                            <td>{{ $view_value->keboardpractice->name }}</td>
                            <td>{{ $view_value->acc }}%</td>



                        </tr>
                             @endforeach

                    </tbody>


                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Keyboard Practice Name</th>
                        <th>Accuracy</th>

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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            window.onload = ()=> {
                var del = document.querySelectorAll(".delete");
                del.forEach(function(item, index) {
                    item.onclick = ()=> {
                        if (comfirm("Are you sure you want to delete it!")) {
                            return true;
                        }else {
                            return false;
                        }
                    }
                });
            }
        </script>

    @endpush
@endonce


