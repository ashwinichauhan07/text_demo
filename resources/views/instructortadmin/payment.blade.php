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
                <i class="fas fa-table mr-1"> {{ auth()->user()->name }} Payment Details</i>


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
                        <th>Payment Id</th>
                        <th>Payemnt</th>
                        <th>Payment Mode</th>
                        <th>Payment Date</th>
                   </tr>
                </thead>
                <tbody>@php $page =0; @endphp
                   @foreach($instructorPayment as $instructorpayment_data)
                   <tr>
                    <td>{{ $instructorpayment_data->id }}</td>
                    <td>{{ $instructorpayment_data->amount }}</td>
                    <td>{{ $instructorpayment_data->mode }}</td>
                    <td>{{ $instructorpayment_data->created_at }}</td>
                   </tr>
                  @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Payment Id</th>
                        <th>Payemnt</th>
                        <th>Payment Mode</th>
                        <th>Payment Date</th>
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
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
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
