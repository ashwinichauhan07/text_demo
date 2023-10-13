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
                <i class="fas fa-table mr-1"> Student Installment List </i>
                <a class="btn btn-dark" style="margin-left: 48em;" onclick="history.back()">Back</a> </li>

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
                    @foreach($data as $datainfo)
                     <tr>
                        <td>{{ $datainfo->id }}</td>
                    <td>

                        @if($datainfo->type == 1)

                       {{ $datainfo->amount }}

                        @endif
                    </td>
                     <td>
                        @if($datainfo->type == 1)

                        {{ $datainfo->installment_date }}

                        @endif

                    </td>
                    <td>@if($datainfo->mode == 1)
                           Cash
                         @elseif($datainfo->mode == 2)
                           Cheque

                           @elseif($datainfo->mode == 3)
                           Online

                           @endif
                          </td>



                         <td>
                            <form action="{{ route('studentinstallments.destroy',$datainfo->id) }}" method="POST">

                             <a href="{{ route('installment.receipt',$datainfo->id) }}" class="btn btn-dark" target="_blank">Print</a>
                             &nbsp;

                             <a class="btn btn-primary" href="{{ route('studentinstallments.edit',$datainfo->id) }}"><i class="fas fa-edit"></i></a><br><br>



                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>

                            </form>



                        </td>

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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

        <script type="text/javascript">
        	window.onload = ()=> {
        		var del = document.querySelectorAll(".delete");
        		del.forEach(function(item, index){
        			item.onclick = ()=> {
        				if (confirm("Are you sure you want to delete !")) {
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
