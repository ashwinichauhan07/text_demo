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
                <i class="fas fa-table mr-1">Deleted Student Installment List </i>
                <a class="btn btn-dark" style="margin-left: 48em;" href="{{ route('studentinfo.index')}}">Back</a> </li>

            </div>
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
                        <th>Receipt No</th>
                        <th>Installment</th>
                        <th>Payment Date</th>
                        <th>Mode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>@php $page =0; @endphp
                    @foreach($data as $receiptData)

                     <tr>
                        <td>{{ $receiptData->id }}</td>
                        <td>
                            @if($receiptData->type == 1)
                            {{ $receiptData->amount }}
                            @endif

                        </td>
                        <td>
                            @if($receiptData->type == 1)

                            {{ $receiptData->installment_date}}

                            @endif
                        </td>
                        <td>
                            @if($receiptData->mode == 1)
                            Cash
                            @elseif($receiptData->mode == 2)
                            Cheque
                            @elseif($datainfo->mode == 3)
                            Online

                            @endif
                        </td>

                <td><a href="{{ route('studentinfo.printreceipt', $receiptData->id) }}" class="btn btn-dark" target="_blank">Print</a></td>

                    </tr>
                    @endforeach
                    </tbody>


                    <tfoot>
                        <tr>
                        <th>No</th>
                        <th>Installment</th>
                        <th>Payment Date</th>
                        <th>Mode</th>
                        <th>Action</th>
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
    @endpush
@endonce
