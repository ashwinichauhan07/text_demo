@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')
<style>
  h1
  {
    text-align: center; 
    font-size: 30px;
    font-weight: 600; 
    background-color: gray;
    width: 100%;
  }
 .box{
      background-color:#2e2e1f;
      color: white;
      height: 50px;
      width: 50%;
      text-align: center;
      display: inline-block;
      margin-bottom: 2%;
      margin-left:3%;
      border-radius: 5px;
      font-size: 20px;
      padding-left: 1.5em;
      padding-right: 5em;
      margin-top: 30px;

    }
</style>

 <main>
                    <div class="container-fluid">

                       <br><br>
                       
                            <div class="card-header">
                              Student Admission Form
                              </a>
                            </div>

                            <!-- <div class="col-xl-12"> -->
                                
                                    <div class="card-body" style="text-align: center; margin-top: 3em;">
                                    <a class="btn btn-dark" href="{{ route('pdf.form') }}">Generate Admission Form</a>

                                       </div>
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
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
   
        <!-- <div class="row mt-4">
			<div class="col-xl-12">
                <div class="card mb-4">
                   <div class="card-body" style="background-color: #ffd11a;">
                    	<h1 style="color: red; font-size: 35px; text-align: center; font-weight: 600;">{{ auth()->user()->name }}</h1><br>
                    	<h3 style=" text-align: center; font-weight: 600; color: blue; font-size: 25px;">{{ $address }}</h3><br>
                    	<div>
                    	<div style="width: 100%; background-color: blue; color: white; border-radius: 10px; height: 30px; padding: 5px; text-align: center; font-weight: 700;" >
                    		<h2>Addmission Form</h2>
                    	</div>
                    </div>
                    <form>
                    <div class="whitebox">
                    	<div class="row">
					<input type="hidden" name="userType" value="3">
					<div class="form-group col-md-6">
						<label for="name"> Name</label>
							<input type="text" name="name" class="form-control" placeholder="Name">
					</div>
					<div class="form-group col-md-6">
						<label for="father_name">Father/Husband Name</label>
							<input type="text" name="father_name" class="form-control" placeholder="Father Name">
					</div>
					<div class="form-group col-md-6">
						<label for="mother_name">Mother Name</label>
							<input type="text" name="mother_name" class="form-control" placeholder="Mother Name">
					</div>
					<div class="form-group col-md-6">
						<label for="phone_no">Phone Number</label>
							<input type="text" name="phone_no" class="form-control" placeholder="Phone Number">
					</div>
					<div class="form-group col-md-6">
						<label for="email">Email</label>
							<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
                    </div>
                  </div>
              </form>
                   </div>
                  </div>
               </div>
           </div>
       </div> -->
  <!-- </main> -->   



    @endpush
@endonce