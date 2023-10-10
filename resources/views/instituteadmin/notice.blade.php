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
            <li class="breadcrumb-item active" style="font-size: 25px; font-weight: 700;">Notice Send By Principle</li>
            {{-- {{ $data->sender }} --}}


        </ol>
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">

               <label style="font-size: 20px; font-weight: bold;width: 10%;">Subject :</label>
               <label style="font-size: 20px; ">{{ $data->subject }}</label>
               <br>
                <label style="font-size: 20px; font-weight: bold;width: 10%;">Message :</label>
                <label style="font-size: 20px; ">{{ $data->message }}</label>

        </div>

    </div>
                <!--  <a  style="margin-left: 65em;" href="{{ route('instituteadmin.dashboard') }}"><i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i></a>  -->

           <a class="btn btn-dark" href="{{ url()->previous() }}" class="btn btn-default"> <i class="fas fa-arrow-circle-left" style="font-size: 25px;"></i></a>
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
