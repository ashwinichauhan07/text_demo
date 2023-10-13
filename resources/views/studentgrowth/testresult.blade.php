@extends('layouts.admin')

@section('title', 'Keyboard Practises')

@section('sidebar')

@parent

@endsection

@section('content')
<main>
        <div class="container-fluid">

              <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" style="font-weight: bold;"> {{$studid->user->name}}   {{$studid->father_name}} {{$studid->lastname}}
                <a class="btn btn-dark" style="margin-left: 50em;"
                   href="{{ route('studentgrowth.viewresult',1)}}">Back</a>

                </li>
            </ol>
                <div class="card mb-4">
                    <div class="card-header">
                    <i class="fas fa-table mr-1"> {{ $practise_name->name }} Result

                    </i>

                    </div>

            <div class="col-xl-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Typing Data</th>
                      <!--   <th>Time</th>
                        <th>Total Marks</th>
                        <th>Obtain Marks</th>
                        <th>Count Mistake</th> -->
                        <th>Accuracy</th>
                        <th>Result</th>
{{--                        <th>Count Length</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($result_data as  $key => $result_value)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $result_value->typingtest->typingdata }}</td>
                            <!-- <td>{{ $result_value->time }}</td>
                            <td>{{ $result_value->tmark }}</td>
                            <td>{{ $result_value->obtmark }}</td>
                            <td>{{ $result_value->countmistake }}</td> -->
                            <td>
                                @php
                                $acc = ($result_value->obtmark/$result_value->tmark)*100
                                @endphp
                                {{ $acc }} %
                            </td>
                            <td>

                                <form method="post" action="{{ route('studentgrowth.showtestresult') }}">

                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $studid->user_id }}">

                                    <input type="hidden" name="id" value="{{ $result_value->id }}">

                                    <input type="hidden" name="practise_type" value="{{ $result_value->practise_type }}">

                                {{--  <a class="btn btn-primary" href="{{ route('studentgrowth.showtestresult', $result_value->id) }}">  --}}

                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i></button>


                                </a>
                                </form>


                                </a>



                            </td>

{{--                            <td>{{ $result_value->countlength }}</td>--}}

                        </tr>
                             @endforeach

                    </tbody>


                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>Typing Data</th>
                       <!--  <th>Time</th>
                        <th>Total Marks</th>
                        <th>Obtain Marks</th>
                        <th>Count Mistake</th> -->
                        <th>Accuracy</th>
                        <th>Result</th>

{{--                        <th>Count Length</th>--}}
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
